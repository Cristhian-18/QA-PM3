<?php
$array_coaseguradas = array();
$array_coaseguradas = @@frm_companias_coaseguradas;

@@tri_correos_coaseguradoras = '';

foreach ($array_coaseguradas as $coaseguradora) {
    //if coaseguradora['frm_email']% contains 'segurosequinoccial.com'
    if (
        strpos($coaseguradora['frm_email'], 'segurosequinoccial.com') !== false
        && $coaseguradora['frm_email'] != '' && $coaseguradora['frm_email'] != null
    ) {
        @@tri_correos_coaseguradoras .= $coaseguradora['frm_email'] . ',';
    } else {
        @@tri_correos_coaseguradoras .= $coaseguradora['frm_email'] . ',';
    }
}

//if 

$grid_ramo = array();
$grid_ramo = @@frm_grd_siniestrosRegsitrados;
foreach ($grid_ramo as $ramo) {
    @@tri_ramo_correo = $ramo['grd_ramo'];
}
