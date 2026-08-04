<?php
if(@@APP_NUMBER == 18){
	$texto = 'Notificación de SINIESTRO';

	//ENVIO DE EMAIL

	$de = '';
	//$de = 'Seguros Equinoccial Venta Virtual<infoequivida@segurosequinoccial.com>';

	$para = 'victor.cortez@beesmart.ec';

	$cc = '';
	$bcc=''; 
	$asunto = "Notificación de SINIESTRO ". @#APP_NUMBER;

	$plantilla_rec = 'No_procede.html';

	$envio_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => $texto));
	
	die($envio_mail);
}
