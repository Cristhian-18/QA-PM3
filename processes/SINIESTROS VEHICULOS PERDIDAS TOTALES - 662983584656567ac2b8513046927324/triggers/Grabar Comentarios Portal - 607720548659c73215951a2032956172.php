<?php
//<?php
//created by Henry Bautista
//20-08-2020
//Grabar historial de caso



 
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
/*$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;
*/
$del_index           = 0;
$del_index_siguiente = 1;
$cod_negativa = 0;
@@frm_accion_aux  = '';
@@frm_accion_aux  = @@frm_accion;


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
$tas_uid_actual    = $rs_siguiente['TAS_UID'];
$tarea_actual    = PMFGetTaskName($rs_siguiente['TAS_UID'],'es');

@@tmp_entra = @@TASK;

		$comentario = @@frm_comentario;
		$accion     = 'INGRESAR';
		$accion_label     = 'Crear Caso desde el Portal';

@@tri_estado_evento = 1;
$cod_estado = @@tri_estado_evento;

$sql = "INSERT INTO certificacion.SINIESTRO_VH_BITACORA_TOTAL (
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
	values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', UPPER('$comentario'),'$accion_label', '$cod_negativa','$cod_estado')";

@@tmp_sql_com = $sql;
$rs_i = executeQuery($sql);

