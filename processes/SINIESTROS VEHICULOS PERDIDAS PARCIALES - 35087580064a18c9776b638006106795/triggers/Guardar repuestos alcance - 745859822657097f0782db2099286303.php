<?php
$alcances = array();
$alcances = @@grd_valores_siniestros_alcance;

foreach($alcances as $alcance){
    $alcance['frm_gvs_cantidad'] = $alcance['frm_gvs_cantidad_1'];
    $alcance['frm_gvs_nparte'] = $alcance['frm_gvs_nparte_1'];
    $alcance['frm_gvs_descripcion'] = $alcance['frm_gvs_descripcion_1'];
    @=grd_valores_siniestros[] = $alcance;
}
