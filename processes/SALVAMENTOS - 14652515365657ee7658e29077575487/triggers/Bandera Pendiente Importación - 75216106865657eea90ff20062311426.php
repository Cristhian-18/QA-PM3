<?php
//Trigger Pendiente Importacion
//<?
/*print_r(@@grd_valores_siniestros_alcance);
echo("-------------<br \>-----------");
print_r(@@grd_valores_siniestros);*/
/*
$alcances = array();
$alcances = @@grd_valores_siniestros_alcance;
@@aux_alcances = 0;

foreach($alcances as $alcance){
    $alcance['frm_gvs_cantidad'] = $alcance['frm_gvs_cantidad_1'];
    $alcance['frm_gvs_nparte_1'] = $alcance['frm_gvs_nparte'];
    $alcance['frm_gvs_descripcion'] = $alcance['frm_gvs_descripcion'];
    @=grd_valores_siniestros[] = $alcance;
}*/


$array_valores = @@grd_valores_siniestros_alcance;

//check if array [frm_gvs_estado] has any in estado "Pendiente"
$pendientes = "0";

foreach (@@grd_valores_siniestros_alcance as $key => $value) {
    if ($value['frm_gvs_estado'] == 'Pendiente') {
        $pendientes = "1";
        break;
    }
}

if($pendientes != "1"){
    $array_valores_normal = @@grd_valores_siniestros;
    
    foreach (@@grd_valores_siniestros as $key => $value) {
        if ($value['frm_gvs_estado'] == 'Pendiente') {
            $pendientes = "1";
            break;
        }
    }
}


@@tri_bandera_pendientes = $pendientes;
@@tri_bandera_compra_completada = '0';

if(@@frm_accion == "INDEMNIZAR"){
	@@tri_bandera_indemnizar = "1";
}
@@tri_bandera_indemnizar = "0";
if(@@frm_accion == "COTIZAR"){
	@@tri_bandera_cotizar = "1";
}