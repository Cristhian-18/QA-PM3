<?php
$array_guardado = array();

$array_guardado = @@grd_valores_siniestros;

@@grd_valores_siniestro_guardado = @@grd_valores_siniestros;

$array_valores = @@grd_valores_siniestros_alcance;

//check if array [frm_gvs_estado] has any in estado "Pendiente"
$pendientes = "0";

foreach (@@grd_valores_siniestros_alcance as $key => $value) {
    if ($value['frm_gvs_estado'] == 'Pendiente') {
        $pendientes = "1";
        break;
    }
}
if ($pendientes != "1") {
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

if (@@APP_NUMBER == 7574) {
    @@tri_bandera_pendientes = 0;
}

if (@@frm_accion == "INDEMNIZAR" || @@frm_accion == 'TALLER INDEMNIZACION') {
    if (@@tri_bandera_indemnizar != "1") {
        @@tri_bandera_indemnizar = "1";
    }
}
@@tri_bandera_indemnizar = "0";
if (@@frm_accion == "COTIZAR") {
    @@tri_bandera_cotizar = "1";
}
