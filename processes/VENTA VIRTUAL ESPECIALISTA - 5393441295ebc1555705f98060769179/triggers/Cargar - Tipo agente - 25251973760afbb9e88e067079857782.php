<?php
$cnx = '1479570925ec29f1d8d1d57019959618';


////////////////
// Tipo agente
////////////////

@@grd_tipo_agente_2 = array();

$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
ESTADO = 1
AND PRO_UID = '5393441295ebc1555705f98060769179'
AND COD_CATALOGO = 'ttipo_agente'
ORDER BY DESCRIPCION";

$rs = executeQuery($sql,$cnx);

for ($i = 1; $i <= count($rs); $i++) {
	@@grd_tipo_agente_2[$i]['frm_tipo_agente_2'] = $rs[$i]['DESCRIPCION'];
}
