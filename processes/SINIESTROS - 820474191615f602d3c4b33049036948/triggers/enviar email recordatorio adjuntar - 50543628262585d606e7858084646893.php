<?php
/*
ESTE TRIGGER SE EJECUTA DESPUES DEL ROMBO....
ACCIONES: ENVIA MENSAJE AL CLIENTE Y SE PAUSA EN LA MISMA TAREA "cliente adjuntar documentos"
*/
try{
    $caseId = @@APPLICATION;

    //Declaro variables para enviar mail
    $de = '';
    //$de = 'Seguros Equinoccial Venta Virtual<infoequivida@segurosequinoccial.com>';
    //$para = 'isaac@corporaciondfl.com';
    $para = @@frm_asegurado_mail;
    $cc = @@tri_user_sac_mail;
    $bcc = '';


    $asunto = "RECORDATORIO DOCUMENTOS ADJUNTOS";
    $plantilla_rec = 'intento_adjunta_documento.html';

    $contador = @@contador_alternativa_mail;
    @@tmp_contador =$contador;

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
        $path = PATH_DOCUMENT . $g->getPathFromUID($application) . PATH_SEP . 'outdocs'. PATH_SEP .
        $outDoc[1]['APP_DOC_UID'] . '_' . $outDoc[1]['DOC_VERSION'];
        $filename = $outDoc[1]['FILENAME'];
        $aAttachFiles[$filename . '.pdf'] = $path . '.pdf';  //remove if not generating a PDF file
    }

    if($contador > 3){
        //$plantilla_rechazada = "documento_adjunta_sin_respuesta.html";
        //@@siniestro_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rechazada);
    }else{
        @@siniestro_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array(), $aAttachFiles);
    }

    $contador = $contador + 1;
    @@contador_alternativa_mail = $contador;
    /*
    @@siniestro_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec);
    $contador = $contador + 1;
    @@contador_alternativa_mail = $contador;
    */

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
