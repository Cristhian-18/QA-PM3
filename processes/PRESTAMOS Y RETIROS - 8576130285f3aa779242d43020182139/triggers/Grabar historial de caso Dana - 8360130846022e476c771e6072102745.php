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

		$comentario = '--';
		$task_uid  = '9666398235f3aa81e583733020266160';
		$del_index           = 2;
		$accion     = @@frm_respuesta_cliente;
		$accion_label     = @@frm_respuesta_cliente;

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
