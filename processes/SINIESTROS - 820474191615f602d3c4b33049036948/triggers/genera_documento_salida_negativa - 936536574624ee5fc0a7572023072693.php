<?php
try{
    $outputUID = '555155095624e041abfbdd9056360623'; //ID documento de salida "carta_negativa";
    //carta_negativa_2  89592389462588bff5884c6085554259
    $application = @@APPLICATION;
    $delIndex = @@INDEX;
    $userUID = @@USER_LOGGED;
    /*EJEMPLO DE PMFGenerateOutputDocument
    PMFGenerateOutputDocument ( string outputUID, string caseUID = null, integer delIndex = null, string userUID = null)
    */

    $generaOutDoc = PMFGenerateOutputDocument($outputUID, $application, $delIndex, $userUID);

    /*
    //Variables para enviar en el correo

    $de = 'NOTIFICACIONES BPM EQUISUIZA - SINIESTROS';
    $para = 'isaac@corporaciondfl.com';
    $cc = 'isaac@corporaciondfl.com';
    $bcc='';
    $asunto = "CARTA DE NEGATIVA";
    $plantilla_rec = 'carta_negativa.html';


    $query = "SELECT MAX(DOC_VERSION) AS MAX_VERSION, APP_DOC_UID FROM APP_DOCUMENT
    WHERE APP_UID = '$application' AND DOC_UID='$outputUID'";
    $result = executeQuery($query);
    $g = new G();
    if (is_array($result) and count($result) > 0) {
        $pathFilename = PATH_DOCUMENT . $g->getPathFromUID(@@APPLICATION) . PATH_SEP . 'outdocs'. PATH_SEP .
        $result[1]['APP_DOC_UID'] . '_' . $result[1]['MAX_VERSION'] . '.html';
        $body = file_get_contents($pathFilename);
        PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec);

        //original
        //PMFSendMessage(@@APPLICATION, 'theboss@example.com', userInfo(@@USER_LOGGED)['mail'], '', '',
        //'Generated Output Document', 'outDocMail.html', array('mailBody' => $body));

    }
    */
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

}
