<?php
//<?
$correo_1 = @@frm_da_correoElectronico;
$correo_2 = @@frm_ds_emailBroker1;
$correo_3 = @@frm_ds_emailBroker2;

$string_correos = '';

//put them in array 
//$correos = array($correo_1, $correo_2, $correo_3);

$correos = array($correo_2, $correo_3);

//remove empty values
$correos = array_filter($correos);
//delete repeated values
$correos = array_unique($correos);
//loop through array and add to string

foreach($correos as $correo){
  //check if doesnt exists
    $string_correos .= $correo . ', ';
}

//remove last comma
$string_correos = rtrim($string_correos, ', ');

@@correos_asegurado_broker = $string_correos;