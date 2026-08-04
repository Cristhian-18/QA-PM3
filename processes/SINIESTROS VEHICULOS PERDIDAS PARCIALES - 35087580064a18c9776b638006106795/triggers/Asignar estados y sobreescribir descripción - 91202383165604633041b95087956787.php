<?php
$repuestos = array();
$repuestos = @@grd_valores_siniestros;

foreach($repuestos as &$repuesto){
    $estado = $repuesto['frm_gvs_disponibilidad'];
    if($estado == 'DISPONIBLE'){
        $repuesto['frm_gvs_estado'] = 'Aprobado';
    } else if($estado == 'IMPORTACIÓN'){
        $repuesto['frm_gvs_estado'] = 'Pendiente';
    } else if($estado == 'FABRICACION'){
        $repuesto['frm_gvs_estado'] = 'Indemnizacion';
    }
}
unset($repuesto);

@=grd_valores_siniestros = $repuestos;

 
 
