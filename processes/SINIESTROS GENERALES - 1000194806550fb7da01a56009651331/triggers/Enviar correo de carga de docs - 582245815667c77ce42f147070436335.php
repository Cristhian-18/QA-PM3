<?php
//Enviar correo inusual
$app_number = @@APP_NUMBER;
$correos = @@correos_asegurado_broker;
$de = '';
$para = $correos;
$cc =  @@tri_destinatarios_copias_cc;
$bcc = @@tri_destinatarios_copias_bcc;
$asunto = "Notificación de carga de documentos caso BPM " . $app_number;
$texto = '';
$comentario = '';
$plantilla_rec = 'Mail_alerta_docs.html';
$message = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' => $texto));

@@bandera_correo_enviado_docs = 1;
