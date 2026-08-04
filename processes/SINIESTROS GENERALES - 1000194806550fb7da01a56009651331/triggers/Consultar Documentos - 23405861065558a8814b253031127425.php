<?php
//created by Henry.
$case_id=@@APPLICATION;
@@tri_bandera_sac = 'true';

$query = "SELECT
  APP_DOC_CREATE_DATE AS FECHA,
  APP_DOC_FILENAME AS FILENAME,
  'HOJA DE AUDITORIA' AS COMENTARIO,
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
                AND APP_DOC_TYPE IN ('INPUT', 'ATTACHED') AND APP_DOC_STATUS IN ('ACTIVE', 'DELETED')
                ORDER BY APP_DOC_CREATE_DATE, DOC_VERSION DESC";
$inDoc = executeQuery($query_i);

$result = executeQuery($query);
if (empty($result) or count($result) == 0) {
   //die("Error: Unable to find Output Document file for case $case_id.");
}

$arr_docs = array();
$con = 1;
$rand = rand(0,9999999999);
$nocache = rand(0,9999999999);
$arr_docs_cliente = array();
$documentos_cliente = array('fle_matricula', 'fle_licencia', 'fle_cedula', 'frm_documentos_otros');
$con_cliente = 1;
foreach($result as $datadoc){
		$fileId = $datadoc['APP_DOC_UID'];
		$version = $datadoc['DOC_VERSION'];
		$arr_docs[$con]['gridDocumentos_Fecha'] = $datadoc['FECHA'];
		$arr_docs[$con]['gridDocumentos_Archivo'] = $datadoc['FILENAME'];
		$arr_docs[$con]['gridDocumentos_Comentario'] = $datadoc['COMENTARIO'];
		$arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($datadoc['USR_UID']);
		$arr_docs[$con]['gridDocumentos_Descarga'] = "/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
		$con++;
		//@@frm_fechaUltimoDocumento = $datadoc['FECHA'];
}

foreach($inDoc as $dataind){
	if (in_array($dataind['APP_DOC_FIELDNAME'], $documentos_cliente)) {
		$fileId = $dataind['APP_DOC_UID'];
		$version = $dataind['DOC_VERSION'];
		$arr_docs_cliente[$con_cliente]['gridDocumentos_Fecha'] = $dataind['FECHA'];
		$arr_docs_cliente[$con_cliente]['gridDocumentos_Archivo'] = $dataind['FILENAME'];
		$arr_docs_cliente[$con_cliente]['gridDocumentos_Comentario'] = ($dataind['COMENTARIO']  == '' ? $dataind['APP_DOC_FIELDNAME'] : $dataind['COMENTARIO']);
		$arr_docs_cliente[$con_cliente]['gridDocumentos_Usuario'] = nomUsuario($dataind['USR_UID']);
		$arr_docs_cliente[$con_cliente]['gridDocumentos_Descarga'] = "/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId&v=$version&p=1";
		$con_cliente++;
	}
	$fileId = $dataind['APP_DOC_UID'];
	$version = $dataind['DOC_VERSION'];
	$arr_docs[$con]['gridDocumentos_Fecha'] = $dataind['FECHA'];
	$arr_docs[$con]['gridDocumentos_Archivo'] = $dataind['FILENAME'];
	$arr_docs[$con]['gridDocumentos_Comentario'] = ($dataind['COMENTARIO']  == '' ? $dataind['APP_DOC_FIELDNAME'] : $dataind['COMENTARIO']);
	$arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($dataind['USR_UID']);
	$arr_docs[$con]['gridDocumentos_Descarga'] = "/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId&v=$version&p=1";
	$con++;
	//@@frm_fechaUltimoDocumento = $datadoc['FECHA'];
}
@=gridDocumentos_cliente = $arr_docs_cliente;
@=gridDocumentos = $arr_docs;
