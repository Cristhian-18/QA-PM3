<?php

$de = '';
$para = @@frm_poliza_emial_vendedor;
$bcc = '';
$plantilla_rec = 'Notificacion_manual.html';

if (@@frm_aps_codigo_tipoAgente == '3') {
    $cc =  '';
}else{
    $cc =  @@frm_poliza_emial_broker;  
}

if(@@frm_accion == 'PAGAR'){
    $asunto = 'Notificación Asignacion Pago Caso BPM: '.@#APP_NUMBER.' '.@#frm_nombres_completos;
    $html_decision_notificacion = 'Gracias por sus respuestas, se procede con la emisión de la póliza';
    @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
}
        
    