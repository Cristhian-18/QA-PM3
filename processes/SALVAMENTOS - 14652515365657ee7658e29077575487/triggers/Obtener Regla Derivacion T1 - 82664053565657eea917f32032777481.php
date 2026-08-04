<?php
//<php
//Obtener Regla Derivacion T1

$process = @@PROCESS;

if(@@bandera == ''){
	@@frm_accion = 'CONTINUAR';
	@@tri_estado = 'INGRESADO';
}

//para obtener la regla en base al direccionador
//obtengo el valor de los anios para validar con el anio del auto

$sql_a = "SELECT VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$process' AND COD_CATALOGO = 'CONFIGURACION'
AND CODIGO = 'ANIOS_MINIMO'";
$rs_a = executeQuery($sql_a);
$valor_a = $rs_a['1']['VALOR'];
$anio_actual = date('Y');


$anio_minimo = $anio_actual - $valor_a;

/*@@frm_vehiculo_anio = '2022';
@@frm_accidente_provincia = '17';
@@frm_vehiculo_marca = 'TOYOTA';*/

$anio_auto = @@frm_vehiculo_anio*1;
$cod_prov = @@frm_accidente_provincia*1;
$marca = @@frm_vehiculo_marca;
$tipo_veh = @@frm_vehiculo_tipo;

if($tipo_veh != "PESADO"){
$tipo_veh= "LIVIANO";
}

$componente_electrico = @@frm_componente_electronico;

//validacion para el anio
if($anio_auto >= $anio_minimo){
	//aki va al concesinario
	$sql_tm = "SELECT * FROM SINIESTROS_DIRECCIONADOR
	WHERE tipo = 'TALLER CONCESIONARIO'
	AND cod_provincia = '$cod_prov'
	AND tipo_vehiculo = '$tipo_veh'
	AND marcas LIKE '%$marca%'
	ORDER BY prioridad, capacidad";
}
else{
	//aki va al taller
	if($componente_electrico=="SI"){
		$sql_tm = "SELECT * FROM SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		AND marcas LIKE '%$marca%'
		ORDER BY prioridad, capacidad";
	} else {
		$sql_tm = "SELECT * FROM SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		AND marcas LIKE '%$marca%'
		ORDER BY prioridad, capacidad";
	}

}

$rs_tm = executeQuery($sql_tm);


//check if empty
if(empty($rs_tm)){

	if($anio_auto >= $anio_minimo){
		//aki va al concesinario
		$sql_tm = "SELECT * FROM SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER CONCESIONARIO'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		ORDER BY prioridad, capacidad";
	}else{
		//aki va al taller
		if($componente_electrico=="SI"){
			$sql_tm = "SELECT * FROM SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			ORDER BY prioridad, capacidad";
		} else {
			$sql_tm = "SELECT * FROM SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			ORDER BY prioridad, capacidad";
		}

	}

	$rs_tm = executeQuery($sql_tm);

}

if(empty($rs_tm)){
$sql_tm = "SELECT * FROM SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			ORDER BY prioridad, capacidad";
}

	$mail_responsa_taller = $rs_tm['1']['email_taller'];

	@@datos_taller = $rs_tm['1'];
	$sql_u = "SELECT USR_UID FROM USERS WHERE USR_POSITION = '$mail_responsa_taller'";
	$rs_u = executeQuery($sql_u);
	@@tri_user_taller = $rs_u['1']['USR_UID'];
    @@tri_tipo_taller = $rs_tm['1']['tipo'];
    @@tri_nombre_taller = $rs_tm['1']['nombre_taller'];

	if(@@tri_user_taller == null){
		echo($mail_responsa_taller);
		die();
	}




