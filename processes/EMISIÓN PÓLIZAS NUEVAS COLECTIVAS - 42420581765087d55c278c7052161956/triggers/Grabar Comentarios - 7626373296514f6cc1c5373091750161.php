<?php
//<?phpcreated by Henry Bautista
//20-08-2020
//Grabar historial de caso

$cnx = '6897140966514f7293404b5050866175';
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
	case '48360598365087da6d339e4002983703':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
		//tarea 1
	case '520685045654466e9133299029687429':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
		//tarea 2
	case '22042344565087da6e310f3013718832':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		//tarea 2 Aprobar caso C
	case '31382453465260bfbf23736093595618':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//tarea 3
	case '37352285165139885e35c51082282227':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
        //tarea 3.1 C
    case '174823200651f71be01d385069925432':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
        //tarea 3.1 T
    case '254263135652f47a1e1f370017901618':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
		//tarea 4 t
	case '646337226651398d5d9ee76046801370':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion_t;
		$accion_label     = @@frm_accion_t_label;

		if($accion == 'RECHAZAR'){
			@@tri_bandera_comercial_label = 'RECHAZO DEL TÉCNICO';
		}

		break;
		//tarea 4 C
		case '187338637651f711d5d3d58092490594':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion_c;
		$accion_label     = @@frm_accion_c_label;

		if($accion == 'RECHAZAR'){
			@@tri_bandera_comercial_label = 'RECHAZO DEL COMERCIAL';
		}

		break;
		//TAREA 5
	case '25600274965087f36d030a4024877936':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;

        //TAREA 6
    case '407718691650882be398cf4039245263':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
         //TAREA 6.1 C
    case '907866719652f4869ed9941040244065':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
        //TAREA 6.1 T
    case '24837568665207b0bab49f3075876637':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
        //TAREA 7.1 C
    case '40520168265139c1fe781b2082871872':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion_c;
		$accion_label     = @@frm_accion_c_label;

		break;
        //TAREA 7.1 T
    case '27227951165207a1bac3907053331729':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion_t;
		$accion_label     = @@frm_accion_t_label;

		break;

		//Tarea 2
	case '78562928365087da6ddd068062972905':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
		//Tarea 8
	case '73169901865139ce82b0d98098087063':
		@@tri_bandera_t8 = '';
		@@tri_bandera_t9 = '';
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		if($accion == 'REGRESAR'){
			@@tri_bandera_t8 = 'true';
		}
		break;
		//Tarea 9
	case '24268372265087e46d019c6030896197':
		@@tri_bandera_t9 = '';
		@@tri_bandera_t8 = '';
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		if($accion == 'REGRESAR'){
			@@tri_bandera_t9 = 'true';
		}
		break;
		//Tarea 10
	case '59758233765139e2bb13f80066822696':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
		//Tarea 11
	case '16795713665139e7c0cb214066895796':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;

		break;
		//Tarea 12
	case '72313372665139ea474c889058922722':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;


		break;
		//Tarea 13
	case '75557425865139ecc83cd31064722953':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
	default:
		$comentario = '--';
		$accion = 'damisan';
		break;
}

$cod_estado = 1;

$sql = "INSERT INTO certificacion.EMISIONES_NUEVAS_BITACORA (
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

$rs_i = executeQuery($sql);



