<?php
$codigo = @@frm_codAgente;
$sucursal = @@frm_poliza_sucursal;
$process = @@PROCESS;

$sql_analista =
"SELECT INTEGRACION FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'ANALISTAS'
AND INTEGRACION != 'PEND. ANALISTA'
AND CODIGO = '$codigo'
AND CAMPO2 = '$sucursal'";

$rs_a = executeQuery($sql_analista);


if(empty($rs_a)){
$sql_analista =
"SELECT INTEGRACION FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'ANALISTAS'
AND INTEGRACION != 'PEND. ANALISTA'
AND CODIGO = '$codigo'";

$rs_a = executeQuery($sql_analista);

}

if(empty($rs_a)){
$sql_analista =
"SELECT INTEGRACION FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'ANALISTAS'
AND  INTEGRACION != 'PEND. ANALISTA'
ORDER BY RAND()";
$rs_a = executeQuery($sql_analista);
}

$analista = $rs_a['1']['INTEGRACION'];

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$analista'";

$rs_u = executeQuery($sql_u);

@@tri_usr_analista = $rs_u['1']['USR_UID'];
