<?php

try {
	$cnx = "11264850561d723f004d5c2072943786";
	$app_uid        = @@APPLICATION;
	$pro_uid        = @@PROCESS;
	@@urs_pda       = @@USER_LOGGED;
	//monto a liquidar

	if (@@frm_accion == 'NEGAR') {
		$monto_liquidar = @@frm_monto_reportado;
	} else {
		if (@@tri_bandera_monto == 'true') {
			$monto_liquidar = @@frm_monto_aprobado;
		} else {
			$monto_liquidar = @@frm_monto_liquidar;
		}
	}

	//codigo de la tabla
	$monto_liquidar = intval($monto_liquidar);
	$sql = "SELECT CAMPO1, DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'APROBADORES_PDA' AND PRO_UID = '$pro_uid' AND ESTADO = 1 AND  $monto_liquidar >= VALOR AND $monto_liquidar <= INTEGRACION  ";
	$rs = executeQuery($sql, $cnx);

	$cod_user = $rs['1']['CAMPO1'];
	$cod_user_p = ($cod_user == 'usuario' ? @@USR_USERNAME : $cod_user); //dj

	@@tri_user_pda_cargo = $rs['1']['DESCRIPCION'];  //dj
	//codigo de user
	$sql_u = "SELECT * FROM USERS WHERE USR_USERNAME = '$cod_user_p'";

	$rs_u = executeQuery($sql_u);
	@@tmp_rs = $rs_u;
	@@tri_user_pda = $rs_u['1']['USR_UID'];
	@@tri_user_pda_name = $rs_u['1']['USR_FIRSTNAME'] . ' ' . $rs_u['1']['USR_LASTNAME'];
	@@tri_user_pda_mail = $rs_u['1']['USR_EMAIL'];
} catch (Exception $e) {

	$errorMessage =  $e->getMessage();
}
