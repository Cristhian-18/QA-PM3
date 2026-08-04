<?php
$sql = "SELECT id, bandera FROM SINIESTRO_VH_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_VH_CONFIGURACION)";

$rs = executeQuery($sql);
$app_number = @@APP_NUMBER;

$id_bandera = $rs['1']['bandera'];
if ($id_bandera == "SI") {
    @@bandera_pendiente_actualizacion = "1";
    $de = '';
    $para = @@tri_destinatarios_copias_cc;
    $bcc = @@tri_correo_desarrollador_bcc;
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
$pro_uid = @@PROCESS;

//obtener url de actualizacion de reserva
$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2, CAMPO1 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Actualizar_reserva'";
$rs_auth =  executeQuery($sql_cata_auth);
$url_reserva = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

//obtener apikey de la actualizacion de reserva
$sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY_ACTUALIZAR_RESERVA'";
$rs_sql_apikey =  executeQuery($sql_apikey);
$apikey = isset($rs_sql_apikey['1']['DESCRIPCION']) ? $rs_sql_apikey['1']['DESCRIPCION'] : '';
 


$caseUID = @@APPLICATION;
$nro_stro = intval(@@id_stro);
$nro_stro = 0;

if ($nro_stro == 0 || $nro_stro == '' || $nro_stro == null) {

    $idpv = @@frm_id_pv ? @@frm_id_pv : null;
    $placa = @@frm_vehiculo_placa ? @@frm_vehiculo_placa : null;
    $codAseg = @@frm_cod_aseg ? @@frm_cod_aseg : null;
    $chasis = @@frm_vehiculo_chasis ? @@frm_vehiculo_chasis : null;

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

    //echo "apikey: " . $apikey . "<br>";
    try {
        //echo $json;
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
            //echo ($msg_m);
        }
        curl_close($ch);

        $result = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'Actualizar reserva',
            $url_poli_param,
            'POST',
            "APIKEY: " . $token,
            json_encode($json),
            json_encode($result),
            json_encode($msg_m)
        );

        $datos_result = $result->data;

        $id_stro_insp = @@tri_nro_stro;
        foreach ($datos_result as $key => $data) {
            if ($key == 'poliza') {
                //get the data of the poliza
                $cod_suc = $data->codSucursal;
                $cod_ramo = $data->codRamo;
            }
            if ($key == 'siniestros') {
                foreach ($data as $datasin) {
                    $idStroInsp = $datasin->idStroInsp;
                    $nroReclamoAgente = $datasin->nroReclamoAgente;

                    if ($id_stro_insp == $idStroInsp) {
                        $nro_stro = $datasin->nroStro;
                        $cod_ind_cob = $datasin->codCobertura;

                        if ($nro_stro == 0 || $nro_stro == '' || $nro_stro == null) {

                            $mensaje_error = "No se ha encontrado el nro stro.";
                        }
                    }
                }
            }
        }
    } catch (Exception $e) {
        // echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

 
$datosSise = json_decode(@@tri_datos_sise);
$anioIns = $datosSise->aaaa_inspeccion;
$aaaa_ejercicio = intval($anioIns);

$coberturas_grid = array();
$coberturas_grid = @@grd_registro_siniestro;
 
foreach ($coberturas_grid as $cobertura) {

    if ($cobertura['grd_s_codCobertura'] == $cod_ind_cob && $cobertura['grd_s_impValor'] != '' && $cobertura['grd_s_aplicar'] == 'SI') {
        $imp_valor_estimado = intval($cobertura['grd_s_impValor']);
    }
}


$valor_aprobado = @@frm_valoresAprobados_totalProformado;
if ($valor_aprobado != '' && $valor_aprobado != null) {
    $imp_valor_estimado = $valor_aprobado;
}

$valor_aprobadoAlcances = @@frm_totalMasAlcances;
if ($valor_aprobadoAlcances != '' && $valor_aprobadoAlcances != null) {
    $imp_valor_estimado = $valor_aprobadoAlcances;
}

$imp_valor_estimado = $imp_valor_estimado;
 
$valor_deducible = @@frm_deducible_deducible;


$imp_valor_estimado = $imp_valor_estimado - $valor_deducible;

//round to int with ceil
$imp_valor_estimado = $imp_valor_estimado;


if ($operation_id == 'null' || $operation_id == '' || $operation_id == null) {
    $operation_id = @@APPLICATION;
}

 
if ($imp_valor_estimado < 0 || $imp_valor_estimado == null || $imp_valor_estimado == '') {
    $debug_info = "
        <div style='background:#F5F5F5; border:1px solid #DDD; border-radius:6px; padding:12px 16px; margin-top:12px; font-family:monospace; font-size:12px; text-align:left; color:#333;'>
            <strong>DEBUG - imp_valor_estimado</strong><br>
            cod_ind_cob (cobertura buscada en grid): " . var_export($cod_ind_cob, true) . "<br>
            valor grid (grd_s_impValor de la cobertura coincidente): " . var_export(isset($imp_valor_estimado) ? $imp_valor_estimado : 'no seteado en el loop', true) . "<br>
            frm_valoresAprobados_totalProformado: " . var_export($valor_aprobado, true) . "<br>
            frm_totalMasAlcances: " . var_export($valor_aprobadoAlcances, true) . "<br>
            frm_deducible_deducible: " . var_export($valor_deducible, true) . "<br>
            <hr style='border:none; border-top:1px solid #DDD; margin:8px 0;'>
            imp_valor_estimado FINAL (tras restar deducible): " . var_export($imp_valor_estimado, true) . "
        </div>
    ";

    die("
    <div style='font-family:-apple-system,Segoe UI,Arial,sans-serif; max-width:480px; margin:60px auto; background:#FFFFFF; border:1px solid #E0E0E0; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.08); overflow:hidden;'>
        <div style='background:#B00020; padding:16px 20px;'>
            <span style='color:#FFFFFF; font-size:14px; font-weight:600;'>⚠ No se puede continuar</span>
        </div>
        <div style='padding:24px 20px;'>
            <p style='margin:0 0 12px 0; color:#333333; font-size:14px; line-height:1.5;'>
                Verifique el valor a actualizar en la reserva: " . $imp_valor_estimado . "
            </p>
            " . $debug_info . "
        </div>
    </div>");
}


//nuevo json
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
        'AR-SVPP-238',
        $url_reserva,
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

     if (strpos($msg_m, 'Reserva actualizada correctamente') === false) {

        if(@@tri_resultado_automatico == 'SI') {
            @@tri_resultado_automatico = 'NO';

            $app=@@APPLICATION;
            $usuario = @@tri_usr_analista;

            $sql_usuario = "SELECT USR_ID, USR_EMAIL FROM USERS WHERE USR_UID = '$usuario'";
            $result_usuario = executeQuery($sql_usuario);

            if(is_array($result_usuario) && count($result_usuario) > 0) {
                $analista_id = $result_usuario[1]['USR_ID'];
                $analista_email = $result_usuario[1]['USR_EMAIL'];


                $actualizar_tarea = "UPDATE APP_DELEGATION SET USR_UID = '$usuario', USR_ID = '$analista_id' WHERE APP_UID = '$app' AND DEL_LAST_INDEX = 1";
                executeQuery($actualizar_tarea);

                @@tri_smart_claims_mensaje = 'Estimado analista, el proceso automático no pudo actualizar la reserva: ' . $msg_m . '. Por favor, revise el caso y realice la actualización manualmente.';

                $de     = 'bpm@equisuiza.com';
                $para   = $analista_email;
                $cc     = '';
                $bcc    = '';
                $asunto = "Resultado de valores" . @@APP_NUMBER;
                $plantilla = 'notificacion_smart.html';

                PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla, array());

            }
            
        }

       die("No se puede continuar con caso debido al siguiente error: " . $msg_m);
    }



} catch (Exception $e) {
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error = $msg_m;
}

if($http_code != 200){
    die('Error al actualizar la reserva. Código HTTP: ' . $http_code . '. Mensaje: ' . $msg_m);
}