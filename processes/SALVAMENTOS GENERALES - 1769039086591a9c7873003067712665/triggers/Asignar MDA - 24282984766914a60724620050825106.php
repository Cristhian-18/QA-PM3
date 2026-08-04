<?php
//Asignar MDA
/*$monto_liquidar = @@frm_as_valorTotal;
if ($monto_liquidar == 0 || $monto_liquidar == '') {
    $monto_liquidar = @@frm_rif_valorLuegoDeducible;
}
$sql_analista =
    "SELECT CAMPO1, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'APROBADORES_PDA' AND
 ESTADO = 1 AND $monto_liquidar > VALOR AND $monto_liquidar < INTEGRACION";
$rs_a = executeQuery($sql_analista);

$cod_user = $rs_a['1']['CAMPO1'];
@@tri_user_pda_cargo = $rs_a['1']['DESCRIPCION'];
	
$cod_user_p = ($cod_user == 'usuario' ? @@USR_USERNAME : $cod_user);

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$cod_user_p'";

$rs_u = executeQuery($sql_u);
*/
$newCaseId = @@process_uid_padre;
$c = new Cases();
$aCase = $c->loadCase($newCaseId);
@@tri_usr_aprobador = $aCase['APP_DATA']['tri_usr_aprobador'];
