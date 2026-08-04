<?php
//created by Henry Bautista
//20-08-2020
//Grabar historial de caso

$cnx = '4647520625f3ca6ed2d2621030136501';
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;

$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);
$rs_actual    = $rs['1'];
$rs_siguiente = $rs['2'];

$ticket 			 = @@APP_NUMBER;
$usr_uid_actual      = @@USER_LOGGED;

$fecha_inicio        = ($rs_actual['DEL_INIT_DATE'] != '') ? $rs_actual['DEL_INIT_DATE'] : '';
$fecha_fin           = date('Y-m-d H:i:s');
$fecha_vencimiento   = ($rs_actual['DEL_TASK_DUE_DATE'] != '') ? $rs_actual['DEL_TASK_DUE_DATE'] :'';
$fecha_derivacion    = ($rs_actual['DEL_DELEGATE_DATE'] != '') ? $rs_actual['DEL_DELEGATE_DATE'] :'';

$usr_uid_receptor    = $rs_siguiente['USR_UID'];

//validacion por tarea
switch(@@TASK){
    case '3344220625f3aa7f69c4e00045814586':
    $comentario = '--';
    $accion     = 'INGRESAR';
    $accion_label     = 'INGRESO DE LA SOLICITUD';
    break;
    case '9689281596036817a5a6ea4046452021':
    $comentario = '--';
    $accion     = 'REPROCESAR';
    $accion_label     = 'REPROCESO DE LA SOLICITUD';
    break;
    case '9666398235f3aa81e583733020266160':
    $comentario = '--';
    $task_uid  = '9666398235f3aa81e583733020266160';
    $del_index           = 2;
    $accion     = @@frm_respuesta_cliente;
    $accion_label     = @@frm_respuesta_cliente;
    break;
    case '8760052855f3aa896a9a815031066895':
    $comentario = @@frm_comentario;
    $accion     = @@cmb_accion_t3;
    $accion_label     = @@cmb_accion_t3_label;
    break;
    case '5567842745f3aa9ae5c6848018455054':
    $comentario = @@frm_comentario_t4;
    $accion     = @@cmb_accion_t4;
    $accion_label     = @@cmb_accion_t4_label;
    break;
    case '8163617725f3aa929732d82091255154':
    $comentario = @@frm_comentario_t5;
    $accion     = @@cmb_accion_t5;
    $accion_label     = @@cmb_accion_t5_label;
    break;
    case '4953250045f4ad54e93c1e8067311607':
    $comentario = @@frm_comentario_t6;
    $accion     = @@cmb_accion_t6;
    $accion_label     = @@cmb_accion_t6_label;
    break;
    case '1544916375f3aaa4eaec343054838090':
    $comentario = @@frm_comentario_t6_1;
    $accion     = @@cmb_accion_t6_1;
    $accion_label     = @@cmb_accion_t6_1_label;
    break;
    case '4690429745ff8d17e91a3c0064253813':
    $comentario = @@frm_comentario_t7;
    $accion     = @@cmb_accion_t7;
    $accion_label     = @@cmb_accion_t7_label;
    break;
    case '626536459676d86a2c16c48010240889':
    $comentario = @@frm_comentario_t30;
    $accion     = @@cmb_accion_t30;
    $accion_label     = @@cmb_accion_t30_label;
    break;
    case '42776573267ad7009927e90081631510':
    $comentario = @@frm_comentario_t4_1;
    $accion     = @@cmb_accion_t4_1;
    $accion_label     = @@cmb_accion_t4_1_label;
    @@tri_novedades_fidelizacion = 'true';
    break;

    default:
    $comentario = '--';
    break;
}

$sql = "INSERT INTO PR_BITACORA (
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
    COMENTARIO, ACCION)
    values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario','$accion_label')";

    $rs_i = executeQuery($sql, $cnx);
