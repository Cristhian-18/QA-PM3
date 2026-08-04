<?php
//ENVIO DE EMAIL  @@tri_ruta_aprobacion== 'PENDIENTE' && @@tri_contador_rcs2  > 0 &&
//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$cnx                   = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
//OBTENER mail del catalogo

$para = @@tri_jefe_email;

$de = '';
$cc =  @@frm_vendedor_email;
//$bcc= 'ctipan@segurosequinoccial.com';
$bcc= @@tri_directorBroker_email;
if(@@tri_es_broker == 'SI'){
	$asunto = 'Caso '.@#APP_NUMBER.' reproceso Venta Virtual Especialista';
		$cc =  '';
}else{
	$asunto = 'Reproceso '.@#APP_NUMBER.' '.@#frm_nombres_completos; 
}

$plantilla_rec = 'Reproceso_suscripcion.html';

@@envio_mail_reproceso = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array());
/*
//para el director
$para_b = @@tri_directorBroker_email;
$de_b = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual';
$cc_b =  'ctipan@segurosequinoccial.com';
$bcc_d = '';
$asunto_d = 'Caso '.@#APP_NUMBER.' reprocesado Venta Virtual Especialista';  

$plantilla_rec_b = 'Reproceso_director_broker.html';

@@envio_mail_reproceso_broker = PMFSendMessage(@@APPLICATION,$de_b,$para_b, $cc_b, $bcc_d, $asunto_d, $plantilla_rec_b, array());

*/