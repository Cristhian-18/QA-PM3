<?php
// created by Henry
// Obtener bandera de fechas atención

@@tri_bandera_atencion = '';

$g = new G();

// ==============================
// FECHAS BASE
// ==============================
$fechaActual   = date('Y-m-d');
$timestampHoy  = strtotime($fechaActual);

// Fecha de creación del caso
$fechaCasoYM = date('Y-m', strtotime(@@APP_CREATE_DATE));
$fechaHoyYM  = date('Y-m');

// ==============================
// ÚLTIMO DÍA DEL MES (HÁBIL)
// ==============================
$fechaFinMes = date('Y-m-t', $timestampHoy);
$diaFinMes   = date('w', strtotime($fechaFinMes));

// Ajustar si cae en fin de semana
if ($diaFinMes == 6) {          // Sábado
    $fechaFinMes = date('Y-m-d', strtotime('-1 day', strtotime($fechaFinMes)));
} elseif ($diaFinMes == 0) {    // Domingo
    $fechaFinMes = date('Y-m-d', strtotime('-2 days', strtotime($fechaFinMes)));
}

// ==============================
// VALIDACIÓN FIN DE MES
// ==============================
$diasRestantes = floor((strtotime($fechaFinMes) - $timestampHoy) / 86400);

if ($diasRestantes <= 0) {
    @@tri_bandera_atencion = 'true';
    $g->SendMessageText("Fecha de apertura no valida", "WARNING");
    return;
}

// ==============================
// VALIDACIÓN INICIO DE MES
// (SOLO SI EL CASO NACIÓ EN ESTE MES)
// ==============================
$diaMesActual = (int) date('d');

if ($fechaCasoYM == $fechaHoyYM && $diaMesActual < 5) {

    $fechaInicioMes     = date('Y-m-01', $timestampHoy);
    $diaInicioMes       = date('w', strtotime($fechaInicioMes));
    $diaSemanaHoy       = date('w', $timestampHoy);

    $inicioValido = true;

    // Mes inicia lunes
    if ($diaInicioMes == 1 && $diaSemanaHoy == 1) {
        $inicioValido = false;
    }

    // Mes inicia sábado
    if ($diaInicioMes == 6 && in_array($diaSemanaHoy, [6, 0, 1])) {
        $inicioValido = false;
    }

    // Mes inicia domingo
    if ($diaInicioMes == 0 && in_array($diaSemanaHoy, [0, 1])) {
        $inicioValido = false;
    }

    if (!$inicioValido) {
        @@tri_bandera_atencion = 'true';
        $g->SendMessageText("Fecha de apertura no valida", "WARNING");
        return;
    }
}

// ==============================
// REDIRECCIÓN AL STEP 2
// ==============================
$result = executeQuery("
    SELECT STEP_UID_OBJ 
    FROM STEP 
    WHERE TAS_UID = '8760052855f3aa896a9a815031066895'
      AND STEP_POSITION = 2
");

if (!empty($result)) {
    @@stepUIDObj = $result[1]['STEP_UID_OBJ'];
    $g->SendMessageText("Validación exitosa", "SUCCESS");
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
}