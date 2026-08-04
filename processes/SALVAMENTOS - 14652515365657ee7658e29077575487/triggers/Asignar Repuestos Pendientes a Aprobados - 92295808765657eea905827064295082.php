<?php
//<?
//Asignar valores a un array
$array = @@grd_valores_siniestros;

for ($i = 0; $i < count($array); $i++) {
    //
    $pendiente = $array[$i]['frm_gvs_estado'];
    if($pendiente == "Pendiente"){
        $array[$i]['frm_gvs_estado'] = "Aprobado";
    }
};
@@grd_valores_siniestros = $array;

