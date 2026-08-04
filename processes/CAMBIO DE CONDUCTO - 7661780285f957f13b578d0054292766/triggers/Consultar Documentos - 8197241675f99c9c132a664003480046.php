<?php
$doc_id_r = "9239613075f95835b4ad833039477595";//Autorizacion de debito
$doc_id_r1 = "9505028456005bd19bc07e7093291487";
$case_id=@@APPLICATION;

$query = "SELECT
APP_DOC_CREATE_DATE AS FECHA,
APP_DOC_FILENAME AS FILENAME,
'AUTORIZACION DE DEBITO' AS COMENTARIO,
USR_UID,
DOC_UID,
APP_DOC_UID,
DOC_VERSION
FROM
APP_DOCUMENT
WHERE APP_UID = '$case_id'
AND DOC_UID in ('$doc_id_r', '$doc_id_r1')
AND APP_DOC_TYPE='OUTPUT'";

$result = executeQuery($query);
if (empty($result) || !is_array($result) || count($result) == 0) {
    die("Error: Unable to find Output Document file for case $case_id.");
}

$arr_docs = array();
$con = 1;
foreach($result as $datadoc){
    if($datadoc['DOC_UID'] == $doc_id_r){
        $fileId = $datadoc['APP_DOC_UID'];
        $version = $datadoc['DOC_VERSION'];
        $arr_docs[$con]['gridDocumentos_Fecha'] = $datadoc['FECHA'];
        $arr_docs[$con]['gridDocumentos_Archivo'] = $datadoc['FILENAME'];
        $arr_docs[$con]['gridDocumentos_Comentario'] = $datadoc['COMENTARIO'];
        $arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($datadoc['USR_UID']);
        $arr_docs[$con]['gridDocumentos_Descarga'] = "/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
        $con++;
    }
}

@=gridDocumentos = $arr_docs;

//para los inputs
foreach(@=frm_copia_ci as $dataci){
    $appuid_doc = $dataci['appDocUid'];
    @@urlcedula = "/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$appuid_doc&v=1&p=1";
}

foreach(@=frm_doc_cta as $datacta){
    $appuid_doccta = $datacta['appDocUid'];
    @@urldoc = "/syscertificacion/es/3sesa/cases/cases_ShowDocument?a={$appuid_doccta}&v=1&p=1";
}
