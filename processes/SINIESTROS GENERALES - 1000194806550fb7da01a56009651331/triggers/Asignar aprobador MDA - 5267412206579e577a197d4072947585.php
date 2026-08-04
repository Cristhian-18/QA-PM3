<?php
//CREATED BY HENRY

$process = @@PROCESS;
/*if(@@TASK != '9988199046555865bcb8e44005902575'){
	$monto_liquidar = @@frm_as_valorTotal;
}else{
	$monto_liquidar = @@frm_rif_valorLuegoDeducible;
}*/
$tri_usr_analista = @@tri_usr_analista;
$sql_username_analista = "SELECT USR_USERNAME FROM USERS WHERE USR_UID = '$tri_usr_analista'";
$rs_username_analista = executeQuery($sql_username_analista);
$tri_username_analista = $rs_username_analista[1]['USR_USERNAME'];

$monto_liquidar =  @@frm_as_valorTotal;
if ($monto_liquidar == 0 || $monto_liquidar == '') {
	$monto_liquidar = @@frm_rif_valorLuegoDeducible;
}

//if <0 then 1
if ($monto_liquidar <= 0) {
	$monto_liquidar = 1;
}
$sql_analista =
"SELECT CAMPO1, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND $monto_liquidar > VALOR AND $monto_liquidar < INTEGRACION";

$rs_a = executeQuery($sql_analista);

@@sql_pda = $sql_analista;

$cod_user = $rs_a['1']['CAMPO1'];
@@tri_user_pda_cargo = $rs_a['1']['DESCRIPCION'];
	
$cod_user_p = ($cod_user == 'usuario' ? $tri_username_analista : $cod_user);

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$cod_user_p'";

$rs_u = executeQuery($sql_u);

if(empty($rs_u)) {
	$sql_analista = "SELECT CAMPO1, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND 1 > VALOR AND 1 < INTEGRACION";
$rs_a = executeQuery($sql_analista);

$cod_user = $rs_a['1']['CAMPO1'];
@@tri_user_pda_cargo = $rs_a['1']['DESCRIPCION'];
	
$cod_user_p = ($cod_user == 'usuario' ? $tri_username_analista : $cod_user);

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$cod_user_p'";

$rs_u = executeQuery($sql_u);
}

@@tri_usr_aprobador = $rs_u['1']['USR_UID'];

/*if(empty($rs_u)){
	echo $sql_analista;
	echo 'VERIFICAR VALORES MDA';
	die();
}*/

