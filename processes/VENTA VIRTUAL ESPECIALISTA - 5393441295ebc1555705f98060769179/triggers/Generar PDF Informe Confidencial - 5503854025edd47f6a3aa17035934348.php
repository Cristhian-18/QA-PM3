<?php
$doc_id = "6876503365f9a3bdb1e03a3065992251";
$case_id = @@APPLICATION;
$server = @@URL_SERVER_SQL;

PMFGenerateOutputDocument($doc_id, '', '', '');
$query = "SELECT   AD.`APP_DOC_CREATE_DATE`,
  AD.APP_DOC_UID AS FILE_ID,
  AD.APP_DOC_FILENAME FILENAME,
  AD.DOC_VERSION AS VERSION
   FROM APP_DOCUMENT AD
   WHERE AD.APP_UID='$case_id' AND AD.DOC_UID='$doc_id'
   ORDER BY AD.DOC_VERSION DESC";
$result = executeQuery($query);
if (!is_array($result) or count($result) == 0) {
   die("Error: Unable to find Output Document file for case $case_id.");
}

$fileId = $result[1]['FILE_ID'];
$filename = $result[1]['FILENAME'];
$version = $result[1]['VERSION'];
@@link_informe_fecha = $result[1]['APP_DOC_CREATE_DATE'];

$rand = rand(0, 9999999999);
$nocache = rand(0, 9999999999);

@@dana_link_informe_confidencial = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
@@frm_control_informe = 'Completado';
