<?php
//Enviar mail de Creacion de Siniestro
$sqlCorreos = "SELECT  ac.CAMPO2 FROM  certificacion.ADMIN_CATALOGOS ac WHERE ac.COD_CATALOGO = 'COPIAS_MAIL' AND ac.INTEGRACION = '35087580064a18c9776b638006106795'
AND ac.DESCRIPCION ='Validar_Creacion_de_Siniestro_Web' LIMIT 1";

$resultadoCorreos = executeQuery($sqlCorreos);

//ENVIO DE EMAIL
$texto = 'Creación de reserva de SINIESTRO';
$de = '';
$para = '';
$cc = $resultadoCorreos[1]['CAMPO2'];
$bcc='';
$asunto = "Creación de siniestro de SINIESTRO ". @#APP_NUMBER;

if(@@frm_documentos_check == 'SI' && @@frm_accion == 'CONTINUAR')
{
	@@frm_accion_web = 'CONTINUAR';
	$plantilla_rec = 'Creacion_siniestro.html';
	@@envio_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => $texto));
}else{
	@@frm_accion_web = 'NOTIFICAR';
	$plantilla_rec = 'Creacion_siniestro_docs.html';
	@@envio_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => $texto));

}
