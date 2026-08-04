<?php
//Trigger Accion T5
//made by Jean

$concesionario = @@frm_taller;

if($concesionario == "TALLER INDEMNIZACION"){ 
	@=frm_accion_dum = array();
 	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("INDEMNIZAR", "Regresar al analistar para indemnización");
    @=frm_accion_dum[] = array("PERDIDA", "Perdida Total");
    @=frm_accion_dum[] = array("COTIZAR", "Enviar a cotizar a Mundo Partes Repuestos de Concesionario");
    @=frm_accion_dum[] = array("SUPERA", "Caso no supera el deducible");
} else {
    @=frm_accion_dum = array();
 	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("CONTINUAR", "Proceder a aprobación PDA de orden de reparación");
    @=frm_accion_dum[] = array("INDEMNIZAR", "Caso para indemnización");
    @=frm_accion_dum[] = array("PERDIDA", "Perdida Total");
    @=frm_accion_dum[] = array("COTIZAR", "Enviar a cotizar a Mundo Partes Repuestos de Concesionario");
    @=frm_accion_dum[] = array("SUPERA", "Caso no supera el deducible");

}
