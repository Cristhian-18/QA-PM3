<?php
//<?phpcreated by Henry Bautista
//20-08-2020
//Grabar historial de caso

$cnx = '20319743365221e1e6bd6c7053940577';
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;
$cod_negativa = 0;
@@tri_bandera_msg  = 'false';

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
	case '47159097865216c17422f85064227461':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		if($accion == 'FINALIZAR'){
			@@frm_caso_estado = "FINALIZADO";
			//$sql = "UPDATE SINIESTRO_REGISTRADO SET usr_auditor = '$usr_uid_receptor' WHERE app_uid = '$app_uid'";
			//$rs = executeQuery($sql, $cnx);
		} else if ($accion == 'CONTINUAR'){
			@@frm_caso_estado = "EN PROCESO";
		} else if ($accion == 'REVISAR'){
			@@frm_caso_estado = "REVISADO";
		}
		//estado del flujo catalogo ESTADO_EVENTO
		//@@tri_estado_evento = 1;
		$cod_estado = @@frm_caso_estado;
		break;
		//tarea 2
	case '17077449865216c3f3d71e5057347607':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		$cod_estado = @@tri_estado_evento;
		if($accion == 'REGRESAR'){
			@@tri_bandera_msg  = 'true';
		}
		break;
		//tarea 3
	case '27724906265216c8f395922053571348':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		$cod_estado = @@tri_estado_evento;
		if($accion == 'REGRESAR'){
			@@tri_bandera_msg  = 'true';
		}
		break;
	default:
		$comentario = 'COMENTARIO BPM';
		$accion = 'CONTINUAR';
		break;
}

$sql = "INSERT INTO certificacion.EMISIONES_MOVIMIENTOS_BITACORA (
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



