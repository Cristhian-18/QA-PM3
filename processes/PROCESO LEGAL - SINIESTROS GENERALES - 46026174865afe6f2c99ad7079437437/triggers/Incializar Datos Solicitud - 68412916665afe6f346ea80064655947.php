<?php
//<?php
//Incializar Datos Solicitud
$pro_uid = @@PROCESS;
@@tri_msg_error = '';

//catalogos de marcas modelos
//obtengo el token
	$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN'";
	$rs_auth =  executeQuery($sql_cata_auth);

	$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
	echo($token);
	die();

//PAIS
	$sql_cata_infoPais = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Pais'";
	$rs_infoPais=  executeQuery($sql_cata_infoPais);

	$url_infoPais = isset($rs_infoPais['1']['DESCRIPCION']) ? $rs_infoPais['1']['DESCRIPCION'] : '';
	$url_inPais_param = 	$url_infoPais = isset($rs_infoPais['1']['DESCRIPCION']) ? $rs_infoPais['1']['DESCRIPCION'] : '';
;
	try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_inPais_param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Accept-Language: application/json",
				"Authorization: Bearer ". $token
			)
		);

		$res = curl_exec($ch);
		$msg_m = '';

		if(curl_errno($ch)){
			$msg_m = curl_error($ch);
			@@tri_msg_error = $msg_m;
		}
		curl_close($ch);

		$result = json_decode($res);

		$arr_Dtapais = array();
		$i = 1;
		$datos_result = $result->data;

		foreach($datos_result as $dataPais){
			$arr_Dtapais[$i] = array($dataPais->codPais, $dataPais->txtDesc);
			$i++;
		}

		@@arr_Dtapais = $arr_Dtapais;

		PMFBitacoraServicios(
		@@APP_NUMBER,
		'trigger',
		'IDS-PLSG-62',
		$url_inPais_param,
		'GET',
		"Accept: application/json" .
		" Content-Type: application/json" .
		" Accept-Language: application/json" .
		" Authorization: Bearer ". $token,
		'',
		$res,
		json_encode($msg_m));

	}
	catch(Exception $e)
	{
		//echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
		$result['mensaje'] = 'false';
		$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
		@@tri_msg_error = $msg_m;
	}

//PROVINCIAS
$pais_portal = @@frm_accidente_pais;
	$sql_cata_infoProv = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'consultarProvincias'";
	$rs_infoProv=  executeQuery($sql_cata_infoProv);

	$url_infoProv = isset($rs_infoProv['1']['DESCRIPCION']) ? $rs_infoProv['1']['DESCRIPCION'] : '';
	$url_inProv_param = 	$url_infoProv.$pais_portal;

	try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_inProv_param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Accept-Language: application/json",
				"Authorization: Bearer ". $token
			)
		);

		$res = curl_exec($ch);

		if(curl_errno($ch)){
			$msg_m = curl_error($ch);
			@@tri_msg_error = $msg_m;
		}
		curl_close($ch);

		$result = json_decode($res);

		$arr_Dtaprov = array();
		$i = 1;
		$datos_result = $result->data;

		foreach($datos_result as $dataProv){
			$arr_Dtaprov[$i] = array($dataProv->codDpto, $dataProv->txtDesc);
			$i++;
		}
		@@arr_Dtaprov = $arr_Dtaprov;

		PMFBitacoraServicios(
		@@APP_NUMBER,
		'trigger',
		'IDS-PLSG-62',
		$url_inProv_param,
		'GET',
		"Accept: application/json" .
		" Content-Type: application/json" .
		" Accept-Language: application/json" .
		" Authorization: Bearer ". $token,
		'',
		$res,
		json_encode($msg_m));

	}
	catch(Exception $e)
	{
		//echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
		$result['mensaje'] = 'false';
		$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
		@@tri_msg_error = $msg_m;
	}
//CANTONES
$prov_portal = @@frm_accidente_provincia;
	$sql_cata_infoCant = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'consultarCantones'";
	$rs_infoCant=  executeQuery($sql_cata_infoCant);

	$url_infoCant = isset($rs_infoCant['1']['DESCRIPCION']) ? $rs_infoCant['1']['DESCRIPCION'] : '';
	$url_infCant_param = 	$url_infoCant.$prov_portal;

	try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_infCant_param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Accept-Language: application/json",
				"Authorization: Bearer ". $token
			)
		);

		$res = curl_exec($ch);

		if(curl_errno($ch)){
			$msg_m = curl_error($ch);
			@@tri_msg_error = $msg_m;
		}
		curl_close($ch);

		$result = json_decode($res);

		$arr_DtaCant = array();
		$i = 1;
		$datos_result = $result->data;

		foreach($datos_result as $dataCant){
			$arr_DtaCant[$i] = array($dataCant->codCanton, $dataCant->txtDesc);
			$i++;
		}
		@@arr_DtaCant = $arr_DtaCant;

		PMFBitacoraServicios(
		@@APP_NUMBER,
		'trigger',
		'IDS-PLSG-62',
		$url_infCant_param,
		'GET',
		"Accept: application/json" .
		" Content-Type: application/json" .
		" Accept-Language: application/json" .
		" Authorization: Bearer ". $token,
		'',
		$res,
		json_encode($msg_m));
	}
	catch(Exception $e)
	{
		//echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
		$result['mensaje'] = 'false';
		$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
		@@tri_msg_error = $msg_m;
	}
//AGENTE
	$codagenet_portal = @@frm_codAgente;
	$codtipoagenet_portal = @@frm_codTipoAgente;

	$sql_cata_infoAgente = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_agente'";
	$rs_infoAgente=  executeQuery($sql_cata_infoAgente);

	$url_infoAgente = isset($rs_infoAgente['1']['DESCRIPCION']) ? $rs_infoAgente['1']['DESCRIPCION'] : '';
	$url_infAgente_param = 	$url_infoAgente.'codigoAgente='.$codagenet_portal.'&codigoTipoAgente='.$codtipoagenet_portal;

	try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_infAgente_param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Accept-Language: application/json",
				"Authorization: Bearer ". $token
			)
		);

		$res = curl_exec($ch);

		if(curl_errno($ch)){
			$msg_m = curl_error($ch);
			@@tri_msg_error = $msg_m;
		}
		curl_close($ch);

		$result = json_decode($res);

		$i = 1;
		$datos_result = $result->data;

		foreach($datos_result as $dataAgente){
			@@frm_busqueda_datosBroker = $dataAgente->txtApellido1;
			@@frm_busqueda_datosBroker_Id = $dataAgente->nroNit;
			}

	    PMFBitacoraServicios(
		@@APP_NUMBER,
		'trigger',
		'IDS-PLSG-62',
		$url_infAgente_param,
		'GET',
		"Accept: application/json" .
		" Content-Type: application/json" .
		" Accept-Language: application/json" .
		" Authorization: Bearer ". $token,
		'',
		$res,
		json_encode($msg_m));
	}
	catch(Exception $e)
	{
		//echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
		$result['mensaje'] = 'false';
		$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
		@@tri_msg_error = $msg_m;
	}

