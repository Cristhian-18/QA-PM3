<?php
if(@@frm_accion == 'CONTINUAR'){
    @@tri_contador_recordatorio = 0;
}
@@tri_bandera_indemnizacion	 = 0;

 
unset(@@grd_vehiculos_afectados['accesorios']);

 
if(@@TASK == '21947251964a193141bc7e8005186014' || @@TASK == '20216636065412a27cfd079043017144'){
	$usruid = @@USER_LOGGED;
}else{
	$usruid = @@tri_user_taller;
}

$aUser = PMFInformationUser($usruid);

$tri_taller_mail = $aUser['mail'];

$sql = "SELECT
  id_sise,
  nombre_taller,
  representante,
  nombre_contacto,
  telefono_contacto,
  email_taller,
  cod_provincia,
  provincia,
  cod_canton,
  canton,
  direccion,
  sector,
  tipo,
  cod_marca,
  marcas,
  prioridad,
  capacidad,
  estado,
  ruc_taller
FROM
  certificacion.SINIESTROS_DIRECCIONADOR
  WHERE email_taller = '$tri_taller_mail'
  ";

$rs = executeQuery($sql);

if(empty($rs)){
	$tri_taller_mail = $aUser['position'];
$sql = "SELECT
  id_sise,
  nombre_taller,
  representante,
  nombre_contacto,
  telefono_contacto,
  email_taller,
  cod_provincia,
  provincia,
  cod_canton,
  canton,
  direccion,
  sector,
  tipo,
  cod_marca,
  marcas,
  prioridad,
  capacidad,
  estado,
  ruc_taller
FROM
  certificacion.SINIESTROS_DIRECCIONADOR
  WHERE email_taller = '$tri_taller_mail'
  ";

$rs = executeQuery($sql);
}
 

if(empty($rs)){
	return;
}

@@frm_taller = $rs['1']['nombre_taller'];
@@frm_taller_nombreContacto = $rs['1']['nombre_contacto'];
@@frm_taller_telefonoContacto = $rs['1']['telefono_contacto'];
@@frm_taller_email = $rs['1']['email_taller'];
@@frm_taller_provincia = $rs['1']['provincia'];
@@frm_taller_ciudad = $rs['1']['canton'];
@@frm_taller_direccion = $rs['1']['direccion'];
@@frm_taller_sector = $rs['1']['sector'];
@@frm_taller_tipo = $rs['1']['tipo'];


//RUC TALLER - Cristhian 17/07/2026
@@frm_ruc_taller = $rs['1']['ruc_taller'];


 
//Obtener Regla Derivacion LEGAL

$process = @@PROCESS;

//se basa en la ciudad de la póliza

$ciudad = @@frm_poliza_sucursal;
//$ciudad = "QUITO";

$ciudad_siniestro = @@frm_accidente_provincia;
if (!is_numeric($ciudad_siniestro)) {
    $ciudad_siniestro = 17;
}

$sql_region = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'PROVINCIAS_DERIVACION_LEGAL'
AND CODIGO = '$ciudad_siniestro'";

$rs_region = executeQuery($sql_region);
$region = $rs_region['1']['VALOR'];
 

//OBTENER ANALISTA DE NEGATIVAS
$sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'NEGATIVA_VEHICULOS'
AND VALOR = '$region'";

@@sql_analista_negativas = $sql_a;

$rs_a = executeQuery($sql_a);
$abogado = $rs_a['1']['INTEGRACION'];
$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$abogado'";
$rs_u = executeQuery($sql_u);

@@tri_usr_negativa_legal =  $rs_u['1']['USR_UID'];

 

$sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'ASISTENCIA_VEHICULOS'
AND CODIGO = '$ciudad_siniestro'
ORDER BY RAND()";

@@sql_abogado = $sql_a;


$rs_a = executeQuery($sql_a);

$abogado = $rs_a['1']['INTEGRACION'];

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$abogado'";
$rs_u = executeQuery($sql_u);

@@tri_usr_legal =  $rs_u['1']['USR_UID'];

if (empty(@@tri_usr_negativa_legal)) {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'kolvera'";
    $rs_u = executeQuery($sql_u);

    @@tri_usr_negativa_legal =  $rs_u['1']['USR_UID'];
}

if (empty(@@tri_usr_legal)) {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'clamorales'";
    $rs_u = executeQuery($sql_u);

    @@tri_usr_legal =  $rs_u['1']['USR_UID'];
}

@@frm_comentario = null;
@@frm_comentario_aux = null;
@@frm_accion = null;
@@frm_accion_label = null;

//Consultar condiciones Poliza

$pro_uid = @@PROCESS;
 
@@proccess_padre = @@PROCESS;

//catalogos de marcas modelos
//obtengo el token
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN'";
$rs_auth =  executeQuery($sql_cata_auth);

$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

$sql_cata_condicionesPoliza = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_Condiciones_Poliza'";
	$rs_condicionesPoliza=  executeQuery($sql_cata_condicionesPoliza);

	$url_condicionesPoliza = isset($rs_condicionesPoliza['1']['DESCRIPCION']) ? $rs_condicionesPoliza['1']['DESCRIPCION'] : '';
	$idPv = @@frm_id_pv;

    $url_inCondiciones_param = $url_condicionesPoliza.$idPv;

    try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_inCondiciones_param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
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
		$result = json_decode($res, true);

		  PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'CCP-SVPP-52',
      $url_inCondiciones_param,
      'GET',
      "Authorization: Bearer ". $token,
      '',
      json_encode($result),
      json_encode($msg_m));

		$id_poliza = $result['response']['nroPoliza'];
        $text_poliza = $result['response']['descripcion'];

		$text_poliza_replaced = str_replace("\r","<br />", $text_poliza);
		$text_poliza_replaced = str_replace("\n","<br />", $text_poliza_replaced);
		$text_poliza_replaced = str_replace("\t"," ", $text_poliza_replaced);

		@@tri_condiciones_poliza = $text_poliza_replaced;


	}
	catch(Exception $e)
	{
		 
		$result['mensaje'] = 'false';
		$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
		@@tri_msg_error = $msg_m;
	}


	//Consultar Cartera


	$sql_cata_cartera = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Deuda_asegurado'";
	$rs_carteraPoliza=  executeQuery($sql_cata_cartera);

	$url_cartera = isset($rs_carteraPoliza['1']['DESCRIPCION']) ? $rs_carteraPoliza['1']['DESCRIPCION'] : '';

	$idaseg = (@@frm_cod_asec == '' ? @@frm_codAseg : '' );
    $url_cartera_param = $url_cartera.$idaseg;

    try{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_cartera_param);
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
					@@tri_cartera = "Hubo un error al consultar la cartera del cliente, por favor, contacte a un administrador";

		}
		curl_close($ch);
		$result = json_decode($res, true);

		  PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'CCP-SVPP-122',
      $url_cartera_param,
      'GET',
      "Authorization: Bearer ". $token,
      '',
      json_encode($result),
      json_encode($msg_m));

        $tri_cartera_dias = $result['respuesta'][0]['dias'];
		$tri_cartera_monto = $result['respuesta'][0]['valor_deuda'];
		@@tri_cartera = "El cliente presenta una deuda de ".$tri_cartera_monto." con ".$tri_cartera_dias." dias de mora.";
	}
	catch(Exception $e)
	{
		@@tri_cartera = "Hubo un error al consultar la cartera del cliente, por favor, contacte a un administrador";
 
		$result['mensaje'] = 'false';
		$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
		@@tri_msg_error = $msg_m;
	}


    
if(@@tri_resultado_automatico == 'SI') {
    @=frm_accion_dum = array();
    @=frm_accion_dum[] = array("AUTOMATICO", "Continuar con proceso automático");
}
else if(@@tri_resultado_automatico == 'NO') {
    if(stripos(@@frm_taller, "MUNDO MOTRIZ") !== false) {
        @@tri_bandera_mundoMotriz = "1";
        @=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        @=frm_accion_dum[] = array("CONTINUAR", "Enviar al PDA para su aprobación");
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
        @=frm_accion_dum[] = array("RECOTIZAR", "Solicitar recotización a Mundo Partes");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
        @=frm_accion_dum[] = array("INDEMNIZAR", "Solicitar aprobación de indemnización");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación peritaje / Ajustador externo");
        @=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
        @=frm_accion_dum[] = array("NEGAR", "Asignar causales para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
        @=frm_accion_dum[] = array("RESPONSABILIDAD", "Generar Responsabilidad Civil");
    }
    else if(@@frm_taller_tipo == "TALLER AUTORIZADO MULTIMARCA") {
        @=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        if(@@tri_bandera_indemnizar == "1") {
            @=frm_accion_dum[] = array("INDEMNIZAR", "Proceder al envio de correo de indemnización");
        } else {
            @=frm_accion_dum[] = array("VERIFICAR", "Enviar al ajustador interno para su aprobación");
        }
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
        @=frm_accion_dum[] = array("INDEMNIZAR", "Solicitar aprobación de indemnización");
        @=frm_accion_dum[] = array("RECOTIZAR", "Solicitar recotización a Mundo Partes");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación peritaje / Ajustador externo");
        @=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
        @=frm_accion_dum[] = array("NEGAR", "Asignar causales para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
        @=frm_accion_dum[] = array("RESPONSABILIDAD", "Generar Responsabilidad Civil");
    }
    else {
        @=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        if(@@tri_bandera_indemnizar == "1") {
            @=frm_accion_dum[] = array("INDEMNIZAR", "Proceder al envio de correo de indemnización");
        } else {
            @=frm_accion_dum[] = array("VERIFICAR", "Enviar al ajustador interno para su aprobación");
        }
        @=frm_accion_dum[] = array("SOLICITAR", "Solicitar información al Cliente");
        @=frm_accion_dum[] = array("ACTUALIZAR", "Mantener en la gestión del analista");
        @=frm_accion_dum[] = array("INDEMNIZAR", "Solicitar aprobación de indemnización");
        @=frm_accion_dum[] = array("REQUERIR", "Solicitar aprobación peritaje");
        @=frm_accion_dum[] = array("SUSTITUIR", "Solicitar auto sustituto");
        @=frm_accion_dum[] = array("PERDER", "Determinar pérdida total");
        @=frm_accion_dum[] = array("APROBAR", "Solicitar aprobación carta no supera deducible");
        @=frm_accion_dum[] = array("NEGAR", "Asignar causales para negativa");
        @=frm_accion_dum[] = array("FINALIZAR", "Cierre administrativo del caso");
        @=frm_accion_dum[] = array("RESPONSABILIDAD", "Generar Responsabilidad Civil");
    }
}



@@today = date("Y-m-d", time() + 86400);

@@hoy= date("Y-m-d");
@@ahora = date("H:i");

@@frm_emisionNegativa_fechaAnalisis = date("Y-m-d");
@@frm_emisionNegativa_ciudad = @@frm_accidente_ciudad;


$documentos = array();

$documentos = @@gridDocumentos;

$lenght = sizeof($documentos);

$last_date = $documentos[$lenght]['gridDocumentos_Fecha'];

@@frm_emisionNegativa_fechaUltimoDoc = $last_date;

//Calculate days between today and last document date

$dias = @@today - @@frm_emisionNegativa_fechaUltimoDoc;
@@frm_emisionNegativa_fechaUltimoPoliza = $dias;

if (
	@@frm_valoresAprobados_totalProformado != null &&
	@@frm_valoresAprobados_totalProformado != '' &&
	!is_nan(@@frm_valoresAprobados_totalProformado)
) {
	return;
}


$taller = @@frm_taller;

$tipo = @@frm_taller_tipo;
$array_valores = array();
$array_valores = @@grd_valores_siniestros;
$suma = 0;
$suma_aux = 0;
$repuestos_len = isset($array_valores);
 
foreach ($array_valores as $valor) {
	 
	if (
		$valor['frm_gvs_cantidad'] != '' && $valor['frm_gvs_cantidad'] != null && $valor['frm_gvs_pvp'] > 0
		&& is_numeric($valor['frm_gvs_pvp'])
	) {
		 
		$valor_pvp =  $valor['frm_gvs_pvp'] ?  $valor['frm_gvs_pvp'] : 0;
	 
		$pvp = $valor_pvp;
		$suma = $suma + $pvp;
		$suma_aux = $suma;
	} else {
		echo "Nan";
	}
}

$suma = round($suma, 2);

 

 

$valores_repuestos = (@@frm_valoresSiniestro_valoresRepuestos1 == '' || @@frm_valoresSiniestro_valoresRepuestos1 == 'NaN' ? 0 : @@frm_valoresSiniestro_valoresRepuestos1);
 

if ($valores_repuestos == 'NaN') {
	echo "is_nan";
}

try {
	if ($valores_repuestos != null && $valores_repuestos != '' && !is_nan($valores_repuestos) && $valores_repuestos != 'NaN') {
	 
		$suma = $valores_repuestos;
		$suma_aux = $suma;
	 
	} else {
		echo "is_nan3";
	}
} catch (Exception $e) {
	echo $e;
}


 

if ($suma == 0 || $suma == "0" || is_nan($suma)) {
	$suma = @@frm_valoresSiniestro_valoresRepuestos1 ? @@frm_valoresSiniestro_valoresRepuestos1 : 0;
	$suma_aux = ($suma == 'NaN' ? 0 : $suma);
	$suma = ($suma == 'NaN' ? 0 : $suma);
}
 

try {
	$suma = number_format($suma, 2, '.', '');
} catch (Exception $e) {
	$suma = 0;
}
 
if ($tipo == "TALLER AUTORIZADO MULTIMARCA" && $suma > 0.01) {

	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	if (@@frm_valoresSiniestro_procentajeDescuentoProformado == null || @@frm_valoresSiniestro_procentajeDescuentoProformado == '') {
		@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	}
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;
}


if (stripos(@@frm_taller, "MUNDO MOTRIZ") !== false && $suma > 1) {
	$suma = $suma_aux;
	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;

	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;

	@@frm_valoresAprobados_valoresRepuestos1 = $suma;
	@@frm_valoresAprobados_procentajeDescuentoProformado = 0;
	@@frm_valoresAprobados_valorRepuestosProformado = $suma;

	@@frm_valoresAprobados_manoObraProformada = @@frm_valoresSiniestro_manoObraProformada;
	@@frm_valoresAprobados_diasEstimadosReparacion = @@frm_valoresSiniestro_diasEstimadosReparacion;
}

if (stripos(@@frm_taller, "MUNDO MOTRIZ") !== false && $suma <= 1) {
	$suma = 0;

	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;

	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;

	@@frm_valoresAprobados_valoresRepuestos1 = $suma;
	@@frm_valoresAprobados_procentajeDescuentoProformado = 0;
	@@frm_valoresAprobados_valorRepuestosProformado = $suma;

	@@frm_valoresAprobados_manoObraProformada = @@frm_valoresSiniestro_manoObraProformada;
	@@frm_valoresAprobados_diasEstimadosReparacion = @@frm_valoresSiniestro_diasEstimadosReparacion;
}

 
$process = @@PROCESS;
$monto_liquidar = 0;
$monto_liquidar = @@frm_valoresSiniestro_totalProformado;
$monto_liquidar = @@frm_valoresAprobados_totalProformado ? @@frm_valoresAprobados_totalProformado : @@frm_valoresSiniestro_totalProformado;
if ($monto_liquidar == 0 || $monto_liquidar == null || $monto_liquidar == '') {
	$monto_liquidar = 0;
}

$sql_analista =
	"SELECT * FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND $monto_liquidar >= VALOR AND $monto_liquidar <= INTEGRACION";

 


$rs_a = executeQuery($sql_analista);

$pda_asignado = $rs_a['1']['DESCRIPCION'];

//check if the pda_asignado is EJECUTIVO_SR

if ($pda_asignado == 'EJECUTIVO_JR') {
	@@tri_pda_aprobacion = @@tri_usr_analista;
	/*echo(@@USER_LOGGED);
		die();*/
	return;
}

//TICKET REQ 2025-007132 
if ($pda_asignado == 'EJECUTIVO_SR') {
	//get the next bracket 
	$group = $rs_a['1']['CAMPO1'];

	$groupUID = PMFGetGroupUID($group);

	$groupArray = PMFGetGroupUsers($groupUID);

	//get the analyst user
	$usr_analista = @@tri_usr_analista;

	//check if the user is in the group
	$found = false;
	foreach ($groupArray as $user) {
		if ($user['USR_UID'] == $usr_analista) {
			$found = true;
			
			break;
		}
	}

	if ($found) {
		$sql_analista =
			"SELECT * FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND DESCRIPCION = 'COORDINACION'";


		$rs_a = executeQuery($sql_analista);
		$pda_asignado = $rs_a['1']['DESCRIPCION'];
	}
}

@@sql_analista = $sql_analista;

if ($pda_asignado == 'COORDINACION') {
	$provincia_accidente = strval(@@frm_accidente_provincia);

	$array_sierra = array("1", "2", "3", "4", "5", "6", "10", "17", "18");

	$array_costa_amazonia = array("7", "8", "9", "12", "13", "14", "20", "21", "22", "23", "24");


	if (in_array($provincia_accidente, $array_sierra)) {
		$value_taller = "SIERRA";
	} else {
		$value_taller = "COSTA";
	}
	$sql_analista =
		"SELECT * FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND $monto_liquidar >= VALOR 
AND $monto_liquidar <= INTEGRACION and CAMPO2 = '$value_taller'";

	$rs_a = executeQuery($sql_analista);

	if (empty($rs_a['1']['CAMPO1'])) {
		$sql_analista =
			"SELECT * FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND  CAMPO2 = '$value_taller'";
		$rs_a = executeQuery($sql_analista);
	}
}
$group = $rs_a['1']['CAMPO1'];

$groupUID = PMFGetGroupUID($group);

$groupArray = PMFGetGroupUsers($groupUID);
$array_value = '0';

$length_group = sizeof($groupArray);

if ($rs_a['1']['DESCRIPCION'] == 'EJECUTIVO_SR') {
	$array_value = rand(0, $length_group - 1);
	$array_value = strval($array_value);
} else {
	//$array_value = '0';
	$array_value = rand(0, $length_group - 1);
	$array_value = strval($array_value);
}

$usr_uid = $groupArray[$array_value]['USR_UID'];
$usr_name = $groupArray[$array_value]['USR_USERNAME'];

@@tri_pda_aprobacion = $usr_uid;

$usr_analista = @@tri_usr_analista;

	$valor_aprobacion = 0;

	if (@@frm_valoresAprobados_totalProformado == '' || @@frm_valoresAprobados_totalProformado == 0 || @@frm_valoresAprobados_totalProformado == null) {
		$valor_aprobacion = @@frm_valoresSiniestro_totalProformado;
	} else {
		$valor_aprobacion = @@frm_valoresAprobados_totalProformado;
	}

	if ($valor_aprobacion == '' || $valor_aprobacion == 0 || $valor_aprobacion == null) {
		$valor_aprobacion = 0;
	}

	if ($valor_aprobacion > 50000) {
		$group = 'DIRECCION_PDA_VH';
		$groupUID = PMFGetGroupUID($group);
		$groupArray = PMFGetGroupUsers($groupUID);
		$usr_uid = $groupArray['0']['USR_UID'];
		$usr_name = $groupArray['0']['USR_USERNAME'];
		@@tri_aprobador_negativa = $usr_uid;
	} else {
		//mail aprobador 
		$aprobador_mail = @@frm_emisionNegativa_jefatura;

		$sql_usrid = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$aprobador_mail'";
		$usr_id = executeQuery($sql_usrid);
		$usr_uid = $usr_id[1]['USR_UID'];
		$usr_name = $usr_id[1]['USR_USERNAME'];
		@@tri_aprobador_negativa = $usr_uid;
	}

    //Asignar Ajustador

$pro_uid = @@PROCESS;
$group = 'VH_SINIESTROS_AJUSTADORES_INTERNOS';

$groupUID = PMFGetGroupUID($group);
$groupArray = PMFGetGroupUsers($groupUID);

 

$group_analistas = 'SINIESTROS_ANALISTAS_VH';
$groupUID_analistas = PMFGetGroupUID($group_analistas);
$groupArray_analistas = PMFGetGroupUsers($groupUID_analistas);



//get user name
$current_user = @@USER_LOGGED;
//select a random  and assign it to the variable
foreach ($groupArray as $user) {
    if ($user['USR_UID'] == $current_user) {
        $usr_uid = $user['USR_UID'];
        @@tri_user_auditor = $usr_uid;
        return;
    }
}

$tipo_veh = @@frm_vehiculo_tipo;

if ($tipo_veh != "PESADO") {
    $tipo_veh = "LIVIANO";
}
 
$provincia_accidente = @@frm_accidente_provincia;
 
if ($provincia_accidente == '' || $provincia_accidente == 'undefined') {
    $provincia_accidente = 0;
}
//to int
$provincia_accidente = $provincia_accidente * 1;

$sql = "SELECT CODIGO FROM ADMIN_CATALOGOS WHERE
     PRO_UID = '$pro_uid'
     AND COD_CATALOGO = 'AJUSTADORES_PROVINCIA'
     AND DESCRIPCION = '$tipo_veh'
     AND VALOR = '$provincia_accidente'
     AND ESTADO = 1
     ORDER BY RAND() LIMIT 1";
 
$rs = executeQuery($sql);
 
if (empty($rs)) {
   

    $sql = "SELECT CODIGO FROM ADMIN_CATALOGOS WHERE
     PRO_UID = '$pro_uid'
     AND COD_CATALOGO = 'AJUSTADORES_PROVINCIA'
     AND DESCRIPCION = '$tipo_veh'
     AND VALOR = ''
     AND ESTADO = 1
     ORDER BY RAND() LIMIT 1";
    
    $rs = executeQuery($sql);
}

$userName = $rs['1']['CODIGO'];

$sql_user = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$userName'";
$rs_user = executeQuery($sql_user);

@@tri_user_auditor = $rs_user['1']['USR_UID'];

if ($rs_user['1']['USR_UID'] == '') {
    echo 'No hay ajustador asignado con los siguientes criterios:';
    echo 'Tipo de vehiculo: ' . $tipo_veh;
    echo 'Provincia: ' . $provincia_accidente;
    echo 'Ajustador: ' . $userName;
    echo 'No se puede continuar';
   die();

}

if(@@tri_resultado_automatico == 'SI'){
    if (@@tri_usr_analista != @@tri_usr_analista_anterior) {
        @@tri_usr_analista = @@tri_usr_analista_anterior;
    }

    @@frm_comentario = 'PROCESO AUTOMATICO';
@@frm_accion = 'AUTOMATICO';

@@frm_documentos_check = 'SI';

if(@@frm_requiere_PartePolicial == 'NO' || @@frm_requiere_PartePolicial == ''){
    @@frm_requiere_AsesoriaLegal = 'NO';
}
@@frm_siniestro_seConsidera = 'AFECTADO';
@@frm_siniestro_informacionResponsable = 'NO';
@@frm_analisisCoberturas_fecha = date('Y-m-d H:i:s');

if (empty(@@frm_rp_componente_e))       @@frm_rp_componente_e       = 'NO';
if (empty(@@frm_componente_accesorios)) @@frm_componente_accesorios = 'NO';
if (empty(@@frm_requiere_AsesoriaLegal)) @@frm_requiere_AsesoriaLegal = 'NO';

if (empty(@@frm_siniestro_OtrosVehiculos)) @@frm_siniestro_OtrosVehiculos = 'NO';
if (empty(@@frm_siniestro_Propiedad)) @@frm_siniestro_Propiedad = 'NO';
if (empty(@@frm_siniestro_Personas)) @@frm_siniestro_Personas = 'NO';

if (empty(@@frm_conductor_relacion) || @@frm_conductor_relacion === 0) @@frm_conductor_relacion = '11';

if(empty(@@frm_analisisCobertura_analisisTecnico)) @@frm_analisisCobertura_analisisTecnico = 'SI';



$cobertura = @@nombre_cobertura;
$grid = @@grd_registro_siniestro;

foreach ($grid as $i => $row) {
    $grid[$i]['grd_s_aplicar'] = (trim($row['grd_s_cobertura']) === trim($cobertura)) ? 'SI' : 'NO';
}

@@frm_valoresAprobados_totalProformado = @@frm_valoresAprobados_manoObraProformada + @@frm_valoresAprobados_valorRepuestosProformado;

    try {
        @@grd_registro_siniestro = $grid;


$texto = @@tri_condiciones_poliza_label;
$texto = html_entity_decode($texto, ENT_QUOTES, 'UTF-8');
$texto = strip_tags($texto);
$texto = preg_replace('/\s+/', ' ', $texto);

@@frm_deducible_ProcentajeSiniestro = null;
@@frm_deducible_PorcentajeAsegurado = null;
@@frm_deducible_ValorMinimo         = null;

// Paso 1: solo matchea "DEDUCIBLES:" (con S y dos puntos) o "DEDUCIBLE POR EVENTO"
// Ya NO matchea la palabra suelta "DEDUCIBLE" de frases como "EL DEDUCIBLE SE DESCONTARA..."
preg_match('/(?:DEDUCIBLES\s*:|DEDUCIBLE\s+POR\s+EVENTO)[^:]*:?.*?(?=NOTAS ACLARA(?:TORIAS|CIONES)|POLITICAS DE PROTECCION|GARANTIAS DE POLIZA|$)/isu', $texto, $seccionMatch);

if (!empty($seccionMatch[0])) {
    $seccionDeducibles = $seccionMatch[0];

    $corte = '(?=\s*(?:-|Pérdidas?\s+Total(?:es)?|Amparo patrimonial|Taller de convenio multimarca|P[ée]rdidas?\s+Parciales?|$))';

    preg_match('/-?(?:Taller de convenio multimarca|P[ée]rdida(?:\s+Parcial|s\s+Parciales))(?=\s*:|\s*\d)\s*:?\s*(.+?)' . $corte . '/iu', $seccionDeducibles, $bloqueMatch);

    if (!empty($bloqueMatch[1])) {
        $bloque = $bloqueMatch[1];

        preg_match('/(\d+(?:\.\d+)?)\s*%\s*del valor del siniestro/iu', $bloque, $mSiniestro);
        if (isset($mSiniestro[1]) && is_numeric($mSiniestro[1])) {
            @@frm_deducible_ProcentajeSiniestro = (float) $mSiniestro[1];
        }

        preg_match('/(\d+(?:\.\d+)?)\s*%\s*del valor asegurado/iu', $bloque, $mAsegurado);
        if (isset($mAsegurado[1]) && is_numeric($mAsegurado[1])) {
            @@frm_deducible_PorcentajeAsegurado = (float) $mAsegurado[1];
        }

        preg_match('/\$\s*(\d+(?:\.\d+)?)/u', $bloque, $mMinimo);
        if (isset($mMinimo[1]) && is_numeric($mMinimo[1])) {
            @@frm_deducible_ValorMinimo = (float) $mMinimo[1];
        } else {
            preg_match('/no menor a\s*(?:USD\.?)?\s*([\d.,]+)/iu', $bloque, $mMinFb);
            if (!empty($mMinFb[1])) {
                $valorMinimo = str_replace('.', '', $mMinFb[1]);
                $valorMinimo = str_replace(',', '.', $valorMinimo);
                if (is_numeric($valorMinimo)) {
                    @@frm_deducible_ValorMinimo = (float) $valorMinimo;
                }
            }
        }
    }
}
  

        // --- Validación de insumos antes de calcular ---
        @@frm_deducible_ValorAsegurado = @@frm_sumaAseguradaCasco;
        $valor_asegurado = @@frm_deducible_ValorAsegurado;

        $motivos = []; // mismo patrón que tri_resultado_automatico

        if (!is_numeric($valor_asegurado)) {
            $motivos[] = 'Valor asegurado (frm_sumaAseguradaCasco) no numérico o vacío';
        }
        if (@@frm_deducible_ValorMinimo === null) {
            $motivos[] = 'No se pudo extraer valor mínimo de deducible del texto de póliza';
        }
        if (@@frm_deducible_ProcentajeSiniestro === null) {
            $motivos[] = 'No se pudo extraer % deducible sobre siniestro del texto de póliza';
        }
        if (@@frm_deducible_PorcentajeAsegurado === null) {
            $motivos[] = 'No se pudo extraer % deducible sobre valor asegurado del texto de póliza';
        }

        if (!empty($motivos)) {
            // Caso NO apto para cálculo automático -> revisión manual
            @@tri_resultado_automatico = 'NO';
            @@tri_motivo_rechazo = implode(' | ', $motivos);
            @@frm_deducible_Valor = ''; // o el campo que uses para indicar "no calculado"


            $app=@@APPLICATION;
            $usuario = @@tri_usr_analista;

            $sql_usuario = "SELECT USR_ID, USR_EMAIL FROM USERS WHERE USR_UID = '$usuario'";
            $result_usuario = executeQuery($sql_usuario);

            if(is_array($result_usuario) && count($result_usuario) > 0) {
                $analista_id = $result_usuario[1]['USR_ID'];
                $analista_email = $result_usuario[1]['USR_EMAIL'];
    

                @@tri_smart_claims_mensaje = 'Estimado analista, el proceso automático no pudo calcular los valores de deducible debido a que uno o más insumos no son válidos. Por favor, revise el caso y realice el cálculo manualmente. Motivo: ' . @@tri_motivo_rechazo;

              

                $de     = 'bpm@equisuiza.com';
                $para   = $analista_email;
                $cc     = '';
                $bcc    = '';
                $asunto = "Resultado de valores" . @@APP_NUMBER;
                $plantilla = 'notificacion_smart.html';

                PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla, array(
                    "tri_smart_claims_mensaje" => @@tri_smart_claims_mensaje,
                    "tri_motivo_rechazo"       => @@tri_motivo_rechazo,
                    "APP_NUMBER"               => @@APP_NUMBER,
                ));

            }
                

            return;
        }
        
        // Solo se llega aquí si TODOS los datos son reales y numéricos
        $valor_siniestro_deducible = $valor_asegurado * (@@frm_deducible_ProcentajeSiniestro / 100);
        $valor_asegurado_deducible = $valor_asegurado * (@@frm_deducible_PorcentajeAsegurado / 100);

        $menor = min(
            @@frm_deducible_ValorMinimo,
            $valor_siniestro_deducible,
            $valor_asegurado_deducible
        );

        if($valor_asegurado > $menor) {
        @@frm_analisisCobertura_superaDeducible = 'SI';
        }else{
            @@frm_analisisCobertura_superaDeducible = 'NO';
        }
        


    } catch (Exception $e) {
        @@tri_resultado_automatico = 'NO';
        @@tri_motivo_rechazo = 'Error calculando deducible: ' . $e->getMessage();
    }
}


if(@@tri_resultado_automatico == 'SI'){
    $array = array();
    $array = @@grd_valores_siniestros;

    foreach ($array as $key => $value) {
        $pendiente = $value['frm_gvs_estado'];
        if($pendiente == "Pendiente"){
            $array[$key]['frm_gvs_estado'] = "Aprobado";
        }
    }

    @=grd_valores_siniestros = $array;
}


if(@@tri_resultado_automatico == 'SI'){

 
$valores = isset(@=frm_reg_alcances) ? @=frm_reg_alcances : array();

    if(!empty($valores)){
        foreach($valores as $row){
 
            $repuesto_proformado_grid = is_numeric($row['rep_proformado']) ? $row['rep_proformado'] : 0;
            $mano_proformado_grid = is_numeric($row['mano_proformada']) ? $row['mano_proformada'] : 0;
            $total_proformado_grid = is_numeric($row['total_proformado']) ? $row['total_proformado'] : 0;

            $rep_aprobado_grid = is_numeric($row['rep_aprobado']) ? $row['rep_aprobado'] : 0;
            $mano_aprobado_grid = is_numeric($row['mano_aprobado']) ? $row['mano_aprobado'] : 0;
            $total_aprobado_grid = is_numeric($row['total_aprobado']) ? $row['total_aprobado'] : 0;

            $rep_proformado = $rep_proformado + round($repuesto_proformado_grid, 2);
            $mano_proformado = $mano_proformado + round($mano_proformado_grid, 2);
            $total_proformado = $total_proformado +  round($total_proformado_grid, 2);

            $rep_aprobado = $rep_aprobado + $rep_aprobado_grid;
            $mano_aprobado = $mano_aprobado + $mano_aprobado_grid ;
            $total_aprobado = $total_aprobado + $total_aprobado_grid;
        }
    }
  


$valorAlcance = isset($total_aprobado) ? $total_aprobado : 0;
if($valorAlcance == null){
	$valorAlcance = 0;
}
 

$valorSiniestro_t = @@frm_valoresAprobados_totalProformado + $valorAlcance;

$deducible1 = ((@@frm_deducible_ProcentajeSiniestro)/100)* $valorSiniestro_t;

$deducible2 = @@frm_deducible_ValorAsegurado * (@@frm_deducible_PorcentajeAsegurado/100);

 

$deducible3 = @@frm_deducible_ValorMinimo;
//get the highest
$deducible = max($deducible1, $deducible2, $deducible3);

$valorSiniestro = @@frm_valoresAprobados_totalProformado + $valorAlcance - $deducible;

 
 

@@tri_valorReclamo = @@frm_valoresAprobados_totalProformado;// +  $valorAlcance;
@@tri_valorAlcance = $valorAlcance ? $valorAlcance : 0;
@@tri_valorDeducible = $deducible;

$tasa = (@@frm_tasa==''?1:@@frm_tasa);
$fechaSiniestro = @@frm_busqueda_fechaSiniestro;
$fechaFinVigencia = @@frm_poliza_FechaFin;
$fechaFinVigencia = str_replace("/", "-", $fechaFinVigencia);
 

$datetime1 = new DateTime($fechaSiniestro);

$datetime2 = new DateTime($fechaFinVigencia);

$num_pol = @@frm_poliza_numero;
if($fechaFinVigencia == null || $fechaFinVigencia == '' ){
	if($num_pol == '425879'){

		$fechaFinVigencia = '2024-04-01T00:00:00';
		$datetime2 = new DateTime($fechaFinVigencia);
		return;
	}
}

$interval = $datetime1->diff($datetime2);

$days = $interval->format('%a');

 
$days = (int)$days;
@@dias_restantes = $days;
 
$prima_neta = ((($valorSiniestro * $tasa/100) / 365));


$prima_neta = $prima_neta * $days;
@@frm_deducible_prima = $prima_neta;
@@frm_deducible_prima = number_format((float)$prima_neta, 2, '.', '');

@@frm_deducible_porcentajeBancos = '3.5%';
$porcentajeBancos = 3.5;

$supBancos = ($prima_neta * $porcentajeBancos) / 100;
@@frm_deducible_bancos = $supBancos;
@@frm_deducible_bancos = number_format((float)$supBancos, 2, '.', '');

@@frm_deducible_sscampesinoPorcentaje = '0.05%';
$porcentajeSSC = 0.5;

$supSSC = ($prima_neta * $porcentajeSSC) / 100;
@@frm_deducible_sscampesino = $supSSC;
@@frm_deducible_sscampesino = number_format((float)$supSSC, 2, '.', '');


$sql_iva = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'CONFIGURACION'
 AND CODIGO ='IVA'";
$iva = executeQuery($sql_iva);
$porcentajeIVA = $iva[1]['VALOR'];

 
@@frm_deducible_ivaPorcentaje = $porcentajeIVA .'%';

$supIVA = (($prima_neta+ $supBancos+ $supSSC) * $porcentajeIVA) / 100;
@@frm_deducible_iva = $supIVA;
@@frm_deducible_iva = number_format((float)$supIVA, 2, '.', '');

@@frm_deducible_deducible = $deducible;
@@frm_deducible_deducible = number_format((float)$deducible, 2, '.', '');

$valorRasa = @@frm_deducible_prima + @@frm_deducible_bancos + @@frm_deducible_sscampesino + @@frm_deducible_iva;

if($valorRasa < 5){
    $valorRasa = 5.84;
}
@@frm_deducible_rasa = $valorRasa;
@@frm_deducible_rasa = number_format((float)@@frm_deducible_rasa, 2, '.', '');

if($valorRasa == 5.84){
@@frm_deducible_totalCliente = @@frm_deducible_rasa + @@frm_deducible_deducible;
}else{
@@frm_deducible_totalCliente = @@frm_deducible_prima + @@frm_deducible_bancos + @@frm_deducible_sscampesino + @@frm_deducible_iva + @@frm_deducible_deducible;
}

@@frm_deducible_totalCliente = number_format((float)@@frm_deducible_totalCliente, 2, '.', '');
@@frm_deducible_deducible_sin_rasa = number_format((float)@@frm_deducible_deducible, 2, '.', '');
@@tri_valorSiniestro = $valorSiniestro - @@frm_deducible_rasa;

 

}


 
$host = $_SERVER['HTTP_HOST'];
$app_uid = @@APP_NUMBER;
$url = "$host/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/abrir?id=$app_uid";

@@link_abrir = $url;


if(@@tri_user_mundopartes == null || @@tri_user_mundopartes == ''){
	$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'mm_tcatota'";

	$rs_u = executeQuery($sql_u);

	@@tri_user_mundopartes = $rs_u['1']['USR_UID'];
}
	

$array_valores = @@grd_valores_siniestros_alcance;

//check if array [frm_gvs_estado] has any in estado "Pendiente"
$pendientes = "0";

foreach (@@grd_valores_siniestros_alcance as $key => $value) {
    if ($value['frm_gvs_estado'] == 'Pendiente') {
        $pendientes = "1";
        break;
    }
}

if($pendientes != "1"){
    $array_valores_normal = @@grd_valores_siniestros;
    
    foreach (@@grd_valores_siniestros as $key => $value) {
        if ($value['frm_gvs_estado'] == 'Pendiente') {
            $pendientes = "1";
            break;
        }
    }
}


@@tri_bandera_pendientes = $pendientes;
@@tri_bandera_compra_completada = '0';

if(@@frm_accion == "INDEMNIZAR"){
	@@tri_bandera_indemnizar = "1";
}
@@tri_bandera_indemnizar = "0";
if(@@frm_accion == "COTIZAR"){
	@@tri_bandera_cotizar = "1";
}

