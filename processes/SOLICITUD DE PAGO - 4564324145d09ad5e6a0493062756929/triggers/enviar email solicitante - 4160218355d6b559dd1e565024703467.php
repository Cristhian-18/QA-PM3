<?php
$pda = nomUsuario(@@USER_LOGGED);

//ENVIO DE EMAIL
	
$cnx = '1665078345d09b448804c01043460634';

 /* Recupera destinatarios de correo */
 $desCC = '';
 $desBCC = '';
 
 $sql_correo = "SELECT *
 FROM ADMIN_CATALOGOS WHERE
 PRO_UID = 'GENERICO' 
 AND INTEGRACION = '4564324145d09ad5e6a0493062756929'
 AND DESCRIPCION = 'enviar email solicitante_sp'
 ";

 $rs_correo = executeQuery($sql_correo, $cnx);
 $desCC = $rs_correo[1]['CAMPO1'];
 $desBCC = $rs_correo[1]['CAMPO2'];



$de = '';

$para = @@frm_solicitante_email;

//$cc = 'apaliz@segurosequinoccial.com';
//$bcc='altorres@segurosequinoccial.com,lochoa@segurosequinoccial.com,lpasquel@segurosequinoccial.com'; 
$cc = $desCC;
$bcc = $desBCC;

$asunto = 'Notificación – Solicitud de pago'; 

$plantilla_rec = 'Notificacion_solicitud.html';
                             
@@envio_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('pda' => $pda));