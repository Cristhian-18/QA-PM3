<?php
//<?phpObtener Ruta Emisión
//created by Henry
//5-3-2024

$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$process = @@PROCESS;

@@frm_accion_emision = 'CONTINUAR';

$grd_coberturas = @=grd_coberturas;

foreach($grd_coberturas as $data_cob){
	if($data_cob['por_extraprima'] > 0 || $data_cob['val_extraprima'] > 0){
		@@frm_accion_emision = 'EMISION_MANUAL';
	}
}


if(@@frm_plan_diferente_asegurado == 'S'){
	@@frm_accion_emision = 'EMISION_MANUAL';
}

if(@@frm_motivo_seguro == '10' || @@frm_motivo_seguro == '13' || @@frm_motivo_seguro == '12'){
	@@frm_accion_emision = 'EMISION_MANUAL';
}

