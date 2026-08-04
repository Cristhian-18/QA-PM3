<?php
$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;

$sql_cata = "SELECT VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_RESUMEN'";

$rs_auth =  executeQuery($sql_cata, $cnx_rp);
$respuesta = isset($rs_auth['1']['VALOR']) ? $rs_auth['1']['VALOR'] : '';


@@urlResumenMagnum = $respuesta;

