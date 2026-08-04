<?php
//ENVIO DE EMAIL @@tri_ruta_aprobacion== 'RECHAZADO' &&

//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$de = '';
$para = @@frm_vendedor_email;
$cc =  @@tri_jefe_email;
$bcc='';
$asunto = 'Solicitud NO aprobado'; 

$plantilla_rec = 'rechazo_RCS2.html';

@@envio_mail_rechazo_rcs2 = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => @@texto_rcs));
