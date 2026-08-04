<?php
try{

    @@ajx_adjunta = '';
    @@contador_alternativa_mail= 1;
    @@mensajito = '';
    @@frm_comentario_label = @@frm_comentario;

    //ENVIO DE EMAIL
    $de = '';
    //$de = 'Seguros Equinoccial Venta Virtual<infoequivida@segurosequinoccial.com>';
    //$para = 'isaac@corporaciondfl.com';
    //$bcc = 'hbautista@segurosequinoccial.com';

    $para = @@frm_asegurado_mail;
    $cc = @@frm_asegurado_mail_1.",".@@frm_asegurado_mailAdicional;
    $bcc='';
    $asunto = "DOCUMENTOS ADJUNTOS";
    $plantilla_rec = 'adjuntar_documento.html';

    //consulto el doc para enviar
    $outputUID = '288996193625f705922b301060222767';
    $application = @@APPLICATION;
    $delIndex = @@INDEX;
    $userUID = @@USER_LOGGED;
    //print_r(@@chk_docs_faltantes);
    $array = @@chk_docs_faltantes;

    if(in_array(40, $array)){
        $outputUID = '96223436366f4cce893a8d2024359858';
        //echo 'Si esta';
    }else{
        //echo "No esta en el array";
    }


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
    //print_r($outDocQuery);

    @@siniestro_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array(), $aAttachFiles);


} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

}
