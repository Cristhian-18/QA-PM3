<?php
//created by Henry
//11-01-2021
//Guardar Estado de Siniestro
try{
    $cnx = '11264850561d723f004d5c2072943786';

    $app_uid   = @@APPLICATION;
    $task_uid  = @@TASK;
    $ticket 			 = @@APP_NUMBER;
    $usr_uid_pda      = @@USER_LOGGED;
    $id_stro = intval(@@tri_id_stro);
    $nro_stro = intval(@@tri_nro_stro);
    $ramo_tec = intval(@@frm_cod_ramo_tec);
    $subramo_tec = intval(@@frm_cod_subramo_tec);
    $cod_riesgo = intval(@@frm_cod_riesgo);
    $ind_riesgo = intval(@@frm_ind_riesgo);
    $estado_evento = 1;
    $estado_siniestro = 1;
    @@tri_estado_evento = $estado_evento;
    @@tri_estado_siniestro = $estado_siniestro;
    $monto_estimado = 0;
    $monto_pagado = 0;

    $sql = "INSERT INTO SINIESTRO_ESTADO (
        app_uid,
        app_number,
        id_stro,
        nro_stro,
        ramo_tec,
        subramo_tec,
        cod_riesgo,
        ind_riesgo,
        estado_evento,
        estado_siniestro,
        monto_estimado,
        monto_pagado,
        usr_uid_pda
    )
    VALUES
    (
        '$app_uid',
        '$ticket',
        '$id_stro',
        '$nro_stro',
        '$ramo_tec',
        '$subramo_tec',
        '$cod_riesgo',
        '$ind_riesgo',
        '$estado_evento',
        '$estado_siniestro',
        '$monto_estimado',
        '$monto_pagado',
        '$usr_uid_pda'
    )

    ";

    $rs = executeQuery($sql, $cnx);

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

   
}
