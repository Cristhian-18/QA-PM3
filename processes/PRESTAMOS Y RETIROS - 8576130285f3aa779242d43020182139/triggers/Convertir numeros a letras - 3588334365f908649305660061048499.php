<?php
 // Variables principales con valores por defecto
$frm_nombres_completos = (trim(@@frm_primer_nombre ?? '') . ' ' .
                         trim(@@frm_apellido_paterno ?? '') . ' ' .
                         trim(@@frm_apellido_materno ?? '')) ?: '';
@@frm_nombres_completos = $frm_nombres_completos;

// Validación de identificación jurídica
$numeroIdentificacionJuridico = @@frm_numero_identificacion_juridico ?? '';

if($numeroIdentificacionJuridico !== '') {
    $frm_numero_identificacion = $numeroIdentificacionJuridico;
    @@frm_numero_identificacion_aux = $numeroIdentificacionJuridico;
    @@frm_cedula_receptor_aux = @@frm_cedula_receptor ?? '';
    @@frm_cedula_pagador_aux = @@frm_cedula_pagador ?? '';
    @@frm_nombres_completos_aux = @@frm_nombre_empresa ?? '';
} else {
    $frm_numero_identificacion = @@frm_numero_identificacion ?? '';
    @@frm_numero_identificacion_aux = @@frm_numero_identificacion ?? '';
    @@frm_nombres_completos_aux = $frm_nombres_completos;
    @@frm_cedula_receptor_aux = @@frm_cedula_receptor ?? '';
    @@frm_cedula_pagador_aux = @@frm_cedula_pagador ?? '';
}

// Instanciación simple de variables
$frm_contratante = @@frm_contratante ?? '';
$frm_numero_poliza = @@frm_numero_poliza ?? '';
$frm_nombre_empresa = @@frm_nombre_empresa ?? '';


 

// Fecha y marcadores de tipo de cuenta
@@frm_fecha_solictud = getCurrentDate();
$medioPagoReceptor = @@frm_medio_pago_receptor ?? '';
@@tri_ban_cuenta_A = ($medioPagoReceptor == '0' ? 'X' : '___');
@@tri_ban_cuenta_C = ($medioPagoReceptor == '1' ? 'X' : '___');

// Funciones de conversión a letras (sin cambios)
function Unidades($num) {
    $unidades = [
        1 => "UN", 2 => "DOS", 3 => "TRES", 4 => "CUATRO",
        5 => "CINCO", 6 => "SEIS", 7 => "SIETE", 8 => "OCHO", 9 => "NUEVE"
    ];
    return $unidades[$num] ?? "";
}

function Decenas($num) {
    $decena = floor($num/10);
    $unidad = $num - ($decena * 10);

    switch($decena) {
        case 1:
            $especiales = [0 => "DIEZ", 1 => "ONCE", 2 => "DOCE", 3 => "TRECE",
                          4 => "CATORCE", 5 => "QUINCE"];
            return $especiales[$unidad] ?? "DIECI ".Unidades($unidad);
        case 2:
            return $unidad == 0 ? "VEINTE" : "VEINTI ".Unidades($unidad);
        case 3: return DecenasY("TREINTA", $unidad);
        case 4: return DecenasY("CUARENTA", $unidad);
        case 5: return DecenasY("CINCUENTA", $unidad);
        case 6: return DecenasY("SESENTA", $unidad);
        case 7: return DecenasY("SETENTA", $unidad);
        case 8: return DecenasY("OCHENTA", $unidad);
        case 9: return DecenasY("NOVENTA", $unidad);
        case 0: return Unidades($unidad);
    }
    return "";
}

function DecenasY($strSin, $numUnidades) {
    return $numUnidades > 0 ? $strSin. " Y " .Unidades($numUnidades) : $strSin;
}

function Centenas($num) {
    $centenas = floor($num / 100);
    $decenas = $num - ($centenas * 100);

    $centenasMap = [
        2 => "DOSCIENTOS", 3 => "TRESCIENTOS", 4 => "CUATROCIENTOS",
        5 => "QUINIENTOS", 6 => "SEISCIENTOS", 7 => "SETECIENTOS",
        8 => "OCHOCIENTOS", 9 => "NOVECIENTOS"
    ];

    if($centenas == 1) {
        return $decenas > 0 ? "CIENTO ".Decenas($decenas) : "CIEN";
    }

    return ($centenasMap[$centenas] ?? ""). ($decenas > 0 ? " ".Decenas($decenas) : "");
}

function Seccion($num, $divisor, $strSingular, $strPlural) {
    $cientos = floor($num / $divisor);
    $resto = $num - ($cientos * $divisor);
    $letras = "";

    if($cientos > 0) {
        $letras = $cientos > 1 ? Centenas($cientos). " " .$strPlural : $strSingular;
    }

    return $letras.($resto > 0 ? "" : "");
}

function Miles($num) {
    $divisor = 1000;
    $cientos = floor($num / $divisor);
    $resto = $num - ($cientos * $divisor);

    $strMiles = Seccion($num, $divisor, "UN MIL", "MIL");
    $strCentenas = Centenas($resto);

    return $strMiles ? $strMiles. " " .$strCentenas : $strCentenas;
}

function Millones($num) {
    $divisor = 1000000;
    $cientos = floor($num / $divisor);
    $resto = $num - ($cientos * $divisor);

    $strMillones = Seccion($num, $divisor, "UN MILLON DE", "MILLONES DE");
    $strMiles = Miles($resto);

    return $strMillones ? $strMillones. " " .$strMiles : $strMiles;
}

function NumeroALetras($num) {
    $enteros = floor($num);
    $centavos = round(($num - $enteros) * 100);

    $data = [
        'numero' => $num,
        'enteros' => $enteros,
        'centavos' => $centavos,
        'letrasCentavos' => "",
        'letrasMonedaPlural' => 'DOLARES',
        'letrasMonedaSingular' => 'DOLAR',
        'letrasMonedaCentavoPlural' => "CENTAVOS",
        'letrasMonedaCentavoSingular' => "CENTAVO"
    ];

    if($data['centavos'] > 0) {
        $centavosTexto = $data['centavos'] == 1 ?
            Millones($data['centavos']). " " .$data['letrasMonedaCentavoSingular'] :
            Millones($data['centavos'])." " .$data['letrasMonedaCentavoPlural'];
        $data['letrasCentavos'] = "CON " . $centavosTexto;
    }

    if($data['enteros'] == 0) {
        return "CERO " . $data['letrasMonedaPlural']." " .$data['letrasCentavos'];
    }

    if($data['enteros'] == 1) {
        return Millones($data['enteros']). " " .$data['letrasMonedaSingular']. " " .$data['letrasCentavos'];
    }

    return Millones($data['enteros']). " " .$data['letrasMonedaPlural']. " " .$data['letrasCentavos'];
}


// Procesamiento según tipo de solicitud
$tipoSolicitud = @@frm_tipo_solicitud ?? '';
$monto = '';

if($tipoSolicitud == 'P') {
    $montoPrestamo = (float)(@@frm_monto_prestamo ?? 0); // Ensure it's a float
    $valorInicial = (float)(@@frm_valor_inicial ?? 0); // Ensure it's a float

    @@frm_monto_solicitado = number_format($montoPrestamo, 2, ',', '.');
    @@frm_monto_prestamo_letras = NumeroALetras($montoPrestamo);
    @@frm_monto_prestamo_unidad = number_format($montoPrestamo, 2, ',', '.');
    @@frm_valor_inicial_letras = NumeroALetras($valorInicial);
    @@frm_valor_inicial_unidad = number_format($valorInicial, 2, ',', '.');

    $monto = @@frm_monto_prestamo_unidad;
} else {
    $montoRetiro = (float)(@@frm_monto ?? 0); // Ensure it's a float
    $costoRetiro = (float)(@@frm_costo_retiro ?? 0); // Ensure it's a float
    $derechoRetiro = (float)(@@frm_derecho_retiro ?? 0); // Ensure it's a float
    $valorDescontado = (float)(@@frm_val_descontado ?? 0); // Ensure it's a float

    @@frm_monto_solicitado = number_format($montoRetiro, 2, ',', '.');
    @@frm_monto_retiro_letras = NumeroALetras($montoRetiro);
    @@frm_monto_retiro_unidad = number_format($montoRetiro, 2, ',', '.');
    @@frm_costo_retiro_unidad = number_format($costoRetiro, 2, ',', '.');
    @@frm_derecho_retiro_unidad = number_format($derechoRetiro, 2, ',', '.');
    @@frm_val_descontado_unidad = number_format($valorDescontado, 2, ',', '.');
}




$plazo = @@frm_plazo_prestamo ?? '';
$frecuencia = @@frm_frecuencia_pago_label ?? '';
$tipoPersona = @@frm_tipo_persona ?? '';


// Generación de texto inicial
if($tipoSolicitud == 'R') {
    if($tipoPersona == 'N') {
        @@frm_txt_inicial = 'Yo: <span class="variable">'.$frm_nombres_completos.'</span> , con documento de identidad Nro. : <span class="variable">'.$frm_numero_identificacion.'</span> ,contratante de la p&oacute;liza Nro.<span class="variable">'.$frm_numero_poliza.'</span>,solicito el siguiente retiro sobre el saldo de mi cuenta individual o de aportes adicionales, según corresponda:';
    } else {
        @@frm_txt_inicial = 'Yo: <span class="variable">'.$frm_nombres_completos.'</span> , con documento de identidad Nro. : <span class="variable">'.$frm_numero_identificacion.'</span> , como representante legal de <span class="variable">'.$frm_nombre_empresa.'</span>, contratante de la p&oacute;liza Nro.<span class="variable">'.$frm_numero_poliza.'</span>, solicito el siguiente retiro sobre el saldo de mi cuenta individual o de aportes adicionales, según corresponda:';
    }
} else {
    if($tipoPersona == 'N') {
        @@frm_txt_inicial = 'Yo: <span class="variable">'.$frm_nombres_completos.'</span> , con documento de identidad Nro. : <span class="variable">'.$frm_numero_identificacion.'</span> ,contratante de la p&oacute;liza Nro.<span class="variable">'.$frm_numero_poliza.'</span>, solicito un préstamo sobre el saldo de mi cuenta individual o de aportes adicionales (según corresponda), por el valor de USD <span class="variable">'.$monto.'</span>,  a ser pagados en <span class="variable">'.$plazo.'</span>, <span class="variable">'.$frecuencia.'</span>.';
    } else {
        @@frm_txt_inicial = 'Yo: <span class="variable">'.$frm_nombres_completos.'</span> , con documento de identidad Nro. : <span class="variable">'.$frm_numero_identificacion.'</span> , como representante legal de <span class="variable">'.$frm_nombre_empresa.'</span>, contratante de la p&oacute;liza Nro.<span class="variable">'.$frm_numero_poliza.'</span>, solicito un préstamo sobre el saldo de mi cuenta individual o de aportes adicionales (según corresponda), por el valor de USD <span class="variable">'.$monto.'</span>,  a ser pagados en <span class="variable">'.$plazo.'</span>, <span class="variable">'.$frecuencia.'</span>.';
    }
}


