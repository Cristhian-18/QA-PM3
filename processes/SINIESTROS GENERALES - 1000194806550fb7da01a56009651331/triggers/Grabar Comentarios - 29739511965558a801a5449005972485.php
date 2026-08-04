<?php
//<?phpcreated by Henry Bautista
//20-08-2020
//Grabar historial de caso
echo "---- Grabar Comentarios Siniestros Generales ----";
$cnx = '934957180650c74e8ed0e10096114321';
echo "Connection UID: " . $cnx;
$app_uid   = @@APPLICATION;
echo "App UID: " . $app_uid;
$task_uid  = @@TASK;
echo "Task UID: " . $task_uid;
try {
	$del_index           = @@INDEX;
} catch (Exception $e) {
	$del_index           = 0;
}
if ($del_index == '' || $del_index == null) {
	$del_index           = 0;
}
echo "Del Index: " . $del_index;
$del_index_siguiente = $del_index + 1;
echo "Del Index Siguiente: " . $del_index_siguiente;
$cod_negativa = 0;
@@frm_accion_aux  = @@frm_accion;
echo "Flag 2";
$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);
$rs_actual    = $rs['1'];
$rs_siguiente = $rs['2'];

$ticket 			 = @@APP_NUMBER;
$usr_uid_actual      = @@USER_LOGGED;

$fecha_inicio        = ($rs_actual['DEL_INIT_DATE'] != '') ? $rs_actual['DEL_INIT_DATE'] : '';
$fecha_fin           = date('Y-m-d H:i:s');
$fecha_vencimiento   = ($rs_actual['DEL_TASK_DUE_DATE'] != '') ? $rs_actual['DEL_TASK_DUE_DATE'] : '';
$fecha_derivacion    = ($rs_actual['DEL_DELEGATE_DATE'] != '') ? $rs_actual['DEL_DELEGATE_DATE'] : '';

$usr_uid_receptor    = $rs_siguiente['USR_UID'];
$tas_uid_actual    = $rs_siguiente['TAS_UID'];
$tarea_actual    = PMFGetTaskName($rs_siguiente['TAS_UID'], 'es');
echo $usr_uid_actual;
@@tmp_entra = @@TASK;
//validacion por tarea
switch (@@TASK) {
	//tarea 1
	case '129794879655582ebe0d391046063183':
		$comentario = 'Caso creado desde el Portal';
		$accion     = 'CONTINUAR';
		$accion_label     = 'Crear Caso desde el Portal';
		break;

	case '946997424659ed8f96902f0002271120':
		$comentario = 'Fin de cierre de Mes';
		$accion     = 'CONTINUAR';
		$accion_label     = 'Continuar desde cierre de mes';
		break;
	//T2: Analizar Revisar Coberturas Siniestro

	case '73612224465558363c37e35011666953':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T3: Aprobar carta deducible
	case '695119116655583dbb8ea09096196722':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T4: Solicitar ajustador reaseguros
	case '2658432166555847bc41125032580507':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T5: Registrar inspección
	case '60452835965558543c85a45021452334':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T5.1: Realizar Gestion Siniestro Cliente
	case '1423020706555856bc5ca73082558635':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T6: Aprobación informe reaseguros
	case '89697538965558593c71d93006162635':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T4: Revisar Información de la negativa
	case '779528443655585e407cd17072201870':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T5: Aprobar Negativa
	case '37174648165655d95040468017560408':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T5: Aprobar ajustador Externo
	case '9988199046555865bcb8e44005902575':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T6: Esperar Informe Externo
	case '389487316655586d3ca8cc4095234799':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T3: Aprobar Cierre Administrativo
	case '21350858965655b15026a94011444687':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T5: Aprobar Siniestro
	case '367107911655586fbdaf2d7040282156':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T4: Esperar Cierre
	case '74628754565655bb4eeac32057363201':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T3.1: Realizar Gestion Siniestro Cliente
	case '23398454665558403c9e484080243447':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T6. Generar AT & OP
	case '310932373656561cd094902089638289':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
	//T3. Cruzar cuentas Generar AT y OP
	case '6896732926565540ce8ab07058757238':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;




	case '20216636065412a27cfd079043017144':
		if (@@frm_comentario_aux != null) {
			@@frm_comentario = @@frm_comentario_aux;
		} else {
			@@frm_comentario = @@frm_comentario_label;
		}
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;

	case '8413667076579f0238dd164034023836':
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;

	default:
		$comentario = @@frm_comentario;
		$accion     = @@frm_ac_accion;
		$accion_label     = @@frm_ac_accion_label;
		break;
}

@@tri_estado_evento = 1;
$cod_estado = @@tri_estado_evento;

$sql = "INSERT INTO certificacion.SINIESTRO_GN_BITACORA (
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
echo $sql;
$rs_i = executeQuery($sql);
