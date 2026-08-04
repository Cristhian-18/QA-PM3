<?php
$doc_id = "7496627105ece994927e011097866968";
//nuevo form
$doc_id_fv = '255220557657445a1bda1f1047276130';
$case_id = @@APPLICATION;
PMFGenerateOutputDocument($doc_id, '', '', '');
//f_v
PMFGenerateOutputDocument($doc_id_fv, '', '', '');

$query = "SELECT DOC_UID, AD.APP_DOC_UID AS FILE_ID, AD.APP_DOC_FILENAME AS FILENAME, AD.APP_DOC_CREATE_DATE AS FECHA ,AD.DOC_VERSION AS VERSION
   FROM APP_DOCUMENT AD
   WHERE AD.APP_UID='$case_id' AND AD.DOC_UID IN ('$doc_id', '$doc_id_fv')
   ORDER BY AD.DOC_VERSION DESC";
$result = executeQuery($query);
if (!is_array($result) or count($result) == 0) {
	die("Error: Unable to find Output Document file for case $case_id.");
}

foreach ($result as $data_doc) {
	$rand = rand(0, 9999999999);
	$nocache = rand(0, 9999999999);
	if ($data_doc['DOC_UID'] == '7496627105ece994927e011097866968') {
		$fileId = $data_doc['FILE_ID'];
		$filename = $data_doc['FILENAME'];
		$version = $data_doc['VERSION'];
		$server = @@URL_SERVER_SQL;

		@@dana_link_solicitud = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
		@@id_proceso_version = $case_id . $version;
		@@link_solicitud_id = "cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
		@@link_solicitud_fecha = $result[1]['FECHA'];
	} else {
		$fileId = $data_doc['FILE_ID'];
		$filename = $data_doc['FILENAME'];
		$version = $data_doc['VERSION'];
		$server = @@URL_SERVER_SQL;
		@@dana_link_solicitud_fv = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
		@@dana_link_formulario = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
		@@id_proceso_version_fv = $case_id . $version;
		@@link_solicitud_id_fv = "cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
		@@link_solicitud_fecha_fv = $result[1]['FECHA'];
	}
}
