<?php
try{
    $texto = 'SINIESTRO CREADO';

    //ENVIO DE EMAIL

    $de = '';
    //$de = 'Seguros Equinoccial Venta Virtual<infoequivida@segurosequinoccial.com>';

    $para = @@frm_asegurado_mail;
    //$para = 'info@corporaciondfl.com';

    $cc = @@tri_user_sac_mail;
    $bcc=@@frm_asegurado_mail_1;

    // si broker es directos @@frm_broker == 'DIRECTOS . . '
    @@tri_destino_email	 = (substr(@@frm_broker,0,8) == 'DIRECTOS' ? @@frm_contratante : @@frm_broker );

    if(@@frm_accion=='CIERRE'){
        $asunto = "NOTIFICACION CON DOCUMENTOS BÁSICOS COMPLETOS ". @#APP_NUMBER;
        $plantilla_rec = 'Siniestro_creado_web.html';
        @@siniestro_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_destino_email' => @@tri_destino_email));
    }

    if(@@frm_accion=='CIERRE_DOCS'){
        $asunto = "NOTIFICACION CON FALTA DOCUMENTOS ". @#APP_NUMBER;
        $plantilla_rec = 'Siniestro_creado_docs.html';
        @@siniestro_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_destino_email' => @@tri_destino_email));
    }

    if(@@frm_accion=='ESPERAR'){
        $asunto = "SINIESTRO CON FALTA DOCUMENTOS ". @#APP_NUMBER;
        $plantilla_rec = 'Siniestro_creado_docs.html';
        @@siniestro_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_destino_email' => @@tri_destino_email));
    }

    if(@@frm_accion=='CONTINUAR'){
        $asunto = "SINIESTRO CON DOCUMENTOS BÁSICOS COMPLETOS ". @#APP_NUMBER;
        $plantilla_rec = 'Siniestro_creado_web.html';
        @@siniestro_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_destino_email' => @@tri_destino_email));
    }
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
