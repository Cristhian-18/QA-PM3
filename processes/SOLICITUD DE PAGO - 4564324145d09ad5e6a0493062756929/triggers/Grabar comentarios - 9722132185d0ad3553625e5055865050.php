<?php
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;

$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);
$rs_actual    = $rs['1'];
$rs_siguiente = $rs['2'];

$cnx                 = '1665078345d09b448804c01043460634';
$ticket 			 = @@APP_NUMBER;
$accion              = @@frm_accion;
$usr_uid_actual      = @@USER_LOGGED;
$comentario_operador = @@frm_comentario;
$fecha_inicio        = ($rs_actual['DEL_INIT_DATE'] != '') ? $rs_actual['DEL_INIT_DATE'] : '';
$fecha_fin           = ($rs_actual['DEL_FINISH_DATE'] != '') ? $rs_actual['DEL_FINISH_DATE'] :'';
$fecha_vencimiento   = ($rs_actual['DEL_TASK_DUE_DATE'] != '') ? $rs_actual['DEL_TASK_DUE_DATE'] :'';
$fecha_derivacion    = ($rs_actual['DEL_DELEGATE_DATE'] != '') ? $rs_actual['DEL_DELEGATE_DATE'] :'';

$usr_uid_receptor    = $rs_siguiente['USR_UID'];
$cod_accion          = @@frm_accion;

$sql = "INSERT INTO COM_BITACORA_SOLICITUD (
  ORDEN,
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
  COMENTARIO)
	values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$cod_accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario_operador')";
executeQuery($sql, $cnx);
@@frm_comentario = '';
@@frm_accion = '';
@@frm_chk_documento_label = 0;

if ($task_uid == '5180195355d09ae9847cc71098788842'){
@@frm_usuario_t1 = $usr_uid_actual;
}