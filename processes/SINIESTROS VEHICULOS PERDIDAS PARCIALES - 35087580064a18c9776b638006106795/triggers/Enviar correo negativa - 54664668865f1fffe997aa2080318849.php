<?php
//Enviar Mail Aseguradoras
//<?
//$texto = 'SOLICITUD DE APROBACION DE COTIZACIÓN';
$caseId = @@APPLICATION;

//ENVIO DE EMAIL
$de = '';
$para = @@tri_correos_enviar;
$cc = @@tri_destinatarios_copias_cc;
$bcc= @@tri_correo_desarrollador_cc;
//$nombre = @@frm_prospecto_apellidos . ' '. @@frm_prospecto_pnombre;
$app_number = @@APP_NUMBER;
$asunto = "Caso cerrado - $app_number";
$plantilla_rec = 'Caso_negativa.html';

$sql ="SELECT 
		   APP_DOC_UID, APP_DOC_FILENAME 
		FROM
		  APP_DOCUMENT where APP_UID = '$caseId'
							 and APP_DOC_FIELDNAME = 'frm_cartaNegativaLega'";
$res = executeQuery($sql);

$docUID = $res['1']['APP_DOC_UID'];

$caseID = @@APPLICATION;
$niv1 = substr($caseID, 0 , 3);
$niv2 = substr($caseID, 3 , 3);
$niv3 = substr($caseID, 6 , 3);
$niv4 = substr($caseID, 9);

$filename = $res['1']['APP_DOC_FILENAME'];
//get extension of file
$ext = substr($filename, strrpos($filename, '.') + 1);

$doc_logico = '/opt/processmaker/shared/sites/workflow/files'.PATH_SEP .$niv1. PATH_SEP .$niv2. PATH_SEP .$niv3. PATH_SEP .$niv4. PATH_SEP .$docUID.'_1.'.$ext;

$aAttachments = array();
$aAttachments = PMFAddAttachmentToArray($aAttachments, basename($doc_logico), $doc_logico);

@@tri_mail_cli = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array(), $aAttachments);