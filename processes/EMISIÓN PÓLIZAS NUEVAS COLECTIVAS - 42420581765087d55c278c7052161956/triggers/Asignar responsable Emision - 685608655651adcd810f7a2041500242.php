<?php
//Jean

$codigo = @@frm_datosSolicitud_tipo;
//foreach($rs as $data){
	if($codigo=='Emision'){
		$frm_responsable_asignado = @@frm_suscriptor_asignado;
		$sql_u = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '$frm_responsable_asignado'";
		$rs_u = executeQuery($sql_u);
		@@frm_responsable_emision = $rs_u['1']['USR_UID'];
		@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];
	}else{
		$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS WHERE
		 COD_CATALOGO = 'ATENCION_REQ' AND ESTADO = 1 AND CODIGO = 'Emision'" ;

		$rs = executeQuery($sql);
		$codigo = $rs['1']['CODIGO'];
		$frm_responsable_asignado = $rs['1']['DESCRIPCION'];
		$sql_u = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = '$frm_responsable_asignado'";
		$rs_u = executeQuery($sql_u);
		//@@frm_responsable_cotizacion = $rs_u['1']['USR_UID'];
		//@@frm_responsable_cotizacion_mail = $rs_u['1']['USR_EMAIL'];
		@@frm_responsable_emision = $rs_u['1']['USR_UID'];
		@@frm_responsable_emision_mail = $rs_u['1']['USR_EMAIL'];	
	}
//}