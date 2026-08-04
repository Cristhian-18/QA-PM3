<?php
$sumaAsegurada     = 0;
$cantidadAplicados = 0;
$process = @@PROCESS;

foreach (@@grd_accesorios  as $fila) {
    $aplicar = $fila['frm_accesorios_aplicar'] ?? false;
    if ($aplicar === true || $aplicar === '1' || $aplicar === 1 || $aplicar === 'true') {
        $sumaAsegurada += (float) ($fila['frm_accesorios_sumaAsegurada'] ?? 0);
        $cantidadAplicados++;
    }
}

@@tri_cantidad_suma_asegurada = $sumaAsegurada;
@@tri_cantidad_applicada      = $cantidadAplicados;



if($sumaAsegurada <= 2000){
 
	$sql_analista =
		"SELECT * FROM ADMIN_CATALOGOS
		WHERE PRO_UID = '$process'
		AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND $sumaAsegurada >= VALOR AND $sumaAsegurada <= INTEGRACION";
	 
	$rs_a = executeQuery($sql_analista);
	$pda_asignado = $rs_a['1']['DESCRIPCION'];
	echo $pda_asignado;
	if ($pda_asignado == 'EJECUTIVO_JR') {
		@@tri_pda_aprobacion = @@tri_usr_analista;
		return;
	} 
	
	if ($pda_asignado == 'EJECUTIVO_SR') {
 
		$group = $rs_a['1']['CAMPO1'];
	
		$groupUID = PMFGetGroupUID($group);
	
		$groupArray = PMFGetGroupUsers($groupUID);
	
 
		$usr_analista = @@tri_usr_analista;
 
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
AND COD_CATALOGO = 'APROBADORES_PDA' AND ESTADO = 1 AND $sumaAsegurada >= VALOR AND $sumaAsegurada <= INTEGRACION and CAMPO2 = '$value_taller'";


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
 
	if($usr_uid==''){
		die('no se encontro aprobador pda');
	}
}