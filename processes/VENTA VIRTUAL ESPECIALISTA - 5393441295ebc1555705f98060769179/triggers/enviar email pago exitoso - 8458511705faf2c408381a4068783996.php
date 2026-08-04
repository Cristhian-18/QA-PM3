<?php
$texto = '';
//ENVIO DE EMAIL

//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$de = '';
if (@@frm_pago_terceros == 'S'){
	$para = @@correo_preferido.','.@@frm_correo_electronico_debito;
}
else
{
	$para = @@correo_preferido;
}
$cc = @@frm_vendedor_email;
@@tmp_cc = $cc;
//$cc = @@correo_preferido;
$bcc='';
$asunto = 'Pago realizado'; 

$plantilla_rec = 'pago_realizado.html';

@@envio_mail_pago_exitoso = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => $texto));
