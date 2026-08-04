<?php
$case_id = @@APPLICATION;
$case_uid_padre = @@app_uid_rc;
@@tri_bandera_sac = 'true';

$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
$server = $config['configuracion_entorno']['url'];
@@URL_SERVER_SQL = $server;

// ─── Query OUTPUT (caso actual) ───────────────────────────────────────────────
$query = "SELECT
    APP_DOC_CREATE_DATE AS FECHA,
    APP_DOC_FILENAME    AS FILENAME,
    'HOJA DE AUDITORIA' AS COMENTARIO,
    USR_UID,
    DOC_UID,
    APP_DOC_UID,
    DOC_VERSION
FROM APP_DOCUMENT
WHERE APP_UID = '$case_id'
AND APP_DOC_TYPE = 'OUTPUT'";

// ─── Query INPUT/ATTACHED (caso actual) ───────────────────────────────────────
$query_i = "SELECT
    APP_DOC_UID,
    APP_DOC_CREATE_DATE AS FECHA,
    USR_UID,
    APP_DOC_COMMENT     AS COMENTARIO,
    DOC_VERSION,
    APP_DOC_FILENAME    AS FILENAME,
    APP_DOC_FIELDNAME
FROM APP_DOCUMENT
WHERE APP_UID = '$case_id'
AND APP_DOC_TYPE   IN ('INPUT', 'ATTACHED')
AND APP_DOC_STATUS IN ('ACTIVE', 'DELETED')
ORDER BY APP_DOC_CREATE_DATE, DOC_VERSION DESC";

// ─── Query INPUT/ATTACHED (caso padre RC) ────────────────────────────────────
$query_i_padre = "SELECT
    APP_DOC_UID,
    APP_DOC_CREATE_DATE AS FECHA,
    USR_UID,
    APP_DOC_COMMENT     AS COMENTARIO,
    DOC_VERSION,
    APP_DOC_FILENAME    AS FILENAME,
    APP_DOC_FIELDNAME
FROM APP_DOCUMENT
WHERE APP_UID = '$case_uid_padre'
AND APP_DOC_TYPE   IN ('INPUT', 'ATTACHED')
AND APP_DOC_STATUS IN ('ACTIVE', 'DELETED')
ORDER BY APP_DOC_CREATE_DATE, DOC_VERSION DESC";

$result       = executeQuery($query);
$inDoc        = executeQuery($query_i);
$inDoc_padre  = executeQuery($query_i_padre);

// Normalizar: executeQuery puede devolver false o array vacío
if (!is_array($result))      $result      = array();
if (!is_array($inDoc))       $inDoc       = array();
if (!is_array($inDoc_padre)) $inDoc_padre = array();

$rand    = rand(0, 9999999999);
$nocache = rand(0, 9999999999);

$arr_docs = array();
$con = 1;

// ─── 1. Documentos del caso PADRE ────────────────────────────────────────────
foreach ($inDoc_padre as $dataind) {
    $fileId  = isset($dataind['APP_DOC_UID']) ? trim($dataind['APP_DOC_UID']) : '';
    $version = isset($dataind['DOC_VERSION']) ? (int)$dataind['DOC_VERSION']  : 1;

    if (empty($fileId)) continue; // fila corrupta, saltar

    $comentario = (isset($dataind['COMENTARIO']) && $dataind['COMENTARIO'] !== '')
        ? $dataind['COMENTARIO']
        : (isset($dataind['APP_DOC_FIELDNAME']) ? $dataind['APP_DOC_FIELDNAME'] : '');

    $arr_docs[$con] = array(
        'gridDocumentos_Fecha'     => isset($dataind['FECHA'])    ? $dataind['FECHA']    : '',
        'gridDocumentos_Archivo'   => isset($dataind['FILENAME'])  ? $dataind['FILENAME']  : '',
        'gridDocumentos_Comentario'=> $comentario,
        'gridDocumentos_Usuario'   => nomUsuario($dataind['USR_UID']),
        'gridDocumentos_Descarga'  => "$server/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId&v=$version&p=1",
    );
    $con++;
}

// ─── 2. Documentos OUTPUT (caso actual) ──────────────────────────────────────
foreach ($result as $datadoc) {
    $fileId  = isset($datadoc['APP_DOC_UID']) ? trim($datadoc['APP_DOC_UID']) : '';
    $version = isset($datadoc['DOC_VERSION']) ? (int)$datadoc['DOC_VERSION']  : 1;

    if (empty($fileId)) continue;

    $arr_docs[$con] = array(
        'gridDocumentos_Fecha'     => isset($datadoc['FECHA'])   ? $datadoc['FECHA']   : '',
        'gridDocumentos_Archivo'   => isset($datadoc['FILENAME']) ? $datadoc['FILENAME'] : '',
        'gridDocumentos_Comentario'=> isset($datadoc['COMENTARIO']) ? $datadoc['COMENTARIO'] : '',
        'gridDocumentos_Usuario'   => nomUsuario($datadoc['USR_UID']),
        'gridDocumentos_Descarga'  => "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache",
    );
    $con++;
}

// ─── 3. Documentos INPUT/ATTACHED (caso actual) ───────────────────────────────
foreach ($inDoc as $dataind) {
    $fileId  = isset($dataind['APP_DOC_UID']) ? trim($dataind['APP_DOC_UID']) : '';
    $version = isset($dataind['DOC_VERSION']) ? (int)$dataind['DOC_VERSION']  : 1;

    if (empty($fileId)) continue;

    $comentario = (isset($dataind['COMENTARIO']) && $dataind['COMENTARIO'] !== '')
        ? $dataind['COMENTARIO']
        : (isset($dataind['APP_DOC_FIELDNAME']) ? $dataind['APP_DOC_FIELDNAME'] : '');

    $arr_docs[$con] = array(
        'gridDocumentos_Fecha'     => isset($dataind['FECHA'])    ? $dataind['FECHA']    : '',
        'gridDocumentos_Archivo'   => isset($dataind['FILENAME'])  ? $dataind['FILENAME']  : '',
        'gridDocumentos_Comentario'=> $comentario,
        'gridDocumentos_Usuario'   => nomUsuario($dataind['USR_UID']),
        'gridDocumentos_Descarga'  => "$server/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId&v=$version&p=1",
    );
    $con++;
}

// ─── Separar grid completa vs grid cliente (sin file_documentosAnalisis) ─────
$grid_completa  = array();
$grid_cliente   = array();
$i_completa = 1;
$i_cliente  = 1;

foreach ($arr_docs as $data) {
    // grid completa: todos los documentos, reindexado desde 1
    $grid_completa[$i_completa] = $data;
    $i_completa++;

    // grid cliente: excluye file_documentosAnalisis, reindexado desde 1
    if ($data['gridDocumentos_Comentario'] !== 'file_documentosAnalisis') {
        $grid_cliente[$i_cliente] = $data;
        $i_cliente++;
    }
}

@=gridDocumentos         = $grid_completa;
@=gridDocumentos_cliente = $grid_cliente;

@@tri_url_bpm = $server;