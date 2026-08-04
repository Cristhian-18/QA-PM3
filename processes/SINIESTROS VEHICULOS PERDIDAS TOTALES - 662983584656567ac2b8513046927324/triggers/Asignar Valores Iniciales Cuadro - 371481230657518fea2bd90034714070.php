<?php

@@frm_valores_valorCasco = @@frm_sumaAseguradaCasco;

$valores_extras = array();
$valores_extras = @@grd_accesorios;

$valor = 0;

foreach($valores_extras as $valor_extra){
	$extra = $valor_extra['frm_accesorios_sumaAsegurada'] ? $valor_extra['frm_accesorios_sumaAsegurada'] : 0;
    $valor = $valor + $extra;
}

@@frm_valores_extras = $valor;

if(@@frm_taller != '' && @@frm_taller != null){
    @@frm_valores_ivaAudatexPorcentaje = 0.12;
	//@@frm_valores_ivaAudatexPorcentaje = 0;
} else {
    @@frm_valores_ivaAudatexPorcentaje = 0;
}