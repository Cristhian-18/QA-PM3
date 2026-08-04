<?php
//created by Henry Bautista
//20-08-2020
//Grabar historial de caso
try {


    @@tri_consultar_datos = '';

    $cnx = '11264850561d723f004d5c2072943786';
    $app_uid   = @@APPLICATION;
    $task_uid  = '746727803624e063116b8f7094625923';
    $del_index           = @@INDEX;
    $del_index_siguiente = @@INDEX + 1;

    $ticket              = @@APP_NUMBER;
    $usr_uid_actual      = @@USER_LOGGED;

    $fecha_inicio        = date('Y-m-d H:i:s');
    $fecha_fin           = date('Y-m-d H:i:s');
    $fecha_vencimiento   = date('Y-m-d H:i:s');;
    $fecha_derivacion    = date('Y-m-d H:i:s');;

    if (@@ajx_adjunta == 'SI') {
        $comentario = @@frm_comentario;
        $accion     = 'Adjuntos cliente';
        $accion_label     = 'Documento enviado por el cliente';
        //estado
        $estado = 'DOCUMENTO RECIBIDO';
    }

    if (@@ajx_adjunta != 'SI') {
        $comentario = 'Documentos no han sido enviados por el cliente'; // 'Documentos no han sido enviados por el cliente';
        $accion     =  'VENCIDO';
        $accion_label     = 'Documentos faltantes';
        //estado
        $estado = 'DOCUMENTO NO RECIBIDO';
    }

    $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
    $rs = executeQuery($sql, $cnx);


    $usr_uid_receptor    = 'SAC';
    $tas_uid_actual    = '799986505615f607b50a4f4033464318';
    $tarea_actual    = PMFGetTaskName('799986505615f607b50a4f4033464318', 'es');
    @@tri_estado_evento = 2;
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

    @@tri_bandera_cliente = 'true';

    @@tri_fecha_documentos = '';
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
