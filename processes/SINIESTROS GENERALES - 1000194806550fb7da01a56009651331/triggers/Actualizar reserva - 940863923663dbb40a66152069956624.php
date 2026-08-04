<?php
$pro_uid = @@PROCESS;
//consulto del catalogo
//obtengo el api_key
$app_number = @@APP_NUMBER;

if($app_number != '989'){
  return;
}


$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2, CAMPO1 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Actualizar_reserva'";
$rs_auth =  executeQuery($sql_cata_auth);
$url_reserva = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

$sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE  CODIGO = 'APIKEY_ACTUALIZAR_RESERVA'";
$rs_sql_apikey =  executeQuery($sql_apikey);

$apikey = isset($rs_sql_apikey['1']['DESCRIPCION']) ? $rs_sql_apikey['1']['DESCRIPCION'] : '';
echo $apikey;

$sql_webhook = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'WEBHOOK_ACTUALIZAR_RESERVA'";
$rs_webhook =  executeQuery($sql_webhook);
$webhook = isset($rs_webhook['1']['DESCRIPCION']) ? $rs_webhook['1']['DESCRIPCION'] : '';


$caseUID = @@APPLICATION;

$nro_stro = intval(@@id_stro);

if ($nro_stro == 0 || $nro_stro == '' || $nro_stro == null) {

  $idpv = @@frm_idpv ? @@frm_idpv : null;
  $placa = @@frm_vehiculo_placa ? @@frm_vehiculo_placa : null;
  $codAseg = @@frm_cod_aseg ? @@frm_cod_aseg : null;
  echo "<p>frm_id_pv:";
  echo ($idpv);
  if ($codAseg == "-1") {
    $codAseg = null;
  }

  $array_datos = array('idpv' => $idpv);
  $json = json_encode($array_datos);
  $sql_cata_auth = "SELECT DESCRIPCION,VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY_CONSULTA'";
  $rs_auth =  executeQuery($sql_cata_auth);
  $token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

  $sql = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_POLIZA_PARAM'";
  $rs =  executeQuery($sql);
  $url_poli_param = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';


  echo "<p>url_poli_param:";
  echo ($url_poli_param);



  try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_poli_param);
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
        "APIKEY: " . $token
      )
    );

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
      $msg_m = curl_error($ch);
      @@tri_msg_error = $msg_m;
      @@tri_bandera_recupera = 'true';
      die();

    }
    curl_close($ch);

    $result = json_decode($res);
    $datos_result = $result->data->polizas;
    /*$nro_inspeccion = @@nro_inspeccion;
    if(isset($nro_inspeccion)){
      $nro_inspeccion = @@tri_id_stro;
    }*/
    $id_stro_insp = @@tri_id_stro;
    $nro_inspeccion = @@tri_nro_stro;
    //947 - 2024
    //remove everything after -
    $nro_inspeccion = explode("-", $nro_inspeccion);
    $nro_inspeccion = $nro_inspeccion[0];
    $nro_inspeccion = intval($nro_inspeccion);
    echo "<p>nro_inspeccion:";
    echo ($nro_inspeccion);
    echo "<p>id_stro_insp:";
    echo ($id_stro_insp);

    foreach ($datos_result as $key => $data) {
      $siniestros = $data->siniestros;
      foreach ($siniestros as $key => $siniestro) {
        if ($siniestro->nroReclamoAgente == $nro_inspeccion) {
          $nro_stro = $siniestro->idStroInsp;
          break;
        }
      }
    }

    PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'AR-SG-121',
      $url_poli_param,
      'POST',
      "Accept: application/json".
      " Content-Type: application/json".
      " Accept-Language: application/json".
      " APIKEY: " . $token,
      json_encode($json),
      json_encode($result),
      json_encode($msg_m));

  } catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
  }
}

//die();

$cod_suc = @@frm_ds_CodsucursalEmision;

$ramo = array();
$ramo = @@grd_ramos;
$cobertura = @@grd_cobertura;
$cod_ramo = $ramo[1]['grd_r_Codramo'];

$aaaa_ejercicio = intval(date('Y'));

$cobertura = @@grd_cobertura;
$cod_ind_cob_in = $cobertura[1]['grd_c_codigo'];
$imp_valor_estimado = $cobertura[1]['grd_c_lim_monto_reportado'];

if ($operation_id == 'null' || $operation_id == '' || $operation_id == null) {
  $operation_id = @@APPLICATION;
}

$imp_valor_estimado = intval($imp_valor_estimado);
 

if ($imp_valor_estimado < 0 || $imp_valor_estimado == null || $imp_valor_estimado == '') {
    die("
    <div style='font-family:-apple-system,Segoe UI,Arial,sans-serif; max-width:480px; margin:60px auto; background:#FFFFFF; border:1px solid #E0E0E0; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.08); overflow:hidden;'>
        <div style='background:#B00020; padding:16px 20px;'>
            <span style='color:#FFFFFF; font-size:14px; font-weight:600;'>⚠ No se puede continuar</span>
        </div>
        <div style='padding:24px 20px;'>
            <p style='margin:0 0 12px 0; color:#333333; font-size:14px; line-height:1.5;'>
                Verifique el valor a actualizar en la reserva: " . $imp_valor_estimado . "
            </p>
        </div>
    </div>");
}


$json_param = array(
  "nro_stro" => intval($nro_stro),
  "cod_suc" => $cod_suc,
  "cod_ramo" => intval($cod_ramo),
  "aaaa_ejercicio" => $aaaa_ejercicio,
  "cod_ind_cob" => $cod_ind_cob,
  "imp_valor_estimado" => $imp_valor_estimado,
  "operation_id" => $operation_id
);


$json = json_encode($json_param);

echo "<p>json_param:";
echo ($json);
die();

@@tri_datos_sise_actualizacion = $json;
try {
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url_reserva);
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
      "Accept: */*",
      "Content-Type: application/json",
      //"Accept-Language: application/json",
      //"Sesa-Key : 20aa9c2054a642939bbd3e9cc30f72e9",
      "Connection: keep-alive",
      "apikey: " . $apikey,
      //"Authorization : Bearer ". $token,
      "Webhook-Endpoint: " . $webhook,
    )
  );
  $res = curl_exec($ch);
  $res = json_decode($res);
  @@tri_msg_error = '';
  @@tri_bandera_recupera = 'false';
  if (curl_errno($ch)) {
    $msg_m = curl_error($ch);

    @@json_actualizacion_sise = $json;
    $g = new G();
    $msg_m = "Hubo un error al momento de actualizar la reserva";
    $g->SendMessageText($msg_m, 'ERROR');
    /*if (@@APP_NUMBER == '1237') {
      echo "$msg_m";
      die();
    }*/
    echo '<br>';
    echo $apikey;
    @@tri_msg_error = $msg_m;
    @@tri_bandera_recupera = 'true';
  }
  curl_close($ch);


  PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'AR-SG-237',
      $url_reserva,
      'POST',
      "Accept: */*" .
      " Content-Type: application/json" .
      " Connection: keep-alive" .
      " apikey: " . $apikey .
      " Webhook-Endpoint: " . $webhook,
      json_encode($json),
      json_encode($res),
      json_encode($msg_m));

  //die();
} catch (Exception $e) {
  //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
  $result['mensaje'] = 'false';
  $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
  @@tri_msg_error = $msg_m;
}

die();
