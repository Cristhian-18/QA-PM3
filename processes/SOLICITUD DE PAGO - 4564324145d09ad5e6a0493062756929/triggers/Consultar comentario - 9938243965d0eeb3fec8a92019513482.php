<?php
date_default_timezone_set('America/Guayaquil');

$cnx = "1665078345d09b448804c01043460634";
$app_uid        = @@APPLICATION;
$pro_uid        = @@PROCESS;

$sql            = "select * from COM_BITACORA_SOLICITUD where APP_UID = '$app_uid' order by ID_BITACORA desc";
$rs_comentarios = executeQuery($sql, $cnx);

$tareas         = obtenerTareasdelProceso($pro_uid);

$sql             = "SELECT USR_UID, CONCAT(USR_FIRSTNAME,' ',USR_LASTNAME) NOMBRE FROM USERS";
$rs_usuarios     = executeQuery($sql);
$html = "";
$html .= "<table class='table' id='tabla-comentarios'>";
	$html .= "<thead>";
		$html .= "<tr>";
			$html .= "<th>Fecha Llegada</th>";
			$html .= "<th>Fecha Inicio</th>";
			$html .= "<th>Fecha Fin</th>";
			$html .= "<th>Tarea</th>";
			$html .= "<th>Usuario</th>";
			$html .= "<th>Comentario</th>";
		$html .= "</tr>";
	$html .= "</thead>";
	$html .= "<tbody>";
		foreach ($rs_comentarios as $value) {
		$html .= "<tr>";
			$html .= "<td>". $value['FECHA_DERIVACION'] ."</td>";
			$html .= "<td>". $value['FECHA_INICIO'] ."</td>";
			$html .= "<td>". $value['FECHA_FIN'] ."</td>";			
			$html .= "<td>". NomTarea($value['TASK_UID'])."</td>";
			$html .= "<td>". NomUsuario($value['USR_UID_ACTUAL']) ."</td>";
			$html .= "<td>". $value['COMENTARIO'] ."</td>";
		$html .= "</tr>";
		}
	$html .= "</tbody>";
$html .= "</table>";

@@tri_comentarios = $html;