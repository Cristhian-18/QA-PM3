<?php
//created by Henry
//Obtener Sumatoria Cumulos
//22-12-2022

@@__ERROR__ = '';
$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;

$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'CUMULOS'";
	$rs =  executeQuery($sql_cata, $cnx_rp);
	$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
	$dns = $url;

$nro_doc = @@frm_numero_identificacion;
$aVars = array(
			   "nro_doc" => $nro_doc
			);
		$json = json_encode($aVars);

//print_r($json);
$mensaje = 'true';
$msg_m = '';
$result = null;

try{

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $dns);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
				array(
					"Accept: application/json",
					"Content-Type: application/json",
					"Accept-Language: application/json"
				)
			);

			$res = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if(curl_errno($ch)){
				//Error de transporte (no hubo respuesta del servicio web)
				$msg_m = 'Error de conexion con el servicio web: '.curl_error($ch);
				$mensaje = 'false';
			}elseif($http_code < 200 || $http_code >= 300){
				//El servicio web respondio, pero con un codigo de error HTTP
				$msg_m = 'El servicio web respondio con error HTTP '.$http_code.': '.$res;
				$mensaje = 'false';
			}

			curl_close($ch);

			if($mensaje != 'false'){
				$result = json_decode($res);
				if(json_last_error() !== JSON_ERROR_NONE){
					//El servicio web respondio con un cuerpo que no es JSON valido
					$msg_m = 'Respuesta invalida del servicio web: '.json_last_error_msg();
					$mensaje = 'false';
				}elseif(isset($result->isError) && $result->isError){
					//El servicio web respondio HTTP 200, pero reporto un error de negocio
					$msg_m = 'El servicio web reporto un error: ['.$result->errorNumber.'] '.$result->errorType.' - '.$result->message;
					$mensaje = 'false';
				}
			}

		PMFBitacoraServicios(
		@@APP_NUMBER,
		'trigger',
		'OSC-VVE-51',
		$dns,
		'POST',
		'NO',
		json_encode($json),
		json_encode($result),
		json_encode($msg_m));

	}catch(Exception $e)
	{
		//echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
		$mensaje = 'false';
		$msg_m = 'Excepcion capturada: Error al consultar el servicio web, comuniquese con el administrador.- '.$e->getMessage();
	}

$bandera_canceladas = 0;
if($mensaje == 'false'){
	@@frm_cumulo_vida = 0;
	@@frm_cumulo_vida_muerte = 0;
	//Hubo un error consultando el servicio web: se fuerza el envio a Referir para revision manual
	$bandera_canceladas = 1;
}else{
	@@frm_cumulo_vida = $result->cumulo_vida;
	@@frm_cumulo_vida_muerte = $result->cumulo_myda;

	$arr_cancelada = is_array($result->Canceladas) ? $result->Canceladas : array();
	foreach($arr_cancelada as $data){
		//$fecha = date_create($data->fecha_cancelacion);
		$fecha = DateTime::createFromFormat('d/m/Y H:i:s', $data->fecha_cancelacion);
		$fecha_format = date_format($fecha, 'Y-m-d');
		$date_time = date('Y-m-d');
		$date_diff = strtotime($date_time) - strtotime($fecha_format);
		$secondsIn5Years = 157680000;
		if($date_diff < $secondsIn5Years){
			$bandera_canceladas = $bandera_canceladas + 1;
		}
	}
}
//se la bandera es mayor que 0 hay referir
@@tri_bandera_canceladas = $bandera_canceladas;
