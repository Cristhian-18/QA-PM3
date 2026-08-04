<?php

$de = '';
$para = @@tri_jefe_email;
$bcc = '';
$asunto = 'Caso BPM: '.@#APP_NUMBER.' Regularizado';
$plantilla_rec = 'Notificacion_manual.html';


if(@@rutat7 === 'SUSCRIPCION_MANUAL'){
    if (@@entradaT10 > 1){
        $html_decision_notificacion = '<br>El Caso BPM: '.@#APP_NUMBER.' del cliente '.@#frm_nombres_completos.' ha sido regularizado.';
        @@html_decision_notificacion = $html_decision_notificacion;    
        @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());            
    }
}