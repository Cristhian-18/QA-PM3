<?php
//copy process venta virtual
//Henry Bautista

try {
    $doc_id_r = "49334809561f2952b885af3088578354"; //solicitud
    $case_id = @@APPLICATION;
    PMFGenerateOutputDocument($doc_id_r, '', '', '');

    $host = @@URL_SERVER_SQL;

    $query = "SELECT
    DOC_UID,
    APP_DOC_UID,
    APP_DOC_FILENAME AS FILENAME,
    DOC_VERSION
    FROM
    APP_DOCUMENT
    WHERE APP_UID = '$case_id'
    AND APP_DOC_TYPE='OUTPUT'";
    $result = executeQuery($query);
    if (empty($result) or count($result) == 0) {
        die("Error: Unable to find Output Document file for case $case_id.");
    }

    foreach ($result as $datadoc) {
        $fileId = $datadoc['APP_DOC_UID'];
        $version = $datadoc['DOC_VERSION'];
        @@link_doc_audt = "$host/syscertificacion/es/" . @@SYS_SKIN . "/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
    }
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
