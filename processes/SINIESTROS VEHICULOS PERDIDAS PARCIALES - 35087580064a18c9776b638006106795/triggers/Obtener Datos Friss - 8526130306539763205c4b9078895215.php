<?php
//Obtener Datos Friss
//<?php
//Incializar Datos Solicitud


if(@@frm_friss_score != ""){
    return;
}
 
$pro_uid = @@PROCESS;
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
$rs_auth = executeQuery($sql_cata_auth);

$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

$sql_frizz_url = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consulta_Friss'";
$rs_frizz = executeQuery($sql_frizz_url);

$url_frizz = isset($rs_frizz['1']['DESCRIPCION']) ? $rs_frizz['1']['DESCRIPCION'] : '';
$url_frizz_param = $url_frizz;

$sql_auth_frizz = "SELECT VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'FRIZZ_BEARER'";
$rs_auth_frizz = executeQuery($sql_auth_frizz);

$bearerAuth = isset($rs_auth_frizz['1']['VALOR']) ? $rs_auth_frizz['1']['VALOR'] : '';
//get the two first words in @@frm_busqueda_nombres


$nombres = explode(" ", @@frm_busqueda_nombres);
$nombres = $nombres[0] . " " . $nombres[1];
$apellidos = "";
try{
    //everything else
    $apellidos = explode(" ", @@frm_busqueda_nombres);
    $apellidos = $apellidos[2] . " " . $apellidos[3];
} catch (Exception $e) {
    $apellidos = "";
}

if(@@frm_busqueda_tipoContratante=='2'){
    //JURIDICO
    $nombres = @@frm_busqueda_nombres;
    $apellidos = "";
}

$negocio = @@frm_poliza_LineaNegocio == 'MASIVO' ? 'MASIVOS' :  @@frm_poliza_LineaNegocio;

$today = date("d/m/Y");
$anio_fab = @@frm_vehiculo_anio;
$num_poliza = @@frm_poliza_numero;

$hora_reporte = @@frm_busqueda_horaSiniestro;
if (strpos($hora_reporte, " ") !== false) {
    $hora_reporte = explode(" ", $hora_reporte);
    $hora_reporte = $hora_reporte[1];
}
if($hora_reporte == ""){
    $hora_reporte = "00:00:00";
}

$fec_hora_reclamo = @@frm_busqueda_fechaSiniestro . "T" . $hora_reporte . "Z";
$fec_hora_recepcion =  @@fecha_hora_recepcion;
$fec_recepcion = @@frm_busqueda_fechaSiniestro;
$ciudad_accidente = @@frm_accidente_ciudad_nombre;
$identificador_conductor = @@frm_conductor_identificacion;
$nombre_cobertura = @@nombre_cobertura;
$prima_neta = @@frm_primaNeta;
$cod_item = @@frm_codItem;
$suma_asegurada = @@frm_sumaAseguradaTotal;
$nro_siniestro = @@id_stro;
//retirar todo luego de T
$fecha_emision = explode("T", @@frm_taller_fechaIngreso);
$fecha_emision = $fecha_emision[0];
$fecha_inicio_poliza = explode("T", @@frm_poliza_FechaInicio);
$fecha_inicio_poliza = $fecha_inicio_poliza[0];
$fecha_fin_poliza = explode("T", @@frm_poliza_FechaFin);
$fecha_fin_poliza = $fecha_fin_poliza[0];
$aseg_tipo_dentificacion = "";
$identificacion = @@frm_asegurado_identificacion;
/*if (@@frm_asegurado_identificacion.length > 10) {
    $aseg_tipo_dentificacion = "RUC";
} else {
    $aseg_tipo_dentificacion = "CI";
}*/
if (strlen($identificacion) > 10) {
    $aseg_tipo_dentificacion = "RUC";
} else {
    $aseg_tipo_dentificacion = "CI";
}


$array_datos_frizz = array(
    "tipo_endoso" => "INDEMNIZACION",
    "ramo" => @@frm_poliza_ramo,
    "negocio" => $negocio,
    "tipo_persona" => @@frm_busqueda_tipoContratante == '2' ? "JURIDICO" : "NATURAL",
	//"tipo_persona" =>"NATURAL",
    "tipo_agente" => "TRUE",
    "ciudad_agente" => @@frm_poliza_sucursal,
    "aseg_nombres" => $nombres,
    "aseg_apellidos" => $apellidos,
    "aseg_genero" => "MASCULINO",
    "aseg_identificacion" => @@frm_asegurado_identificacion ?@@frm_asegurado_identificacion:"0" ,
    "aseg_tipo_dentificacion" => $aseg_tipo_dentificacion,
    "aseg_estado_civil" => "UNION LIBR",
    "aseg_fecha_nac" => "2023-09-06",
    "aseg_telefono" => @@frm_busqueda_celular_1,
    "aseg_celular" => @@frm_busqueda_celular_1,
    "aseg_email" => @@frm_busqueda_mail_1,
    "aseg_tipo_cta_ban" => "",
    "vh_anio_fab" => "$anio_fab",
    "vh_placa" => @@frm_vehiculo_placa,
    "vh_inspeccion" => "TRUE",

    "fecha_fin_vigencia" => $fecha_fin_poliza,
    "fecha_ini_vigencia" => $fecha_inicio_poliza,
    "tipo_uso" => "PRIVADO",
    "pol_estado" => "ACTIVO",
    "vh_chasis"=>@@frm_vehiculo_chasis,
    "coberturas"=> "",
    "suma_asegurada"=> "$suma_asegurada",
    "prima"=> "$prima_neta",
    "conducto_pago"=> "",
    "plan_pago"=> "",
    "causa_siniestro"=> "$nombre_cobertura",
    "fecha_ocurrencia_siniestro"=> "$fec_hora_reclamo",
    "tipo_atencion"=> "",
    "monto_siniestro"=> "0", //DEFAULT EN 0
    "fecha_registro_siniestro"=> "$fec_recepcion",
    "lugar_ocurrencia"=> "$ciudad_accidente",
    "identificacion_beneficiario"=> "",
    "identificacion_pagador"=> "",
    "conductor_identificacion"=> "$identificador_conductor",
    "num_poliza"=> "$num_poliza",
    "cod_item"=> "$cod_item",
    "nro_siniestro" => "$nro_siniestro",
    "bpm_app_number" => @@APP_NUMBER,
    "bpm_app_uid" => @@APPLICATION

);
//"fecha_emision" => $fecha_emision,
if ($fecha_emision != ''){
    $array_datos_frizz["fecha_emision"] = $fecha_emision;
}



$json = json_encode($array_datos_frizz);

@@datos_frizz_json = $json;

try {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_frizz_param);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
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
            "Connection:keep-alive",
            "User-Agent: PostmanRuntime/7.35.0",
            "apikey: $token",
            "Authorization: Bearer $bearerAuth"
        )
    );

    $res = curl_exec($ch);
	$msg_m = "";
    if (curl_errno($ch)) {
        $msg_m = curl_error($ch);
        echo(" ERROR ");
       echo $msg_m;

    }
    curl_close($ch);



    $result = json_decode($res);

    @@frm_friss_score = $result->descripcion;
    $data_friss['1'] = array(
        'frm_friss_fecha' => date("d/m/Y"),
        'frm_friss_name' => $result->indicador->name,
        'frm_friss_value' => $result->indicador->value,
        'frm_friss_argumentation' => $result->indicador->descripcionArgumentation
    );

    @=frm_friss_grid = $data_friss;

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'ODF-VPP-204',
        $url_frizz_param,
        'POST',
        "Accept: application/json" .
        " Content-Type: application/json" .
        " Accept-Language: application/json" .
        " Connection:keep-alive" .
        " User-Agent: PostmanRuntime/7.35.0" .
        " apikey: $token" .
        " Authorization: Bearer $bearerAuth",
        $json,
        $res,
        $msg_m);

} catch (Exception $e) {
    echo 'ExcepciÃƒÂ³n capturada Friss: ', $e->getMessage(), "\n";

    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    //@@tri_msg_error = $msg_m;
}

 