<?php
/* ---- OBTENCION DE TOKEN PARA CONSUMO DE SERVICIOS WEB ----- */
@@tri_smart_claims_error  = '';
@@tri_resultado_final = 'RECHAZADO';
$valoresAprobados = @@frm_valoresAprobados_totalProformado;
 
if(empty($valoresAprobados) || $valoresAprobados == 0) {
    $valoresAprobados = 0;
}

$proceso = @@PROCESS;
$app_uid = @@APPLICATION;

$sql_authenticacion = "SELECT ac.VALOR, ac.INTEGRACION, ac.CAMPO1 FROM ADMIN_CATALOGOS ac where ac.CODIGO = 'SMART_CLAIMS_AUTH' and ac.PRO_UID = '$proceso' and ac.ESTADO = 1";

$result_authenticacion = executeQuery($sql_authenticacion);

if (empty($result_authenticacion)) {
	 @@tri_smart_claims_error = "Faltan datos de autenticación para SmartClaims. Verifique el catálogo SMART_CLAIMS_AUTH para el proceso";
	return;
}

$url = $result_authenticacion[1]['VALOR'];
$email = $result_authenticacion[1]['INTEGRACION'];
$password = $result_authenticacion[1]['CAMPO1'];

if (empty($url) || empty($email) || empty($password)) {
   @@tri_smart_claims_error ="Faltan datos de autenticación para SmartClaims. Verifique el catálogo SMART_CLAIMS_AUTH para el proceso";
	return ;
}

$body        = ["email" => $email, "password" => $password];
$body_string = json_encode($body);

if ($body_string === false) {
    @@tri_smart_claims_error = "Error al codificar JSON para autenticación SmartClaims: " ;
	return;
}

$headers = [
    "Content-Type: application/json",
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $body_string,
    CURLOPT_HTTPHEADER     => $headers,
]);
$response  = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$curl_error = curl_error($curl);
curl_close($curl);

// ---- BITÁCORA ----
PMFBitacoraServicios(
    @@APP_NUMBER,
    'POST',
    'sc-pp-41',
    $url,
    'POST',
    implode(', ', $headers),
    $body_string,
    $response,
    $curl_error
);

if ($response === false || $curl_error) {
   @@tri_smart_claims_error =  "Error en cURL durante autenticación SmartClaims: $curl_error";
	return ;
}

if ($http_code !== 200) {
     @@tri_smart_claims_error = "Autenticación SmartClaims fallida. HTTP $http_code - Response: $response";
	return;
}

// ---- EXTRAER TOKEN ----
$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    @@tri_smart_claims_error = "Error al decodificar JSON de autenticación: " ;
	return ;
}

if (empty($data['success']) || empty($data['token'])) {
    @@tri_smart_claims_error =  "Autenticación fallida: ";
	return ;
}

$token = $data['token']; //Bearer token para usar en el siguiente servicio


/* ---- CONSUMIR EL SERVICIO DE SMART CLAIMS ----- */

$sql_servicio = "SELECT ac.VALOR FROM ADMIN_CATALOGOS ac where ac.CODIGO = 'SMART_CLAIMS_SERVICE' and ac.PRO_UID = '$proceso' and ac.ESTADO = 1";

$result_servicio = executeQuery($sql_servicio);
 

$url = $result_servicio[1]['VALOR'];

/* ---- OBTENCIO DE LA DATA DEL SERVICIO ----- */

$sqlDocs = "SELECT APP_DOC_UID, APP_DOC_FILENAME, APP_DOC_COMMENT
            FROM APP_DOCUMENT
            WHERE APP_UID = '$app_uid'
            AND DOC_UID = '739729238652a772f7814b7025820719'
            ORDER BY APP_DOC_CREATE_DATE DESC";

$docs = executeQuery($sqlDocs);


if (empty($docs)) {
    @@tri_smart_claims_error = "No se encontraron documentos para el caso: $app_uid";
	return ;
}

$licencia  = null;
$matricula = null;

foreach ($docs as $doc) {
    $ext  = pathinfo($doc['APP_DOC_FILENAME'], PATHINFO_EXTENSION);
    $ruta = getRutaDocumentoPM($app_uid, $doc['APP_DOC_UID'], $ext);

    if (!file_exists($ruta)) continue;

    if (strpos($doc['APP_DOC_COMMENT'], 'LICENCIA') !== false) {
        $licencia = ['ruta' => $ruta, 'nombre' => $doc['APP_DOC_FILENAME'], 'ext' => $ext];
    } elseif (strpos($doc['APP_DOC_COMMENT'], 'MATRICULA') !== false) {
        $matricula = ['ruta' => $ruta, 'nombre' => $doc['APP_DOC_FILENAME'], 'ext' => $ext];
    }
}
 

if (!$licencia || !$matricula) {
      @@tri_smart_claims_error = "Faltan documentos requeridos (licencia o matrícula) para este caso: $app_uid";
	return ;
}

 
// ---- ENVÍO A SMART CLAIMS - VEHÍCULOS ---- 

$post_fields = [
    // Datos del asegurado
    'identificacionAsegurado'            => @@frm_asegurado_identificacion,
    'nombreAsegurado'                    => @@frm_asegurado_nombres,
    'placaVehiculo'                      => @@frm_vehiculo_placa,
    'fechaFinVigenciaPoliza'             => @@frm_poliza_FechaFin,
    'fechaOcurrenciaSiniestro'           => @@frm_busqueda_fechaSiniestro,
    'fechaReporteSiniestro'              => @@fecha_hora_recepcion,
    'chasisVehiculo'                     => @@frm_vehiculo_chasis,
    'idPv'                               => @@frm_id_pv,

    // Flags booleanos (se envían como string 'true'/'false')
    'perdidaParcialPorDanio'             => 'true',
    'Inundado'                           => 'false',
    'existePartePolicial'                => 'false',
    'esResponsableSegunCriterioDelAsegurado' => 'false',
    'danioSimple'                        => 'true',
    'ChoqueMultiple'                     => 'false',

    // Documentos (archivos)
    'documentos[0].codigo'              => 'DOCUMENTO_LICENCIA_CONDUCIR',
   'documentos[0].archivo'  => new CURLFile($licencia['ruta'],  getMimeType($licencia['ext']),  $licencia['nombre']),

    'documentos[1].codigo'              => 'DOCUMENTO_MATRICULA_VEHICULO',
   'documentos[1].archivo'  => new CURLFile($matricula['ruta'], getMimeType($matricula['ext']), $matricula['nombre']),

];

 
$headers_vehiculos = [
    "Authorization: Bearer $token",
    // NO agregar Content-Type aquí — cURL lo genera solo con el boundary correcto
];

$curl_vehiculos = curl_init();
curl_setopt_array($curl_vehiculos, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 60,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $post_fields,
    CURLOPT_HTTPHEADER     => $headers_vehiculos,
]);

$response_vehiculos  = curl_exec($curl_vehiculos);
$http_code_vehiculos = curl_getinfo($curl_vehiculos, CURLINFO_HTTP_CODE);
$curl_error_vehiculos = curl_error($curl_vehiculos);
curl_close($curl_vehiculos);

$response_data = json_decode($response_vehiculos, true);
$mensaje       = $response_data['mensaje'] ?? 'SIN_RESPUESTA';

// ---- BITÁCORA ----
PMFBitacoraServicios(
    @@APP_NUMBER,
    'POST',
    'sc-pp-130',
    $url,
    'POST',
    implode(', ', $headers_vehiculos),
    json_encode(array_filter($post_fields, fn($v) => !($v instanceof CURLFile))), // no loggear archivos binarios
    $response_vehiculos,
    $curl_error_vehiculos
);

if ($http_code_vehiculos !== 200 || !empty($curl_error_vehiculos)) {
    @@tri_smart_claims_estado     = 'FALLO_HTTP';
    @@tri_smart_claims_resultado  = '';
    @@tri_smart_claims_descripcion = $curl_error_vehiculos ?: "HTTP $http_code_vehiculos";

} elseif ($mensaje === 'Proceso exitoso') {
    @@tri_smart_claims_estado     = 'COMPLETADO';
    @@tri_smart_claims_resultado  = $response_data['descripcion'] ?? ''; // ROJO / VERDE / AMARILLO
    @@tri_smart_claims_puntaje    = $response_data['puntaje']     ?? '';
    @@tri_smart_claims_alerta     = $response_data['codigoAlerta'] ?? '';

    // Extraer solo las descripciones de las reglas que NO se cumplieron
    $reglasNoCumplidas = array_filter(
        $response_data['reglasEvaluadas'] ?? [],
        function ($regla) {
            return $regla['cumpleRegla'] === false;
        }
    );

    $descripcionesFallidas = array_column($reglasNoCumplidas, 'descripcionArgumentation');

    @@tri_smart_claims_reglas_fallidas = implode("\n", $descripcionesFallidas);

    // ───────────────────────────────────────────
    // Evaluar valores Aprobados
    // ───────────────────────────────────────────
    // Debe haber al menos 1 accesorio aplicado Y la suma debe ser <= 2000
    if ($valoresAprobados === 0 || $valoresAprobados > 2000) {
    // No hay valorAprobado aplicados → esta validación no aplica
        $valorAprobado = false;
    } else{
        $valorAprobado = true;
    }

    // ───────────────────────────────────────────
    // Evaluar condición de Smart Claims
    // ───────────────────────────────────────────
    $smartClaimsAprobado = (@@tri_smart_claims_resultado === 'VERDE');

    // ───────────────────────────────────────────
    // Resultado final
    // ───────────────────────────────────────────
    if ($smartClaimsAprobado && $valorAprobado) {
        @@tri_resultado_final = 'APROBADO';
        @@tri_smart_claims_titulo  = 'Su caso ha sido aprobado';
        @@tri_smart_claims_mensaje = 'Su solicitud ha sido validada exitosamente y continuará con el proceso correspondiente.';

    } else {
        @@tri_resultado_final = 'RECHAZADO';
        @@tri_smart_claims_titulo  = 'Su caso requiere revisión adicional';

        $detalleReglas = '';

        // Reglas fallidas de Smart Claims (si aplica)
        if (!$smartClaimsAprobado && !empty(@@tri_smart_claims_reglas_fallidas)) {
            $reglas = explode("\n", @@tri_smart_claims_reglas_fallidas);
            foreach ($reglas as $regla) {
                $detalleReglas .= '<li style="margin-bottom: 5px;">' . htmlspecialchars($regla) . '</li>';
            }
        }

        // Motivo de valorAprobado (si aplica)
        if (!$valorAprobado) {
            $detalleReglas .= '<li style="margin-bottom: 5px;">Los valores aprobados (' . number_format($valoresAprobados, 2) . ') supera el límite permitido de 2000.</li>';
        }

        if (!empty($detalleReglas)) {
            $detalleReglas = '<ul style="margin: 10px 0; padding-left: 20px;">' . $detalleReglas . '</ul>';
        }

        @@tri_smart_claims_mensaje = 'Su solicitud requiere revisión adicional por nuestro equipo debido a las siguientes observaciones:' . $detalleReglas;
    }

    // ───────────────────────────────────────────
    // Envío de correo
    // ───────────────────────────────────────────
    $uid_analista = @@tri_usr_analista_anterior;
    $sql_analista_correo  = "SELECT USR_EMAIL FROM USERS u where u.USR_UID = '$uid_analista'";
    $result_analista_correo = executeQuery($sql_analista_correo);
    $para = $result_analista_correo[1]['USR_EMAIL'] ?? 'villanodaniel8@gmail.com';

    $de     = 'bpm@equisuiza.com';
    $para   = $para;
    $cc     = '';
    $bcc    = '';
    $asunto = "Resultado evaluación Smart Claims - Vehículos - Solicitud #" . @@APP_NUMBER;
    $plantilla = 'notificacion_smart.html';

    PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla, array());


} elseif ($mensaje === 'EJECUTANDO') {
    @@tri_smart_claims_estado     = 'EJECUTANDO';
    @@tri_smart_claims_resultado  = '';
    @@tri_smart_claims_descripcion = 'Procesamiento en curso';
	if(@@TASK=='56594959064f8a7036237e1042256890'){
		die('CONTROL DE AVANCE');
	}
} else {
    // ERROR u otro mensaje desconocido
    @@tri_smart_claims_estado     = $mensaje;
    @@tri_smart_claims_resultado  = '';
    @@tri_smart_claims_descripcion = $response_data['descripcion'] ?? '';
}

