<?php
$imp_valor_estimado = 3000;
$nro_stro = 400;
$cod_suc = 4;
$aaaa_ejercicio = 2026;
$cod_ind_cob=21;

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


print_r($json);

die();