<?php
//ENVIO DE EMAIL  @@tri_ruta_aprobacion== 'PENDIENTE' && @@tri_contador_rcs2  > 0 &&
//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$cnx                   = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$app_uid = @@APPLICATION;

if(@@frm_accion == 'APROBAR'){
	$de = '';
	$para = @@tri_directorBroker_email;
	//$cc =  'victor.cortez@beesmart.ec';
	$cc =  '';
	$bcc= '';
	$asunto = 'Caso '.@#APP_NUMBER.' aprobado Venta Virtual Especialista'; 

	$plantilla_rec = 'Notificacion_director_broker.html';

	@@envio_mail_diretor_broker = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array());
}
