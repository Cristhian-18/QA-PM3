<?php
try{
    $texto = 'CARTA DE NEGATIVA';
    $caseId = @@APPLICATION;

    //ENVIO DE EMAIL
    $de = '';
    //$de = 'Seguros Equinoccial Venta Virtual<infoequivida@segurosequinoccial.com>';
    //$para = @@tri_user_sac_mail;
    //$para = @@tri_user_sac_mail.",".@@frm_negativa_email_1.",".@@frm_negativa_email_2.",".@@frm_negativa_email_3;
    //$para = @@frm_asegurado_mail;
    //$cc = 'victor.cortez@beesmart.ec';
    $cc = @@tri_user_sac_mail;
    //$bcc= 'dalulema@segurosequinoccial.com';
    $bcc = @@tri_user_auditor_mail.",".@@tri_user_pda_negativa_mail;
    //$bcc= 'mlopez@vimeworks.com';
    $asunto = "RESOLUCIÓN DEL CASO: ".@#APP_NUMBER;
    $plantilla_rec = 'carta_negativa.html';

    //18484817666f37ab6010a66053054153 : documento de entrada Documento Negativa Aprobada, si es true en el SQL entonces se envia este Doc, si no se manda el siguiente código:
    //Este, este o este
    $emailsDirigidos = array(
        @@frm_negativa_email_1 => @@frm_negativa_dirigido_1,
        @@frm_negativa_email_2 => @@frm_negativa_dirigido_2,
        @@frm_negativa_email_3 => @@frm_negativa_dirigido_3
    );

    $host = @@URL_SERVER_SQL;


    if (isset(@=frm_documento_NegativaAprobada) and !empty(@=frm_documento_NegativaAprobada)) {
        $inputDocId = '18484817666f37ab6010a66053054153'; //set to Input Document ID
        $caseId = @@APPLICATION;
        //find the UID and version for the uploaded Input Document file(s):
        $query = "SELECT APP_DOC_UID, DOC_VERSION FROM APP_DOCUMENT
        WHERE APP_UID='$caseId' AND DOC_UID='$inputDocId' AND
        APP_DOC_STATUS='ACTIVE' ORDER BY APP_DOC_INDEX";
        $aFiles = executeQuery($query);
        $docUID = $aFiles['1']['APP_DOC_UID'];
        $v= $aFiles['1']['DOC_VERSION'];

        //Creo link de archivo
        $server = "$host/sys".@@SYS_SYS."/".@@SYS_LANG."/".@@SYS_SKIN."/cases/cases_ShowDocument?a=".$docUID."&v=".$v;
        //Crear enlace publico
        @@link_doc_negativa_output = $server;

        //@@negativa_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec);
    }else{
        //consulto ultimo archivo insertado
        $outputUID = '555155095624e041abfbdd9056360623';
        $sql ="SELECT
        MAX(DOC_VERSION) AS MAX_VERSION, APP_DOC_UID
        FROM
        APP_DOCUMENT where APP_UID = '$caseId'
        and APP_DOC_TYPE = 'OUTPUT' and DOC_UID = '$outputUID'";
        $res = executeQuery($sql);
        $docUID = $res['1']['APP_DOC_UID'];
        $v= $res['1']['MAX_VERSION'];


        //Creo link de archivo
        $server = "$host/syscertificacion/es/".@@SYS_SKIN."/cases/cases_ShowOutputDocument?a=".$docUID."&v=".$v."&ext=pdf";
        //Crear enlace publico
        @@link_doc_negativa_output = $server;

        //@@negativa_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec);
        // Crear un arreglo con las tres variables
        //$dirigidos = array(@@frm_negativa_email_1, @@frm_negativa_email_2, @@frm_negativa_email_3);


    }

    foreach ($emailsDirigidos as $email => $dirigido) {
        // Aquí puedes definir las demás variables necesarias para PMFSendMessage
        $paraUno = $email;           // Enviar el correo a la dirección del arreglo
        //$paraUno = 'victor.cortez@beesmart.ec';
        // Enviar el correo
        @@frm_negativa_dirigido = $dirigido;
        //echo(@@frm_negativa_dirigido);
        @@negativa_mail = PMFSendMessage(@@APPLICATION, $de, $paraUno, $cc, $bcc, $asunto, $plantilla_rec);

    }


} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}

