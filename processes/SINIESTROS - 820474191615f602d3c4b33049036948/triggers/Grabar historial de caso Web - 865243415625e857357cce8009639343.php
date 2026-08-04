<?php
//created by Henry Bautista
//20-08-2020
//Grabar historial de caso
try{

    @@tri_consultar_datos='';

    $cnx = '11264850561d723f004d5c2072943786';
    $app_uid   = @@APPLICATION;
    $task_uid  = @@TASK;
    $del_index           = @@INDEX;
    $del_index_siguiente = @@INDEX+1;

    $ticket 			 = @@APP_NUMBER;
    $usr_uid_actual      = 'Web';

    $fecha_inicio        = date('Y-m-d H:i:s');
    $fecha_fin           = date('Y-m-d H:i:s');
    $fecha_vencimiento   = date('Y-m-d H:i:s');;
    $fecha_derivacion    = date('Y-m-d H:i:s');;

    $usr_uid_receptor    = 'SAC';
    $tas_uid_actual    = '799986505615f607b50a4f4033464318';
    $tarea_actual    = PMFGetTaskName('799986505615f607b50a4f4033464318','es');
    $cod_estado = @@tri_estado_evento;

    //validacion por tarea

    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;


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
        values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario','$accion_label', '$cod_negativa', '$cod_estado')";

        $rs_i = executeQuery($sql, $cnx);
    } catch (Exception $e) {

        $errorMessage =  $e->getMessage();


    }
