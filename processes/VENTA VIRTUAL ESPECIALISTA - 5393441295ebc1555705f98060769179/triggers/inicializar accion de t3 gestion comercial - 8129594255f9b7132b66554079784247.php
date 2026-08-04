<?php
//////////
// ACCION
//////////

@@frm_modificar_solicitud = '';
@@frm_modificar_debito = '';
@@frm_modificar_covid = '';

/*
if(@@frm_control_informe == "" ){
	@@frm_control_informe = "PENDIENTE";
}

if(@@frm_control_adjuntos == "" ){
	@@frm_control_adjuntos = "PENDIENTE";
}

@=frm_accion_documentos = array();
@=frm_accion_documentos[] = array("", "Seleccione");
@=frm_accion_documentos[] = array("MODIFICAR", "Modificar la informacion de los formularios");
if(@@frm_control_informe != "Completado"){
	@=frm_accion_documentos[] = array("INFORME", "Llenar Informe confidencial");
}

if(@@frm_control_informe != "PENDIENTE" and strtoupper(@@frm_control_pago) == 'PAGADO' ){
	@=frm_accion_documentos[] = array("CONTINUAR", "Continuar con el Director comercial");
	@=frm_accion_documentos[] = array("ADJUNTAR", "Adjuntar documentacion");
}*/

@=frm_accion_documentos = array();
@=frm_accion_documentos[] = array("", "Seleccione");

if((@@frm_control_informe == "" && @@frm_control_adjuntos == "") || (@@frm_control_informe == "PENDIENTE" && @@frm_control_adjuntos == "PENDIENTE")){
	@=frm_accion_documentos[] = array("MODIFICAR", "Modificar la solicitud (en todos los campos que no impacten a Magnum)");
	@=frm_accion_documentos[] = array("INFORME", "Declaración Asesor Comercial/Broker");
}


//@=frm_accion_documentos[] = array("ADJUNTAR", "Adjuntar documentos");
//@=frm_accion_documentos[] = array("INFORME", "Llenar informe de agente");

if(@@frm_control_informe == "" ){
	@@frm_control_informe = "PENDIENTE";
}

if(@@frm_control_adjuntos == "" ){
	@@frm_control_adjuntos = "PENDIENTE";
}

if(@@frm_control_informe == 'Completado' && (@@frm_control_adjuntos == "" || @@frm_control_adjuntos == "PENDIENTE")){
	@=frm_accion_documentos[] = array("MODIFICAR", "Modificar la solicitud (en todos los campos que no impacten a Magnum)");
	@=frm_accion_documentos[] = array("ADJUNTAR", "Adjuntar documentos");
}

if(@@frm_control_informe == 'Completado' && @@frm_control_adjuntos == "COMPLETO" ){
	@=frm_accion_documentos[] = array("MODIFICAR", "Modificar la solicitud (en todos los campos que no impacten a Magnum)");
	@=frm_accion_documentos[] = array("INFORME", "Declaración Asesor Comercial/Broker");
	@=frm_accion_documentos[] = array("ADJUNTAR", "Adjuntar documentos");
	@=frm_accion_documentos[] = array("CONTINUAR", "Continuar el proceso");	
}


