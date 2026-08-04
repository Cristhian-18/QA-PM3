<?php
//Trigger Accion T5
//made by Jean
@@frm_vehiculo_valor_asegurado_accesorios = @@frm_sumaAseguradaTotal;

$newCaseId = @@process_uid_padre;
$c = new Cases();
$aCase = $c->loadCase($newCaseId);
@@frm_nroEndoso  = $aCase['APP_DATA']['frm_nroEndoso'];

$subastado = @@tri_bandera_subasta;

@=frm_accion_dum = array();
@=frm_accion_dum[] = array("", "-- Seleccione uno --");
@=frm_accion_dum[] = array("CONTINUAR", "Enviar salvamento a subasta");

if($subastado == "1"){ 
	@=frm_accion_dum[] = array("REDUCIR", "Solicitar reducción de valores");
}

