<?php
@@link_cotizacion_fecha = "";
@@dana_link_cotizacion = "";
@@link_cotizacion_id = "";
$doc_id = "8389951105f64019a92d566080540293";
$case_id = @@APPLICATION;

//$query = "SELECT AD.APP_DOC_UID AS FILE_ID, AD.APP_DOC_FILENAME AS FILENAME, AD.APP_DOC_CREATE_DATE AS FECHA ,AD.DOC_VERSION AS VERSION FROM APP_DOCUMENT AD  WHERE AD.APP_UID='$case_id' AND AD.DOC_UID='$doc_id'  ORDER BY AD.DOC_VERSION DESC ";

$query = "SELECT AD.APP_DOC_UID AS FILE_ID, AD.APP_DOC_FILENAME AS FILENAME, AD.APP_DOC_CREATE_DATE AS FECHA ,AD.DOC_VERSION AS VERSION
FROM
  certificacion.APP_DOCUMENT AD
WHERE AD.APP_UID = '$case_id'
  AND APP_DOC_FIELDNAME = 'file_cotizacion'
  AND APP_DOC_TYPE = 'ATTACHED'
  AND APP_DOC_STATUS = 'ACTIVE'
ORDER BY AD.APP_DOC_CREATE_DATE DESC";

$result = executeQuery($query);
@@tmp_cotizacion = $query;
if (!is_array($result)) {
	//die("Error: no encontramos cotizacion adjunta $case_id.");
	@@link_cotizacion_fecha = "";
	@@dana_link_cotizacion = "";
	@@link_cotizacion_id = "";
} else {

	$fileId = $result[1]['FILE_ID'];
	$filename = $result[1]['FILENAME'];
	$version = $result[1]['VERSION'];
	$server = @@URL_SERVER_SQL;


	@@link_cotizacion_fecha = $result[1]['FECHA'];

	@@dana_link_cotizacion = "$server/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId&v=$version&p=1";

	@@link_cotizacion_id = "cases/cases_ShowDocument?a=$fileId&v=$version&p=1";
}
