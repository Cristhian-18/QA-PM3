<?php
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
    //created by Henry
    //24-12-2020
    //Guardar Documentos Compartida
    $pro_uid = @@PROCESS;
    //consulto del catalogo
    //obtengo el api_key
    $sql_cata_auth = "SELECT DESCRIPCION, CAMPO2, CAMPO1 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Actualizar_reserva'";
    $rs_auth =  executeQuery($sql_cata_auth);
    $url_reserva = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

    $sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'APIKEY'";
	$rs_sql_apikey =  executeQuery($sql_apikey);

	$apikey = isset($rs_sql_apikey['1']['DESCRIPCION']) ? $rs_sql_apikey['1']['DESCRIPCION'] : '';




    $caseUID = @@APPLICATION;

		$nro_stro = intval(@@id_stro);
		$cod_suc = @@frm_poliza_codSucursal;
		$cod_ramo = @@frm_codRamo;
		$aaaa_ejercicio = intval(date('Y'));

        $coberturas = explode(",", @@frm_cobertura_aplicada);
		$cod_ind_cob = intval($coberturas[0]);
		$imp_valor_estimado = '900';
		$operation_id = @@APPLICATION;



        $coberturas_grid = array();
        $coberturas_grid = @@grd_registro_siniestro;

        foreach($coberturas_grid as $cobertura){
            if($cobertura['grd_s_codCobertura'] == $cod_ind_cob && $cobertura['grd_s_impValor'] != '' && $cobertura['grd_s_aplicar'] == 'SI'){
                $imp_valor_estimado = intval($cobertura['grd_s_impValor']);
            }
        }





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
        "imp_valor_estimado" => floatval($imp_valor_estimado),
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
        'AR-SPT-238',
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
      die("Trigger detenido: msg_m no indica actualización exitosa. Valor recibido: " . $msg_m);
    }

} catch (Exception $e) {
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error = $msg_m;
}
