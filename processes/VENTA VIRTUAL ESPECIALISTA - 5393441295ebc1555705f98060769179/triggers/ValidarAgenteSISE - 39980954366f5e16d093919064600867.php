<?php


$usr_uid = @@USER_LOGGED;
$usr_name = @@USR_USERNAME;

$sql_agen = "SELECT DESCRIPCION, VALOR, INTEGRACION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'magente' AND ESTADO = 1 AND CODIGO = '$usr_name'";

echo $sql_agen;
$rs_agen = executeQuery($sql_agen   );

if (empty($rs_agen) || !isset($rs_agen[1]['VALOR']) || empty($rs_agen[1]['VALOR'])) {
	echo '<br><p><h3>Solicitar revision de la parametrizacion del Agente.</h3></p>';
	die();
}
