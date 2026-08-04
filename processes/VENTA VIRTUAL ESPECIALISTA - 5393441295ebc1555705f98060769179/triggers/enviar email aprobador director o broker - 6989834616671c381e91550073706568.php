<?php
//ENVIO DE EMAIL  @@tri_ruta_aprobacion== 'PENDIENTE' && @@tri_contador_rcs2  > 0 &&
//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$cnx                   = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$app_uid = @@APPLICATION;

$de = '';
$para = @@tri_jefe_email;
$cc =  '';
$bcc= 'mguaman@equisuiza.com';
$asunto = 'Caso ingresado '.@#APP_NUMBER.' Venta Virtual Especialista'; 
$plantilla_rec = 'Notificacion_director.html';

if(@@tri_es_broker === 'SI'){
	$para = @@tri_jefe_email;
	$plantilla_rec = 'Notificacion_broker.html';
}

@@envio_mail_director_broker = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array());
