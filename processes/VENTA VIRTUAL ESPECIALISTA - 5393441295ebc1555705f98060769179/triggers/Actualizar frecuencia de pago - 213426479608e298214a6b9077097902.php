<?php
$cnx = "1479570925ec29f1d8d1d57019959618";
$producto = @@frm_producto;
$frecuencia_pago = @@frm_frecuencia_pago;

$sql  = "
SELECT COUNT(*) AS contar
FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO='tforma_pago'
AND ESTADO = 1
AND VALOR = '$producto'
AND CODIGO = '$frecuencia_pago'
ORDER BY CODIGO ASC";

$rs = executeQuery($sql, $cnx);
$contar = $rs[1]['contar']*1;

if($contar <= 0){
	@@frm_frecuencia_pago = '';
	@@frm_frecuencia_pago_label = '';
}

