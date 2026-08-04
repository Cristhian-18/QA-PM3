<?php
//<?phpcreated by Henry
//11-1-2021
//Generar Reserva SiSe
try{
    @@__ERROR__ = '';
    @@tri_id_stro = $result->id_stro;
    @@tri_nro_stro = '';
    @@tri_bandera_grabado = '';
    @@tri_message_grabado = '';

    $cnx_rp = '11264850561d723f004d5c2072943786';
    $pro_uid = @@PROCESS;

    //header
    $cod_suc = @@frm_sucursal;
    $cod_ramo = @@frm_ramo;
    $id_pv_fact = @@frm_id_pv;
    $id_pv_cero = @@frm_id_pv_cero;
    $fec_hora_reclamo = @@frm_fecha_ocurrencia;
    $fec_aviso = @@frm_fecha_notificacion;
    $fec_registro = date('Y-m-d');
    $fec_dciapol = date('Y-m-d');
    $nro_dcia = "";
    $cod_causa = @@frm_causa_siniestro;
    $cod_usuario = @@USR_USERNAME;
    $cod_evento = 1;
    $cod_causa_stro = 0;
    $cod_tipo_pago = (@@frm_tipo_pago == '' ? 0: @@frm_tipo_pago);
    $nro_crm = @@APP_NUMBER;
    $cod_tipo_siniestro = @@frm_tipo_siniestro;
    $imp_monto_reportado = @@frm_monto_reportado;
    $sn_mes_vencido = (@@frm_mes_vencido_label == 'true' ? -1 : 0);
    $cod_cobertura_madre = @@frm_cobertura_madre;
    $cod_diagnostico = (@@frm_diagnostico == '' ? 0 : @@frm_diagnostico);
    $cod_motivo_detenido = 1;
    $cod_usuario_autoriza = "DSAA";
    $fec_concesion_credito = (@@frm_fecha_concesion == '' ? '1999-01-01' : @@frm_fecha_concesion);
    $fec_vencimiento_credito = (@@frm_fecha_vencimiento == '' ? '1999-01-01' : @@frm_fecha_vencimiento);
    $cod_plazo_credito = (@@frm_plazo_credito == '' ? 0 : @@frm_plazo_credito);
    $cod_aseg = @@frm_cod_aseg;

    //detalle_cobertura
    $cod_ramo_tec = @@frm_cod_ramo_tec;
    $cod_subramo = @@frm_cod_subramo_tec;
    $ind_riesgo = @@frm_ind_riesgo;
    $cod_riesgo = @@frm_cod_riesgo;
    $cod_objeto = @@frm_cod_objeto;
    $cod_amparo = @@frm_cod_amparo;
    $cod_categ = @@frm_cod_categ;
    $cod_tercero = @@frm_cod_tercero;
    $cod_aseg = @@frm_cod_aseg;
    $nro_aseg = @@frm_nro_aseg;
    $nro_pariente = @@frm_nro_pariente;
    $imp_estimado = @@frm_monto_reportado;
    $cod_estado_siniestro= 1;
    $cod_estado_evento = 1;
    $imp_recl = 0;

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

 $msg_m = '';
    if(curl_errno($ch_auth)){
        $msg_m = curl_error($ch_auth);
    }

    PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'GRS-S-94', $dns_auth, 'POST', "Authorization", json_encode($json_auth), json_encode($res_auth), json_encode($msg_m));


if(curl_errno($ch_auth)){
    $msg_m_auth = curl_error($ch_auth);
    if(@@tri_bandera_web == ''){
        @@tri_message_grabado = $msg_m_auth;
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '645044310615f604fbf13b2086110376');
    }else{
        @@tri_message_grabado = $msg_m_auth;
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '107728664625e828b141b80070787980');
    }
}
curl_close($ch_auth);
$rs_m_auth = json_decode($res_auth, true);

$token='';
try
{
    if(count($rs_m_auth) > 0 && !empty($rs_m_auth)){
        foreach($rs_m_auth as $key => $data_auth){
            if($key == 'Token'){
                $token = $data_auth;
            }
        }
    }
}
catch(Exception $e)
{
    if(@@tri_bandera_web == ''){
        @@tri_message_grabado = $result->Message;
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '645044310615f604fbf13b2086110376');
    }else{
        @@tri_message_grabado = $result->Message;
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '107728664625e828b141b80070787980');
    }
}


$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'SERVICIOS_WEB_S' AND CODIGO = 'GRABAR_SINIESTRO'";
$rs =  executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$dns = $url;

$header_stro['siniestro']["cabecera_siniestro"] = array(
    "cod_suc" => $cod_suc,
    "cod_ramo" => $cod_ramo,
    "id_pv_fact" => $id_pv_fact,
    "id_pv_cero" => $id_pv_cero,
    "fec_hora_reclamo" => $fec_hora_reclamo,
    "fec_aviso" => $fec_aviso,
    "fec_registro" => $fec_registro,
    "fec_dciapol" => $fec_dciapol,
    "nro_dcia" => $nro_dcia,
    "cod_causa" => $cod_causa,
    "cod_usuario" => $cod_usuario,
    "cod_evento" => $cod_evento,
    "cod_causa_stro" => $cod_causa_stro,
    "cod_tipo_pago" => $cod_tipo_pago,
    "nro_crm" => $nro_crm,
    "cod_tipo_siniestro" => $cod_tipo_siniestro,
    "imp_monto_reportado" => $imp_monto_reportado,
    "sn_mes_vencido" => $sn_mes_vencido,
    "cod_cobertura_madre" => $cod_cobertura_madre,
    "cod_diagnostico" => $cod_diagnostico,
    "cod_motivo_detenido" => $cod_motivo_detenido,
    "cod_usuario_autoriza" => $cod_usuario_autoriza,
    "fec_concesion_credito" => $fec_concesion_credito,
    "fec_vencimiento_credito" => $fec_vencimiento_credito,
    "cod_plazo_credito" => $cod_plazo_credito,
    "cod_aseg" => $cod_aseg,
    "nro_casoBpm" => $nro_crm
);

if(@@grd_coberturas['1']['grd_txt_desc_riesgo'] != '' ){
    $i=1;
    $j=1;
    foreach(@=grd_coberturas as $datagrid_cober){
        if($datagrid_cober['grd_txt_aplicar'] == 'SI' && $datagrid_cober['grd_txt_valor'] != ''){
            $cod_ramo_tec = $datagrid_cober['grd_cod_ramo_tec'];
            $cod_subramo = $datagrid_cober['grd_cod_subramo_tec'];
            $ind_riesgo = $datagrid_cober['grd_ind_riesgo'];
            $cod_riesgo = $datagrid_cober['grd_cod_riesgo'];
            $cod_objeto = $datagrid_cober['grd_cod_objeto'];
            $cod_amparo = $datagrid_cober['grd_cod_amparo'];
            $cod_categ = $datagrid_cober['grd_cod_categ'];
            $cod_tercero = $datagrid_cober['grd_cod_tercero'];
            $cod_aseg = $datagrid_cober['grd_cod_aseg'];
            $nro_aseg = $datagrid_cober['grd_nro_aseg'];
            $nro_pariente = $datagrid_cober['grd_nro_pariente'];
            if(@@tri_bandera_web == '')
            $imp_estimado = $datagrid_cober['grd_txt_valor'];
            else
            $imp_estimado = $datagrid_cober['grd_txt_valor_aprobado'];
            if($j == 1){
                $header_stro['siniestro']['aseguradoStro']['detalle_cobertura'] = array(array(
                    "cod_ramo_tec" => $cod_ramo_tec,
                    "cod_subramo" => $cod_subramo,
                    "ind_riesgo" => $ind_riesgo,
                    "cod_riesgo" => $cod_riesgo,
                    "cod_objeto" => $cod_objeto,
                    "cod_amparo" => $cod_amparo,
                    "cod_categ" => $cod_categ,
                    "cod_tercero" => $cod_tercero,
                    "cod_aseg" => $cod_aseg,
                    "nro_aseg" => $nro_aseg,
                    "nro_pariente" => $nro_pariente,
                    "imp_estimado" => $imp_estimado,
                    "cod_estado_siniestro" => $cod_estado_siniestro,
                    "cod_estado_evento" => $cod_estado_evento,
                    "imp_recl" => $imp_recl)
                );
                $j++;
            }else{
                $header_stro_cober = array(
                    "cod_ramo_tec" => $cod_ramo_tec,
                    "cod_subramo" => $cod_subramo,
                    "ind_riesgo" => $ind_riesgo,
                    "cod_riesgo" => $cod_riesgo,
                    "cod_objeto" => $cod_objeto,
                    "cod_amparo" => $cod_amparo,
                    "cod_categ" => $cod_categ,
                    "cod_tercero" => $cod_tercero,
                    "cod_aseg" => $cod_aseg,
                    "nro_aseg" => $nro_aseg,
                    "nro_pariente" => $nro_pariente,
                    "imp_estimado" => $imp_estimado,
                    "cod_estado_siniestro" => $cod_estado_siniestro,
                    "cod_estado_evento" => $cod_estado_evento,
                    "imp_recl" => $imp_recl);
                    array_push($header_stro['siniestro']['aseguradoStro']['detalle_cobertura'],$header_stro_cober);
                }
            }
            $i++;
        }
    }
    print_r($header_stro);
    if(@@grd_beneficiarios['1']['grd_codigo_b'] != '' ){
        foreach(@=grd_beneficiarios as $datagrid){
            $nro_beneficiario = $datagrid['nro_benef'];
            $cod_parentesco = $datagrid['cod_parentesco'];
            $txt_apellido1 = $datagrid['txt_apellido1'];
            $txt_apellido2 = $datagrid['txt_apellido2'];
            $txt_nombre = $datagrid['txt_nombre'];
            $cod_leyenda = $datagrid['cod_leyenda'];
            $pje_partic = $datagrid['pje_partic'];
            $cod_tipo_doc = $datagrid['cod_tipo_doc'];
            $txt_documento = $datagrid['txt_documento'];
            $cod_tipo_persona = $datagrid['cod_tipo_persona'];

            $header_stro['siniestro']['aseguradoStro']['beneficiariosStro'] = array(array(
                "nro_benef" => $nro_beneficiario,
                "cod_parentesco" => $cod_parentesco,
                "txt_apellido1" => $txt_apellido1,
                "txt_apellido2" => $txt_apellido2,
                "txt_nombre" => $txt_nombre,
                "cod_leyenda" => $cod_leyenda,
                "pje_partic" => $pje_partic,
                "cod_tipo_doc" => $cod_tipo_doc,
                "txt_documento" => $txt_documento,
                "cod_tipo_persona" => $cod_tipo_persona)
            );
        }
    }
    if(@@frm_tipo_asegurado == 'O'){
        $nro_doc = @@frm_documento_fallecido;
        $cod_tipo_doc = @@frm_tipo_documento_fallecido;
        $txt_apellido1 = @@frm_apellido_paterno_fallecido;
        $txt_apellido2 = @@frm_apellido_materno_fallecido;
        $txt_nombre = @@frm_nombres_fallecido;
        $cod_parentezco_stro = @@frm_parentesco_fallecido;

        $header_stro['siniestro']['aseguradoStro']['dependienteStro'] = array(array(
            "nro_doc" => $nro_doc,
            "cod_tipo_doc" => $cod_tipo_doc,
            "txt_apellido1" => $txt_apellido1,
            "txt_apellido2" => $txt_apellido2,
            "txt_nombre" => $txt_nombre,
            "cod_parentezco_stro" => $cod_parentezco_stro)
        );
    }

    $json_stro = json_encode($header_stro);
    @@send_json = $json_stro;


    try{

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $dns);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_stro);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Accept-Language: application/json",
            "Authorization: Bearer ". $token
        )
    );

    $res = curl_exec($ch);

    if(curl_errno($ch)){
        $msg_m = curl_error($ch);
    }
    curl_close($ch);

    $result = json_decode($res);

  PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Guardar documentos MFILES', $dns, 'POST', "Authorization: Bearer ". $token, $json_stro, $result, $msg_m);


    @@result_grabado = $result;

    if(isset($result->isError) && $result->isError === false && isset($result->errorNumber) && $result->errorNumber == 0)
    {
        @@tri_id_stro = $result->id_stro;
        @@tri_nro_stro = $result->nro_stro;
        @@tri_bandera_grabado = 'true';
        @@frm_fecha_reserva = date('Y-m-d');
    }else{
        if(@@tri_bandera_web == ''){
            @@tri_message_grabado = $result->Message;
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '645044310615f604fbf13b2086110376');
        }else{
            @@tri_message_grabado = $result->Message;
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '107728664625e828b141b80070787980');
        }
    }

}catch(Exception $e)
{
    if(@@tri_bandera_web == ''){
        @@tri_message_grabado = $result->Message;
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '645044310615f604fbf13b2086110376');
    }else{
        @@tri_message_grabado = $result->Message;
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '107728664625e828b141b80070787980');
    }

}

} catch (Exception $e) {
    $errorMessage =  $e->getMessage();
}

