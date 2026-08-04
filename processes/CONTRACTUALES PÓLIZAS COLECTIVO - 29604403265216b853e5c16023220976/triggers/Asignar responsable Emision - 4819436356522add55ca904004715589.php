<?php
//Jean
/*$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS WHERE
 COD_CATALOGO = 'ATENCION_REQ' AND ESTADO = 1" ;

$rs = executeQuery($sql);

foreach($rs as $data){
	$codigo = $data['CODIGO'];
	$frm_responsable_asignado = $data['DESCRIPCION'];
	$sql_u = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = '$frm_responsable_asignado'";
	$rs_u = executeQuery($sql_u);
	if($codigo=='Emision'){
		@@frm_responsable_emision = $rs_u['1']['USR_UID'];
		@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];
	}else{
		@@frm_responsable_cotizacion = $rs_u['1']['USR_UID'];
		@@frm_responsable_cotizacion_mail = $rs_u['1']['USR_EMAIL'];
	}
}

*/

$ciudad = @@frm_datosSolicitud_sucursal;

if($ciudad == 1){
	$frm_responsable_emision = 'KPIEDRA';
} else {
	$frm_responsable_emision = 'APTORRES';
}

$sql_user = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = '$frm_responsable_emision'";
$rs_user = executeQuery($sql_user);
@@frm_responsable_emision = $rs_user['1']['USR_UID'];

$frm_responsable_emision = @@frm_responsable_emision;
$sql_u = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '$frm_responsable_emision'";
$rs_u = executeQuery($sql_u);
@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];

