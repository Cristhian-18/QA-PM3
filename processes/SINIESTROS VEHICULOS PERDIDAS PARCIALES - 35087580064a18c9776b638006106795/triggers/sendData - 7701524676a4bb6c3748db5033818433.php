<?php
//sendData

if (!ctype_digit((string) @@frm_numpreliq) || (int) @@frm_numpreliq <= 0) {
    executeQuery("UPDATE SECUENCIAS SET valor_actual = LAST_INSERT_ID(valor_actual + 1) WHERE nombre_secuencia = 'numero_preliquidacion'");
    $rs = executeQuery("SELECT LAST_INSERT_ID() AS siguiente");

    @@frm_numpreliq = $rs['1']['siguiente'];
    @@frm_numpreliq_label = $rs['1']['siguiente'];
}

@@frm_estado_label = "PENDIENTE";
@@frm_estado = "PENDIENTE";

PMFSendVariables(@@APPLICATION, [
    'frm_numpreliq'       => @@frm_numpreliq,
    'frm_numpreliq_label' => @@frm_numpreliq_label,
]);

$url   = 'https://wso2dev.equinoccialonline.com/v1/GestionAdministrativaFinanciera/Administrativo/PortalProveedores/preliquidaciones';
$token = 'eyJ4NXQjUzI1NiI6Ik1XSXlOREk1WWpFMlpXWTFPRE13TVdJM05HWm1NVFl5TlRNMk5UVmhaVGcxTlRNM1pUTmhOV0ptWkRFMU9UQTROV0UxWVRobE1qTmxOV0V6WWpJeVlRPT0iLCJraWQiOiJnYXRld2F5X2NlcnRpZmljYXRlX2FsaWFzIiwidHlwIjoiSldUIiwiYWxnIjoiUlMyNTYifQ==.eyJzdWIiOiJkZXNhcnJvbGxhZG9yQGNhcmJvbi5zdXBlciIsImFwcGxpY2F0aW9uIjp7ImlkIjoyMDQ3LCJ1dWlkIjoiZjVjMmFmZTctZjcyOC00YWEzLWI2M2MtMDk3YzhiNDcyYzQ4In0sImlzcyI6Imh0dHBzOlwvXC8xMC4xMC4xMS43NDo5NDQzXC9vYXV0aDJcL3Rva2VuIiwia2V5dHlwZSI6IlBST0RVQ1RJT04iLCJwZXJtaXR0ZWRSZWZlcmVyIjoiIiwidG9rZW5fdHlwZSI6ImFwaUtleSIsInBlcm1pdHRlZElQIjoiIiwiaWF0IjoxNzc5Mjg0NjYwLCJqdGkiOiJiNThkOGM2OS1iYjQ1LTRiMzgtYjFmYi0xYTI4NDA3Zjk2YjIifQ==.jjF6guhKXQtdvGxTbHJEtq8VAlrW3rgMXqXASp3jZcjGZuo-H9Jo3f2eXFsMKlN0QpeMxBg8lU3iIFGzNMhgO8uglOrXBMywSgvfAw2oevog2KVV9I4XKJ42H5fsIW8S8rtOeXJP9B26tMi8cm2Jmmy0yMkkqPVQ3OzYWDHWyCxAzgiZK1MhUGiBE01lj6oweNDDuMHkzV7lDnor6NR6BWaZ5sSBCr5jYa3uiNFDDjlmbS1GVh0shvw6q66Ge9iQ7AXIZVzqtirLpAQWIm0MRs746MOluL6yjeBAMXJikiDN_4Zrm4cGnwULRMGKXNsDcUSnajta0_o4I8zNkS-MEA==';

$cuerpo = [
    'IdentificadorProcesoBpm'        => @@APPLICATION,
    'NumeroCasoBpm'                  => (int) @@frm_numcaso,
    'EstadoProcesoBpm'               => @@frm_estado,
    'IdentificadorSiniestro'         => @@frm_numero_reporte_sise,
    'EtiquetaIdentificadorSiniestro' => @@frm_numero_reporte_sise,
    'NumeroSiniestro'                => @@frm_numero_reclamo_sise,
    'EtiquetaNumeroSiniestro'        => @@frm_numero_reclamo_sise,
    'UsuarioTaller'                  => @@frm_usuario_taller,
    'EtiquetaUsuarioTaller'          => @@frm_usuario_taller,
    //RUC TALLER - Cristhian 17/07/2026
    'rucProveedor'                   => @@frm_ruc_taller,
    'NombreProceso'                  => @@frm_name_process,
    'EtiquetaNombreProceso'          => @@frm_name_process,
    'NumeroPreLiquidacion'           => (int) @@frm_numpreliq,
    'EtiquetaNumeroPreLiquidacion'   => (string) @@frm_numpreliq_label,
    'NumeroCaso'                     => (int) @@frm_numcaso,
    'EtiquetaNumeroCaso'             => (string) @@frm_numcaso,
    'BusquedaNombres'                => @@frm_busqueda_nombres,
    'EtiquetaBusquedaNombres'        => @@frm_busqueda_nombres,
    'OrdenReparacion'                => @@frm_ordenReparacion,
    'EtiquetaOrdenReparacion'        => @@frm_ordenReparacion,
    'VehiculoPlaca'                  => @@frm_vehiculo_placa,
    'EtiquetaVehiculoPlaca'          => @@frm_vehiculo_placa,
    'VehiculoMarca'                  => @@frm_vehiculo_marca,
    'EtiquetaVehiculoMarca'          => @@frm_vehiculo_marca,
    'VehiculoModelo'                 => @@frm_vehiculo_modelo,
    'EtiquetaVehiculoModelo'         => @@frm_vehiculo_modelo,
    'VehiculoChasis'                 => @@frm_vehiculo_chasis,
    'EtiquetaVehiculoChasis'         => @@frm_vehiculo_chasis,
    'ValorManoObraProformada'        => @@frm_valoresAprobados_manoObraProformada,
    'EtiquetaManoObraProformada'     => @@frm_valoresAprobados_manoObraProformada,
    'ValorRepuestosProformados'      => @@frm_valoresAprobados_valorRepuestosProformado,
    'EtiquetaRepuestosProformados'   => @@frm_valoresAprobados_valorRepuestosProformado,
    'Deducible'                      => @@frm_deducible_deducible,
    'EtiquetaDeducible'              => @@frm_deducible_deducible,
    'Rasa'                           => @@frm_deducible_rasa,
    'EtiquetaRasa'                   => @@frm_deducible_rasa,
    'Vale'                           => @@frm_vale,
    'EtiquetaVale'                   => @@frm_vale,
    'NumeroRrn'                      => @@frm_nro_rrn,
    'EtiquetaNumeroRrn'              => @@frm_nro_rrn,
];

$body = json_encode([
    'IdSolicitud'   => @@APPLICATION,
    'Solicitante'   => 'BPM-PRELIQUIDACION',
    'TipoSolicitud' => 'EMITIR',
    'Cuerpo'        => $cuerpo,
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,            $url);
curl_setopt($ch, CURLOPT_POST,           true);
curl_setopt($ch, CURLOPT_POSTFIELDS,     $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT,        20);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CAINFO, false);
curl_setopt($ch, CURLOPT_CAPATH, false);
curl_setopt($ch, CURLOPT_HTTPHEADER,     [
    'apikey: ' . $token,
    'Content-Type: application/json',
]);

$respuesta = curl_exec($ch);
$errorCurl = curl_errno($ch) ? curl_error($ch) : '';
$httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$resultado = json_decode($respuesta);

// ── Tolerante a mayúsculas/minúsculas en la respuesta del portal ─────────────
$creado = false;
if (isset($resultado->Resultado->creado)) {
    $creado = (bool) $resultado->Resultado->creado;
} elseif (isset($resultado->resultado->creado)) {
    $creado = (bool) $resultado->resultado->creado;
}

$erroresList = [];
if (isset($resultado->Errores) && is_array($resultado->Errores)) {
    $erroresList = $resultado->Errores;
} elseif (isset($resultado->errores) && is_array($resultado->errores)) {
    $erroresList = $resultado->errores;
}

// Código 409 = ya existe en el portal → tratar como éxito
$yaExiste = false;
foreach ($erroresList as $error) {
    $codigo = isset($error->Codigo) ? $error->Codigo : (isset($error->codigo) ? $error->codigo : null);
    if ((int) $codigo === 409) {
        $yaExiste = true;
        break;
    }
}

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'PORTAL-PROVEEDORES-PRELIQ',
    $url,
    'POST',
    'apikey: ' . $token,
    $body,
    json_encode($resultado),
    $errorCurl
);

if ($errorCurl !== '' || (!$creado && !$yaExiste)) {
    $mensajeError = 'No se pudo enviar la preliquidación al portal de proveedores. '
        . ($errorCurl !== '' ? $errorCurl : ('HTTP ' . $httpCode . ': ' . $respuesta));
    error_log($mensajeError . ' - APP: ' . @@APPLICATION);
    die($mensajeError);
}

if ($yaExiste) {
    error_log('Preliquidación ya existía en el portal - APP: ' . @@APPLICATION . ' NumPreliq: ' . @@frm_numpreliq);
}