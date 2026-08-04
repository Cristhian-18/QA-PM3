<?php
//@@frm_comentario = '';
//@@frm_comentario_label = '';
//created by Henry
//Consultar Siniestro Existente
//10-3-2022
try {
    $cnx = '11264850561d723f004d5c2072943786';
    $app_uid = @@APPLICATION;
    $pro_uid = @@PROCESS;
    $sql = "SELECT
    *
    FROM
    SINIESTRO_ESTADO
    WHERE APP_UID = '$app_uid'";

    $rs = executeQuery($sql, $cnx);

    $frm_id_stro = $rs['1']['id_stro'];
    $frm_cod_ramo_tec = $rs['1']['ramo_tec'];
    $frm_cod_subramo_tec = $rs['1']['subramo_tec'];
    $frm_cod_riesgo = $rs['1']['cod_riesgo'];
    $frm_ind_riesgo = $rs['1']['ind_riesgo'];
    $estado_evento = $rs['1']['estado_evento'];
    $estado_siniestro = $rs['1']['estado_siniestro'];

    $sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'SERVICIOS_WEB_S' AND CODIGO = 'CONSULTA_ESTADO'";
    $rs_d =  executeQuery($sql_cata, $cnx);
    $url = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
    $dns = $url;

    $aVars = array(
        "frm_id_stro" => $frm_id_stro,
        "frm_cod_ramo_tec" => $frm_cod_ramo_tec,
        "frm_cod_subramo_tec" => $frm_cod_subramo_tec,
        "frm_cod_riesgo" => $frm_cod_riesgo,
        "frm_ind_riesgo" => $frm_ind_riesgo
    );
    $json = json_encode($aVars);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $dns);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Accept-Language: application/json"
        )
    );

    $res = curl_exec($ch);
    $msg_m = '';
    if (curl_errno($ch)) {
        $msg_m = curl_error($ch);
    }
    curl_close($ch);

    $result = json_decode($res);
    
    PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'CSE-S-66', $dns, 'POST', '', $json, $result, $msg_m);
 
    $cod_estado_evento_result = $result->consulta5[0]->cod_estado_evento;
    $cod_estado_siniestro_result = $result->consulta5[0]->cod_estado_siniestro;
    @@tri_imp_monto_estimado = $result->consulta5[0]->imp_monto_estimado;
    @@tri_imp_monto_pagado = $result->consulta5[0]->imp_monto_pagado;
    $id_cns_stro_estado = $result->consulta5[0]->id_cns_stro_estado;
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
