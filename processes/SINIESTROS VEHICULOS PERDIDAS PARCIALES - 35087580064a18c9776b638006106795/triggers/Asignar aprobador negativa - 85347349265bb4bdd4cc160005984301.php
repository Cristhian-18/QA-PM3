<?php
//<?
	//CREATED BY HENRY
	$process = @@PROCESS;
	$monto_liquidar = 0;
	$monto_liquidar = @@frm_valoresSiniestro_totalProformado;
	if ($monto_liquidar == 0 || $monto_liquidar == null) {
		$monto_liquidar = 0;
	}
	echo ($monto_liquidar);
	$sql_analista =
		"SELECT * FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'APROBACION_NEGATIVAS_VH' AND ESTADO = 1 AND $monto_liquidar > VALOR AND $monto_liquidar < INTEGRACION";

	//print_r($rs_a);

	$rs_a = executeQuery($sql_analista);
	$pda_asignado = $rs_a['1']['DESCRIPCION'];

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
AND COD_CATALOGO = 'APROBACION_NEGATIVAS_VH' AND ESTADO = 1 AND $monto_liquidar > VALOR 
AND $monto_liquidar < INTEGRACION and CAMPO2 = '$value_taller'";

		$rs_a = executeQuery($sql_analista);
	}

	$group = $rs_a['1']['CAMPO1'];

	$groupUID = PMFGetGroupUID($group);

	$groupArray = PMFGetGroupUsers($groupUID);
	$usr_uid = $groupArray['0']['USR_UID'];
	$usr_name = $groupArray['0']['USR_USERNAME'];
	
	@@tri_aprobador_negativa = $usr_uid;
	
//$cod_user = $rs_a['1']['CAMPO1'];*/
