<?php
//<?
	//CREATED BY HENRY
	$process = '35087580064a18c9776b638006106795';
	$monto_liquidar = 0;
	$monto_liquidar = @@frm_valoresSiniestro_totalProformado;
	if ($monto_liquidar == 0 || $monto_liquidar == null || $monto_liquidar == '') {
		$monto_liquidar = 0;
	}

	$sql_analista =
		"SELECT * FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND $monto_liquidar >= VALOR AND $monto_liquidar <= INTEGRACION";

	//print_r($rs_a);

	@@sql_analista = $sql_analista;

	$rs_a = executeQuery($sql_analista);
	
	$pda_asignado = $rs_a['1']['DESCRIPCION'];
	
	if ($pda_asignado == 'EJECUTIVO_JR') {
		@@tri_pda_aprobacion = @@tri_usr_analista;
		/*echo(@@USER_LOGGED);
		die();*/
		return;
	}

	if ($pda_asignado == 'EJECUTIVO_SR') {
		//get the next bracket 
		$group = $rs_a['1']['CAMPO1'];
	
		$groupUID = PMFGetGroupUID($group);
	
		$groupArray = PMFGetGroupUsers($groupUID);
	
		//get the analyst user
		$usr_analista = @@tri_usr_analista;
	
		//check if the user is in the group
		$found = false;
		foreach ($groupArray as $user) {
			if ($user['USR_UID'] == $usr_analista) {
				$found = true;
				
				break;
			}
		}
	
		if ($found) {
			$sql_analista =
				"SELECT * FROM ADMIN_CATALOGOS
	WHERE COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND DESCRIPCION = 'COORDINACION'";
	
	
			$rs_a = executeQuery($sql_analista);
			$pda_asignado = $rs_a['1']['DESCRIPCION'];
		}
	}

	if ($pda_asignado == 'COORDINACION') {
		$provincia_accidente = strval(@@frm_accidente_provincia);

		$array_sierra = array("1", "2", "3", "4", "5", "6", "10", "17", "18");

		$array_costa_amazonia = array("7", "8", "9", "12", "13", "14", "20", "21", "22", "23", "24");


		if (in_array($provincia_accidente, $array_sierra)) {
			$value_taller = "SIERRA";
		} else {
			$value_taller = "COSTA";
		}
		$sql_analista =
			"SELECT * FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND $monto_liquidar >= VALOR AND $monto_liquidar <= INTEGRACION and CAMPO2 = '$value_taller'";


		$rs_a = executeQuery($sql_analista);
		if (empty($rs_a['1']['CAMPO1'])) {
			$sql_analista =
				"SELECT * FROM ADMIN_CATALOGOS
	WHERE COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND  CAMPO2 = '$value_taller'";
			$rs_a = executeQuery($sql_analista);
		}
	}

	$group = $rs_a['1']['CAMPO1'];

	$groupUID = PMFGetGroupUID($group);

	$groupArray = PMFGetGroupUsers($groupUID);

	$array_value = '0';

	$length_group = sizeof($groupArray);

	if($rs_a['1']['DESCRIPCION'] == 'EJECUTIVO_SR'){
		$array_value = rand(0, $length_group-1);
		$array_value = strval($array_value);
	} else {
		$array_value = '0';
	}
	
	$usr_uid = $groupArray[$array_value]['USR_UID'];
	$usr_name = $groupArray[$array_value]['USR_USERNAME'];

	@@tri_pda_aprobacion = $usr_uid;
	/*

    die();*/
//$cod_user = $rs_a['1']['CAMPO1'];*/
