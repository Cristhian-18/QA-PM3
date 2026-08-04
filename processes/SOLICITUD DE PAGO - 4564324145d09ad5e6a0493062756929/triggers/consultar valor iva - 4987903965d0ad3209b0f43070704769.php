<?php
$cnx = '1665078345d09b448804c01043460634'; 
$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE PRO_UID = '8950685675bc4fc9a7402d3075704630'
AND COD_CATALOGO = 'CONFIGURACION' 
AND CODIGO = 'IVA'
AND ESTADO = 1";
$rs = executeQuery($sql,$cnx);

@@prod_por_iva = $rs['1']['VALOR'];

@@frm_fecha_solicitud = date("Y-m-d H:i:s");