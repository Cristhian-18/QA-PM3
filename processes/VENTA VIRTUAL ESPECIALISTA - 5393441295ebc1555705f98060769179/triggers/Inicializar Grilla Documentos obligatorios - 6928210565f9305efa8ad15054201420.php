<?php
// felipe GUerra
$cnx = '5624461675dcaef93dcaa10013654573';

$sql = "SELECT 
  DESCRIPCION frm_obli_descripcion
FROM
  ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'DOCUMENTOS' 
AND PRO_UID = '6464242075dc1b09e050206009257411'
AND ESTADO = 1
AND VALOR = 'TODOS'
ORDER BY DESCRIPCION";

$rs = executeQuery($sql, $cnx);

@@grd_obligatorios = $rs;