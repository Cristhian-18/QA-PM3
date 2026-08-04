<?php
//created by Hugo
//Inicializar Combo Accion Correccion

if(@@tri_bandera_t8 == 'true'){
	@=frm_accion_dum = array();
	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
	@=frm_accion_dum[] = array("REGRESAR_E", "Continuar con la emisión sin modificación MDA");
	@=frm_accion_dum[] = array("CONTINUAR", "Continuar con Actualización de Aprobación MDA");
}
else if(@@tri_bandera_t9 == 'true'){
	@=frm_accion_dum = array();
	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
	@=frm_accion_dum[] = array("REGRESAR_B", "Continuar con la emisión sin modificación MDA");
	@=frm_accion_dum[] = array("CONTINUAR", "Continuar con Actualización de Aprobación MDA");
}
