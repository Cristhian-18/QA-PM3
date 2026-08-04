<?php
$usr = @@USER_LOGGED;
$accion = @@frm_accion;
$fecha = date("Y-m-d H:i:s");
$app_uid = @@APPLICATION;

if($accion == 'NEGAR'){
	$estado =  'NEGADO';
}else {
	$estado =  'APROBADO';
}
// actualizacion de la solicitud
$cnx = '1665078345d09b448804c01043460634'; 
$sqls = "UPDATE COM_SOLICITUD_PAGO
SET APP_STATUS = '$estado',
UID_JEFECC = '$usr',
ACCION = '$accion',
FECHA_APROBACION = '$fecha'
WHERE APP_UID = '$app_uid'";
@@TMP_sqls = $sqls;
$rss  = executeQuery($sqls,$cnx);