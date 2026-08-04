<?php

//<?
$repuestos = array();
$repuestos = @@grd_valores_siniestros;


foreach($repuestos as $repuesto){
    $estado = $repuesto['frm_gvs_disponibilidad'];
    if($estado == 'DISPONIBLE'){
        $repuesto['frm_gvs_estado'] = 'Aprobado';
    } else if($estado == 'IMPORTACIÓN'){
        $repuesto['frm_gvs_estado'] = 'Pendiente';
    } else if($estado == 'FABRICACION'){
        $repuesto['frm_gvs_estado'] = 'Indemnizacion';
    } 

    /*$ajustado = $repuesto['frm_gvs_descripcion_ajustada'];
    if($ajustado != '' && $ajustado != null){
		echo($ajustado);
        $repuesto['frm_gvs_descripcion'] = $ajustado;
		$repuesto['frm_gvs_descripcion_label'] = $ajustado;
    }
    print_r($repuestos);*/

}

@=grd_valores_siniestros = array();
@=grd_valores_siniestros = $repuestos;

