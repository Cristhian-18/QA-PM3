<?php
$doc_id = "1465807915ecc74912c13c2030426904";
$case_id = @@APPLICATION;
$result  = PMFGenerateOutputDocument($doc_id, '', '', '');


$query = "SELECT AD.APP_DOC_UID AS FILE_ID, AD.APP_DOC_FILENAME AS FILENAME, AD.APP_DOC_CREATE_DATE AS FECHA ,AD.DOC_VERSION AS VERSION
   FROM APP_DOCUMENT AD
   WHERE AD.APP_UID='$case_id' AND AD.DOC_UID='$doc_id'
   ORDER BY AD.DOC_VERSION DESC";
$result = executeQuery($query);


if (!is_array($result)) {
   die("Error: Unable to find Output Document file for case $case_id.");
}

$fileId = $result[1]['FILE_ID'];
$filename = $result[1]['FILENAME'];
$version = $result[1]['VERSION'];
@@link_covid_fecha = $result[1]['FECHA'];
$server = @@URL_SERVER_SQL;

@@dana_link_covid = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
@@link_covid_id = "cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
$case_id = @@APP_NUMBER;
@@dana_link_covid = "$server/syscertificacion/es/3sesa/beesmartec/services/poliza_especialista/magnun_go/magnun3.php?case=" . $case_id;
@@link_covid_id = "beesmartec/services/poliza_especialista/magnun_go/magnun3.php?case=" . $case_id;

@@link_desicion_id = "$server/syscertificacion/es/3sesa/beesmartec/services/poliza_especialista/magnun_go/magnun2.php?case=" . $case_id;

@@link_bootstrap_id = "$server/syscertificacion/es/3sesa/beesmartec/services/poliza_especialista/magnun_go/magnun4.php?case=" . $case_id;
