<?php
//<?php
//created by Henry
//24-12-2020
//bandera cierre de mes
try {
  $cnx = '934957180650c74e8ed0e10096114321';
  //estado de la bandera

  $sql = "SELECT id, bandera FROM SINIESTRO_VH_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_VH_CONFIGURACION)";

  $rs = executeQuery($sql, $cnx);
  $app_number = @@APP_NUMBER;

  $id_bandera = $rs['1']['bandera'];
  if ($id_bandera == "SI") {
    @@bandera_pendiente_actualizacion = "1";
    $de = '';
    $para = @@tri_correo_desarrollador_cc;
    $bcc = '';
    $asunto = "Actualizar reserva - " . $app_number;
    $texto = '<p align="justify">Estimado(a),&nbsp;Colaborador</p>';
    $texto .= '<p align="justify">Se le notifica que se intentó actualizar una reserva durante el cierre de mes</tipo>
		</p>';
    $comentario = '';
    $accion = '';
    $plantilla_rec = 'Plantilla_mail.html';

    @@envio_mail_t1 = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' =>
    $texto));

    return;
  }
  @@bandera_pendiente_actualizacion = "0";
  //Guardar Documentos Compartida
  $pro_uid = '35087580064a18c9776b638006106795';

  $sql_cata_auth = "SELECT DESCRIPCION, CAMPO2, CAMPO1 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Actualizar_reserva'";
  $rs_auth =  executeQuery($sql_cata_auth);
  $url_reserva = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

  $sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY_ACTUALIZAR_RESERVA'";
  $rs_sql_apikey =  executeQuery($sql_apikey);

  $apikey = isset($rs_sql_apikey['1']['DESCRIPCION']) ? $rs_sql_apikey['1']['DESCRIPCION'] : '';

  $sql_webhook = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'WEBHOOK_ACTUALIZAR_RESERVA'";
  $rs_webhook =  executeQuery($sql_webhook);
  $webhook = isset($rs_webhook['1']['DESCRIPCION']) ? $rs_webhook['1']['DESCRIPCION'] : '';


  $caseUID = @@APPLICATION;


  $valor_aprobado = @@frm_valoresAprobados_totalProformado;
  if ($valor_aprobado != '' && $valor_aprobado != null) {
    $imp_valor_estimado = $valor_aprobado;
  }

  $valor_aprobadoAlcances = @@frm_totalMasAlcances;
  if ($valor_aprobadoAlcances != '' && $valor_aprobadoAlcances != null) {
    $imp_valor_estimado = $valor_aprobadoAlcances;
  }

  $valor_deducible = @@tri_valorDeducible;

  $porcentajeSiniestro = @@frm_deducible_ProcentajeSiniestro;
  $valorMinimo = @@frm_deducible_ValorMinimo;
  $imp_valor_estimado = $imp_valor_estimado - $valor_deducible;
  if ($operation_id == 'null' || $operation_id == '' || $operation_id == null) {
    $operation_id = @@APPLICATION;
  }

  $newCaseId = @@app_uid_rc;
  $c = new Cases();
  $aCase = $c->loadCase($newCaseId);
  $array_actualizacion_reserva = $aCase['APP_DATA']['array_actualizacion_reserva'];
  $vehiculos_siniestrados = array();
  $vehiculos_siniestrados = $aCase['APP_DATA']['grd_vehiculos_afectados'];
  @@grid_original = $vehiculos_siniestrados;
  function eliminarAccesorios(&$array)
  {
    foreach ($array as $key => &$value) {
      if ($key === 'accesorios') {
        unset($array[$key]);
      } elseif (is_array($value)) {
        eliminarAccesorios($value);
      }
    }
  }

  // Uso:
  eliminarAccesorios($vehiculos_siniestrados);
  //VALIDA QUE SE DE DE BAJA UNA RC
  if (@@frm_accion == 'FINALIZAR') {
    $imp_valor_estimado = '0.00';
  }

  foreach ($vehiculos_siniestrados as &$vehiculo) {
    $num_bpm = $vehiculo['numBPM'];
    $estado = $vehiculo['frm_vafectado_estado'];
    if ($num_bpm == @@APP_NUMBER && $estado != 'NOAPLICA') {
      $vehiculo['frm_vafectado_reserva'] = $imp_valor_estimado;
      //frm_vafectado_reserva_label
      $vehiculo['frm_vafectado_reserva_label'] = number_format($imp_valor_estimado, 2, '.', '');
    }
    if (isset($vehiculo['numBPM']) && $vehiculo['numBPM'] != 0 && $vehiculo['numBPM']) {
      $valor += $vehiculo['frm_vafectado_reserva'];
    }
  }
  unset($vehiculo);

  $nro_stro = intval(@@id_stro);
  if ($nro_stro == 0 || $nro_stro == '' || $nro_stro == null) {

    $idpv = $aCase['APP_DATA']['frm_id_pv'] ? $aCase['APP_DATA']['frm_id_pv'] : null;
    $placa = $aCase['APP_DATA']['frm_vehiculo_placa'] ? $aCase['APP_DATA']['frm_vehiculo_placa'] : null;
    $codAseg = $aCase['APP_DATA']['frm_cod_aseg'] ? $aCase['APP_DATA']['frm_cod_aseg'] : null;
    $chasis = $aCase['APP_DATA']['frm_vehiculo_chasis'] ? $aCase['APP_DATA']['frm_vehiculo_chasis'] : null;

    if ($codAseg == "-1") {
      $codAseg = null;
    }

    $array_datos = array('idpv' => $idpv, "placa" => $placa, "chasis" => $chasis);
    $json = json_encode($array_datos);
    $sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
    $rs_auth =  executeQuery($sql_cata_auth);

    $token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

    //INFO DE POLIZA POR PLACA E ID_PV
    $sql_cata_poli = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_poliza_Placa_IdPv'";
    $rs_poli =  executeQuery($sql_cata_poli);

    $url_poli = isset($rs_poli['1']['DESCRIPCION']) ? $rs_poli['1']['DESCRIPCION'] : '';
    $url_poli_param = $url_poli;



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


      //echo $res;
      if (curl_errno($ch)) {
        $msg_m = curl_error($ch);
        @@tri_msg_error = $msg_m;
        @@tri_bandera_recupera = 'true';
      }
      curl_close($ch);

      $result = json_decode($res);

       PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'ACRC182',
      $url_poli_param,
      'POST',
      "APIKEY: " . $token,
      json_encode($json),
      json_encode($result),
      json_encode($msg_m));

      $datos_result = $result->data;

      $id_stro_insp =  $aCase['APP_DATA']['tri_nro_stro'];
      foreach ($datos_result as $key => $data) {
        if ($key == 'poliza') {
          $cod_suc = $data->codSucursal;
          $cod_ramo = $data->codRamo;
        }
        if ($key == 'coberturas') {

          foreach ($data as $datacob) {

            $cobertura = $datacob->cobertura;
            if (stripos($cobertura, 'RESPONSABILIDAD CIVIL') !== false) {
              $cod_ind_cob = $datacob->codConsecutivo;
               break;
            }
          }
        }
        if ($key == 'siniestros') {
          foreach ($data as $datasin) {
            $idStroInsp = $datasin->idStroInsp;
            $nroReclamoAgente = $datasin->nroReclamoAgente;

            if ($id_stro_insp == $idStroInsp) {
              $nro_stro = $datasin->nroStro;
            
              if ($nro_stro == 0 || $nro_stro == '' || $nro_stro == null) {

                $mensaje_error = "No se ha encontrado el nro stro.";
              }

            }
          }
        }
      }
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
  }

  $array_coberturas = $aCase['APP_DATA']['grd_registro_siniestro'] ? $aCase['APP_DATA']['grd_registro_siniestro'] : null;
  $codConsecutivo = null;

  $fechaSise = $aCase['APP_DATA']['fecha_hora_recepcion'] ?? null;
  $anio_aux = $fechaSise != null ? date('Y', strtotime($fechaSise)) : null;
  $anio = $anio_aux != null ? $anio_aux : @@anioIns;
  $aaaa_ejercicio = intval($anio);


  //DATA JSON ANTERIO ACTUALIZACION RESERVA DANIEL
  // $json_param = array(
  //   "nro_stro" => intval($nro_stro),
  //   "cod_suc" => $cod_suc,
  //   "cod_ramo" => intval($cod_ramo),
  //   "aaaa_ejercicio" => $aaaa_ejercicio,
  //   "cod_ind_cob" => $cod_ind_cob,
  //   "imp_valor_estimado" => $valor,
  //   "operation_id" => $operation_id
  // );

  $imp_valor_estimado = $valor;

 

  
  $json_param = array(
    "codigoScript"     => "ACTUALIZACION_RESERVA_GENERALES",
    "codigoAplicacion" => "BPM_PPROCCES_GENERALES",
    "parametros"       => array(
        "nro_stro"           => intval($nro_stro),
        "cod_suc"            => intval($cod_suc),
        "cod_ramo"           => intval($cod_ramo),
        "aaaa_ejercicio"     => intval($aaaa_ejercicio),
        "cod_ind_cob"        => intval($cod_ind_cob),
        "imp_valor_estimado" => round(floatval($imp_valor_estimado), 2),
    )
);

$json = json_encode($json_param, JSON_PRESERVE_ZERO_FRACTION);
 

@@tri_valor_reserva = $imp_valor_estimado;
@@tri_datos_sise_actualizacion = $json;


 
try {
   $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url_reserva);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Accept: */*",
        "Content-Type: application/json",
        "Connection: keep-alive",
        "apikey: " . $apikey,
    ));

    $res_raw = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    @@tri_msg_error = '';
    @@tri_bandera_recupera = 'false';
    $msg_m = ''; // Inicializar siempre

    if (curl_errno($ch)) {
        $msg_m = curl_error($ch);
        @@json_actualizacion_sise = $json;
        $g = new G();
        @@tri_msg_error = $msg_m;
        @@tri_bandera_recupera = 'true';

    } else {

        $res = json_decode($res_raw);

        if ($http_code == 404 || $res_raw === null || $res_raw === '') {
            $msg_m = 'Recurso no encontrado (404). El dominio o endpoint no es válido.';
            @@json_actualizacion_sise = $json;
            @@tri_msg_error = $msg_m;
            @@tri_bandera_recupera = 'true';

        } elseif ($http_code == 401) {
            $msg_m = 'Error de autenticación (401): ' . (isset($res->message) ? $res->message : 'No autorizado');
            @@json_actualizacion_sise = $json;
            @@tri_msg_error = $msg_m;
            @@tri_bandera_recupera = 'true';

        } elseif ($http_code == 403) {
            $msg_m = 'Acceso denegado (403): ' . (isset($res->message) ? $res->message : 'Acceso prohibido');
            @@json_actualizacion_sise = $json;
            @@tri_msg_error = $msg_m;
            @@tri_bandera_recupera = 'true';

        } elseif ($http_code == 500) {
            $errores = (isset($res->errores) && is_array($res->errores)) ? implode(' | ', $res->errores) : '';
            $msg_m = 'Error del servidor (500): ' . (isset($res->mensaje) ? $res->mensaje : 'Error interno') . ($errores ? ' - ' . $errores : '');
            @@json_actualizacion_sise = $json;
            @@tri_msg_error = $msg_m;
            @@tri_bandera_recupera = 'true';

        } elseif ($http_code == 200) {

            if (isset($res->exitoso) && $res->exitoso === true && isset($res->datos[0])) {
                $nro_correla_estim = $res->datos[0]->nro_correla_estim;
                $txt_desc_proceso  = $res->datos[0]->txt_desc_proceso;

                if ($nro_correla_estim > 0) {
                    $msg_m = 'Reserva actualizada correctamente: ' . $txt_desc_proceso;
                    @@tri_bandera_recupera = 'false';
                    @@tri_msg_error = '';
                    // Aquí tu lógica de éxito...
                } else {
                    $msg_m = 'No se actualizó la reserva: ' . $txt_desc_proceso;
                    @@json_actualizacion_sise = $json;
                    @@tri_msg_error = $msg_m;
                    @@tri_bandera_recupera = 'true';
                }

            } else {
                $msg_m = 'Respuesta inesperada del servidor.';
                @@json_actualizacion_sise = $json;
                @@tri_msg_error = $msg_m;
                @@tri_bandera_recupera = 'true';
            }

        } else {
            $msg_m = 'Error inesperado. HTTP Code: ' . $http_code;
            @@json_actualizacion_sise = $json;
            @@tri_msg_error = $msg_m;
            @@tri_bandera_recupera = 'true';
        }
    }

    curl_close($ch);

    // Bitácora al final, siempre se ejecuta
    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'AR-RCPP-368',
        $url_reserva,
        'POST',
        "apikey: " . $token,
        json_encode($json),
        json_encode($res ?? null),
        json_encode($msg_m)
    );

} catch (Exception $e) {
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error = $msg_m;
}


  //AQUI NO SE ACTUALIZA MAS
  if (isset($vehiculos_siniestrados['accesorios'])) {
    unset($vehiculos_siniestrados['accesorios']);
  }


  PMFSendVariables(@@app_uid_rc, array('grd_vehiculos_afectados' => $vehiculos_siniestrados));

  sendVariablesCanceled(@@app_uid_rc, array('grd_vehiculos_afectados' => $vehiculos_siniestrados));
} catch (Exception $e) {

  $errorMessage =  $e->getMessage();
}
