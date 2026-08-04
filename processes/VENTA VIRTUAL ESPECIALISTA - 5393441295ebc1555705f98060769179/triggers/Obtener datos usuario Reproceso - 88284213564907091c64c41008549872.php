<?php
//created by Henry
//9-12-2020
//Obtener datos usuario Auditor monto superior

$cnx_rp = '1479570925ec29f1d8d1d57019959618';
//@@tri_jefe_uid = '6079143455fd146b12eec50096286240';
$process = @@PROCESS;

if(@@tri_es_broker == 'SI'){
	@@frm_uid_reproceso = @@tri_jefe_uid;
}else{
	@@frm_uid_reproceso = @@frm_uid_vendedor;
}

//para el mail de rechaz
if(@@frm_accion == 'RECHAZAR'){
	@@tri_mail_rechazo = @@frm_comentario;
}