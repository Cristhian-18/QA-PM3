<?php
//ENVIO DE EMAIL @@tri_ruta_aprobacion== 'RECHAZADO' &&

//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$de = '';
$para = @@frm_vendedor_email;
$cc =  @@tri_jefe_email;
$bcc='';

if (@@frm_accion == 'RECHAZADO'){
	$asunto = 'Solicitud pagador rechazada'; 
	$mensaje = 'Esta solicitud ha sido RECHAZADA por el Director Comercial. El caso se cerrará automáticamente';
}
if (@@frm_accion == 'APROBADO'){
	$asunto = 'Solicitud pagador aprobado'; 
	$mensaje = 'Esta solicitud ha sido APROBADA por el Director Comercial. Puede continuar el proceso';
}


$plantilla_rec = 'rechazo_equifax.html';

@@envio_mail_rechazo_rcs2 = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_mensaje' => $mensaje));
