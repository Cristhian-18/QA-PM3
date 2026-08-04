<?php
//Trigger Accion T5
//made by Jean

$concesionario = strpos(@@frm_taller_tipo, "MULTIMARCA");

$array_valores = @@grd_valores_siniestros;
@@tri_bandera_compra = "0";

$taller = @@frm_taller;

if($taller == 'TALLER INDEMNIZACION'){
	@@tri_bandera_indemnizacion = "1";
	$indemnizacion = 1;
} else {
	$indemnizacion = 0;
}

foreach($array_valores as $key => $value){
    if($value['frm_gvs_estado'] == 'Aprobado' && $value['frm_gvs_cantidad'] != null){
        $pendientes = "1";
		@@tri_bandera_compra = "1";
        break;
    }
}

if($indemnizacion == "1"){
	@=frm_accion_dum = array();
 	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("INDEMNIZAR", "Caso aprobado - Aprobar indemnización");
	@=frm_accion_dum[] = array("AJUSTAR", "Realizar ajuste - Volver al ajustador interno");
    @=frm_accion_dum[] = array("RECHAZAR", "Caso rechazado - Volver al analista");
}
else if($pendientes == "1"){
	@=frm_accion_dum = array();
 	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("COMPRAR", "Caso aprobado - Generar la Orden de Compra e Inicio de reparación");
	@=frm_accion_dum[] = array("AJUSTAR", "Realizar ajuste - Volver al ajustador interno");
    @=frm_accion_dum[] = array("RECHAZAR", "Caso rechazado - Volver al analista");
} else {
    @=frm_accion_dum = array();
 	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
    @=frm_accion_dum[] = array("CONTINUAR", "Caso aprobado - Iniciar la reparación");
	@=frm_accion_dum[] = array("AJUSTAR", "Realizar ajuste - Volver al ajustador interno");
    @=frm_accion_dum[] = array("RECHAZAR", "Caso rechazado - Volver al analista");
}