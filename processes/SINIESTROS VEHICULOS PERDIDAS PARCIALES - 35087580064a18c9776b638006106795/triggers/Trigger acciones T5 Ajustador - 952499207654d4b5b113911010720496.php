<?php
//Trigger Accion T5
//made by Jean

$array_valores = array();
$array_valores = @@grd_valores_siniestros;

foreach ($array_valores as $key => $value) {
    if ($value['frm_gvs_disponibilidad'] == 'IMPORTACIÓN'
    && ($value['frm_gvs_estado'] == 'Pendiente' || $value['frm_gvs_estado'] == '')
    ) {
        $value['frm_gvs_estado'] = 'Pendiente';
        $bandera_importacion = "1";
    }

}




$concesionario = @@frm_taller;
if(@@tri_bandera_indemnizacion == "1"){
	@=frm_accion_dum = array();
 	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("CONTINUAR", "Proceder a Aprobación PDA de indemnización");
    @=frm_accion_dum[] = array("PERDIDA", "Perdida Total");
    @=frm_accion_dum[] = array("SUPERA", "Caso no supera el deducible");
} else if($concesionario == "TALLER INDEMNIZACION"){ 
	@=frm_accion_dum = array();
 	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("CONTINUAR", "Regresar al analista para indemnización");
    @=frm_accion_dum[] = array("PERDIDA", "Perdida Total");
    @=frm_accion_dum[] = array("COTIZAR", "Enviar a cotizar a Mundo Partes Repuestos de Concesionario");
    @=frm_accion_dum[] = array("SUPERA", "Caso no supera el deducible");
} else {
    @=frm_accion_dum = array();
 	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("CONTINUAR", "Proceder a aprobación PDA de orden de reparación");
    if($bandera_importacion == "1"){
        @=frm_accion_dum[] = array("IMPORTACION", "Solicitar aprobación de importación de repuestos");
    }
    @=frm_accion_dum[] = array("INDEMNIZAR", "Caso para indemnización");
    @=frm_accion_dum[] = array("PERDIDA", "Perdida Total");
    @=frm_accion_dum[] = array("COTIZAR", "Enviar a cotizar a Mundo Partes Repuestos de Concesionario");
    @=frm_accion_dum[] = array("SUPERA", "Caso no supera el deducible");

}

@=frm_accion_dum[] = array("MANTENER", "Mantener en la gestión del Auditor");
