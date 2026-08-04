<?php
//Consultar condiciones Poliza

$pro_uid = '35087580064a18c9776b638006106795';
/*echo(@@frm_cod_asec);
die();*/
@@proccess_padre = '35087580064a18c9776b638006106795';


$app = @@APPLICATION;
//catalogos de marcas modelos
//obtengo el token
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN'";
$rs_auth =  executeQuery($sql_cata_auth);

$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

$sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
$rs_apikey = executeQuery($sql_apikey);
$apikey = isset($rs_apikey['1']['DESCRIPCION']) ? $rs_apikey['1']['DESCRIPCION'] : '';

$sql_cata_condicionesPoliza = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_Condiciones_Poliza'";
$rs_condicionesPoliza =  executeQuery($sql_cata_condicionesPoliza);

$url_condicionesPoliza = isset($rs_condicionesPoliza['1']['DESCRIPCION']) ? $rs_condicionesPoliza['1']['DESCRIPCION'] : '';
$idPv = @@frm_idpv;

$url_inCondiciones_param = $url_condicionesPoliza . $idPv;



try {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url_inCondiciones_param);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt(
		$ch,
		CURLOPT_HTTPHEADER,
		array(
			"Accept: application/json",
			"Content-Type: application/json",
			"apikey: " . $apikey,
			"Authorization: ". $token
		)
	);

	$res = curl_exec($ch);
	$msg_m = '';
	if (curl_errno($ch)) {
		$msg_m = curl_error($ch);
		@@tri_msg_error = $msg_m;
	}
	curl_close($ch);
	$result = json_decode($res, true);
	PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'CCP-SG-59', $url_inCondiciones_param, 'GET', 'apikey,Authorization','', $result, $msg_m);
 
	$id_poliza = $result['response']['nroPoliza'];
	$text_poliza = $result['response']['descripcion'];

	$text_poliza_replaced = str_replace("\t", "<br />", $text_poliza);
	$text_poliza_replaced = str_replace("\n", "<br />", $text_poliza);

	@@tri_condiciones_poliza = $text_poliza_replaced;
 

} catch (Exception $e) {
 
	$result['mensaje'] = 'false';
	$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
	@@tri_msg_error = $msg_m;

}

return;
 


$sql_cata_cartera = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Deuda_asegurado'";
$rs_carteraPoliza =  executeQuery($sql_cata_cartera);

$url_cartera = isset($rs_carteraPoliza['1']['DESCRIPCION']) ? $rs_carteraPoliza['1']['DESCRIPCION'] : '';

$idaseg = (@@frm_rs_codAsegurado == '' ? @@frm_rs_codAsegurado : '');
$url_cartera_param = $url_cartera . $idaseg;

try {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url_cartera_param);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt(
		$ch,
		CURLOPT_HTTPHEADER,
		array(
			"Accept: application/json",
			"Content-Type: application/json",
			"Accept-Language: application/json",
			"apikey: " . $apikey
		)
	);

	$res = curl_exec($ch);

	if (curl_errno($ch)) {
		$msg_m = curl_error($ch);
		@@tri_msg_error = $msg_m;
	 
	}
	curl_close($ch);
	$result = json_decode($res, true);

	$tri_cartera_dias = $result['respuesta'][0]['dias'];
	$tri_cartera_monto = $result['respuesta'][0]['valor_deuda'];
	@@tri_cartera = "El cliente presenta una deuda de " . $tri_cartera_monto . " con " . $tri_cartera_dias . " dias de mora.";

	 
} catch (Exception $e) {
	//echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
	$result['mensaje'] = 'false';
	$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
	@@tri_msg_error = $msg_m;
}
