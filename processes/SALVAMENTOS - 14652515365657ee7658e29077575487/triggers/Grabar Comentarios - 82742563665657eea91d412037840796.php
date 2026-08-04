<?php
//<?php
//created by Henry Bautista
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
	case '47793586864a1915c3740e7013393106':
		$comentario = 'Caso creado desde el Portal';
		$accion     = 'INGRESAR';
		$accion_label     = 'Crear Caso desde el Portal';
		break;
		//tarea 2 taller
	case '2814675986570f7b5d3d972036392492':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//TAREA 3
	case '3979529086570ecedcc4223046293199':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//Tarea 4
	case '6446626306570f675d06470042798562':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//Tarea 2.1 Analista
	case '7224080306570f8a5d63779009811615':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//Tarea 2.1 reasig taller
	case '7905287836570fda5db9121042838857':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//Tarea 2.1 Realizar Gestión Cliente
	case '8833405506570f765d25976060912095':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        case '8959308626570f82dd44967021489428':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            break;
            //Tarea 2.1 reasig taller
        case '9051008716570f9bde4c002056705244':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            break;
            //Tarea 2.1 Realizar Gestión Cliente
        case '9537609146570f625d0fd09043397372':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            break;
		//T2: Validar Información Siniestro - Comercial
	default:
		$comentario = '--';
		$accion = 'damisan';
		break;
}

@@tri_estado_evento = 1;
$cod_estado = @@tri_estado_evento;

$sql = "INSERT INTO  SINIESTRO_VH_BITACORA (
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


