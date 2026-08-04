<?php

$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$html_decision_magnum = '';
@@tri_bandera_primera_cuota = '';

$sql = "SELECT CODIGO, DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'RESP_MAGNUM' AND ESTADO = 1";
$rs_cat = executeQuery($sql, $cnx);

$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_DECISION_MAGNUM'";
$rs_auth =  executeQuery($sql_cata_auth, $cnx);

$url_auth = $rs_auth['1']['DESCRIPCION'];


$tri_case_id_magnum = @@tri_case_id_magnum;

$dns_auth = str_replace("caseid", $tri_case_id_magnum, $url_auth);

$token = @@token;
$ch_auth = curl_init();
curl_setopt($ch_auth, CURLOPT_URL, $dns_auth);
curl_setopt($ch_auth, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch_auth, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch_auth, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_auth, CURLOPT_FAILONERROR, true);
curl_setopt($ch_auth, CURLOPT_HTTPHEADER,
			array(
							"Accept: application/json",
							"Content-Type: application/json",
							"Accept-Language: application/json",
							"Authorization: Bearer ". $token
						)
		   );
$res = curl_exec($ch_auth);

$msg_m_auth = '';
if(curl_errno($ch_auth)){
	$msg_m_auth = curl_error($ch_auth);
	$result['mensaje_mostrar'] = 'Excepción capturada: Error al generar token, comuniquese con el  administrador.- '.utf8_encode($msg_m_auth);
}
curl_close($ch_auth);
$rs_m = json_decode($res);



PMFBitacoraServicios(
			@@APP_NUMBER,
			'trigger',
			'IMGGD-VVE-50',
			$dns_auth,
			'GET',
			"Accept: application/json" .
			" Content-Type: application/json" .
			" Accept-Language: application/json" .
			" Authorization: Bearer ". $token,
			'',
			$res,
			$msg_m_auth);

$colDecisionNodes = $rs_m->childNodes['0']->value;
$colLifeNode = $colDecisionNodes->childNodes['0'];

//obtener la decision e life
$odecision = $colLifeNode->value->decision;

$tri_bandera_decision = 'false';
switch($odecision->decision->internalCode){
		case 'REFER':
		$respuesta = 'REFER';
			foreach($rs_cat as $data_cat){
				$res_c = $data_cat['CODIGO'];
				$res_a = $data_cat['CAMPO2'];
				if($res_c == 'REFER')
					$html_decision_magnum = "<h4>$res_a</h4>";
			}
		break;
		case 'DECLINE':
		$respuesta = 'DECLINE';
			@@tri_bandera_primera_cuota = 'true';
			foreach($rs_cat as $data_cat){
				$res_c = $data_cat['CODIGO'];
				$res_a = $data_cat['CAMPO2'];
				if($res_c == 'DECLINE')
					$html_decision_magnum = "<h4>$res_a</h4>";
			}
		break;
		case 'ACCEPT':
		$respuesta = 'ACCEPT';
		//validacion cuando hay extraprima
		foreach($odecision->supportCodes as $obj_suppotcodes){
			$valida_exp = $obj_suppotcodes->text;
			if($valida_exp == 'EM' || $valida_exp == 'PM'){
				$tri_bandera_decision = 'true';
				foreach($rs_cat as $data_cat){
					$res_c = $data_cat['CODIGO'];
					$res_a = $data_cat['CAMPO2'];
					if($res_c == 'ACCEPT_V')
						$html_decision_magnum = "<h4>$res_a</h4>";
				}
			}else{
				foreach($rs_cat as $data_cat){
					$res_c = $data_cat['CODIGO'];
					$res_a = $data_cat['CAMPO2'];
					if($res_c == 'ACCEPT')
						$html_decision_magnum = "<h4>$res_a</h4>";
				}
			}
		}
		break;
		case 'POSTPONE':
		$respuesta = 'POSTPONE';
		@@tri_bandera_primera_cuota = 'true';
			foreach($rs_cat as $data_cat){
				$res_c = $data_cat['CODIGO'];
				$res_a = $data_cat['CAMPO2'];
				if($res_c == 'POSTPONE')
					$html_decision_magnum = "<h4>$res_a</h4>";
			}
		break;
}

//CONTROL SI TIENE VARIAS SOLICITUDES
/*if(@@tri_bandera_magnum == 'true'){
	$respuesta = 'INDISTINCT';
	foreach($rs_cat as $data_cat){
				$res_c = $data_cat['CODIGO'];
				$res_a = $data_cat['CAMPO2'];
				if($res_c == 'INDISTINCT')
					$html_decision_magnum = "<h4>$res_a</h4>";
			}
}*/

//$html_decision_magnum .= '<h5>'.$odecision->decision->text.'</h5><br>';

if($tri_bandera_decision == 'true'){

	$odecision_childNodes = $colLifeNode->value->childNodes;
	$arrar_des = json_decode(json_encode($odecision_childNodes), true);

	foreach($arrar_des as $data_childProduct){
		$cod_magnu_Prod = $data_childProduct['key'];
		switch($cod_magnu_Prod){
			case 'LIFE':
				foreach(@=grd_coberturas as $datagrid){
					$val_aseg = intval($datagrid['valor_asegurado']);
					//valido si tiene valor en la cobertura
					if($val_aseg > 0){
						$namecober = $datagrid['cobertura_label'];
						if($namecober == 'VIDA' || $namecober == 'CAPITAL COMPLEMENTARIO'){
							$namecober_vida .= $datagrid['cobertura_label'].' / ';
						}
						if((@@frm_producto == '113' || @@frm_producto == '114' || @@frm_producto == '116' || @@frm_producto == '117' || @@frm_producto == '210' || @@frm_producto == '2100' || @@frm_producto == '215' || @@frm_producto == '2150' || @@frm_producto == '211' || @@frm_producto == '2110' || @@frm_producto == '216' || @@frm_producto == '2160') && $namecober == 'ANTICIPO EN CASO DE ENFERMEDAD TERMINAL'){
							$namecober_vida .= $datagrid['cobertura_label'].' / ';
						}
					}
				}
				$namecober_vida = substr($namecober_vida,0,-3);
				$html_decision_magnum .= '<p><b><h4>'.$namecober_vida.'</h4></b></p>';
				//$html_decision_magnum .= '<p>DECISION : '.$data_childProduct['value']['decision']['decision']['text'].'<p>';
				if(array_key_exists('adjustments', $data_childProduct['value']['decision'])){
					$colsupportCodes = $data_childProduct['value']['decision']['adjustments'];
					foreach($colsupportCodes as $osupportCode){
						if(isset($osupportCode['value'])){
							$osupportCode_text = $osupportCode['type']['text'] == 'Extra Mortalidad/Morbilidad' ? 'Extraprima (porcentaje)' : 'Extraprima (milaje)';
							$html_decision_magnum .= '<p><h4><i>'.$osupportCode_text.' : ';
							$html_decision_magnum .= $osupportCode['value'].'</i></h4></p>';
							$tri_decision_bandera_vida = 'true';
						}
					}
					if($tri_decision_bandera_vida != 'true'){
						$html_decision_magnum .= '<p><h4><i>Tarifa Normal</i></h4></p>';
					}
				}
			break;

			case 'ADB':
				foreach(@=grd_coberturas as $datagrid){
					$val_aseg = intval($datagrid['valor_asegurado']);
					//valido si tiene valor en la cobertura
					if($val_aseg > 0){
						$namecober = $datagrid['cobertura_label'];
						if($namecober == 'MUERTE Y DESMEMBRACION ACCIDENTAL' || $namecober == 'INCAPACIDAD TOTAL Y PERMANENTE - ACCIDENTE' || $namecober == 'GASTOS MEDICOS POR ACCIDENTE - SIN DEDUCIBLE' || $namecober == 'GASTOS MEDICOS POR ACCIDENTE - CON DEDUCIBLE' || $namecober == 'RENTA DIARIA POR HOSPITALIZACION - ACC. Y ENF.' || $namecober == 'RENTA DIARIA POR HOSPITALIZACION POR ACCIDENTE'){
							$namecober_adb .= $datagrid['cobertura_label'].' / ';
						}
					}
				}
				$namecober_adb = substr($namecober_adb,0,-3);
				$html_decision_magnum .= '<h4><b>'.$namecober_adb.'</b></h4>';
				//$html_decision_magnum .= 'DECISION : '.$data_childProduct['value']['decision']['decision']['text'].'<br>';
				if(array_key_exists('adjustments', $data_childProduct['value']['decision'])){
					$colsupportCodes = $data_childProduct['value']['decision']['adjustments'];
					foreach($colsupportCodes as $osupportCode){
						if(isset($osupportCode['value']) && $osupportCode['value'] != ''){
							$osupportCode_text = $osupportCode['type']['text'] == 'Extra Mortalidad/Morbilidad' ? 'Extraprima (porcentaje)' : 'Extraprima (milaje)';
							$html_decision_magnum .= '<p><h4><i>'.$osupportCode_text.' : ';
							$html_decision_magnum .= $osupportCode['value'].'</i></h4></p>';
							$tri_decision_bandera_adb = 'true';
						}
					}
					if($tri_decision_bandera_adb != 'true'){
						$html_decision_magnum .= '<p><h4><i>Tarifa Normal</i></h4></p>';
					}
				}
			break;

			case 'TPD':
				foreach(@=grd_coberturas as $datagrid){
					$val_aseg = intval($datagrid['valor_asegurado']);
					//valido si tiene valor en la cobertura
					if($val_aseg > 0){
						$namecober = $datagrid['cobertura_label'];
						if($namecober == 'BENEFICIO ADICIONAL INCAP. TOTAL Y PERMANENTE' || $namecober == 'INCAPACIDAD TOTAL Y PERMANENTE - ENFERMEDAD'){
							$namecober_tpd .= $datagrid['cobertura_label'].' / ';
						}
					}
				}
				$namecober_tpd = substr($namecober_tpd,0,-3);
				$html_decision_magnum .= '<h4><b>'.$namecober_tpd.'</b></h4>';
				//$html_decision_magnum .= 'DECISION : '.$data_childProduct['value']['decision']['decision']['text'].'<br>';
				if(array_key_exists('adjustments', $data_childProduct['value']['decision'])){
					$colsupportCodes = $data_childProduct['value']['decision']['adjustments'];
					foreach($colsupportCodes as $osupportCode){
						if(isset($osupportCode['value'])){
							$osupportCode_text = $osupportCode['type']['text'] == 'Extra Mortalidad/Morbilidad' ? 'Extraprima (porcentaje)' : 'Extraprima (milaje)';
							$html_decision_magnum .= '<p><h4><i>'.$osupportCode_text.' : ';
							$html_decision_magnum .= $osupportCode['value'].'</i></h4></p>';
							$tri_decision_bandera_tdp = 'true';
						}
					}
					if($tri_decision_bandera_tdp != 'true'){
						$html_decision_magnum .= '<p><h4><i>Tarifa Normal</i></h4></p>';
					}
				}
			break;

			case 'CI':
				foreach(@=grd_coberturas as $datagrid){
					$val_aseg = intval($datagrid['valor_asegurado']);
					//valido si tiene valor en la cobertura
					if($val_aseg > 0){
						$namecober = $datagrid['cobertura_label'];
						if($namecober == 'BENEFICIO ADICIONAL POR ENFERMEDADES GRAVES' || $namecober == 'ANTICIPO EN CASO DE ENFERMEDAD GRAVES'){
							$namecober_ci .= $datagrid['cobertura_label'].' / ';
						}
					}
				}
				$namecober_ci = substr($namecober_ci,0,-3);
				$html_decision_magnum .= '<h4><b>'.$namecober_ci.'</b></h4>';
				//$html_decision_magnum .= 'DECISION : '.$data_childProduct['value']['decision']['decision']['text'].'<br>';
				if(array_key_exists('adjustments', $data_childProduct['value']['decision'])){
					$colsupportCodes = $data_childProduct['value']['decision']['adjustments'];
					foreach($colsupportCodes as $osupportCode){
						if(isset($osupportCode['value'])){
							$osupportCode_text = $osupportCode['type']['text'] == 'Extra Mortalidad/Morbilidad' ? 'Extraprima (porcentaje)' : 'Extraprima (milaje)';
							$html_decision_magnum .= '<p><h4><i>'.$osupportCode_text.' : ';
							$html_decision_magnum .= $osupportCode['value'].'</i></h4></p>';
							$tri_decision_bandera_ci = 'true';
						}
					}
					if($tri_decision_bandera_ci != 'true'){
						$html_decision_magnum .= '<p><h4><i>Tarifa Normal</i></h4></p>';
					}
				}
			break;

			default:
				echo 'no hay';
			break;
		}
	}

	$html_decision_magnum .= '<p><h4>Una vez suscrito todo el caso, emitiremos una decisión final.</h4></p>';
}
if (@@tri_bandera_cierreMes == 'SI'){
	if (strpos($html_decision_magnum, "Caso controlado por cierre de mes")=== false){
		$html_decision_magnum .= '<p style="color: red;"><h4>Caso controlado por cierre de mes</h4></p>';
	}
}


//echo $html_decision_magnum;
//die();
//@@banderaEsExtraprima = $tri_bandera_decision;
@@tri_decision_magnum = $res;
@@tri_decision_magnum_result = $respuesta;
@@html_decision_magnum = $html_decision_magnum;

