<?php
//Trigger Accion T5.2

@@frm_fecha_entrega = date('Y-m-d');
$pos = strpos(@@frm_taller_tipo, "CONCESIONARIO");
if($pos !== false){
	@@tri_bandera_concesionario = "1";
} else {
	@@tri_bandera_concesionario = "0";
}

if(@@frm_taller == "MUNDO MOTRIZ"){
	@@tri_bandera_mundo = "1";
} else {
	@@tri_bandera_mundo = "0";
}


if(@@tri_bandera_compra_completada == "1"){
    @=frm_accion_dum = array();
    @=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("CONTINUAR", "Finalizar arreglo del automotor");
    @=frm_accion_dum[] = array("REGISTRAR", "Registrar comentario");
	@=frm_accion_dum[] = array("SOLICITAR", "Solicitar alcance adicional");
	
}/*else if(@@frm_taller != "MUNDO MOTRIZ"){
    @=frm_accion_dum = array();
    @=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("CONTINUAR", "Finalizar arreglo del automotor");
    @=frm_accion_dum[] = array("REGISTRAR", "Registrar comentario");
	@=frm_accion_dum[] = array("SOLICITAR", "Solicitar alcance adicional");
	
}*/
else {
    @=frm_accion_dum = array();
    @=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("REGISTRAR", "Registrar comentario");
	@=frm_accion_dum[] = array("SOLICITAR", "Solicitar alcance adicional");
    @=frm_accion_dum[] = array("REPUESTOSP", "Registrar recepción parcial de repuestos");
    @=frm_accion_dum[] = array("REPUESTOS", "Registrar recepción total de repuestos");
    @=frm_accion_dum[] = array("DISCREPANCIA", "Registrar discrepancia de repuestos");

}