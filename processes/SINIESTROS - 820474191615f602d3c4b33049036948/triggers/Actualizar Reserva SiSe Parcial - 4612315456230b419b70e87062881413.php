<?php
//created by Henry
//11-1-2021
//Actualizar Reserva SiSe Parcial
@@__ERROR__ = '';
@@tri_bandera_update = '';
@@tri_message_update = '';
try{
    $cnx_rp = '11264850561d723f004d5c2072943786';
    $pro_uid = @@PROCESS;

    //header
    $cod_suc = @@frm_sucursal;
    $cod_ramo = @@frm_ramo;
    $id_pv_fact = @@frm_id_pv;
    $id_pv_cero = @@frm_id_pv_cero;
    $fec_hora_reclamo = @@frm_fecha_ocurrencia_auditor;
    $fec_aviso = @@frm_fecha_notificacion;
    $fec_registro = date('Y-m-d');
    $fec_dciapol = date('Y-m-d');
    $nro_dcia = "";
    $cod_causa = @@frm_causa_siniestro;
    $cod_usuario = (@@USR_USERNAME == 'ycordova') ? 'ycordova1' : @@USR_USERNAME;
    $cod_evento = 1;
    $cod_causa_stro = 0;
    $cod_tipo_pago = (@@frm_tipo_pago == '' ? 0: @@frm_tipo_pago);
    $nro_crm = @@APP_NUMBER;
    $cod_tipo_siniestro = @@frm_tipo_siniestro;
    $imp_monto_reportado = @@frm_monto_reportado;
    $sn_mes_vencido = (@@frm_mes_vencido_label == 'true' ? 1 : 0);
    $cod_cobertura_madre = @@frm_cobertura_madre;
    //$cod_diagnostico = (@@frm_diagnostico == '' ? 0 : @@frm_diagnostico);
    $cod_diagnostico = 0;
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
    $imp_estimado = @@frm_monto_liquidar;
    $id_stro = @@tri_id_stro;
    if(@@frm_accion == 'NEGAR' || @@frm_accion == 'NO_PROCEDER'){
        $cod_estado_siniestro= 3;
        $cod_estado_evento = 4;
        @@cod_estado_evento = $cod_estado_evento;
        $marca_stro = 2;
        $imp_estimado = 0;
        if(@@tri_bandera_alcance == 'ALCANCE'){
            $imp_estimado = @@frm_monto_pagado_al;
            $marca_stro = 4;
        }
        @@frm_monto_liquidar = 0;
    }else{
        if(@@frm_accion == 'APROBAR'){
            $cod_estado_siniestro= 2;
            $cod_estado_evento = 7;
            @@cod_estado_evento = $cod_estado_evento;
            if(@@frm_monto_reportado == @@frm_monto_liquidar){
                $marca_stro = 4;
            }else{
                $marca_stro = 2;
            }
        }
    }
    $imp_recl = 0;


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
        "nro_casoBpm" => $nro_crm,
        "id_stro" => $id_stro,
        "marca_stro" => $marca_stro
    );

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
    @@send_json_up = $json_stro;

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
            "Accept-Language: application/json"
        )
    );

    $res = curl_exec($ch);

    if(curl_errno($ch)){
        $msg_m = curl_error($ch);
    }
    curl_close($ch);

    $result = json_decode($res);

    PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Actualizar reserva sise parcial', $dns, 'POST', 'NO', json_encode($json_stro), json_encode($result), $msg_m);

    @@result_update = $result;

    if(isset($result->isError) && $result->isError === false && isset($result->errorNumber) && $result->errorNumber == 0)
    {
        @@tri_id_stro_up = $result->id_stro;
        @@tri_nro_stro_up = $result->nro_stro;
        @@tri_bandera_update = 'true';
    }else{
        @@tri_message_update = $result->Message;

        if(@@TASK == '309930261615f607b901f74034966395'){
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '19704822661d89a84dc5eb6067966042');
        }
        else{
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '76587094661da3be8a7b6b9083070571');
        }
    }

}catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    @@tri_message_update = 'ExcepciÃƒÂ³n capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    if(@@TASK == '309930261615f607b901f74034966395'){
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '19704822661d89a84dc5eb6067966042');
    }
    else{
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '76587094661da3be8a7b6b9083070571');
    }

}

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

}

