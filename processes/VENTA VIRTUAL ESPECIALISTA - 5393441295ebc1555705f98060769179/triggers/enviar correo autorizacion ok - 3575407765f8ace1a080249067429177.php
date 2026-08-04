<?php
$texto = '';
//ENVIO DE EMAIL
	
$de = '';
$para = @@frm_vendedor_email;
$cc = '';
$bcc='';
$asunto = 'Aprobación de autorización de débito'; 

$plantilla_rec = 'autorizaciondebito_ok.html';
                             
@@envio_mail_autorizacion_ok = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => $texto));
