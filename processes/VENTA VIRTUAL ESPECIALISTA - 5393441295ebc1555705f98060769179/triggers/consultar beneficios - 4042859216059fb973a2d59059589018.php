<?php
$cnx = "1479570925ec29f1d8d1d57019959618";
$prod = @@frm_producto;
$sql = "SELECT  CODIGO, DESCRIPCION
FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO='PRODUCTO_COBERTURA'
and ESTADO = 1
AND VALOR = '$prod'
ORDER BY DESCRIPCION ASC";
@@tmp_sql = $sql;
$result = executeQuery($sql,$cnx);

unset(@=aBeneficios);
if (is_array($result)) {
  foreach ($result as $row) {
    @=aBeneficios[]= array($row['CODIGO'], $row['DESCRIPCION']);
  }
}

// consultar impuesto
$sql = "SELECT VALOR FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'PARAMETROS_GENERALES' AND CODIGO = 'IMPUESTO' AND ESTADO = 1 AND PRO_UID = '5393441295ebc1555705f98060769179'";
$rs = executeQuery($sql,$cnx);
$iva = $rs[1]['VALOR'];

// CONSULTAR RAMO
$sql = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'producto_vida' AND CODIGO = '$prod' AND ESTADO = 1 ";
$rs = executeQuery($sql,$cnx);
@@frm_ramo = $rs[1]['VALOR'];

// DEDUCIBLES
$sql = "SELECT  C.CODIGO, C.DESCRIPCION  
FROM ADMIN_CATALOGOS C
WHERE 
C.COD_CATALOGO='tdeducible_vida'
AND C.ESTADO = 1";
$rsd = executeQuery($sql,$cnx);

unset(@=aDeducible);
if (is_array($rsd)) {
  foreach ($rsd as $row) {
    @=aDeducible[]= array($row['CODIGO'], $row['DESCRIPCION']);
  }
}