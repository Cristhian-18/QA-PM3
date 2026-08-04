<?php
//created by Hugo
//Inicializar Combo Accion Correccion
//find in string @@frm_taller_tipo if contains "CONCESIONARIO"
	$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'mm_tcatota'";

	$tipo_veh = @@frm_vehiculo_tipo;

	if($tipo_veh == 'PESADO'){
		$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'Impart'";
	}

	$rs_u = executeQuery($sql_u);

	@@tri_user_mundopartes = $rs_u['1']['USR_UID'];

	$tipo_taller = @@frm_taller_tipo;

	if(@@frm_sumaAseguradaTotal != ""){
		@@frm_vehiculo_valor_asegurado_accesorios = @@frm_sumaAseguradaTotal;
	}
	
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

if(strpos(@@frm_taller, "MUNDO MOTRIZ") !== false){
	@@tri_bandera_mundoMotriz = "1";
	@=frm_accion_dum[] = array("REASIGNAR_ANALISTA", "Reasignar a un nuevo analista");
}

