<?php
@@__ERROR__  = '';


$cnx = "1479570925ec29f1d8d1d57019959618";
$app_uid        = @@APPLICATION;
$pro_uid        = @@PROCESS;

$sql            = "select * from VV_BITACORA where APP_UID = '$app_uid' order by ID_BITACORA desc";
$rs_comentarios = executeQuery($sql, $cnx);


$tareas         = obtenerTareasdelProceso($pro_uid);

$sql             = "SELECT USR_UID, CONCAT(USR_FIRSTNAME,' ',USR_LASTNAME) NOMBRE FROM USERS";
$rs_usuarios     = executeQuery($sql);

$html = "";
if (count($rs_comentarios) > 0) {
	$html .= "<table class='table' id='tabla-comentarios'>";
	$html .= "<thead>";
	$html .= "<tr>";
	$html .= "<th>Fecha Derivación</th>";
	$html .= "<th>Fecha Atención</th>";
	$html .= "<th>Fecha Fin</th>";
	$html .= "<th>Tarea</th>";
	$html .= "<th>Acción</th>";
	$html .= "<th>Usuario</th>";
	$html .= "<th>Comentario</th>";
	$html .= "</tr>";
	$html .= "</thead>";
	$html .= "<tbody>";
	foreach ($rs_comentarios as $value) {
		$html .= "<tr>";
		$html .= "<td>" . $value['FECHA_DERIVACION'] . "</td>";
		$html .= "<td>" . $value['FECHA_INICIO'] . "</td>";
		$html .= "<td>" . $value['FECHA_FIN'] . "</td>";
		$html .= "<td>" . NomTarea($value['TASK_UID']) . "</td>";
		$html .= "<td>" . $value['ACCION'] . "</td>";
		$html .= "<td>" . NomUsuario($value['USR_UID_ACTUAL']) . "</td>";
		$html .= "<td>" . $value['COMENTARIO'] . "</td>";
		$html .= "</tr>";
	}
	$html .= "</tbody>";
	$html .= "</table>";
}
@@tri_comentarios = $html;

@@frm_fecha_actual = date("Y-m-d H:i:s");

$host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
@@URL_SERVER_SQL =  $server;


