<?php
$app = @@APPLICATION;

$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
$server = $config['configuracion_entorno']['url'];

$ruta = $server . '/sys' . @@SYS_SYS . '/' . @@SYS_LANG . '/' . @@SYS_SKIN . '/cases/cases_ShowDocument?a=';
$ruta_out = $server . '/sys' . @@SYS_SYS . '/' . @@SYS_LANG . '/' . @@SYS_SKIN . '/cases/cases_ShowOutputDocument?a=';
$i = 0;
@@tri_documentos = '';

$sql = "
SELECT
DOC.APP_DOC_UID ID,
DOC.APP_DOC_TITLE,
CONCAT_WS('- ',
DOC.APP_DOC_COMMENT,
DOC.APP_DOC_FILENAME) DOCUMENTO,
DOC.APP_DOC_TYPE TIPO,
DOC.DOC_VERSION,
CONCAT(
USR.USR_FIRSTNAME,
' - ',
USR.USR_LASTNAME,
' (',
USR.USR_USERNAME,')'
) NOMBRE,
DOC.APP_DOC_CREATE_DATE FECHA
FROM
APP_DOCUMENT DOC,
USERS USR
WHERE DOC.APP_UID = '$app'
AND DOC.APP_DOC_STATUS = 'ACTIVE'
AND DOC.USR_UID = USR.USR_UID
ORDER BY DOC.APP_DOC_CREATE_DATE";
@@tmprs = $sql;

$rs = executeQuery($sql);


$html = '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<tbody>';
$html .= '<tr>';
$html .= '<th width="30%" align="CENTER" class="FormSubTitle">DESCARGAR ARCHIVO</th>';
$html .= '<th width="20%"align="CENTER" class="FormSubTitle">TIPO</th>';
$html .= '<th width="20%"align="CENTER" class="FormSubTitle">CREADO POR</th>';
$html .= '<th width="20%" align="CENTER" class="FormSubTitle">FECHA</th>';
$html .= '</tr>';
$sw = 0;


foreach ($rs as $data) {

	@@ruta_descarga_in = $ruta1 = ($data["TIPO"] == 'INPUT' ? $ruta : $ruta_out) . $data["ID"] .
		'&v=' . $data['DOC_VERSION'] . '&ext=pdf';


	$sw = 1;
	//$rs[$sw]['RUTA'] = $ruta;
	$i++;

	if ($i % 2 == 0)
		$color = 'modo1';
	else
		$color = 'modo2';

	$html .= '<tr class = "' . $color . '" style="text-align:center">';
	$html .= '<td align="left"><a href="' . $ruta1 . '">' . $data["DOCUMENTO"] . '</a></td>';
	$html .= '<td align="left">' . $data["TIPO"] . '</td>';
	$html .= '<td align="left">' . $data["NOMBRE"] . '</td>';
	$fechaInicio = substr($data["FECHA"], 0, 20);
	$html .= '<td>' . $fechaInicio . '</td>';
	$html .= '</tr>';
}

$html .= '</tbody>
</table>';

@@tri_documentos = ($sw == 0 ? "No existen documentos adjuntos." : $html);
