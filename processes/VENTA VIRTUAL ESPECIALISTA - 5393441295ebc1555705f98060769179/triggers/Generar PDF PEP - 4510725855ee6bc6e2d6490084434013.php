<?php
$doc_id = "confirmar";
$case_id = @@APPLICATION;
PMFGenerateOutputDocument($doc_id, '', '', '');
$query = "SELECT AD.APP_DOC_UID AS FILE_ID, C.CON_VALUE AS FILENAME, AD.DOC_VERSION AS VERSION
   FROM APP_DOCUMENT AD, CONTENT C
   WHERE AD.APP_UID='$case_id' AND AD.DOC_UID='$doc_id' AND AD.APP_DOC_UID=C.CON_ID AND
   C.CON_CATEGORY='APP_DOC_FILENAME' AND AD.DOC_VERSION=C.CON_PARENT
   ORDER BY AD.DOC_VERSION DESC";
$result = executeQuery($query);
if (!is_array($result) or count($result) == 0) {
   die("Error: Unable to find Output Document file for case $case_id.");
}

$fileId = $result[1]['FILE_ID'];
$filename = $result[1]['FILENAME'];
$version = $result[1]['VERSION'];
$server = @@URL_SERVER_SQL;

@@dana_link_pep = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
