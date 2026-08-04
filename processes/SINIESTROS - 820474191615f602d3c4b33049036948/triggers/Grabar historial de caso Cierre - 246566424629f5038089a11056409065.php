<?php
//created by Henry Bautista
//20-08-2020
//Grabar historial de caso
try {
    $cnx = '11264850561d723f004d5c2072943786';
    $app_uid   = @@APPLICATION;
    $task_uid  = '5738766796298c3a3e33a08031379834';
    $del_index           = @@INDEX;
    $del_index_siguiente = @@INDEX + 1;

    $ticket              = @@APP_NUMBER;
    $usr_uid_actual      = @@USER_LOGGED;

    $fecha_inicio        = date('Y-m-d H:i:s');
    $fecha_fin           = date('Y-m-d H:i:s');
    $fecha_vencimiento   = date('Y-m-d H:i:s');
    $fecha_derivacion    = date('Y-m-d H:i:s');

    $usr_uid_receptor    = 'TECNICO';
    $tas_uid_actual    = '5738766796298c3a3e33a08031379834';
    $tarea_actual    = PMFGetTaskName('5738766796298c3a3e33a08031379834', 'es');
    $cod_estado = @@tri_estado_evento;

    //validacion por tarea

    $sql = "INSERT INTO SINIESTRO_BITACORA (
        APP_NUMBER,
        APP_UID,
        TASK_UID,
        FECHA_INICIO,
        FECHA_FIN,
        FECHA_DERIVACION,
        FECHA_VENCIMIENTO,
        DEL_INDEX,
        COD_ACCION,
        USR_UID_ACTUAL,
        USR_UID_RECEPTOR,
        COMENTARIO, ACCION, COD_NEGATIVA, COD_ESTADO)
        values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario','$accion_label', '$cod_negativa','$cod_estado')";

    $rs_i = executeQuery($sql, $cnx);
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
