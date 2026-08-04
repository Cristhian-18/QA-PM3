<?php
$sqlCorreos = "SELECT  ac.CAMPO2 FROM   ADMIN_CATALOGOS ac WHERE ac.COD_CATALOGO = 'COPIAS_MAIL' AND ac.INTEGRACION = '14652515365657ee7658e29077575487'
AND ac.DESCRIPCION ='Validar_Creacion_de_Siniestro_Web' LIMIT 1";

$resultadoCorreos = executeQuery($sqlCorreos);


//ENVIO DE EMAIL
$texto = 'Creación de reserva de SINIESTRO';
$de = '';
$para = 'hbautista@segurosequinoccial.com';
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
