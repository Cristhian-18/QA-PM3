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
	case '365727144656f5e3f0830b7087994098':
		$comentario = @@frm_comentario;
		$accion     = 'INGRESAR';
		$accion_label     = 'Crear Caso desde el Portal';
		break;
		//T2. Cuadro de negociación
		case '80344871565c30abb235f32046251503':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion_2;
		$accion_label     = @@frm_accion_2_label;
		break;
	case '83542135165656893645600089050230':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
	case '531801560659eda0d83bd65047221047':
				$comentario = 'Fin de cierre de Mes';
				$accion     = 'CONTINUAR';
				$accion_label     = 'Continuar desde cierre de mes';
				break;
	case '1863400316570dcbc68d769006593980':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
		//T5.1 Gestión INVEC
	case '2586232946570e61c744f98018505372':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T10: Legalizar Contratos
    case '25992847365657ba379b185011083843':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T7 Solicitud de valores
    case '2941030696570e2d47c4287036236099':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T3.1 Validación del informe de perito externo
    case '3669211926570d9747654c9079761509':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T2. Aprobar perito externo
    case '3995529256570d71c680898049395800':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T5. Aprobar Carta de negativa
    case '48470480565656f1f520ee1029026366':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T4. Revisar Siniestro
    case '52356331965656e03596ae6015167071':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T2. Adjuntar documentos faltantes
    case '573739720656569fb5e1f83076247357':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;

            //T8. Revisar Informe Docs Adjuntos y Generar  AT
    case '58939644365657793769409050904287':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T2. Generar Validación Fress y notificar
    case '589428217656568e35c72b5010727719':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T6. Rechazo de PT
    case '5913263356570e208bc87d7041004506':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T3. Adjuntar informe del perito externo
    case '6561430336570d7946d14c9066706978':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T9. Revisar contratos
    case '7959108336570efab61a727075636723':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T2. Asesoria Legal
    case '7974589156570d8fc666741053238646':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;


        //T4. Aprobar Siniestro
    case '923365838656570db6e0f98006456629':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T5. Aprobar Siniestro
    case '92573944165657153749253074680199':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T6. Gestionar Documentos
    case '929063931656573fb6b27b4042558105':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T4. Revisar Carta de negativa
    case '93486372465656eab6a6686053267318':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;
        //T7. Solicitar Pago Parcial
    case '952696038656576cb82f200019772619':
		$comentario = @@frm_comentario;
		$accion     = @@frm_accion;
		$accion_label     = @@frm_accion_label;
		break;

		//TAREA 3
	default:
		$comentario = '--';
		$accion = 'damisan';
		break;
}

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
	values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario','$accion_label', '$cod_negativa','$cod_estado')";
@@tmp_sql_com = $sql;
$rs_i = executeQuery($sql);


$sql_portal = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE  CODIGO = 'ACTUALIZAR_ESTADO_PORTAL'";
	$rs_auth = executeQuery($sql_portal);
	$portal_estado = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

	$cod_estado = 2; // REVISION
	$sql_estado = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'ESTADOS' AND CODIGO = '$cod_estado'";
	$rs_estado = executeQuery($sql_estado);
	$estado = isset($rs_estado['1']['DESCRIPCION']) ? $rs_estado['1']['DESCRIPCION'] : '';

	$datos_array = array(
		"numeroCasoBpm" => strval(@@APP_NUMBER),
		"nuevoEstado" => $estado,
	);
	$datos_json = json_encode($datos_array);
	echo($portal_estado);
	print_r($datos_json);
	try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$portal_estado);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $datos_json);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array(
				//"Accept: application/json",
				"Content-Type: application/json",
				//"Accept-Language: application/json",
				//"Authorization: Bearer ". $token
			)
		);
		$res = curl_exec($ch);

		if (curl_errno($ch)) {
			$msg_m = curl_error($ch);

			//die();
		}
		curl_close($ch);

		PMFBitacoraServicios(
		@@APP_NUMBER,
		'trigger',
		'GC-SVPT-251',
		$portal_estado,
		'PUT',
		"Content-Type: application/json",
		$datos_json,
		$res,
		$msg_m);

	} catch  (Exception $e) {
		$portal_estado = 'Error al actualizar estado en el portal';
	}

