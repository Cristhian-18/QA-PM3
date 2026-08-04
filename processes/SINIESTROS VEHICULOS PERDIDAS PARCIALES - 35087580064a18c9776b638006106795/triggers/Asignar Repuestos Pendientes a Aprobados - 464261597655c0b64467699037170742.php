<?php
$array = array();
$array = @@grd_valores_siniestros;

foreach ($array as $key => $value) {
    $pendiente = $value['frm_gvs_estado'];
    echo($pendiente);
    if($pendiente == "Pendiente"){
        $array[$key]['frm_gvs_estado'] = "Aprobado";
    }
}

@=grd_valores_siniestros = $array;