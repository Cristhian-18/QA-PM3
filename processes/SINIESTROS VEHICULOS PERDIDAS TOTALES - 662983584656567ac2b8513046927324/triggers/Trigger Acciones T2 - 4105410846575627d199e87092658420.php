<?php
$bandera_parciales = @@app_padre;

if($bandera_parciales != null){
@=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        @=frm_accion_dum[] = array("CONTINUAR", "Solicitar aprobación MDA");
        @=frm_accion_dum[] = array("PARCIAL", "Cerrar caso de perdida total y volver a perdida parcial");
        @=frm_accion_dum[] = array("CERRAR", "Cerrar caso");
} else {
@=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        @=frm_accion_dum[] = array("CONTINUAR", "Solicitar aprobación MDA");
	@=frm_accion_dum[] = array("CREARPARCIAL", "Crear caso en parciales y cerrar caso actual");
	@=frm_accion_dum[] = array("PARCIAL", "Cerrar caso");
}
