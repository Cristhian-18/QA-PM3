<?php
//Trigger Pendiente Importacion

$array_valores = @@grd_valores_siniestros;

//check if array [frm_gvs_estado] has any in estado "Pendiente"
$pendientes = "0";
foreach ($array_valores as $key => $value) {
    if ($value['frm_gvs_estado'] == 'Indemnizacion') {
        $pendientes = "1";
        break;
    }
}
@@tri_envio_correo_indemnizacion  = $pendientes;