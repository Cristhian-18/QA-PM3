<?php
//Enviar correo inusual cambio

$accion = @@frm_accion;

if ($accion == 'CONTINUAR') {

    $app_number = @@APP_NUMBER;
    $correos = @@tri_correos_enviar;
    $de = '';
    $para = $correos;
    //$para = @@tri_correo_desarrollador_cc;
    $cc = '';
    $bcc = @@tri_correo_desarrollador_bcc;
    $asunto = "Notificación de carga de documentos caso BPM " . $app_number;
    $texto = '';
    $comentario = '';
    $plantilla_rec = 'Mail_alerta_docs.html';
    $message = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' => $texto));

    @@bandera_correo_enviado_docs = 1;
}
