<?php
//$doc_id_r = "180007123607708f73cd439014142241";//Autorizacion de debito
$case_id=@@APPLICATION;

$host = @@URL_SERVER_SQL;


$query = "SELECT
APP_DOC_CREATE_DATE AS FECHA,
APP_DOC_FILENAME AS FILENAME,
'ACTUALIZACIÓN DE DATOS' AS COMENTARIO,
USR_UID,
DOC_UID,
APP_DOC_UID,
DOC_VERSION
FROM
APP_DOCUMENT
WHERE APP_UID = '$case_id'
AND APP_DOC_TYPE='OUTPUT'";

//input document
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
$query_i = "SELECT APP_DOC_UID, APP_DOC_CREATE_DATE AS FECHA, USR_UID, APP_DOC_COMMENT AS COMENTARIO, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, APP_DOC_FIELDNAME
FROM APP_DOCUMENT
WHERE APP_UID='$case_id'
AND APP_DOC_TYPE = 'INPUT' AND APP_DOC_STATUS = 'ACTIVE'
ORDER BY DOC_VERSION DESC";
$inDoc = executeQuery($query_i);

$result = executeQuery($query);

echo 'aqui 9';

if (empty($result) or count($result) == 0) {
    die("Error: Unable to find Output Document file for case $case_id.");
}

$arr_docs = array();
$con = 1;


foreach($result as $datadoc){
    $fileId = $datadoc['APP_DOC_UID'];
    $version = $datadoc['DOC_VERSION'];
    $arr_docs[$con]['gridDocumentos_Fecha'] = $datadoc['FECHA'];
    $arr_docs[$con]['gridDocumentos_Archivo'] = $datadoc['FILENAME'];
    $arr_docs[$con]['gridDocumentos_Comentario'] = $datadoc['COMENTARIO'];
    $arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($datadoc['USR_UID']);
    $arr_docs[$con]['gridDocumentos_Descarga'] = "$host/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
    $con++;
}

foreach($inDoc as $dataind){
    $fileId = $dataind['APP_DOC_UID'];
    $version = $dataind['DOC_VERSION'];
    $arr_docs[$con]['gridDocumentos_Fecha'] = $dataind['FECHA'];
    $arr_docs[$con]['gridDocumentos_Archivo'] = $dataind['FILENAME'];
    $arr_docs[$con]['gridDocumentos_Comentario'] = $dataind['COMENTARIO'];
    $arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($dataind['USR_UID']);
    $arr_docs[$con]['gridDocumentos_Descarga'] = "$host/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId";
    $con++;
}

@=gridDocumentos = $arr_docs;
