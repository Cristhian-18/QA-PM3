<?php
//created by Hugo
//Inicializar Combo Accion Correccion
//find in string @@frm_taller_tipo if contains "CONCESIONARIO"

	$tipo_taller = @@frm_taller_tipo;
	@@frm_vehiculo_valor_asegurado_accesorios = @@frm_sumaAseguradaTotal;

	if( trim(@@frm_taller_tipo) == "TALLER CONCESIONARIO"){
		@=frm_accion_dum = array();
        @=frm_accion_dum[] = array("", "-- Seleccione uno --");
        @=frm_accion_dum[] = array("COTIZADO", "Enviar al analista para su aprobación");
        @=frm_accion_dum[] = array("ESPERAR", "Registrar seguimiento al caso");
        @=frm_accion_dum[] = array("PERDIDA", "Enviar al analista - Posible perdida total");
        @=frm_accion_dum[] = array("DESISTIR", "Enviar al analista - Caso desistido");
	} 
	else if( trim(@@frm_taller_tipo) != "TALLER CONCESIONARIO") {
			@=frm_accion_dum = array();
			@=frm_accion_dum[] = array("", "-- Seleccione uno --");
			@=frm_accion_dum[] = array("CONTINUAR", "Enviar a Mundo Partes para su cotización");
			@=frm_accion_dum[] = array("ESPERAR", "Registrar seguimiento al caso");
			@=frm_accion_dum[] = array("PERDIDA", "Enviar al analista - Posible perdida total");
			@=frm_accion_dum[] = array("DESISTIR", "Enviar al analista - Caso desistido");
		}

if(@@frm_taller == "MUNDO MOTRIZ" || @@frm_taller == "MUNDO MOTRIZ SA"  ){
	@@tri_bandera_mundoMotriz = "1";
}

