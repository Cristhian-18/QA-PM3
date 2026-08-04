<?php
//<?php
//Consultar Datos Solicitud

$pro_uid = @@PROCESS;
@@tri_msg_error = '';
@@tri_bandera_recupera = '';

//cargar info de la solicitud
$idpv = @@frm_id_pv ? @@frm_id_pv : null;
$placa = @@frm_vehiculo_placa ? @@frm_vehiculo_placa : null;
$codAseg = @@frm_cod_aseg ? @@frm_cod_aseg : null;

if($codAseg == "-1"){
	$codAseg = null;
}

if(@@nro_inspeccion != null && @@nro_inspeccion != '' ){
	@@tri_id_stro = @@nro_inspeccion. " - ". date("Y");
}

if(@@id_stro_insp != null && @@id_stro_insp != '' ){
	@@tri_nro_stro = @@id_stro_insp;
}

$array_datos = array('idpv'=>$idpv, "placa"=>$placa, "codAseg"=>$codAseg);
$json = json_encode($array_datos);

$id_stro_insp = @@id_stro_insp ? @@id_stro_insp : null;
$id_stro = @@id_stro ? @@id_stro : null;

if($id_stro_insp == null || $id_stro == null){
  return;
}

//cargar datos de analasis
//obtengo el api_key
	$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
	$rs_auth =  executeQuery($sql_cata_auth);

	$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

//INFO DE POLIZA POR PLACA E ID_PV
	$sql_cata_poli = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_poliza_Placa_IdPv'";
	$rs_poli=  executeQuery($sql_cata_poli);

	$url_poli = isset($rs_poli['1']['DESCRIPCION']) ? $rs_poli['1']['DESCRIPCION'] : '';
	$url_poli_param = $url_poli;

	try{
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url_poli_param);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
				array(
					"Accept: application/json",
					"Content-Type: application/json",
					"Accept-Language: application/json",
					"APIKEY: ". $token
				)
			);

		$res = curl_exec($ch);

		if(curl_errno($ch)){
			$msg_m = curl_error($ch);
			@@tri_msg_error = $msg_m;
			@@tri_bandera_recupera = 'true';
		}
		curl_close($ch);

		$result = json_decode($res);

		  PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'ONSDP-SVPP-82',
      $url_poli_param,
      'POST',
      "APIKEY: " . $token,
      json_encode($json),
      json_encode($result),
      json_encode($msg_m));

		if($result->codigo == '204' || $result->codigo == '500' || empty($result)){
			@@tri_bandera_error = "1";
			@@frm_accion = "ERROR";

		} else {
			@@tri_bandera_error = "0";
		}

		$arr_Dta = array();
		$i = 1;
		$datos_result = $result->data;

		foreach($datos_result as $key => $data){
			$aux_sini = 1;
			if($key == 'siniestros'){
				foreach($data as $datasin){
					/*$aux_sini++;*/
            $id_stro_insp_array = $datasin->idStroInsp;
            $id_stro_array = $datasin->idStro;
            //@@tri_nro_stro

            if($id_stro_insp == $id_stro_insp_array && $id_stro == $id_stro_array){
              $id_nro_stro = $datasin->nroStro;
              @@tri_nro_stro = $id_nro_stro;
            }
				}
			}
		}
		@@tri_bandera_error = "0";
	}
	catch(Exception $e)
	{
		echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
		$result['mensaje'] = 'false';
		$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();

		@@tri_msg_error = $msg_m;
		@@tri_bandera_error = "1";
	}

