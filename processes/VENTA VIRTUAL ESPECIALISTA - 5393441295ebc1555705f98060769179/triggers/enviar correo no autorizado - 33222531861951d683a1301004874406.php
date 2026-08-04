<?php
$texto = '';
//ENVIO DE EMAIL
	
$de = '';
$para = @@frm_vendedor_email;
$cc = '';
$bcc='';
$asunto = 'Rechazo autorizacion de debito'; 

$plantilla_rec = 'rechazopago.html';
                             
@@envio_mail_no_pago = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => $texto));
