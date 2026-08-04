<?php
//<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida

$duplicado = @@tri_revisar_duplicado;
if ($duplicado == '1' && @@APP_NUMBER != '2581') {
  // @@error_message = 'Caso con posible duplicidad, por favor, verificar';
  // return;
}
echo ("Reserva");




$pro_uid = @@PROCESS;
$operation_id = @@APPLICATION;
//consulto del catalogo
//obtengo el api_key
$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2, CAMPO1 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Crear_reserva_generales'";
$rs_auth =  executeQuery($sql_cata_auth);

$url_reserva = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

$sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'APIKEY_GENERALES' and PRO_UID = '$pro_uid'";
$rs_apikey =  executeQuery($sql_apikey);

$token = isset($rs_apikey['1']['DESCRIPCION']) ? $rs_apikey['1']['DESCRIPCION'] : '';

//echo ($token . '<br><br>');
//die();
//$url_reserva = isset($rs_auth['1']['CAMPO1']) ? $rs_auth['1']['CAMPO1'] : '';

$sql_webhook = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'WEBHOOK_CREAR_RESERVA'";
$rs_webhook =  executeQuery($sql_webhook);
$webhook = isset($rs_webhook['1']['DESCRIPCION']) ? $rs_webhook['1']['DESCRIPCION'] : '';


/*echo($token);
	echo($url_reserva);*/
//consulto los documento
//output document
$caseUID = @@APPLICATION; //set to the Output Document's unique ID
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
//$hora_reporte = @@frm_busqueda_horaSiniestro;
//if hora reporte contains space, take only the last part

if (strpos($hora_reporte, " ") !== false) {
  $hora_reporte = explode(" ", $hora_reporte);
  $hora_reporte = $hora_reporte[1];
}
//get only hour minute and second from the date
//$hora_reporte = substr($hora_reporte, 11, 8);

$g = new G();

$sn_muestra = -1;


$sn_muestra = -1;
$cod_suc = @@frm_ds_CodsucursalEmision;

$ramo = array();
$ramo = @@grd_ramos;
$cobertura = @@grd_cobertura;
$cod_ramo = $ramo[1]['grd_r_Codramo'];
@@aplicacion_texto = $ramo[1]['grd_r_nAplicacion'];

@@ramo_texto = $ramo[1]['grd_r_ramo'];
@@sucursal_texto = $ramo[1]['grd_r_sucursal'];
@@subramo_texto = @@grd_cobertura[1]['grd_c_subramo'];

@@inciso_texto = @@grd_items[1]['grd_i_direccion'];
@@objeto_texto = @@grd_cobertura[1]['grd_c_objeto'];
@@amparo_texto =  @@grd_cobertura[1]['grd_c_amparo'];

@@valor_solicitado = $cobertura[1]['grd_c_lim_monto_reportado'];
@@suma_asegurada = $cobertura[1]['grd_c_suma_aseg'];

$hora = @@frm_ds_horaOcurrencia;
$hora_insp = @@frm_ii_HoraContacto;
if ($hora_insp == '') {
  $hora_insp = '00:00:00';
}

$tz = "T00:00:00Z";
$tz_hora_ocurrencia = "T" . $hora . "Z";
//replace any 60 seconds with 59
$tz_hora_ocurrencia = str_replace(":60", ":59", $tz_hora_ocurrencia);
$tz_hora_inspeccion = "T" . $hora_insp . "Z";
$tz_hora_inspeccion = str_replace(":60", ":59", $tz_hora_inspeccion);

$nro_pol_in = @@frm_rs_NroPoliza;
$id_pv_in = @@frm_idpv;
$cod_aseg_in = @@frm_rs_codAsegurado;

$txt_aplicacion_in = ''; //BUSCAR

$txt_lugar_insp_in = @@frm_dg_lugarInspeccionSiniestro; //BUSCAR
//max 199 characters
$txt_lugar_insp_in = substr($txt_lugar_insp_in, 0, 199);

//get usrname from tri_usr_analista
if(@@tri_usr_analista == null || @@tri_usr_analista == '') {
  echo '<br> El usuario analista no puede estar vacio<br>';
  return;
}
$id_analista = @@tri_usr_analista;
$sql_username = "SELECT USR_USERNAME
 FROM USERS WHERE USR_UID = '$id_analista'";
$rs_username = executeQuery($sql_username);
if (isset($rs_username['1']['USR_USERNAME'])) {
  $cod_ajustador_inicial = $rs_username['1']['USR_USERNAME'];
} else {
  echo '<br> El usuario analista no existe<br>';
  die();
}

$ajustador_inicial = $cod_ajustador_inicial;
$datos_ajustador_inicial = PMFInformationUser($ajustador_inicial);
$cod_ajustador_inicial_in = $cod_ajustador_inicial;

//$cod_ajustador_inicial_in = null; //BUSCAR
$cod_causa_in = @@frm_is_CodcausaSiniestro;

$cod_item_in = @@grd_items[1]['grd_i_item']; //BUSCAR

$cod_ind_cob_in = $cobertura[1]['grd_c_codigo'];
$txt_direccion_in = @@frm_ii_direccionInspeccion;
//max 199 characters
$txt_direccion_in = substr($txt_direccion_in, 0, 199);
$txt_telefono_in = @@frm_ii_telefonoContacto;
$txt_reportado_in = '';

$fecha_reclamo = @@frm_ds_fechaOcurrencia;
//change date format from dd-MM-YYYY to YYYY-MM-dd
$fecha_reclamo = str_replace("/", "-", $fecha_reclamo);
$fecha_reclamo = date("Y-m-d", strtotime($fecha_reclamo));
@@frm_ds_fechaOcurrencia = $fecha_reclamo;
$fec_hora_reclamo_in = $fecha_reclamo . $tz_hora_ocurrencia;
@@tri_text_hora_reporte = $fec_hora_reclamo_in;
//$fec_hora_reclamo_in = @@frm_ds_fechaOcurrencia . $tz_hora_ocurrencia;
$fecha_inspeccion = @@frm_dg_fechaInspeccionSiniestro ? @@frm_dg_fechaInspeccionSiniestro : date('Y-m-d');
$fec_inspec_in = $fecha_inspeccion . $tz_hora_inspeccion;
//retirar T y Z, GUIONES Y DEJARLO COMO 20240813 15:24:10


$cod_ajustador_in = 1;
$fec_hora_recepcion_in = @@frm_da_FechaRegistro;
//03\/01\/2024 12:20:49 to 2024-01-03T12:20:49Z
$fec_hora_recepcion_in = str_replace("/", "-", $fec_hora_recepcion_in);
//extract AM or PM and the space before it (1:12:25 PM)
$fec_hora_recepcion_in = substr($fec_hora_recepcion_in, 0, -3);

$fec_hora_recepcion_in = str_replace(" ", "T", $fec_hora_recepcion_in);

$fec_hora_recepcion_in = str_replace("\\", "", $fec_hora_recepcion_in);
//echo($fec_hora_recepcion_in);
$fec_hora_recepcion_in = $fec_hora_recepcion_in . "Z";
//if(first character is not 0 and first substring separated by "-" is less than 9, add 0 before it)

$fec_hora_recepcion_in = explode("-", $fec_hora_recepcion_in);
//print_r($fec_hora_recepcion_in);
if ($fec_hora_recepcion_in[0] < 10 && $fec_hora_recepcion_in[0][0] != 0) {
  $fec_hora_recepcion_in[0] = "0" . $fec_hora_recepcion_in[0];
}

//concat everything again
$fec_hora_recepcion_in = $fec_hora_recepcion_in[0] . "-" . $fec_hora_recepcion_in[1] . "-" . $fec_hora_recepcion_in[2];
@@tri_text_hora_ocurrencia = $fec_hora_recepcion_in;

//fecha is in dd-MM-YYYYT12:20:49Z and it should be in 2024-01-03T12:20:49Z

$date_fecha_hora = date("Y-m-d\TH:i:s\Z", time());
$fecha_hora_rec = @@frm_da_FechaRegistro;

//IF EMPTY, DIE
if (empty($fecha_hora_rec)) {
  echo '<br> La fecha de recepción no puede estar vacia<br>';
  die();
}
@@fecha_hora_recepcion = $fecha_hora_rec ? $fecha_hora_rec : $date_fecha_hora;
$fec_hora_recepcion_in =  @@fecha_hora_recepcion;
echo ($fec_hora_recepcion_in);

//echo($fec_hora_recepcion_in);

$cod_usuario_in = @@USER_LOGGED;
$txtbroker_in = @@frm_ds_broker  ? @@frm_ds_broker : '';
$imp_reserva_estim_in = @@valor_solicitado  ? @@valor_solicitado : 0;
$sn_ajustador_ie_in = 'NO';
$txt_contacto_in = '';



$txtbiensinies_in = @@frm_is_bienSiniestrado ? @@frm_is_bienSiniestrado : '';
//clean txtbiensinies_in from unicode escape sequences

$txtbiensinies_in = preg_replace('/[^A-Za-z ]/', '', $txtbiensinies_in);


try {
  $json_encoded = json_encode($txtbiensinies_in);


  // Decode JSON to replace Unicode escape sequences with their characters
  $txtbiensinies_in = json_decode($json_encoded);

  // Check if decoding was successful
  if ($txtbiensinies_in === null) {
    throw new Exception("Failed to decode Unicode escape sequences");
  }
  /*echo $txtbiensinies_in;
  die();*/
} catch (Exception $e) {
  /*echo 'Excepción capturada: ',  $e->getMessage(), "\n";
  die();*/
}

$aaaa_inspeccion_in = intval(date('Y'));
$txt_deducible_in = '';
$txtObs_in = '';

//replace 2024-08-13T15:24:10Z with 20240813 152410
$fecha_hora_rec = $fec_hora_recepcion_in;

$fecha_hora_reclamo = $fec_hora_reclamo_in;


if ($fecha_hora_rec < $fecha_hora_reclamo) {
  echo '<br> La fecha de recepción no puede ser menor a la fecha de reclamo<br>';
  echo "Hora reclamo: " . $fecha_hora_reclamo;
  echo "<br>Hora recepcion: " . $fecha_hora_rec;
  //die();
}

$json_param = array(
  "operation_id" => $operation_id,
  "sn_muestra" => $sn_muestra,
  "cod_suc" => intval($cod_suc),
  "cod_ramo" => intval($cod_ramo),
  "nro_pol" => intval($nro_pol_in),
  "id_pv" => intval($id_pv_in),
  "cod_aseg" => intval($cod_aseg_in),
  "txt_aplicacion" => $txt_aplicacion_in,
  "txt_lugar_insp" => $txt_lugar_insp_in,
  "cod_ajustador_inicial" => $cod_ajustador_inicial_in,
  "cod_causa" => intval($cod_causa_in),
  "cod_item" => intval($cod_item_in),
  "cod_ind_cob" => intval($cod_ind_cob_in),
  "txt_direccion" => $txt_direccion_in,
  "txt_telefono" => $txt_telefono_in,
  "txt_reportado" => $operation_id,
  "fec_hora_reclamo" => $fecha_hora_reclamo,
  "fec_inspec" => $fec_inspec_in,
  "cod_ajustador" => 5339,
  "fec_hora_recepcion" => $fecha_hora_rec,
  "cod_usuario" => 'JEMUNOZ',
  "txtbroker" => $txtbroker_in,
  "imp_reserva_estim" => intval($imp_reserva_estim_in),
  "sn_ajustador" => -1,
  "txt_contacto" => $txt_contacto_in,
  "txtbiensinies" => $txtbiensinies_in,
  "aaaa_inspeccion" => $aaaa_inspeccion_in,
  "txt_deducible" => $txt_deducible_in,
  "txtObs" => $txtObs_in,
  "webhookURL" => $webhook

);


$json = json_encode($json_param);
echo ($json);

@@tri_datos_sise = $json;

//print_r(@@tri_datos_sise);
/*die();
  return;*/

try {
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url_reserva);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FAILONERROR, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
      "Accept: */*",
      "Content-Type: application/json",
      //"Accept-Language: application/json",
      //"Sesa-Key : 20aa9c2054a642939bbd3e9cc30f72e9",
      "Connection: keep-alive",
      "apikey: " . $token,
      //"Authorization : Bearer ". $token,
      "Webhook-Endpoint:" . $webhook
    )
  );

  $res = curl_exec($ch);
  echo ("<br>Respuesta: " . $res);
  print_r($res);

  echo 'datos <br>';
   echo "<h3>Información de la petición cURL:</h3>";
echo "<strong>URL:</strong> " . $url_reserva . "<br>";
echo "<strong>Método:</strong> POST<br>";
echo "<strong>Headers:</strong><br>";
echo "<pre>";
print_r($headers);
echo "</pre>";
echo "<strong>Body (JSON):</strong><br>";
echo "<pre>";
echo htmlspecialchars($json);
echo "</pre>";
echo "<strong>Token:</strong> " . substr($token, 0, 20) . "..." . "<br>";
echo "<strong>Webhook:</strong> " . $webhook . "<br>";
echo "<hr>";
  //echo ("Respuesta: " . $res);
  $result = json_decode($res);
  //print_r($res)

  if (curl_errno($ch)) {
    header("HTTP/1.1 500 Internal Server Error");
    $msg_m = curl_error($ch);
    echo ("Error al momento de generar la solicitud en SISE");
    echo ("<p>URL Reserva : $url_reserva </p>");
    echo ("<p>Token : $token </p>");
    echo ($msg_m);
    print_r($res);
    $result = json_decode($res);
    print_r($result);
    //echo($url_reserva);
    //print_r($rs_auth);
    //print_r(" Json enviado: ".$json);
    @@tri_msg_error = $msg_m;
    @@tri_bandera_recupera = 'true';
  }


  curl_close($ch);
  $result = json_decode($res);


 PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'GRS-SN-355',
$url_reserva,
'POST',
"apikey: " . $token,
json_encode($json),
json_encode($result),
json_encode($msg_m));

  //print_r($result);
  //@@sise_id_stro = $result['operation_id'];
  $sise_id = $result->operation_id;
  @@sise_id_stro = $sise_id;
  @@bandera_sise = '1';
  echo json_encode(array(
    'tri_nro_stro' => $sise_id
  ));





  //print_r($result);
  //die();
} catch (Exception $e) {
  //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
  $result['mensaje'] = 'false';
  $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
  @@tri_msg_error = $msg_m;
  echo ($result['mensaje_mostrar']);
}
