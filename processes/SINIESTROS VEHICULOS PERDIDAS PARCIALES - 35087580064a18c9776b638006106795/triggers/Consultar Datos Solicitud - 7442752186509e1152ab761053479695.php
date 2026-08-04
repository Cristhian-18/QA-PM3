<?php
//<?php
//Consultar Datos Solicitud
$hora_reporte = @@frm_busqueda_horaSiniestro;

//cambiar cualquier 60 por 59
$hora_reporte = str_replace("60", "59", $hora_reporte);
@@frm_busqueda_horaSiniestro = $hora_reporte;

$pro_uid = @@PROCESS;
@@tri_msg_error = '';
@@tri_bandera_recupera = '';

//cargar info de la solicitud
$idpv = @@frm_id_pv ? @@frm_id_pv : null;

if($idpv == null){
	$g = new G();
    $msg_m = "El IDPV está vacio";
    $g->SendMessageText($msg_m, 'ERROR');
	return;
}

$placa = @@frm_vehiculo_placa ? @@frm_vehiculo_placa : null;
$codAseg = @@frm_cod_aseg ? @@frm_cod_aseg : null;
$chasis = @@frm_vehiculo_chasis ? @@frm_vehiculo_chasis : null;

if($codAseg == "-1"){
	$codAseg = null;
}

//$array_datos = array('idpv'=>$idpv, "placa"=>$placa, "codAseg"=>$codAseg);
$array_datos = array('idpv' => $idpv, "placa" => $placa, "chasis" => $chasis);

$json = json_encode($array_datos);
// echo 'JSON: '.$json;
	$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
	$rs_auth =  executeQuery($sql_cata_auth);



	$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';



//INFO DE POLIZA POR PLACA E ID_PV
	$sql_cata_poli = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_poliza_Placa_IdPv'";
	$rs_poli=  executeQuery($sql_cata_poli);



	$url_poli = isset($rs_poli['1']['DESCRIPCION']) ? $rs_poli['1']['DESCRIPCION'] : '';
	$url_poli_param = $url_poli;
	$cobertura_flag = 0;




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

		echo 'datos sol';
       print_r($res);
		echo 'fin datos sol';

		if(curl_errno($ch)){
			$msg_m = curl_error($ch);
			@@tri_msg_error = $msg_m;
			@@tri_bandera_recupera = 'true';

		}
		curl_close($ch);

		$result = json_decode($res);

		if($result->codigo == '204' || $result->codigo == '500' || empty($result)){
			@@tri_bandera_error = "1";
			@@frm_accion = "ERROR";
			echo 'No se encontraron datos para la solicitud -
			 Servicio ID_PV Poliza no encontró información con la
			 placa: '.$placa.' y el ID_PV: '.$idpv . ' y el chasis '. $chasis;


		} else {
			@@tri_bandera_error = "0";
		}


		$arr_Dta = array();
		$i = 1;
		$datos_result = $result->data;


		foreach($datos_result as $key => $data){

			if($key == 'poliza'){
				@@frm_poliza_contratante = @@frm_contratante;
				@@frm_id_pv = $data->idPv;
				@@frm_id_pvCero = $data->idPvCero;
				@@frm_codItem = $data->codItem;
				@@frm_poliza_codSucursal = $data->codSucursal;
				@@frm_poliza_sucursal = $data->sucursal;
				@@frm_codRamo = $data->codRamo;
				@@frm_poliza_numero = $data->nroPoliza;
				if($data->nroPoliza == '' || $data->nroPoliza == null){
					@@tri_bandera_error = "1";
					@@frm_accion = "ERROR";
				}

				@@frm_codAseg = $data->codAseg;
				@@frm_cod_aseg = $data->codAseg;
				@@frm_taller_fechaIngreso = $data->fechaEmision;
				@@frm_poliza_FechaInicio = $data->fechaVigenciaDesde;
				@@frm_poliza_FechaFin = $data->fechaVigenciaHasta;
				@@frm_codTipoAgente = $data->codTipoAgente;
				@@frm_codAgente = $data->codAgente;
				@@frm_facultativo = $data->facultativo;
				@@frm_facultado = $data->facultado;
				@@frm_codUsuario = $data->codUsuario;
				@@frm_poliza_codProducto = $data->codProducto;
				@@frm_poliza_producto = $data->producto;
				@@frm_tasa = $data->tasa;
				@@frm_primaNeta = $data->primaNeta;
				@@frm_primaTotal = $data->primaTotal;
				@@frm_sumaAseguradaCasco = $data->sumaAseguradaCasco;
				@@frm_sumaAseguradaTotal = $data->sumaAseguradaTotal;
				@@frm_vehiculo_valor_asegurado = $data->sumaAseguradaTotal;
				@@frm_poliza_ramo = $data->ramo;
			}
			if($key == 'endoso'){

				@@frm_tipoEndoso = $data->tipoEndoso;
				@@frm_grupoEndoso = $data->grupoEndoso;
				@@frm_nroEndoso = $data->nroEndoso;

			}
			if($key == 'movimiento'){

				@@frm_movimiento = $data->movimiento;
			}
			if($key == 'negocio'){

				@@frm_poliza_LineaNegocio = $data->tipoNegocio;
				@@frm_tipoSubNegocio = $data->tipoSubNegocio;
			}

			if($key == 'vehiculo'){
				   @@frm_vehiculo_marca = $data->marca;
				   @@frm_vehiculo_modelo = $data->modelo;
				   @@frm_vehiculo_anio = $data->anioModelo;
				   @@frm_vehiculo_Codtipo = $data->codTipoVeh;

				   @@frm_vehiculo_tipo = $data->tipoVeh;
				   @@frm_vehiculo_gplaca = $data->placa;
				   @@frm_vehiculo_motor = $data->motor;
				   @@frm_vehiculo_chasis = $data->chasis;
				   @@frm_vehiculo_Codcolor = $data->color;
				   @@frm_vehiculo_color = $data->color;
				   @@frm_vehiculo_servicio = $data->placa;
			}

			$aux_cob = 1;
			try{
				$sn_dt = @@tri_sn_dt;
			}
			catch(Exception $e){
				$sn_dt = 0;
			}
            //$sn_dt = @@tri_sn_dt;

            if( $sn_dt = null ||  $sn_dt = ''){
                @@tri_sn_dt = 0;
            }

			if($key == 'coberturas'){
				//print_r($data);
				$coberturas = array();
				//separated by comma from @@frm_cobertura_aplicada
				$coberturas = explode(",", @@frm_cobertura_aplicada);
				// Convierte todos los valores a enteros para evitar problemas de comparación
				$coberturas = array_map('intval', $coberturas);

				// Elimina los valores 5 y 35 del array
				$coberturas = array_diff($coberturas, array(5, 35));
				if(empty($coberturas)){
					// echo 'Coberturas aplicadas: '. @@frm_cobertura_aplicada;
					// echo 'Coberturas vacias - SOLO RC';
					$coberturas = explode(",", @@frm_cobertura_aplicada);
					//die();
				}

				// Reinicia los índices del array resultante (opcional, pero útil)
				$coberturas = array_values($coberturas);

				foreach($data as $datacob){

					$cob_apli = 'NO';
					/*if(@@frm_cobertura_aplicada == $datacob->codCobertura){
						$cob_apli = 'SI';
					}*/

					$datacoblimiteMin = ($datacob->limiteMin == 0 ? '0' : $datacob->limiteMin);
					$datacoblimiteMax = ($datacob->limiteMax == 0 ? '0' : $datacob->limiteMax);
					$datacobertura = ($datacob->codCobertura == 17 ? 'AMPARO PATRIMONIAL' : $datacob->cobertura);
					@=grd_registro_siniestro[$aux_cob] = array(
					   'grd_s_codCobertura'=>$datacob->codCobertura,
					   'grd_s_cobertura'=>$datacobertura,
					   'grd_s_limiteMin'=>$datacoblimiteMin,
					   'grd_s_limiteMax'=>$datacoblimiteMax,
					   'grd_s_codConsecutivo'=>$datacob->codConsecutivo,
					   'grd_s_impPrimaBasica'=>$datacob->impPrimaBasica,
					   'grd_s_impSumaAsegurada'=>$datacob->impSumaAsegurada,
					   'grd_s_aplicar'=>$cob_apli);
					if(in_array($datacob->codCobertura, $coberturas)){
						//print_r($coberturas);
						$cob_apli = 'SI';
						//if $datacob->datacobertura contains "RESPONSABILIDAD CIVIL" then
						//print_r($datacob);
						if(strpos($datacob->cobertura, 'RESPONSABILIDAD CIVIL') !== false){
                           // echo("RESPONSABILIDAD CIVIL");
							@@tri_sn_dt = -1;
                            if($cobertura_flag==0){
								@@tri_cod_cobertura = $datacob->codCobertura;
								@@tri_cod_ind_cob = $datacob->codConsecutivo;
								@@nombre_cobertura = $datacobertura;
								// echo 'Seleccionado: <br>';
								// print_r($datacob);
								$cobertura_flag = 1;
							}
						} else {
							/*echo("Cod_ind_cob ");
							echo(@@tri_cod_ind_cob);*/
              				@@tri_cod_cobertura = $datacob->codCobertura;
							@@tri_cod_ind_cob = $datacob->codConsecutivo;
							@@nombre_cobertura = $datacobertura;
							// echo 'Seleccionado: <br>';
							// print_r($datacob);
						}
					}
					//print_r($datacob);
					$aux_cob++;
				}
			}
			$aux_sini = 1;

			if($key == 'siniestros'){
				foreach($data as $datasin){

					@=grd_historial_siniestros[$aux_sini] = array(
					   'grd_hs_fecha'=>$datasin->fechaRegistro,
					   'grd_hs_siniestro'=>$datasin->nroStro,
					   'grd_hs_inspeccion'=>$datasin->idStroInsp,
					   'grd_hs_siniestro_idStro'=>$datasin->idStro,
					   'grd_hs_codCausa'=>$datasin->codCausa,
					   'grd_hs_causa'=>$datasin->causa,
					   'grd_hs_codCobertura'=>$datasin->codCobertura,
					   'grd_hs_cobertura'=>$datasin->cobertura,
					   'grd_hs_taller'=>$datasin->taller,
					   'grd_hs_ciudad'=>$datasin->ciudadTaller,
					   'grd_hs_usuario'=>$datasin->codUsuarioReporte);
					$aux_sini++;
				}
			}
			$aux_extras = 1;
			if($key == 'accesorios'){
				foreach($data as $dataextra){
					@=grd_accesorios[$aux_extras] = array(
					   'frm_accesorios_accesorio'=>$dataextra->descripcion,
					   'frm_accesorios_sumaAsegurada'=>$dataextra->sumaAsegurada,
					   'frm_accesorios_codAccesorio'=>$dataextra->codAccesorio);
					$aux_extras++;
				}
			}
		}
		@@tri_bandera_error = "0";

		PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'CDS-VPP-295',
        $url_poli_param,
        'POST',
        "Accept: application/json" .
		" Content-Type: application/json" .
		" Accept-Language: application/json" .
		" APIKEY: ". $token,
        $json,
        $res,
        $msg_m);

	}
	catch(Exception $e)
	{
		echo 'ExcepciÃƒÂ³n capturada Consultar: ',  $e->getMessage(), "\n";
		$result['mensaje'] = 'false';
		$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();

		@@tri_msg_error = $msg_m;
		@@tri_bandera_error = "1";
	}

// echo ("ACCION CDS");
// echo (@@frm_accion);

