<?php
@@envio_mail_rcs_pendiente = '';
//ENVIO DE EMAIL

//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$de = '';
$cc = @@tri_jefe_email;
$para =  @@frm_vendedor_email;

//$para = $cc = 'info@corporaciondfl.com';

$bcc='';
$asunto = 'Pendiente Aprobación Pagador'; 

$plantilla_rec = 'rcs1_pendiente.html';

@@envio_mail_eqfx_pendiente = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => @@tri_mensaje));
