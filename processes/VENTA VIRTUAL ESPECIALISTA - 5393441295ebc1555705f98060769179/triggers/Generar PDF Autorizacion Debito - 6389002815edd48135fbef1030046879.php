<?php
$doc_id = "2243400975ec74080523606085555297";
$case_id = @@APPLICATION;
PMFGenerateOutputDocument($doc_id, $case_id, '', '');


$query = "SELECT AD.APP_DOC_UID AS FILE_ID, AD.APP_DOC_FILENAME AS FILENAME, AD.APP_DOC_CREATE_DATE AS FECHA ,AD.DOC_VERSION AS VERSION
   FROM APP_DOCUMENT AD  WHERE AD.APP_UID='$case_id' AND AD.DOC_UID='$doc_id'
   ORDER BY AD.DOC_VERSION DESC";
$result = executeQuery($query);
if (!is_array($result) or count($result) == 0) {
   die("Error: Unable to find Output Document file for case $case_id.");
}

$fileId = $result[1]['FILE_ID'];
$filename = $result[1]['FILENAME'];
$version = $result[1]['VERSION'];
$server = @@URL_SERVER_SQL;


$rand = rand(0, 9999999999);
$nocache = rand(0, 9999999999);

@@link_autorizacion_fecha = $result[1]['FECHA'];

@@dana_link_autorizacion = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
@@id_proceso_version = $case_id . $version;

@@link_autorizacion_id = "cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";


echo @@dana_link_autorizacion;
echo @@link_autorizacion_id;
