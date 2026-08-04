<?php
//ENVIO DE EMAIL  @@tri_ruta_aprobacion== 'PENDIENTE' && @@tri_contador_rcs2  > 0 &&
//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$de = '';
$para = @@frm_vendedor_email;
$cc =  @@tri_jefe_email;
$bcc= '';
$asunto = 'Caso aprobado RCS'; 

$plantilla_rec = 'aprobado_rcs2.html';

@@envio_mail_aprobacion_rcs2 = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => @@texto_rcs));
