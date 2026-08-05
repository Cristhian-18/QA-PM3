<?php
//<?phpcreated by Henry
//29-08-2020
//Grabar Informacion SISE

$cnx = '8482936745f9583f22269b8093624807';
$cnx_rp = '9690765645f958391b6c2e8035729611';
$pro_uid = @@PROCESS;

@@tri_mes_grbar = '';

//obtengo el token
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_CU_GEN_TOKEN_AUTH'";
$rs_auth = executeQuery($sql_cata_auth, $cnx_rp);

$url_auth = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$dns_auth = $url_auth;

$aVars_auth = array(
    "userName" => "servicio_proveedores",
    "password" => "BQFkJJsh1;0VsHOS48y8"
);

$json_auth = json_encode($aVars_auth);

$ch_auth = curl_init();
curl_setopt($ch_auth, CURLOPT_URL, $dns_auth);
curl_setopt($ch_auth, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch_auth, CURLOPT_POSTFIELDS, $json_auth);
curl_setopt($ch_auth, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_auth, CURLOPT_FAILONERROR, true);
curl_setopt($ch_auth, CURLOPT_HTTPHEADER,
array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Accept-Language: application/json"
)
);
$res_auth = curl_exec($ch_auth);
if (curl_errno($ch_auth)) {
    $msg_m_auth = curl_error($ch_auth);
}
curl_close($ch_auth);
$rs_m_auth = json_decode($res_auth, true);

$token = '';
try
{
    if (!empty($rs_m_auth) && is_array($rs_m_auth) && count($rs_m_auth) > 0) {
        foreach ($rs_m_auth as $key => $data_auth) {
            if ($key == 'Token') {
                $token = $data_auth;
            }
        }
    }
}
catch (Exception $e)
{
    //aqui redirect al caso
    @@tri_mes_grbar = "ERROR: " . $msg_m_auth;
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
    die();
}

$id_pv_cero = @@id_pv_cero;
$id_pv = @@id_pv_cero;
$cod_aseg_cont = @@insuredCode;
$cod_aseg_pag = @@insuredPaymentCode;
$ind_conducto = @@ind_conducto;
if (@@frm_medio_pago == 'CTAAHO' || @@frm_medio_pago == 'CTACTE') {
    $tipo_conducto = '1';
    @@tipo_conducto = '1';
    $cod_bco_conducto = @@frm_entidad_financiera;
} else {
    $tipo_conducto = '2';
    @@tipo_conducto = '2';
    $cod_bco_conducto = @@frm_tipo_tarjeta;
}
$nro_cta_tarj = @@frm_numero_tarjeta;
$fecha_cadu = str_replace("/", "", @@frm_fecha_caducidad_tarjeta_label);
$aaaamm_vto_tarj = ($fecha_cadu == '' ? '19000101' : $fecha_cadu);
if (@@frm_medio_pago == 'CTAAHO')
    $sn_cta_corriente = 0;
if (@@frm_medio_pago == 'CTACTE')
    $sn_cta_corriente = '-1';
if (@@frm_medio_pago == 'TARJETA')
    $sn_cta_corriente = 0;

$email = @@frm_correo_electronico_poliza;
$telef_celular = @@frm_celular_poliza;
$imp_monto = @@frm_monto;
$cod_frec_pago = @@frm_frecuencia_pago;
$cod_concepto = @@frm_concepto_debito;
$sn_pago_tercero = (@@frm_pago_terceros == 'S' ? '-1' : '0');
$cod_parentesco = (@@frm_parentesco == '' ? '0' : @@frm_parentesco);
$tipo_fte = ((@@tri_ban_bpm == 'true' || @@tri_ban_sac == 'true') ? 2 : 1);
$paymentDocType = @@frm_tipo_identificacion_pagador;
$paymentIdentification = @@frm_cedula_pagador;
$paymentLastname = @@frm_apellidos_pagador;
$paymentMiddlename = @@frm_apellidos_pagador_m;
$paymentNames = @@frm_nombre_pagador;
$paymentMail = @@frm_correo_electronico_debito;
$paymentCellphone = @@frm_celular_debito;
$codeConductoLast = @@ind_conducto;
$filenameCI = (@@urlcedula == '' ? ' ' : @@urlcedula);
$filenameLetter = (@@urldoc == '' ? ' ' : @@urldoc);
$policyLoanNumber = @@frm_concepto_pago;

$sql_cata = "SELECT DESCRIPCION, VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_SAVE_CONDUIT'";
$rs = executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$apiKey = isset($rs['1']['VALOR']) ? $rs['1']['VALOR'] : '';

$body = array(
    "codigoScript" => "PIPECONTRACTOR_SAVECONDUIT",
    "codigoAplicacion" => "BPM_LURANA",
    "parametros" => array(
        "id_pv_cero" => (int) $id_pv_cero,
        "id_pv" => (int) $id_pv,
        "cod_aseg_cont" => (float) $cod_aseg_cont,
        "cod_aseg_pag" => (float) $cod_aseg_pag,
        "ind_conducto" => (int) $ind_conducto,
        "tipo_conducto" => (int) $tipo_conducto,
        "cod_bco_conducto" => (float) $cod_bco_conducto,
        "nro_cta_tarj" => (string) $nro_cta_tarj,
        "aaaamm_vto_tarj" => (float) $aaaamm_vto_tarj,
        "sn_cta_corriente" => (string) $sn_cta_corriente,
        "email" => (string) $email,
        "telef_celular" => (string) $telef_celular,
        "imp_monto" => (float) $imp_monto,
        "cod_frec_pago" => (string) $cod_frec_pago,
        "cod_concepto" => (string) $cod_concepto,
        "sn_pago_tercero" => (string) $sn_pago_tercero,
        "cod_parentesco" => (int) $cod_parentesco,
        "tipo_fte" => (int) $tipo_fte,
        "tipo_doc_pagador" => (string) $paymentDocType,
        "nro_doc_pagador" => (string) $paymentIdentification,
        "txt_apellido1_pag" => (string) $paymentLastname,
        "text_apellido2_pag" => (string) $paymentMiddlename,
        "txt_nombres_pag" => (string) $paymentNames,
        "email_pag" => (string) $paymentMail,
        "telef_celular_pag" => (string) $paymentCellphone,
        "cod_conducto_ant" => (float) $codeConductoLast,
        "txt_ubic_ci_pag" => (string) $filenameCI,
        "txt_ubic_cta_pag" => (string) $filenameLetter,
        "nro_pol_prest" => (float) $policyLoanNumber
    )
);
$json_body = json_encode($body);

$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer " . $token,
    "ApiKey: $apiKey"
);

try {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, false);
    $res = curl_exec($ch);
    $curl_error = curl_errno($ch) ? curl_error($ch) : '';
    curl_close($ch);

    PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Grabar informacion conducto', $url, 'POST', 'Auth ' . $token, $json_body, $res, $curl_error);

    if ($curl_error !== '') {
        // Error nuestro - fallo de comunicacion
        @@tri_mes_grbar = 'Error de servicio de consulta.';
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');

    } else {
        $rs = json_decode($res);

        if (!isset($rs->exitoso)) {
            // Error nuestro - formato inesperado
            @@tri_mes_grbar = 'Error de servicio de consulta.';
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');

        } elseif ($rs->exitoso !== true) {
            // Error de ELLOS - se muestra el mensaje que envia el servicio
            @@tri_mes_grbar = !empty($rs->errores)
                ? implode(' | ', (array) $rs->errores)
                : (isset($rs->mensaje) ? $rs->mensaje : 'Error al grabar informacion.');
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');

        } elseif (!empty($rs->datos) && is_array($rs->datos) && count($rs->datos) > 0) {
            foreach ($rs->datos as $data) {

                if ($data->snProcess == -1) {
                    @@motivo_proceso = $data->reason;
                    @@tri_ban_spc6 = 'true';
                } else {
                    //aqui redirect al caso
                    @@tri_mes_grbar = $data->reason;
                    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
                }
            }
        } else {
            //aqui redirect al caso
            @@tri_mes_grbar = "ERROR: No hay datos en la respuesta.";
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
        }
    }

} catch (Exception $e)
{
    $msg = 'Excepción capturada: ' . $e->getMessage() . "\n";
    @@tri_mes_grbar = limpiarCadena($msg);
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
}