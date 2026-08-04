<?php
//Jean
$cnx = '6897140966514f7293404b5050866175';
$codigo = @@frm_datosSolicitud_tipo;
$accion = @@frm_accion;

$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS WHERE
 COD_CATALOGO = 'ATENCION_REQ' AND ESTADO = 
1 AND CODIGO = '$codigo'" ;

$rs = executeQuery($sql);
$frm_responsable_asignado = $rs['1']['DESCRIPCION'];

$sql_u = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = '$frm_responsable_asignado'";
$rs_u = executeQuery($sql_u);

if($accion != 'FINALIZAR'){
	if($codigo=='Emision'){
	@@frm_responsable_emision = $rs_u['1']['USR_UID'];
	@@frm_suscriptor_asignado =	@@frm_suscriptor_asignado;
	@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];
	@@frm_accion = 'CONTINUAR';
}else{
	/*@@frm_responsable_cotizacion = $rs_u['1']['USR_UID'];
	@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];
	@@frm_responsable_cotizacion_mail = $rs_u['1']['USR_EMAIL'];*/
		
	@@frm_responsable_cotizacion = @@frm_suscriptor_asignado;
	$frm_responsable_asignado = @@frm_suscriptor_asignado;
	$sql_cot = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '$frm_responsable_asignado'";
	$rs_cot = executeQuery($sql_cot);
	@@frm_responsable_emision_mail = $rs_cot['1']['USR_EMAIL'];
	@@frm_responsable_cotizacion_mail = $rs_cot['1']['USR_EMAIL'];

	@@frm_accion = 'REVISAR';
}
}else{
@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];
}


