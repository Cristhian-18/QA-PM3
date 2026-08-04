<?php
//<?
if (@@frm_accion == "REGRESAR") {

    $fecha_hora = date("Y-m-d H:i:s");

    $valor = @@frm_salvamento_precioVenta;

    $array_valor = array(
        "prc_esperado" => $valor,
        "fecha_subasta" => $fecha_hora
    );

    $array_registro = array();
    $array_registro = @@grd_registro_subasta;

    $aux = 1;
    @@grd_registro_subasta = array();
    foreach ($array_registro as $registro) {
        if ($registro['prc_esperado'] != "" && $registro['prc_esperado'] != null) {
            @=grd_registro_subasta[$aux] = $registro;
			 $aux++;
        }
    }
    @=grd_registro_subasta[$aux] = $array_valor;



}