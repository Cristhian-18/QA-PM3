<?php

$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;

$de = '';
$para = @@frm_vendedor_email;
$cc =  @@tri_jefe_email;
$bcc= '';
$asunto = 'Decisión de caso en Magnum - '.@#APP_NUMBER; 

$plantilla_rec = 'respuesta_magnum.html';

//|| @@tri_decision_magnum_result == "REFER"

if(@@tri_decision_magnum_result === 'DECLINE' || @@tri_decision_magnum_result === 'POSTPONE'  || (@@tri_decision_magnum_result === 'ACCEPT' && strpos(strtoupper(@@html_decision_magnum), 'EXTRAPRIMA') !== false) ){
	@@envio_mail_ejec = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array());
	@@correoEnviadoDesicionMagnum = 'SI';
}

