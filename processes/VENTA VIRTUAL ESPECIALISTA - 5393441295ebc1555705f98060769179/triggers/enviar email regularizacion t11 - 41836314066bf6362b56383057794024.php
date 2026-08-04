<?php

$cnx = '1479570925ec29f1d8d1d57019959618';
/* Recupera destinatarios de correo */
$desBCC = '';

$sql_correo = "SELECT *
FROM ADMIN_CATALOGOS WHERE
PRO_UID = 'GENERICO' 
AND INTEGRACION = '5393441295ebc1555705f98060769179'
AND DESCRIPCION = 'enviar email regulacion t11'
";

$rs_correo = executeQuery($sql_correo, $cnx);
$desBCC = $rs_correo[1]['CAMPO1'];

$de = '';
$para = @@tri_jefe_email;
//$bcc = 'se_mlopez@segurosequinoccial.com, pmartinez@segurosequinoccial.com';
$bcc = $desBCC;
$asunto = 'Caso BPM: '.@#APP_NUMBER.' Regularizado';
$plantilla_rec = 'Notificacion_manual.html';

if (@@frm_accion === 'CONTINUAR'){
    if (@@entradaT10 > 1){
        $html_decision_notificacion = '<br>El Caso BPM: '.@#APP_NUMBER.' del cliente '.@#frm_nombres_completos.' ha sido regularizado.';
        @@html_decision_notificacion = $html_decision_notificacion;    
        @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());            
    }
}
