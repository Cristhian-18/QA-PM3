<?php
//ENVIO DE EMAIL @@tri_ruta_aprobacion== 'PENDIENTE' && @@tri_contador_rcs2  > 2 &&

//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$de = '';
$para = @@tri_email_cumplimiento;
$cc =  @@frm_vendedor_email.','.@@tri_jefe_email;
$bcc='';
$asunto = 'Caso vencido RCS 2'; 

$plantilla_rec = 'pendiente_rcs2.html';

@@envio_mail_pendiente_rcs2 = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => @@texto_rcs));
