<?php
//<?php
	//created by Henry Bautista
	//20-08-2020
	//Grabar historial de caso

	 
	$app_uid   = @@APPLICATION;
	$task_uid  = @@TASK;
	$del_index           = @@INDEX;
	$del_index_siguiente = @@INDEX + 1;
	$cod_negativa = 0;
	$cod_estado = 3;

	@@frm_accion_aux  = @@frm_accion;



	$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

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

	@@tmp_entra = @@TASK;
	$cod_estado = 4;

	//validacion por tarea
	switch (@@TASK) {
			//tarea 1
		case '47793586864a1915c3740e7013393106':
			$comentario = 'Caso creado desde el Portal';
			$accion     = 'INGRESAR';
			$accion_label     = 'Crear Caso desde el Portal';
			break;
			case '275166779659ecfc991e0e7090100390':
				$comentario = 'Fin de cierre de Mes';
				$accion     = 'CONTINUAR';
				$accion_label     = 'Continuar desde cierre de mes';
				break;
			//tarea 2 taller
		case '21947251964a193141bc7e8005186014':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			if ($accion == "CONTINUAR") {
				$cod_estado = 8;
			} else if ($accion == "ESPERAR" || $accion == "REASIGNAR_ANALISTA" || $accion == "REASIGNAR") {
				$cod_estado = 4;
			} else if ($accion == "DESISTIR" || $accion == "PERDIDA"  || $accion == "COTIZADO") {
				$cod_estado = 9;
			}
			break;
		case '684546693656747abb3f8d0039022770':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			if ($accion == "CONTINUAR") {
				$cod_estado = 9;
			} else {
				$cod_estado = 9;
			}
			break;
			//TAREA 3
		case '2579012976503be0b08c3b6090809481':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 9;
			break;
		//MANUAL
		case '84774882165bd3244376ce4033980736':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion_2;
			$accion_label     = @@frm_accion_2_label;
			$cod_estado = 9;
			break;
			//Tarea 4
		case '56594959064f8a7036237e1042256890':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			if ($accion == "SOLICITAR") {
				$cod_estado = 2;
			} else if ($accion == "CONTINUAR" || $accion == "INDEMNIZAR") {
				$cod_estado = 9;
			} else if ($accion == "APROBAR" || $accion == "NEGAR") {
				$cod_estado = 12;
			} else if ($accion == "REQUERIR" || $accion == "RECOTIZAR" || $accion == "ACTUALIZAR" || $accion == "VERIFICAR") {
				$cod_estado = 9;
			} else if ($accion == "PERDER") {
				$cod_estado = 6;
			} else if ($accion == "FINALIZAR") {
				$cod_estado = 7;
			} else {
				$cod_estado = 9;
			}
			break;
			//Tarea 2.1 Analista
		case '72144115864a1924c5ab549003287587':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			if ($accion == "ACTUALIZAR") {
				$cod_estado = 3;
			} else if ($accion == "SOLICITAR") {
				$cod_estado = 2;
			} else {
				$cod_estado = 1;
			}
			break;
			//Tarea 2.1 reasig taller
		case '2429365746526b8e3ce1692043508776':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//Tarea 2.1 Realizar Gestión Cliente
		case '1346005026526fac1a91d03001561073':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 3;
			break;
			//T2: Validar Información Siniestro - Comercial
		case '14286117264a1924c53d4c0063435298':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 3;
			break;
			//T3: Revisar Información Cartera del siniestro
		case '27398367464a1974c31cb78042429959':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//T3: Validar Información Siniestro - Analistas
		case '5075995886526b01d838ef4015318307':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 3;
			break;
			//T3: Validar Información Siniestro - Analistas
		case '967574797654a692b966e03081751211':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 13;
			break;
			//T5: Adjuntar Información del Siniestro
		case '54026307264a1947c2ccb33085557235':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 9;
			break;
			//T5: Registro de datos de los repuestos
		case '855535701652eaa2e18e1f2066505597':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//T6: Recepción de repuestos
		case '668350398652eb04c96cac8087279453':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//T6.1: Recepción de repuestos
		case '74204951465270061a3a591051089497':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			@@tri_mundo_partes_auditor = 'true';
			break;
			//Tarea ADJUNTAR DOCUMTO
			//T5: Aprobar Siniestro
		case '46680647864a194cc1ea273036601085':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			if ($accion == "CONTINUAR" || $accion == "COMPRAR") {
				$cod_estado = 15;
			} else if ($accion == "AJUSTAR") {
				$cod_estado = 13;
			} else if ($accion == "RECHAZAR") {
				$cod_estado = 9;
			} else if ($accion == "INDEMNIZAR") {
				$cod_estado = 14;
			}
			break;
			//Tarea 6 pda
		case '74725028464a1963426ccd7096187892':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//T6: Revisar Información de la negativa
		case '9148285416526b22bd12785076248090':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//T7: Adjunte el finiquito
		case '5012526796503c65306a0f1027793854':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//T7: Aprobar Carta de negativa
		case '8918106796526b2cbbf8677016141095':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//Tarea 7
		case '74725028464a1963426ccd7096187892':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//T5: Aprobar ajustador Externo
		case '1894100466526ff49a8ce66026408166':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 9;
			break;
			//T5: Verificar daños del siniestro
		case '63199860364a1956c302338036694005':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			if ($accion == "CONTINUAR" || $accion == "COMPRAR") {
				$cod_estado = 13;
			} else if ($accion == "INDEMNIZAR" || $accion == "PERDIDA") {
				$cod_estado = 9;
			} else if ($accion == "COTIZAR") {
				$cod_estado = 8;
			}
			break;
			//T5: Aprobar daños del siniestro
		case '68284694964f8a843632370070752291':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//T6: Verificar daños del siniestro Externo
		case '97599337664f8a8fb544ba6077513094':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 9;
			break;
			//T6.1: Adjuntar Información del Siniestro
		case '74204951465270061a3a591051089497':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 13;
			break;
			//Tarea 5 negativas
		case '4409057566526b0c3cd7896010697770':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
			//Tarea 5.1 negativas
		case '8853055126526b18bca33a0006984500':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
		case '732793791655305f046b591087019576':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
		case '34441431065538510bb0961060980173':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;

		case '488852611655313465e08c8061217933':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
		case '889550067654129ffcd4c26047533019':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
		case '946401411653c3f2174b725029930533':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;


		case '200798330654671a66e4c49016843438':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
		case '86755295465559b9f32c026015339771':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			$cod_estado = 10;
			break;
		case '83950282665b3444075c471097332671':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
		//T7: Generación de Preliquidación - Cristhian
		case '4566689726a24ab50f2a6b6014803750':
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = "Enviar Pre-liquidación";
			break;
		//T7.1: Notificación del Portal - Cristhian
		case '1744216476a24b001152801025107445':
			$comentario = 'Datos recibidos y almacenados correctamente';
			$accion     = 'CONTINUAR';
			$accion_label     = 'Notificación del Portal';
			break;
		case '20216636065412a27cfd079043017144':
			if (@@frm_comentario_aux != null) {
				@@frm_comentario = @@frm_comentario_aux;
			} else {
				@@frm_comentario = @@frm_comentario_label;
			}
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
		default:
			$comentario = @@frm_comentario;
			$accion     = @@frm_accion;
			$accion_label     = @@frm_accion_label;
			break;
	}

	@@tri_estado_evento = $cod_estado;
	/*$cod_estado = @@tri_estado_evento;*/

	$sql = "INSERT INTO certificacion.SINIESTRO_VH_BITACORA (
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

	$pro_uid = @@PROCESS;
	$sql_portal = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ACTUALIZAR_ESTADO_PORTAL'";
	$rs_auth = executeQuery($sql_portal);
	$portal_estado = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

	$sql_estado = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'ESTADOS' AND PRO_UID = '$pro_uid' AND CODIGO = '$cod_estado'";
	$rs_estado = executeQuery($sql_estado);
	$estado = isset($rs_estado['1']['DESCRIPCION']) ? $rs_estado['1']['DESCRIPCION'] : '';

	$datos_array = array(
		"numeroCasoBpm" => strval(@@APP_NUMBER),
		"nuevoEstado" => $estado,
	);
    @@tri_estado_actual_caso = $estado;
	$datos_json = json_encode($datos_array);
	//echo($portal_estado);
	//print_r($datos_json);
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
			//echo(" ERROR ");
			//echo $msg_m;

			//die();
			//die();
		}
	//	echo("Exito guardando estado");
		curl_close($ch);

		PMFBitacoraServicios(
			@@APP_NUMBER,
			'trigger',
			'GC-VPP-419',
			$portal_estado,
			'PUT',
			"Content-Type: application/json",
			$datos_json,
			$res,
			$msg_m);

	} catch  (Exception $e) {
		$portal_estado = 'Error al actualizar estado en el portal';
	}
