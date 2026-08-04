<?php
//<?phpcreated by Henry Bautista
//20-08-2020
//Grabar historial de caso

$cnx = '934957180650c74e8ed0e10096114321';
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;
$cod_negativa = 0;
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
//validacion por tarea
switch (@@TASK){
		//tarea 1
	case '740162561655197380ad384031247515':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//tarea 2
	case '50943033965564504560f22042080521':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//TAREA 3
	case '4277893366551978809d333057141244':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//Tarea 4
	case '377721710655640a460c299063129585':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//Tarea 5
	case '7141911776551982811d1b6055417956':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;

	default:
		$comentario = '--';
		$accion = 'CONTINUAR';
		break;
}

@@tri_estado_evento = 1;
$cod_estado = @@tri_estado_evento;

$sql = "INSERT INTO  SINIESTRO_GN_BITACORA (
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
@@tmp_sql_com = $sql;
$rs_i = executeQuery($sql);



