<?php
$texto = '';
//ENVIO DE EMAIL
	
$de = '';
$para = @@frm_vendedor_email;
$cc = '';
$bcc='';
$asunto = 'Pago no realizado'; 

$plantilla_rec = 'pagonorealizado.html';
                             
@@envio_mail_no_pago = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => $texto));
