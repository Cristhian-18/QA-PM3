<?php
//<?php
//created by Henry
$case_id=@@APPLICATION;
$server = @@URL_SERVER_SQL;


$query = "SELECT
  t1.APP_DOC_CREATE_DATE AS FECHA,
  t1.APP_DOC_FILENAME AS FILENAME,
  t1.APP_DOC_FILENAME AS COMENTARIO,
  t1.USR_UID,
  t1.DOC_UID,
  t1.APP_DOC_UID,
  t1.DOC_VERSION
FROM wf_equivida.APP_DOCUMENT t1
JOIN (SELECT APP_DOC_UID, MAX(DOC_VERSION) AS latest_version
    FROM wf_equivida.APP_DOCUMENT
    WHERE APP_UID = '$case_id'
      AND APP_DOC_TYPE = 'OUTPUT' GROUP BY APP_DOC_UID) t2
  ON t1.APP_DOC_UID = t2.APP_DOC_UID AND t1.DOC_VERSION = t2.latest_version
WHERE t1.APP_UID = '$case_id' AND t1.APP_DOC_TYPE = 'OUTPUT'
ORDER BY t1.APP_DOC_CREATE_DATE DESC";

//input document
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
$query_i = "SELECT APP_DOC_UID, APP_DOC_CREATE_DATE AS FECHA, USR_UID, APP_DOC_COMMENT AS COMENTARIO, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, APP_DOC_FIELDNAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$case_id'
                AND APP_DOC_TYPE IN ('INPUT','ATTACHED') AND APP_DOC_STATUS = 'ACTIVE' AND APP_DOC_FIELDNAME NOT IN ('file_cotizacion_csv','file_cotizacion') AND APP_DOC_FIELDNAME IN ('file_cedula_fechaCaducidad','file_requisitosMedicos','file_requisitosFinancieros','file_primeraCuota','file_documentosDesgravamen','fle_docs_repro') ORDER BY APP_DOC_CREATE_DATE DESC";
$inDoc = executeQuery($query_i);

$result = executeQuery($query);
if (empty($result) or count($result) == 0) {
   //die("Error: Unable to find Output Document file for case $case_id.");
}

$arr_docs = array();
$con = 1; $con_out = 1;
$rand = rand(0,9999999999);
$nocache = rand(0,9999999999);
foreach($result as $datadoc){
		$fileId = $datadoc['APP_DOC_UID'];
		$version = $datadoc['DOC_VERSION'];
		$op = $datadoc['DOC_UID'];
		$gridDocumentos_Fecha = $datadoc['FECHA'];
		$gridDocumentos_Descarga = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
		$con_out++;

		switch($op){
			case '7496627105ece994927e011097866968':
				@@link_solicitud_fecha = $gridDocumentos_Fecha;
				@@dana_link_solicitud = $gridDocumentos_Descarga;
			break;

			/*case '1465807915ecc74912c13c2030426904':
				@@link_covid_fecha = $gridDocumentos_Fecha;
				@@dana_link_covid = $gridDocumentos_Descarga;
			break;*/

			case '2243400975ec74080523606085555297':
				@@link_autorizacion_fecha = $gridDocumentos_Fecha;
				@@dana_link_autorizacion = $gridDocumentos_Descarga;
			break;

			case '6876503365f9a3bdb1e03a3065992251':
				@@link_informe_fecha = $gridDocumentos_Fecha;
				@@dana_link_informe_confidencial = $gridDocumentos_Descarga;
			break;

			case '308255212646cd4d0b3b6a5006332297':
				@@tri_dictamen_fecha = $gridDocumentos_Fecha;
				@@dana_link_dictamen = $gridDocumentos_Descarga;
			break;

			default:
			//por default
			break;
		}
}

foreach($inDoc as $dataind){
	$fileId = $dataind['APP_DOC_UID'];
	$version = $dataind['DOC_VERSION'];
	$arr_docs[$con]['gridDocumentos_Fecha'] = $dataind['FECHA'];
	$arr_docs[$con]['gridDocumentos_Archivo'] = $dataind['FILENAME'];
	$arr_docs[$con]['gridDocumentos_Comentario'] = ($dataind['COMENTARIO']  == '' ? $dataind['APP_DOC_FIELDNAME'] : $dataind['COMENTARIO']);
	$arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($dataind['USR_UID']);
	$arr_docs[$con]['gridDocumentos_Descarga'] = "$server/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId&v=$version&p=1";
	$con++;
}

@=gridDocumentos = $arr_docs;
