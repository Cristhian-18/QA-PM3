<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
@@tmp_task_comentario ='ACA';
$codaccion = @@frm_accion;
$accion = @@frm_accion_label;
$tri_com = @@frm_comentario;



switch ($task_uid) {

	case '651288139600ed8bde48f03058219572':
		//T01 REGISTRAR COTIZACION
		$codaccion = @@tri_ruta_cot;
		$accion = (@@tri_ruta_cot == 'EQUIFAX' ? 'Calificación Pagador' :@@tri_ruta_cot);
		$accion = ($accion == 'RCS2' ? 'Validación cumplimiento' :$accion);
		$tri_com = @@frm_comentario.' '.@@tri_mensaje;
		break;

	case '98347037763c1710775dee0058061655':
		//t02 aprobacion suscripcion
		$codaccion = @@frm_accion;
		$accion = @@frm_accion_label;
		$tri_com = @@frm_comentario;
		@@frm_comentario_suscripcion = @@frm_comentario;
		break;

	case '882901358601ad950a8bf53090351450':
		//T02 APROBACION RCS
		//$codaccion = @@tri_ruta_aprobacion;
		//$accion = @@tri_ruta_aprobacion;
		//$tri_com = @@tri_comentario;

		break;

	case '4404428445ebc16bf7a4621025224859':
		//T03: DIGITAR SOLICITUD
		$codaccion = 'Continuar';
		$accion = $codaccion;
		$tri_com = 'Observación de la poliza '.@@frm_aclaraciones_observacion;
		if(@@frm_motivo_seguro == '11')
			@@frm_bandera_seguro = 'DESGRAVAMEN - ';
		break;

	case '1166133805eecd2b1a13176062175774':
		//T04: CONFIRMAR SOLICITUD CLIENTE
		if (@@frm_accion_t4 == 'REPROCESAR'){
			$codaccion = @@frm_accion_t4;
			$accion = @@frm_accion_t4_label;
			$tri_com = @@frm_comentario;
		}
		else
		{
	$codaccion = (@@frm_respuesta_cliente == '' ? 'NO INGRESO CODIGO': @@frm_respuesta_cliente) ;
			$accion = $codaccion ;
		$tri_com = @@frm_dana_observacion_cliente;
		}
		break;

	case '9938028895f0f3574ab7db1043599014':
		//T03: ENVIAR OPERACIONES GESTION COMERCIAL
		$codaccion = @@frm_accion;
		$accion = @@frm_accion_label;
		$sol =@@frm_modificar_solicitud_label;
		$deb =@@frm_modificar_debito_label ;
		$cov =@@frm_modificar_covid_label ;

		//$tri_com = @@frm_comentario. " MODIFICAR: SOLICITUD $sol AUTORIZACION $deb COVID $cov";
		$tri_com = @@frm_comentario;
		break;

	case '9951294895f7bbe764eab77080978845':
		//T05: CONFIRMAR AUTORIZACION DEBITO PAGADOR
		$codaccion = (@@frm_respuesta_cliente == '' ? 'NO INGRESO CODIGO': @@frm_respuesta_cliente) ;
		$accion = $codaccion ;
		$tri_com = @@frm_dana_observacion_cliente;
		break;

	case '9257231405f2081e4d98196054267916':
		//T06: CONFIRMAR PRIMER PAGO
		$codaccion = (@@frm_accion_t4 == '' ? 'PAGAR' : @@frm_accion_t4) ;
		$accion = $codaccion ;
		$tri_com = ($codaccion == 'REPROCESAR' ? @@frm_comentario : @@frm_pago_medios_estado.' fecha:'.@@frm_pago_medios_estado_fecha );
		//@@frm_respuesta_cliente;
		break;

	case '3010753755f46fdab8bb4c9043097501':
		//T06: CONFIRMACION CLIENTE
		$codaccion = @@frm_respuesta_cliente;
		$accion = $codaccion ;
		$tri_com = @@frm_dana_observacion_cliente;
		break;

	case '5378516815f96e3b7bf1699006176801':
		//T07: APROBAR VENTA DIRECTOR COMERCIAL
		break;

	case '4033495885f982c8ce12631090926236':
		//T10: ANALIZAR CASO EMISION
		if(@@frm_accion == 'RECHAZAR'){
			@@tri_mail_rechazo = @@frm_comentario;
		}
		break;

	case '9625228685f982cb3eaa338037581251':
		//T09: REGULARIZAR NOVEDADES COMERCIAL
		$codaccion = @@frm_accion;
		$accion = @@frm_accion_label;
		$tri_com = @@frm_comentario;
		@@tri_bandera_reproceso = 'true';
		break;

	case '4291645125f982d2bbc6a56093864701':
		//T10: APROBAR CAMBIOS CLIENTE
		break;

	case '9536469695f982d53c704c8074215007':
		//T11:EMITIR DICTAMEN DE SUSCRIPCION
		break;

	case '5056935685f982dcc5647c6004830349':
		//T12: GESTIONAR DEVOLUCIÓN  (TESORERÍA)
		break;

	case '4609779015f982faca9a7d7049044941':
		//T13: GENERAR POLIZA Y APLICAR PAGO
		$codaccion = @@frm_accion;
		$accion = @@frm_accion_label;
		$tri_com = @@frm_comentario.' '.@@frm_cobranza_comentario;
		break;

	case '5884096535f9832cbd413a9024289790':
		//T14: GESTIONAR RECEPCION DE POLIZA
		$codaccion = @@frm_accion;
		$accion = @@frm_accion_label;
		$tri_com = @@frm_comentario;
		break;

	case '5309085505f98331d3d24e7084079360':
		//T15: REVISAR INFORMACION DE PÓLIZA (SUSCRIPCIÓN)
		break;

	case '3132949705f983343dd1581097699310':
		//T16:REGULARIZAR PÓLIZA (EMISIÓN)
		break;

	case '7073762295f98336bebf6e3060612796':
		//T17: ARCHIVAR FILE
		$codaccion = @@frm_accion;
		$accion = @@frm_accion_label;
		$tri_com = @@frm_comentario;
		break;

}
$comentario = ($tri_com == '' ? 'sin comentario' : $tri_com);


$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;

$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);
$rs_actual    = $rs['1'];
$rs_siguiente = $rs['2'];

$ticket = @@APP_NUMBER;
$usr_uid_actual      = @@USER_LOGGED;

$fecha_inicio        = ($rs_actual['DEL_INIT_DATE'] != '') ? $rs_actual['DEL_INIT_DATE'] : '';
$fecha_fin           = ($rs_actual['DEL_FINISH_DATE'] != '') ? $rs_actual['DEL_FINISH_DATE'] :'';
$fecha_vencimiento   = ($rs_actual['DEL_TASK_DUE_DATE'] != '') ? $rs_actual['DEL_TASK_DUE_DATE'] :'';
$fecha_derivacion    = ($rs_actual['DEL_DELEGATE_DATE'] != '') ? $rs_actual['DEL_DELEGATE_DATE'] :'';

$usr_uid_receptor    = $rs_siguiente['USR_UID'];
$tiempo_sla = @@tri_tiempo_sla;
$tiempo_atencion = @@tri_tiempo_atencion ;
$holgura = $tiempo_sla - $tiempo_atencion;



$sql = "INSERT INTO VV_BITACORA (
ORDEN,
APP_UID,
TASK_UID,
FECHA_INICIO,
FECHA_FIN,
FECHA_DERIVACION,
FECHA_VENCIMIENTO,
DEL_INDEX,
COD_ACCION,
ACCION,
USR_UID_ACTUAL,
USR_UID_RECEPTOR,
COMENTARIO,
TIEMPO_SLA,
TIEMPO_ATENCION,
HOLGURA)
values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$codaccion', '$accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario', $tiempo_sla, $tiempo_atencion, $holgura)";
executeQuery($sql, $cnx);
@@tmp_comm = $sql;
@@tri_usr_siguiente = $usr_uid_receptor;
@@tmp_comentario = $sql;
@@frm_accion = '';
@@frm_accion_t4 = '';
@@frm_comentario = '';
