<?php
$process = '35087580064a18c9776b638006106795';
$debug = "===== INICIO DEBUG TALLER =====<br><br>";

// ---------------- ANIOS MINIMO ----------------
$sql_a = "SELECT VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$process' AND COD_CATALOGO = 'CONFIGURACION'
AND CODIGO = 'ANIOS_MINIMO'";
$rs_a = executeQuery($sql_a);
$valor_a = $rs_a['1']['VALOR'];
$anio_actual = date('Y');
$anio_minimo = $anio_actual - $valor_a;

$debug .= "-------------------------------------------<br>";
$debug .= "PASO 1: CONSULTA ANIOS_MINIMO<br>";
$debug .= "-------------------------------------------<br>";
$debug .= "SQL: $sql_a<br><br>";
$debug .= "VALOR (config anios minimo): " . nl2br(print_r($valor_a, true)) . "<br>";
$debug .= "ANIO_ACTUAL: $anio_actual<br>";
$debug .= "ANIO_MINIMO calculado: $anio_minimo<br><br>";

// ---------------- PROVINCIA ----------------
$provincia = @@frm_provincia_reparacion;

$debug .= "-------------------------------------------<br>";
$debug .= "PASO 2: PROVINCIA DE REPARACION<br>";
$debug .= "-------------------------------------------<br>";
$debug .= "frm_provincia_reparacion (crudo): " . @@frm_provincia_reparacion . "<br>";

if (@@frm_provincia_reparacion == null || @@frm_provincia_reparacion == 'undefined') {
	$provincia = '17';
	$debug .= ">>> CONDICION: provincia null/undefined -> forzando provincia = 17<br>";
} else {
	$debug .= ">>> CONDICION: provincia valida, se mantiene: $provincia<br>";
}
$debug .= "PROVINCIA FINAL: $provincia<br><br>";

$anio_auto = @@frm_vehiculo_anio * 1;
$cod_prov = $provincia * 1;
$marca = @@frm_vehiculo_marca;
$tipo_veh = @@frm_vehiculo_tipo;

if ($tipo_veh != 'PESADO') {
	$tipo_veh = 'LIVIANO';
}

$componente_electrico = @@frm_componente_electronico;

$debug .= "-------------------------------------------<br>";
$debug .= "PASO 3: VARIABLES DE ENTRADA<br>";
$debug .= "-------------------------------------------<br>";
$debug .= "ANIO_AUTO: $anio_auto<br>";
$debug .= "COD_PROV: $cod_prov<br>";
$debug .= "MARCA: $marca<br>";
$debug .= "TIPO_VEH (normalizado): $tipo_veh<br>";
$debug .= "COMPONENTE_ELECTRICO: $componente_electrico<br><br>";

$debug .= "-------------------------------------------<br>";
$debug .= "PASO 4: EVALUACION ANIO_AUTO vs ANIO_MINIMO (1er intento, con marca)<br>";
$debug .= "-------------------------------------------<br>";

//validacion para el anio
if ($anio_auto >= $anio_minimo) {
	$debug .= ">>> CONDICION: ANIO_AUTO ($anio_auto) >= ANIO_MINIMO ($anio_minimo)<br>";
	$debug .= ">>> RESULTADO: entra por CONCESIONARIO<br><br>";
	$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
	WHERE tipo = 'TALLER CONCESIONARIO'
	AND cod_provincia = '$cod_prov'
	AND tipo_vehiculo = '$tipo_veh'
	AND marcas LIKE '%$marca%'
	AND estado = '1'
	ORDER BY prioridad, capacidad";
} else {
	$debug .= ">>> CONDICION: ANIO_AUTO ($anio_auto) < ANIO_MINIMO ($anio_minimo)<br>";
	if ($componente_electrico == "SI") {
		$debug .= ">>> SUB-CONDICION: COMPONENTE_ELECTRICO = SI<br>";
		$debug .= ">>> RESULTADO: entra por TALLER AUTORIZADO MULTIMARCA<br><br>";
		$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		AND marcas LIKE '%$marca%'
		AND estado = '1'
		ORDER BY prioridad, capacidad";
	} else {
		$debug .= ">>> SUB-CONDICION: COMPONENTE_ELECTRICO != SI<br>";
		$debug .= ">>> RESULTADO: entra por TALLER AUTORIZADO MULTIMARCA<br><br>";
		$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		AND marcas LIKE '%$marca%'
		AND estado = '1'
		ORDER BY prioridad, capacidad";
	}
}

$debug .= "SQL (1er intento): $sql_tm<br><br>";
$rs_tm = executeQuery($sql_tm);
$debug .= "RESULTADO 1er intento: " . nl2br(print_r($rs_tm, true)) . "<br><br>";

//check if empty
if (empty($rs_tm)) {
	$debug .= "-------------------------------------------<br>";
	$debug .= "PASO 5: RS_TM VACIO -> 2do INTENTO (SIN MARCA)<br>";
	$debug .= "-------------------------------------------<br>";
	if ($anio_auto >= $anio_minimo) {
		$debug .= ">>> RAMA: ANIO_AUTO >= ANIO_MINIMO -> MULTIMARCA sin marca (ojo: aqui ya NO es concesionario)<br>";
		$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			AND estado = '1'
			ORDER BY prioridad, capacidad";
	} else {
		if ($componente_electrico == "SI") {
			$debug .= ">>> RAMA: ANIO_AUTO < ANIO_MINIMO, COMPONENTE_ELECTRICO = SI -> MULTIMARCA sin marca<br>";
			$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			AND estado = '1'
			ORDER BY prioridad, capacidad";
		} else {
			$debug .= ">>> RAMA: ANIO_AUTO < ANIO_MINIMO, COMPONENTE_ELECTRICO != SI -> MULTIMARCA sin marca<br>";
			$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			AND estado = '1'
			ORDER BY prioridad, capacidad";
		}
	}
	$debug .= "SQL (2do intento): $sql_tm<br><br>";
	$rs_tm = executeQuery($sql_tm);
	$debug .= "RESULTADO 2do intento: " . nl2br(print_r($rs_tm, true)) . "<br><br>";
} else {
	$debug .= "-------------------------------------------<br>";
	$debug .= "PASO 5: RS_TM NO VACIO, se omite 2do intento (sin marca)<br>";
	$debug .= "-------------------------------------------<br><br>";
}

// ---------------- COMPONENTE E / INUNDADO ----------------
$debug .= "-------------------------------------------<br>";
$debug .= "PASO 6: EVALUACION COMPONENTE_E / INUNDADO<br>";
$debug .= "-------------------------------------------<br>";
$debug .= "frm_rp_componente_e: " . @@frm_rp_componente_e . "<br>";
$debug .= "frm_componente_inundado: " . @@frm_componente_inundado . "<br>";

if (@@frm_rp_componente_e == 'SI' || @@frm_componente_inundado == "SI") {
	$debug .= ">>> CONDICION CUMPLIDA: rp_componente_e = SI o componente_inundado = SI<br>";
	$debug .= ">>> Se fuerza SOBRESCRITURA: reintenta CONCESIONARIO con marca<br><br>";

	$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER CONCESIONARIO'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		AND marcas LIKE '%$marca%'
		AND estado = '1'
		ORDER BY prioridad, capacidad";

	$debug .= "SQL (concesionario forzado): $sql_tm<br><br>";
	$rs_tm = executeQuery($sql_tm);
	$debug .= "RESULTADO (concesionario forzado): " . nl2br(print_r($rs_tm, true)) . "<br><br>";

	if (empty($rs_tm)) {
		$debug .= ">>> RS_TM VACIO tras forzar concesionario -> fallback MULTIMARCA sin marca<br><br>";
		$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
				WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
				AND cod_provincia = '$cod_prov'
				AND tipo_vehiculo = '$tipo_veh'
				AND estado = '1'
				ORDER BY prioridad, capacidad";

		$debug .= "SQL (fallback multimarca): $sql_tm<br><br>";
		$rs_tm = executeQuery($sql_tm);
		$debug .= "RESULTADO (fallback multimarca): " . nl2br(print_r($rs_tm, true)) . "<br><br>";
	}
} else {
	$debug .= ">>> CONDICION NO CUMPLIDA: se mantiene el resultado anterior de rs_tm<br><br>";
}

// ---------------- TALLER INDEMNIZACION (fallback final) ----------------
$debug .= "-------------------------------------------<br>";
$debug .= "PASO 7: CHECK FINAL RS_TM VACIO -> TALLER INDEMNIZACION<br>";
$debug .= "-------------------------------------------<br>";

if (empty($rs_tm)) {
	@@sql_taller_antes_indemnizacion = $sql_tm;
	$debug .= ">>> RS_TM VACIO -> se guarda sql_taller_antes_indemnizacion y se cae a TALLER INDEMNIZACION<br>";
	$debug .= "sql_taller_antes_indemnizacion guardado: " . @@sql_taller_antes_indemnizacion . "<br><br>";

	$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
		WHERE nombre_taller = 'TALLER INDEMNIZACION'";

	$debug .= "SQL (taller indemnizacion): $sql_tm<br><br>";
	$rs_tm = executeQuery($sql_tm);
	$debug .= "RESULTADO (taller indemnizacion): " . nl2br(print_r($rs_tm, true)) . "<br><br>";
} else {
	$debug .= ">>> RS_TM NO VACIO, no se cae a TALLER INDEMNIZACION<br><br>";
}

// ---------------- TALLER SELECCIONADO ----------------
$mail_responsa_taller = $rs_tm['1']['email_taller'];
@@id_taller = $rs_tm['1']['id_sise'];
@@datos_taller = $rs_tm['1'];
@@frm_ruc_taller = $rs_tm['1']['ruc_taller'];

$debug .= "-------------------------------------------<br>";
$debug .= "PASO 8: TALLER SELECCIONADO (final)<br>";
$debug .= "-------------------------------------------<br>";
$debug .= "MAIL_RESPONSA_TALLER: $mail_responsa_taller<br>";
$debug .= "ID_TALLER (id_sise): " . @@id_taller . "<br>";
$debug .= "FRM_RUC_TALLER: " . @@frm_ruc_taller . "<br>";
$debug .= "DATOS_TALLER completo: " . nl2br(print_r($rs_tm['1'], true)) . "<br><br>";

// ---------------- BUSQUEDA USUARIO ----------------
$debug .= "-------------------------------------------<br>";
$debug .= "PASO 9: BUSQUEDA USUARIO (por USR_EMAIL)<br>";
$debug .= "-------------------------------------------<br>";

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$mail_responsa_taller'";
$debug .= "SQL_U (por email): $sql_u<br><br>";
$rs_u = executeQuery($sql_u);
$debug .= "RESULTADO (por email): " . nl2br(print_r($rs_u, true)) . "<br><br>";

if (empty($rs_u)) {
	$debug .= ">>> RS_U VACIO por USR_EMAIL -> reintentando por USR_POSITION<br><br>";
	$sql_u = "SELECT USR_UID FROM USERS WHERE USR_POSITION = '$mail_responsa_taller'";
	$debug .= "SQL_U (por position): $sql_u<br><br>";
	$rs_u = executeQuery($sql_u);
	$debug .= "RESULTADO (por position): " . nl2br(print_r($rs_u, true)) . "<br><br>";
} else {
	$debug .= ">>> RS_U encontrado por USR_EMAIL, no se reintenta por USR_POSITION<br><br>";
}

@@sql_datos_taller = $sql_tm;

$debug .= "-------------------------------------------<br>";
$debug .= "PASO 10: RESULTADO FINAL<br>";
$debug .= "-------------------------------------------<br>";
$debug .= "sql_datos_taller guardado: " . @@sql_datos_taller . "<br><br>";

echo '<br>SQL TALLER:' . $sql_tm . '<br>';

@@tri_user_taller = $rs_u['1']['USR_UID'];
@@tri_tipo_taller = $rs_tm['1']['tipo'];
@@tri_nombre_taller = $rs_tm['1']['nombre_taller'];

$debug .= "TRI_USER_TALLER: " . @@tri_user_taller . "<br>";
$debug .= "TRI_TIPO_TALLER: " . @@tri_tipo_taller . "<br>";
$debug .= "TRI_NOMBRE_TALLER: " . @@tri_nombre_taller . "<br><br>";

$debug .= "===== FIN DEBUG TALLER =====<br>";

echo $debug;
die();