<?php

/**
 * Trigger: Generación de Preliquidación
 * Proceso : SINIESTROS VEHICULOS PERDIDAS PARCIALES
 * Tarea   : T7 - Generación de Preliquidación
 * Momento : Before Assignment
 * Autor   : Daniel
 * Fecha   : 2026-06
 *
 * Variables fuente:
 *   frm_valoresAprobados_valoresRepuestos1              → REPUESTOS
 *   frm_valoresAprobados_procentajeDescuentoProformado  → % Descuento
 *   frm_valoresAprobados_valorRepuestosProformado       → Valor repuestos proformado
 *   frm_valoresAprobados_manoObraProformada             → MANO DE OBRA
 *   frm_valoresAprobados_diasEstimadosReparacion        → Días estimados
 *   frm_valoresAprobados_totalProformado                → Total proformado
 *
 * Variables proformado (referencia):
 *   frm_valoresSiniestro_procentajeDescuentoProformado
 *   frm_valoresSiniestro_valorRepuestosProformado
 *   frm_valoresSiniestro_manoObraProformada
 *   frm_valoresSiniestro_diasEstimadosReparacion
 *   frm_valoresSiniestro_totalProformado
 */

// ─────────────────────────────────────────────
// 1. CONFIGURACIÓN DEL PORTAL (actualizar cuando esté listo)
// ─────────────────────────────────────────────
define('PORTAL_URL',        'https://PORTAL_FACTURAS/api/preliquidacion');  // TODO: URL real
define('PORTAL_TOKEN',      'BEARER_TOKEN_AQUI');                           // TODO: token real
define('PORTAL_TIMEOUT',    15);

// ─────────────────────────────────────────────
// 2. VARIABLES DEL CASO
// ─────────────────────────────────────────────

// --- Identificadores del caso ---
$appNumber   = @@APP_NUMBER;
$appUid      = @@APP_UID;
$nroReclamo  = @@tri_nro_stro  ?? null;   // puede ser null (integración BPM↔SISE pendiente)
$cobertura   = @@nombre_proceso ?? '';
$ejercicio   = @@ejercicio      ?? '';
$sucursal    = @@sucursal       ?? '';
$ramo        = @@ramo           ?? '';

// --- Valores APROBADOS (fuente definitiva para la preliquidación) ---
$repuestos          = @@frm_valoresAprobados_valoresRepuestos1             ?? 0;
$pctDescuento       = @@frm_valoresAprobados_procentajeDescuentoProformado ?? 0;
$repuestosProf      = @@frm_valoresAprobados_valorRepuestosProformado      ?? 0;
$manoObra           = @@frm_valoresAprobados_manoObraProformada            ?? 0;
$diasReparacion     = @@frm_valoresAprobados_diasEstimadosReparacion       ?? 0;
$totalProformado    = @@frm_valoresAprobados_totalProformado               ?? 0;

// --- Valores PROFORMADOS (referencia / trazabilidad) ---
$refPctDescuento    = @@frm_valoresSiniestro_procentajeDescuentoProformado ?? 0;
$refRepuestosProf   = @@frm_valoresSiniestro_valorRepuestosProformado      ?? 0;
$refManoObra        = @@frm_valoresSiniestro_manoObraProformada            ?? 0;
$refDias            = @@frm_valoresSiniestro_diasEstimadosReparacion       ?? 0;
$refTotal           = @@frm_valoresSiniestro_totalProformado               ?? 0;

// --- Deducible y RASA (según RFC) ---
$deducible   = @@deducible ?? 0;
$rasa        = @@rasa      ?? 0;

// ─────────────────────────────────────────────
// 3. CONSTRUCCIÓN DEL PAYLOAD
// ─────────────────────────────────────────────
$payload = [

    // Identificación del siniestro
    'bpm_numero'        => $appNumber,
    'bpm_uid'           => $appUid,
    'nro_reclamo'       => $nroReclamo,     // null hasta que se resuelva integración SISE
    'cobertura'         => $cobertura,
    'ejercicio'         => $ejercicio,
    'sucursal'          => $sucursal,
    'ramo'              => $ramo,

    // Valores aprobados (los que van en la preliquidación)
    'aprobado' => [
        'repuestos'              => (float) $repuestos,
        'pct_descuento'          => (float) $pctDescuento,
        'repuestos_proformado'   => (float) $repuestosProf,
        'mano_obra'              => (float) $manoObra,
        'dias_reparacion'        => (int)   $diasReparacion,
        'total_proformado'       => (float) $totalProformado,
    ],

    // Valores proformados originales (trazabilidad)
    'proformado' => [
        'pct_descuento'          => (float) $refPctDescuento,
        'repuestos_proformado'   => (float) $refRepuestosProf,
        'mano_obra'              => (float) $refManoObra,
        'dias_reparacion'        => (int)   $refDias,
        'total_proformado'       => (float) $refTotal,
    ],

    // Deducciones (según RFC)
    'deducible'  => (float) $deducible,
    'rasa'       => (float) $rasa,

];

// ─────────────────────────────────────────────
// 4. ENVÍO AL PORTAL
//    Comentado hasta que el portal esté listo.
//    Descomentar y ajustar URL + token cuando esté disponible.
// ─────────────────────────────────────────────

/*
$jsonPayload = json_encode($payload, JSON_UNESCAPED_UNICODE);

$ch = curl_init(PORTAL_URL);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_TIMEOUT        => PORTAL_TIMEOUT,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . PORTAL_TOKEN,
    ],
    CURLOPT_POSTFIELDS     => $jsonPayload,
    CURLOPT_SSL_VERIFYPEER => true,
]);

$response  = curl_exec($ch);
$httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError || $httpCode < 200 || $httpCode >= 300) {
    PMFBitacoraServicios('T7_Preliquidacion_ERROR', [
        'bpm'      => $appNumber,
        'http'     => $httpCode,
        'error'    => $curlError ?: "HTTP $httpCode",
        'response' => substr($response, 0, 500),
        'payload'  => $payload,
    ]);
    @@preliquidacion_enviada = 'ERROR';
    @@preliquidacion_error   = $curlError ?: "HTTP $httpCode - $response";
} else {
    $data = json_decode($response, true);
    PMFBitacoraServicios('T7_Preliquidacion_OK', [
        'bpm'      => $appNumber,
        'numero'   => $data['numero_preliquidacion'] ?? 'N/D',
        'response' => $data,
    ]);
    @@preliquidacion_enviada = 'OK';
    @@preliquidacion_numero  = $data['numero_preliquidacion'] ?? '';
}
*/

 
 
@@preliquidacion_enviada = 'PENDIENTE';
@@preliquidacion_error   = '';
@@preliquidacion_numero  = '';