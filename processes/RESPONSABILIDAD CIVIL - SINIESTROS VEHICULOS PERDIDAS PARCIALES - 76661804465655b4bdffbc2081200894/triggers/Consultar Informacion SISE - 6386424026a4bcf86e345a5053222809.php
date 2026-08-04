<?php
// Consultar Informacion SISE

//$pro_uid = @@PROCESS;

$pro_uid = '35087580064a18c9776b638006106795';

@@tri_msg_error_sise = '';
@@tri_bandera_error_sise = '1'; // por defecto: no se obtuvo la información

// Datos de la solicitud para consultar la poliza — los tres son obligatorios,
// si llega alguno vacío no se llama al servicio (evita mandar datos vacíos)
$idpv = @@frm_id_pv ?: null;
$placa = @@frm_vehiculo_placa ?: null;
$codAseg = (@@frm_informacion_codigoAsegurado && @@frm_informacion_codigoAsegurado != '-1') ? @@frm_informacion_codigoAsegurado : null;

if ($idpv === null || $placa === null || $codAseg === null) {
    @@tri_msg_error_sise = 'Faltan datos obligatorios (idpv, placa o codAseg) para consultar el servicio.';
    return;
}

$jsonBody = json_encode(['idpv' => $idpv, 'placa' => $placa, 'codAseg' => $codAseg]);

// Obtener token y URL del servicio desde el catálogo
$sqlAuth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
$rsAuth = executeQuery($sqlAuth);
$token = $rsAuth['1']['DESCRIPCION'] ?? '';

$sqlUrl = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_poliza_Placa_IdPv'";
$rsUrl = executeQuery($sqlUrl);
$url = $rsUrl['1']['DESCRIPCION'] ?? '';


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json',
    'APIKEY: ' . $token,
]);

$respuesta = curl_exec($ch);
$errorCurl = curl_errno($ch) ? curl_error($ch) : '';
curl_close($ch);

$result = json_decode($respuesta);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'ONSDP-SVPP-82',
    $url,
    'POST',
    'APIKEY: ' . $token,
    $jsonBody,
    json_encode($result),
    $errorCurl
);

if ($errorCurl !== '' || empty($result) || in_array($result->codigo ?? null, [204, 500], true)) {
    @@tri_msg_error_sise = $errorCurl !== '' ? $errorCurl : 'No se pudo obtener la información del servicio.';
    return;
}

// Buscar, dentro de los siniestros devueltos, el que coincide con los
// identificadores del caso actual, y extraer su número de siniestro
foreach ($result->data->siniestros ?? [] as $siniestro) {
    @@frm_numero_reporte_sise = $siniestro->nroReclamoAgente;
    @@frm_numero_reclamo_sise = $siniestro->nroStro;
    @@tri_bandera_error_sise = '0'; // sí se obtuvo la información: el siguiente paso puede continuar
    break;
}

if (@@tri_bandera_error_sise === '1') {
    @@tri_msg_error_sise = 'No se encontró el siniestro en la respuesta del servicio.';
}