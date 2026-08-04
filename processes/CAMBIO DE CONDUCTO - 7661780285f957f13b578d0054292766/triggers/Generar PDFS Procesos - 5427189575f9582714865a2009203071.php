<?php
//copy process venta virtual
//Henry Bautista

if (@@frm_ramo == '60') {
    $doc_id_r = "9505028456005bd19bc07e7093291487"; // Autorizacion de debito global
} else {
    $doc_id_r = "9239613075f95835b4ad833039477595"; // Autorizacion de debito especialista
}

$case_id = @@APPLICATION;

$casedoc = PMFGenerateOutputDocument($doc_id_r, $case_id, '', '');

$query = "SELECT
DOC_UID,
APP_DOC_UID,
APP_DOC_FILENAME AS FILENAME,
DOC_VERSION
FROM APP_DOCUMENT
WHERE APP_UID = '$case_id'
AND APP_DOC_TYPE = 'OUTPUT'";

$result = executeQuery($query);

if (empty($result) || !is_array($result) || count($result) == 0) {
    die("Error: Unable to find Output Document file for case $case_id.");
}

foreach ($result as $datadoc) {
    if ($datadoc['DOC_UID'] == $doc_id_r) {
        $fileId = $datadoc['APP_DOC_UID'];
        $version = $datadoc['DOC_VERSION'];

        @@link_dana_dbito = "/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
    }
}
