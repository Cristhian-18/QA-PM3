<?php
 
$array_valores = @@grd_valores_siniestros;
 
 
foreach(@@grd_valores_siniestros as $key => $value){
 
    if($value['frm_gvs_disponibilidad'] != 'DISPONIBLE' ){
		@@tri_resultado_automatico = 'NO';
        break;
    }
}

 