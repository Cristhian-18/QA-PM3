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
$rs_auth =  executeQuery($sql_cata_auth, $cnx_rp);

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
$msg_m_auth = '';
if(curl_errno($ch_auth)){
    $msg_m_auth = curl_error($ch_auth);
}
curl_close($ch_auth);
$rs_m_auth = json_decode($res_auth, true);


PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'GDA-CC-48', $dns_auth, 'POST', '', $json_auth, $rs_m_auth, $msg_m_auth);


$token='';
try
{
    if(!empty($rs_m_auth) && is_array($rs_m_auth) && count($rs_m_auth) > 0){
        foreach($rs_m_auth as $key => $data_auth){
            if($key == 'Token'){
                $token = $data_auth;
            }
        }
    }
}
catch(Exception $e)
{
    //aqui redirect al caso
    @@tri_mes_grbar = "ERROR: ".$msg;
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
    die();
}


$id_pv_cero = @@id_pv_cero;
//$id_pv = @@id_pv;
$id_pv = @@id_pv_cero;
$cod_aseg_cont = @@insuredCode;
$cod_aseg_pag = @@insuredPaymentCode;
$ind_conducto = @@ind_conducto;
if(@@frm_medio_pago == 'CTAAHO' || @@frm_medio_pago == 'CTACTE'){
    $tipo_conducto = '1';
    @@tipo_conducto = '1';
    $cod_bco_conducto = @@frm_entidad_financiera;
}else{
    $tipo_conducto = '2';
    @@tipo_conducto = '2';
    $cod_bco_conducto = @@frm_tipo_tarjeta;
}
$nro_cta_tarj = @@frm_numero_tarjeta;
$fecha_cadu = str_replace("/", "", @@frm_fecha_caducidad_tarjeta_label);
$aaaamm_vto_tarj = ($fecha_cadu == '' ? '19000101' : $fecha_cadu);
if(@@frm_medio_pago == 'CTAAHO')
$sn_cta_corriente = 0;
if(@@frm_medio_pago == 'CTACTE')
$sn_cta_corriente = '-1';
if(@@frm_medio_pago == 'TARJETA')
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
$filenameLetter = (@@urldoc == '' ? ' ': @@urldoc);
$policyLoanNumber = @@frm_concepto_pago;

$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_SAVE_CONDUIT'";
$rs =  executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$dns_d = $url;


$aVars = array(
    "idPvCero" => $id_pv_cero,
    "idPv" => $id_pv,
    "securedCodeCont" => $cod_aseg_cont,
    "securedCodePag" => $cod_aseg_pag,
    "indConduit" => $ind_conducto,
    "conduitType" => $tipo_conducto,
    "bankCodeConduit" => $cod_bco_conducto,
    "cardAccountNumber" => $nro_cta_tarj,
    "expirationCard" => $aaaamm_vto_tarj,
    "isCurrentAccount" => $sn_cta_corriente,
    "email" => $email,
    "cellPhone" => $telef_celular,
    "amount" => $imp_monto,
    "paymentFrequencyCode" => $cod_frec_pago,
    "conceptCode" => $cod_concepto,
    "isThirdPayment" => $sn_pago_tercero,
    "relationshipCode" => $cod_parentesco,
    "fteType" => $tipo_fte,
    "paymentDocType" => $paymentDocType,
    "paymentIdentification" => $paymentIdentification,
    "paymentLastname" => $paymentLastname,
    "paymentMiddlename" => $paymentMiddlename,
    "paymentNames" => $paymentNames,
    "paymentMail" => $paymentMail,
    "paymentCellphone" => $paymentCellphone,
    "codeConductoLast" => $codeConductoLast,
    "filenameCI" => $filenameCI,
    "filenameLetter" => $filenameLetter,
    "policyLoanNumber" => $policyLoanNumber
);
$json = json_encode($aVars);

//@@json = $json;

//print_r($json);
//die();
try{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $dns_d);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);

$msg = '';
if(curl_errno($ch)){
    $msg = curl_error($ch);
}
curl_close($ch);

$rs = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'GDA-CC-183', $dns_d, 'POST', 'Authorization', $json, $rs, $msg);


if(!empty($rs) && is_array($rs) && count($rs) > 0){
    foreach($rs as $data){

        $snProcess = $rs[0]->snProcess;


        if($snProcess == -1){
            @@motivo_proceso = $data->reason;
            @@tri_ban_spc6 = 'true';
        }else{
            //aqui redirect al caso
            @@tri_mes_grbar = $data->reason;
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
        }
    }
}
else{
    //aqui redirect al caso
    @@tri_mes_grbar = "ERROR: ".$msg;
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
}
} catch(Exception $e)
{
    $msg = 'Excepción capturada: '.$e->getMessage()."\n";
    @@tri_mes_grbar = limpiarCadena($msg);
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
}
