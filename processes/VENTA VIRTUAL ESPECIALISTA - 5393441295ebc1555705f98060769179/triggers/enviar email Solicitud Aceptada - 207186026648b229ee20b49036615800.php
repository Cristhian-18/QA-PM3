<?php
//ENVIO DE EMAIL  @@tri_ruta_aprobacion== 'PENDIENTE' && @@tri_contador_rcs2  > 0 &&
//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$cnx                   = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$app_uid = @@APPLICATION;
//OBTENER mail del catalogo

$de = '';
$para = @@frm_vendedor_email;
$cc =  @@tri_jefe_email;
$bcc='';
//$bcc= 'ctipan@segurosequinoccial.com';
$asunto = 'Solicitud Aceptada '.@#APP_NUMBER.' '.@#frm_primer_nombre.' '.@#frm_apellido_paterno; 

$plantilla_rec = 'Solicitud_Aceptada.html';

@@envio_mail_emision = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array());
