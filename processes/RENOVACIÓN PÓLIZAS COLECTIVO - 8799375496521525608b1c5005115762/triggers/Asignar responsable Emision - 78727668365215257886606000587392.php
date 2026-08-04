<?php
//Jean
/*$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS WHERE
 COD_CATALOGO = 'ATENCION_REQ' AND CODIGO = 'Emision' AND ESTADO = 1" ;

$rs = executeQuery($sql);

	$codigo = $rs['1']['CODIGO'];
	$frm_responsable_asignado = $rs['1']['DESCRIPCION'];
	$sql_u = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = '$frm_responsable_asignado'";
	$rs_u = executeQuery($sql_u);
		@@frm_responsable_emision = $rs_u['1']['USR_UID'];
		@@frm_emisor_asignado = $rs_u['1']['USR_UID'];
		@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];

*/
$frm_responsable_emision = @@frm_responsable_emision;
$sql_u = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '$frm_responsable_emision'";
$rs_u = executeQuery($sql_u);
@@frm_emisor_asignado = $rs_u['1']['USR_UID'];
@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];