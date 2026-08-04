<?php
try {
   /*
ESTE TRIGGER SE EJECUTA DESPUES DEL ROMBO....
ACCIONES: ENVIA MENSAJE AL CLIENTE Y SE PAUSA EN LA MISMA TAREA "cliente adjuntar documentos"
*/

   $caseId = @@APPLICATION;

   //Declaro variables para enviar mail
   //$de = 'Seguros Equinoccial Venta Virtual<infoequivida@segurosequinoccial.com>';
   $de = '';
   //$para = 'isaac@corporaciondfl.com';
   //$cc = 'isaac@corporaciondfl.com';
   $para = @@frm_asegurado_mail;
   $cc = @@tri_user_sac_mail;
   $bcc = @@frm_asegurado_mail_1;

   $asunto = "SIN RESPUESTA DOCUMENTOS ADJUNTOS";
   $plantilla_rec = 'documento_adjunta_sin_respuesta.html';

   //consulto el doc para enviar
   $outputUID = '288996193625f705922b301060222767';
   $application = @@APPLICATION;
   $delIndex = @@INDEX;
   $userUID = @@USER_LOGGED;

   $outDocQuery = "SELECT MAX(DOC_VERSION), APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$application' AND DOC_UID='$outputUID'
                AND APP_DOC_TYPE = 'OUTPUT' AND APP_DOC_STATUS = 'ACTIVE'";

   $outDoc = executeQuery($outDocQuery);

   if (!empty($outDoc)) {
      $g = new G();
      $path = PATH_DOCUMENT . $g->getPathFromUID($application) . PATH_SEP . 'outdocs' . PATH_SEP .
         $outDoc[1]['APP_DOC_UID'] . '_' . $outDoc[1]['DOC_VERSION'];
      $filename = $outDoc[1]['FILENAME'];
      $aAttachFiles[$filename . '.pdf'] = $path . '.pdf';  //remove if not generating a PDF file
   }

   @@siniestro_mail = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array(), $aAttachFiles);
} catch (Exception $e) {

   $errorMessage =  $e->getMessage();
}
