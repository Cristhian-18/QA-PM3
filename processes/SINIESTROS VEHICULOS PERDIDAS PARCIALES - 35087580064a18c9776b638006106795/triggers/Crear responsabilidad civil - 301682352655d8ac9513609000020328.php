<?php
//<?

$vehiculos_siniestrados = array();
$vehiculos_siniestrados = @@grd_vehiculos_afectados;
$aux = 1;
@@grd_valores_siniestros_alcance = array();
$app = @@APPLICATION;
$process = @@PROCESS;
$pro_uid = @@PROCESS;

//consulta bandera
$sql = "SELECT id, bandera FROM SINIESTRO_VH_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_VH_CONFIGURACION)";
$rs = executeQuery($sql);
$id_bandera = $rs['1']['bandera'];

// ============ (SIN CAMBIOS) CONSULTA DE DATOS PREVIOS ============
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'Crear_reserva'
AND PRO_UID = '$process' AND ESTADO = 1";
$rs_auth =  executeQuery($sql_cata_auth);
$apikey = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$valor = 0;
$sql_consultar_datos_reserva = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
WHERE CODIGO = 'Consultar_reserva'
AND PRO_UID = '$process' AND ESTADO = 1";
$rs_consultar_datos_reserva =  executeQuery($sql_consultar_datos_reserva);
$url_consultar_datos_reserva = isset($rs_consultar_datos_reserva['1']['DESCRIPCION']) ? $rs_consultar_datos_reserva['1']['DESCRIPCION'] : '';
$id_stro_insp = @@id_stro_insp ? @@id_stro_insp : @@tri_nro_stro;

$array_consultar_datos = array(
    'idStroInsp' => $id_stro_insp,
);

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_consultar_datos_reserva);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "apikey: ". $apikey,
        "Sesa-key: 20aa9c2054a642939bbd3e9cc30f72e9",
    )
);

$jsonData = json_encode($array_consultar_datos);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

$res = curl_exec($ch);

if(curl_errno($ch)){
    $msg_m = curl_error($ch);
    @@tri_msg_error = $msg_m;
}
$result = json_decode($res, true);

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'CRC-SVPP-59',
$url_consultar_datos_reserva,
'POST',
"apikey: ". $apikey,
json_encode($jsonData),
json_encode($result),
json_encode($msg_m));


$codTercero = $result['data']['coberturas'][0]['estimaciones'][0]['codTercero'];
$idStro = $result['data']['idStro'];
$codItem = $result['data']['codItem'];

} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
$codTercero = isset($codTercero) ? $codTercero : 'INVALIDO';

$sql_url_crear_reserva = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
WHERE CODIGO = 'Generar_Reclamo_Existente'
AND PRO_UID = '$process' AND ESTADO = 1";
$rs_url_crear_reserva =  executeQuery($sql_url_crear_reserva);
$url_crear_reserva = isset($rs_url_crear_reserva['1']['DESCRIPCION']) ? $rs_url_crear_reserva['1']['DESCRIPCION'] : '';

$sql_actualizar_reserva = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
WHERE CODIGO = 'Actualizar_reserva'
AND PRO_UID = '$process' AND ESTADO = 1";
$rs_actualizar_reserva =  executeQuery($sql_actualizar_reserva);
$url_actualizar_reserva = isset($rs_actualizar_reserva['1']['DESCRIPCION']) ? $rs_actualizar_reserva['1']['DESCRIPCION'] : '';

$sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
$rs_sql_apikey =  executeQuery($sql_apikey);
$apikey = isset($rs_sql_apikey['1']['DESCRIPCION']) ? $rs_sql_apikey['1']['DESCRIPCION'] : '';

$sql_apikey_reserva = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY_ACTUALIZAR_RESERVA'";
$rs_sql_apikey_reserva =  executeQuery($sql_apikey_reserva);
$apikey_reserva = isset($rs_sql_apikey_reserva['1']['DESCRIPCION']) ? $rs_sql_apikey_reserva['1']['DESCRIPCION'] : '';

$nro_stro = null;
$aaaa_ejercicio = intval(date('Y'));

$datosSise = json_decode(@@tri_datos_sise);
$anioIns = $datosSise->aaaa_inspeccion;
$anioIns = intval($anioIns);

if ($nro_stro == 0 || $nro_stro == '' || $nro_stro == null) {

    $idpv = @@frm_id_pv ? @@frm_id_pv : null;
    $placa = @@frm_vehiculo_placa ? @@frm_vehiculo_placa : null;
    $codAseg = @@frm_cod_aseg ? @@frm_cod_aseg : null;
    $chasis = @@frm_vehiculo_chasis ? @@frm_vehiculo_chasis : null;
    $pro_uid = @@PROCESS;
    if ($codAseg == "-1") {
        $codAseg = null;
    }

    $array_datos = array('idpv' => $idpv, "placa" => $placa, "chasis" => $chasis);
    $json = json_encode($array_datos);
    $sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
    $rs_auth =  executeQuery($sql_cata_auth);
    $token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

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

        if (curl_errno($ch)) {
            $msg_m = curl_error($ch);
            @@tri_msg_error = $msg_m;
            @@tri_bandera_recupera = 'true';
        }
        curl_close($ch);

        $result = json_decode($res);
        $datos_result = $result->data;

        PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'CRS-SVPP-171',
        $url_poli_param,
        'POST',
         "APIKEY: " . $token,
        json_encode($json),
        json_encode($result),
        json_encode($msg_m));

        $id_stro_insp = @@tri_nro_stro;
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

    }
}


if (@@frm_origen_core_insurance != 'INSURANCE') {
    // Validación para CREACIÓN de reserva
    if (
        (empty($idStro) ||
        empty($codItem) ||
        empty($codTercero) || $codTercero == 'INVALIDO')
        && $id_bandera != "SI"
    ) {
      die("No fue posible crear la reserva del siniestro. "
        . "Por favor verifique los datos ingresados o contacte al equipo de soporte."
        . "<br>----- Información técnica (soporte) -----<br>"
        . "idStro=" . var_export($idStro, true)
        . ", codItem=" . var_export($codItem, true)
        . ", codTercero=" . var_export($codTercero, true));
    }

    // Validación para ACTUALIZACIÓN de reserva
    if (
        (empty($nro_stro) ||
        empty($cod_suc) ||
        empty($cod_ramo) ||
        empty($aaaa_ejercicio) ||
        empty($cod_ind_cob))
        && $id_bandera != "SI"
    ) {
        die("No fue posible actualizar la reserva del siniestro. "
        . "Por favor verifique los datos ingresados o contacte al equipo de soporte."
        . "<br>----- Información técnica (soporte) -----<br>"
            . "nro_stro=" . var_export($nro_stro, true)
            . ", cod_suc=" . var_export($cod_suc, true)
            . ", cod_ramo=" . var_export($cod_ramo, true)
            . ", aaaa_ejercicio=" . var_export($aaaa_ejercicio, true)
            . ", cod_ind_cob=" . var_export($cod_ind_cob, true));
    }
}



// ============ NUEVO: DETERMINAR ELEGIBILIDAD ANTES DE CREAR CASOS ============
$valor = 0;
$hayVehiculosElegibles = false;

if (@@frm_siniestro_OtrosVehiculos == "SI") {
    foreach ($vehiculos_siniestrados as $vehiculo) {
        $estado  = $vehiculo['frm_vafectado_estado'];
        $marca   = $vehiculo['frm_vafectado_marca'];
        $creado  = $vehiculo['frm_creado'];

        // Vehículos YA creados en corridas anteriores: suman siempre al acumulado
        if (isset($vehiculo['numBPM']) && $vehiculo['numBPM'] != 0 && $vehiculo['numBPM'] != '') {
            $valor += $vehiculo['frm_vafectado_reserva'];
            continue;
        }

        // Vehículos NUEVOS elegibles en esta corrida
        if ($creado != 1 && $estado != '' && $estado != null) {
            if ($estado == 'NOAPLICA') {
                continue;
            }
            if (!in_array($estado, array('INDEMNIZACION', 'TALLER')) && ($marca == null || $marca == '')) {
                continue;
            }
            $hayVehiculosElegibles = true;
            $valor += $vehiculo['frm_vafectado_reserva'];
        }
    }
}

// ============ CORTE POR ORIGEN INSURANCE (movido al frente) ============
 
if (@@frm_origen_core_insurance != 'INSURANCE') {
   
    // ============ CREAR Y ACTUALIZAR RESERVA (antes de crear casos) ============
    if ($hayVehiculosElegibles) {

        // Buscar codConsecutivo de cobertura RESPONSABILIDAD CIVIL
        $array_coberturas = @@grd_registro_siniestro;
        $codConsecutivo = null;
        foreach ($array_coberturas as $cobertura) {
            if (stripos($cobertura['grd_s_cobertura'], 'RESPONSABILIDAD CIVIL') !== false) {
                $codConsecutivo = intval($cobertura['grd_s_codConsecutivo']);
                break;
            }
        }

        if ($codConsecutivo == null || $codConsecutivo == '') {
            $g = new G();
            $g->SendMessageText("No se ha encontrado el codConsecutivo.", 'ERROR');
        }

        // Payload creación de reserva
        $array_creacion_reserva = array(
            'idStro'      => $idStro,
            'codItem'     => $codItem,
            'codIndCob'   => $codConsecutivo,
            'codTercero'  => $codTercero,
            'codEstim'    => 1,
            'impEstimAct' => $valor,
            'codUsuario'  => 'USRVBPMSINIESTROS'
        );
        $jsonData = json_encode($array_creacion_reserva);
        @@jsonData_RC = $jsonData;

        if ($id_bandera == "SI") {
                encolarReservaPendiente(@@APP_NUMBER, 1, $jsonData);
        }else{
            // CREAR RESERVA
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,            $url_crear_reserva);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FAILONERROR,    true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Accept: application/json",
                    "Content-Type: application/json",
                    "Accept-Language: application/json",
                    "apikey: " . $apikey
                ));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

                $res = curl_exec($ch);
                @@respuesta_creacion_rc_reserva = $res;

                if (curl_errno($ch)) {
                    @@tri_msg_error = curl_error($ch);
                }
                curl_close($ch);

                PMFBitacoraServicios(
                @@APP_NUMBER,
                'trigger',
                'CRS-SVPP-394',
                $url_crear_reserva,
                'POST',
                "apikey: " . $apikey,
                json_encode($jsonData),
                json_encode($result),
                json_encode($msg_m));

            } catch (Exception $e) {
                @@tri_msg_error = "Error: " . $e->getMessage();
            }
            //FIN CREAR RESERVA

        }

        // ACTUALIZAR RESERVA
        $json_param = array(
            "codigoScript"     => "ACTUALIZACION_RESERVA_GENERALES",
            "codigoAplicacion" => "BPM_PPROCCES_GENERALES",
            "parametros"       => array(
                "nro_stro"           => intval($nro_stro),
                "cod_suc"            => intval($cod_suc),
                "cod_ramo"           => intval($cod_ramo),
                "aaaa_ejercicio"     => intval($aaaa_ejercicio),
                "cod_ind_cob"        => intval($cod_ind_cob),
                "imp_valor_estimado" => round(floatval($valor), 2),
            )
        );

        $json = json_encode($json_param, JSON_PRESERVE_ZERO_FRACTION);
        @@array_actualizacion_reserva = $json_param;
        @@json_actualizacion_rc = $json;

         if ($id_bandera == "SI") {
            encolarReservaPendiente(@@APP_NUMBER, 2, $json);
         }else{
            try {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url_actualizar_reserva);
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
                    "apikey: " . $apikey_reserva,
                ));

                $res_raw = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                @@tri_msg_error = '';
                @@tri_bandera_recupera = 'false';
                $msg_m = '';

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

                PMFBitacoraServicios(
                    @@APP_NUMBER,
                    'trigger',
                    'CRS-SVPP-453',
                    $url_actualizar_reserva,
                    'POST',
                    "apikey: " . $token,
                    json_encode($json),
                    json_encode($res ?? null),
                    json_encode($msg_m)
                );

                $uid_analista = @@tri_usr_analista;

                if (!empty($uid_analista)) {
                    $sql_analista_correo = "SELECT USR_EMAIL FROM USERS u WHERE u.USR_UID = '" . addslashes($uid_analista) . "'";
                    $result_analista_correo = executeQuery($sql_analista_correo);

                    if (isset($result_analista_correo[1]['USR_EMAIL']) && !empty($result_analista_correo[1]['USR_EMAIL'])) {

                        $para   = $result_analista_correo[1]['USR_EMAIL'];
                        $de     = 'bpm@equisuiza.com';
                        $cc     = '';
                        $bcc    = '';
                        $asunto = "Resultado Actualizacion Reserva- Vehículos - Solicitud #" . @@APP_NUMBER;
                        $plantilla = 'notificacion_smart.html';

                        @@tri_smart_claims_titulo = 'ACTUALIZACION DE RESERVA';
                        @@tri_smart_claims_mensaje = 'ACTUALIZACION DE RESERVA: ' . $msg_m;

                        PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla, array());
                    }
                }

                // Si la actualización no fue exitosa, se detiene el trigger y NO se crean los casos RC
            
                

                if (strpos($msg_m, 'Reserva actualizada correctamente') === false) {
                    $g = new G();

                    $g->SendMessageText("La actualización no pudo completarse debido a que el servicio procesador devolvió una respuesta que impidió continuar con la operación. Se recomienda revisar el detalle del mensaje para identificar la causa del inconveniente y realizar las acciones correctivas correspondientes antes de volver a intentarlo.", "WARNING");

                    if($id_bandera != "SI"){
                        die();
                    }
                }

            } catch (Exception $e) {
                @@tri_msg_error = 'Excepción capturada: Error al consultar la Base de Datos, comuníquese con el administrador. ' . $e->getMessage();
                die("La actualización no pudo completarse debido a que el servicio procesador devolvió una respuesta que impidió continuar con la operación. Se recomienda revisar el detalle del mensaje para identificar la causa del inconveniente y realizar las acciones correctivas correspondientes antes de volver a intentarlo.<br><br><strong>Detalle:</strong> " . $e->getMessage());
            
            }
        }
    }
}

// ============ CREAR CASOS RC (ahora después de reserva creada/actualizada con éxito) ============
if (@@frm_siniestro_OtrosVehiculos == "SI") {

    $taskUID = '38904972565655b4c198e78054771644';
    $processUID = '76661804465655b4bdffbc2081200894';

    foreach ($vehiculos_siniestrados as &$vehiculo) {

        $estado      = $vehiculo['frm_vafectado_estado'];
        $marca       = $vehiculo['frm_vafectado_marca'];
        $modelo      = $vehiculo['frm_vafectado_modelo'];
        $placa       = $vehiculo['frm_vafectado_placa'];
        $propietario = $vehiculo['frm_vafectado_propietario'];
        $danos       = $vehiculo['frm_vafectado_danios'];
        $anio        = $vehiculo['frm_vafectado_anio'];
        $creado      = $vehiculo['frm_creado'];

        if ($creado != 1 && $estado != '' && $estado != null) {

            $vehiculo['frm_creado'] = 1;
            $newCaseUID = '';

            switch ($estado) {

                case 'NOAPLICA':
                break;

                case 'INDEMNIZACION':
                case 'TALLER':
                $newCaseUID = PMFNewCase($processUID, @@USER_LOGGED, $taskUID,
                array(
                    'app_uid_rc'       => @@APPLICATION,
                    'app_number_padre' => @@tri_nro_stro . ' - RC' . $aux,
                    'marca'            => $marca,
                    'modelo'           => $modelo,
                    'placa'            => $placa,
                    'propietario'      => $propietario,
                    'danos'            => $danos,
                    'anio'             => $anio,
                    'estado'           => $estado,
                    'anioIns'          => $anioIns
                ), "TO_DO");
                break;

                default:
                if ($marca == null || $marca == '') {
                    break;
                }
                $newCaseUID = PMFNewCase($processUID, @@USER_LOGGED, $taskUID,
                array(
                    'app_uid_rc'       => @@APPLICATION,
                    'app_number_padre' => @@tri_nro_stro . ' - RC' . $aux,
                    'marca'            => $marca,
                    'modelo'           => $modelo,
                    'placa'            => $placa,
                    'propietario'      => $propietario,
                    'danos'            => $danos,
                    'anio'             => $anio,
                    'estado'           => $estado,
                    'anioIns'          => $anioIns
                ), "TO_DO");
                break;
            }

            $g = new G();

            if ($newCaseUID) {
                $c = new Cases();
                $aCaseInfo = $c->LoadCase($newCaseUID, 1);
                $msg = 'New Case #' . $aCaseInfo['APP_NUMBER'] . ' is assigned to ' . $aCaseInfo["CURRENT_USER"];
                $g->SendMessageText($msg, 'INFO');

                $vehiculo['numBPM'] = $aCaseInfo['APP_NUMBER'];
                $aux++;

                $sqlDel = "SELECT DEL_INDEX FROM APP_DELEGATION 
                        WHERE APP_UID = '$newCaseUID' 
                        AND DEL_FINISH_DATE IS NULL 
                        ORDER BY DEL_INDEX DESC 
                        LIMIT 1";
                $resultDel = executeQuery($sqlDel);

                $delIndex = !empty($resultDel[1]['DEL_INDEX']) ? (int)$resultDel[1]['DEL_INDEX'] : 1;
                PMFDerivateCase($newCaseUID, $delIndex, @@USER_LOGGED, false, false);
                $g->SendMessageText('Case #' . $aCaseInfo['APP_NUMBER'] . ' derivado correctamente.', 'INFO');

            } else {
                $msg = "Unable to create new case." . (isset(@@__ERROR__) ? @@__ERROR__ : '');
                $g->SendMessageText($msg, 'ERROR');
            }
        }
    }
    unset($vehiculo);
}

@=grd_vehiculos_afectados = $vehiculos_siniestrados;