<?php
$bandera_parciales = @@tri_bandera_parcial;

@@tri_bandera_T6 = "1";

@=frm_accion_dum = array();
@=frm_accion_dum[] = array("", "-- Seleccione uno --");
@=frm_accion_dum[] = array("CONTINUAR", "Enviar a aprobación MDA");
@=frm_accion_dum[] = array("SOLICITAR", "Solicitar ampliación de valores al coordinador");

if($bandera_parciales == "1"){
        @=frm_accion_dum[] = array("PARCIAL", "Cerrar caso para perdida parcial");
}