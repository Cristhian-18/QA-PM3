<?php
@@envio_mail_rcs_pendiente = '';
//ENVIO DE EMAIL

//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$de = '';
$para = @@tri_jefe_email;
$cc =  @@frm_vendedor_email.','.@@tri_email_cumplimiento;
//
//$para = $cc = '';

$bcc='info@corporaciondfl.com';
$asunto = 'PENDIENTE RCS'; 

$plantilla_rec = 'rcs1_pendiente.html';

@@envio_mail_rcs_pendiente = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => @@tri_mensaje));

@@tri_rcs_label = 'PENDIENTE RCS';