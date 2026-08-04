<?php
/*
ESTE TRIGGER SE EJECUTA DESPUES DEL ROMBO....
ACCIONES: ENVIA MENSAJE AL CLIENTE SI HA ADJUNTADO DOCUMENTO
*/
try {
    $caseId = @@APPLICATION;

    //Declaro variables para enviar mail
    $de = '';
    //$de = 'Seguros Equinoccial Venta Virtual<infoequivida@segurosequinoccial.com>';
    //$para = 'isaac@corporaciondfl.com';
    $para = @@frm_asegurado_mail;
    $cc = @@tri_user_sac_mail;
    $bcc = '';
    $asunto = "DOCUMENTOS ADJUNTOS RECIBIDOS";
    $plantilla_rec = 'adjunta_documento_recibido.html';
    @@siniestro_mail = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec);
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
