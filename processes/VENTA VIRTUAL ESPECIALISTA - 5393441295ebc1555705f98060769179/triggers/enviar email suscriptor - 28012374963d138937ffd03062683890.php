<?php
 
$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
/*OBTENER mail del catalogo
$sql = "SELECT CODIGO, DESCRIPCION, VALOR FROM ADMIN_CATALOGOS
WHERE 
CODIGO = 'MAIL_SUSCRIPTOR'
AND ESTADO = 1
AND PRO_UID = '$pro_uid'";
$rs  = executeQuery($sql, $cnx);*/

/* Recupera destinatarios de correo */
$desPARA = '';
$desCC = '';
$desBCC = '';

$sql_correo = "SELECT *
FROM ADMIN_CATALOGOS WHERE
PRO_UID = 'GENERICO' 
AND INTEGRACION = '5393441295ebc1555705f98060769179'
AND DESCRIPCION = 'enviar email suscriptor'
";

$rs_correo = executeQuery($sql_correo, $cnx);
$desPARA = $rs_correo[1]['VALOR'];

$de = '';
//$para = $rs['1']['DESCRIPCION'];
//$para = 'pmartinez@segurosequinoccial.com';
$para = $desPARA;
$cc =  '';
$bcc = '';
$asunto = 'Información de caso en Magnum No -' .@#APP_NUMBER; 

$plantilla_rec = 'Notificacion_suscriptor.html';
if (@@correoInformacionEnviado == 'NO') {
	@@envio_mail_suscriptor = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
	@@correoInformacionEnviado = 'SI';
}
 