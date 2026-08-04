<?php
//created by Hugo
//Inicializar Combo Accion Correccion

if(@@tri_bandera_reg == 'true'){
	@=frm_accion_dum = array();
	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
	@=frm_accion_dum[] = array("CONTINUAR", "Continuar con la emisión");
	@=frm_accion_dum[] = array("REGULARIZAR", "Requiere Regularización comercial");
	@=frm_accion_dum[] = array("NO_CONCRETADO", "No Concretado");
}else{
	@=frm_accion_dum = array();
	@=frm_accion_dum[] = array("", "-- Seleccione uno --");
	@=frm_accion_dum[] = array("CONTINUAR", "Continuar con la emisión");
	@=frm_accion_dum[] = array("REGULARIZAR", "Requiere Regularización comercial");
	@=frm_accion_dum[] = array("FINALIZAR", "Rechazo/ Aplazo");
}

//usuario suscriptor
$usr = @@USER_LOGGED;
$sql = "SELECT USR_USERNAME, USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '".$usr."'";
$rs = executeQuery($sql);
@@tri_user_suscriptor_mail = $rs['1']['USR_EMAIL'];