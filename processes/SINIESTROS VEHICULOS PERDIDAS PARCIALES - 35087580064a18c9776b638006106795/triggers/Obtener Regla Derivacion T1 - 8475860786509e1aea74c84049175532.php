<?php
//<?
//Obtener Regla Derivacion T1

$process = @@PROCESS;
 

//para obtener la regla en base al direccionador
//obtengo el valor de los anios para validar con el anio del auto
$sql_a = "SELECT VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$process' AND COD_CATALOGO = 'CONFIGURACION'
AND CODIGO = 'ANIOS_MINIMO'";
$rs_a = executeQuery($sql_a);
$valor_a = $rs_a['1']['VALOR'];
$anio_actual = date('Y');



$anio_minimo = $anio_actual - $valor_a;

$provincia = @@frm_provincia_reparacion;



if (@@frm_provincia_reparacion == null || @@frm_provincia_reparacion == 'undefined') {
	$provincia = '17';
}

$anio_auto = @@frm_vehiculo_anio * 1;
$cod_prov = $provincia * 1;

$marca = @@frm_vehiculo_marca;
$tipo_veh = @@frm_vehiculo_tipo;


if ($tipo_veh != 'PESADO') {
	$tipo_veh = 'LIVIANO';
}

$componente_electrico = @@frm_componente_electronico;



//validacion para el anio
if ($anio_auto >= $anio_minimo) {

	//aki va al concesinario
	$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
	WHERE tipo = 'TALLER CONCESIONARIO'
	AND cod_provincia = '$cod_prov'
	AND tipo_vehiculo = '$tipo_veh'
	AND marcas LIKE '%$marca%'
	AND estado = '1'
	ORDER BY prioridad, capacidad";
} else {
	//aki va al taller
	if ($componente_electrico == "SI") {
		$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		AND marcas LIKE '%$marca%'
		AND estado = '1'
		ORDER BY prioridad, capacidad";
	} else {
		$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		AND marcas LIKE '%$marca%'
		AND estado = '1'
		ORDER BY prioridad, capacidad";


	}
}

$rs_tm = executeQuery($sql_tm);


//check if empty
if (empty($rs_tm)) {
	if ($anio_auto >= $anio_minimo) {
		$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			AND estado = '1'
			ORDER BY prioridad, capacidad";
	} else {
		//aki va al taller
		if ($componente_electrico == "SI") {
			$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			AND estado = '1'
			ORDER BY prioridad, capacidad";
		} else {
			$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
			WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
			AND cod_provincia = '$cod_prov'
			AND tipo_vehiculo = '$tipo_veh'
			AND estado = '1'
			ORDER BY prioridad, capacidad";
		}
	}
	$rs_tm = executeQuery($sql_tm);
}

if (@@frm_rp_componente_e == 'SI' || @@frm_componente_inundado == "SI") {
	$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
		WHERE tipo = 'TALLER CONCESIONARIO'
		AND cod_provincia = '$cod_prov'
		AND tipo_vehiculo = '$tipo_veh'
		AND marcas LIKE '%$marca%'
		AND estado = '1'
		ORDER BY prioridad, capacidad";

	$rs_tm = executeQuery($sql_tm);

	if (empty($rs_tm)) {
		$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
				WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
				AND cod_provincia = '$cod_prov'
				AND tipo_vehiculo = '$tipo_veh'
				AND estado = '1'
				ORDER BY prioridad, capacidad";

		$rs_tm = executeQuery($sql_tm);
	}
}
if (empty($rs_tm)) {
	@@sql_taller_antes_indemnizacion = $sql_tm;
	$sql_tm = "SELECT * FROM certificacion.SINIESTROS_DIRECCIONADOR
		WHERE nombre_taller = 'TALLER INDEMNIZACION'";

	$rs_tm = executeQuery($sql_tm);
}



$mail_responsa_taller = $rs_tm['1']['email_taller'];


@@id_taller = $rs_tm['1']['id_sise'];

@@datos_taller = $rs_tm['1'];

//RUC TALLER - Cristhian 17/07/2026
@@frm_ruc_taller = $rs_tm['1']['ruc_taller'];

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$mail_responsa_taller'";
$rs_u = executeQuery($sql_u);


if (empty($rs_u)) {
	$sql_u = "SELECT USR_UID FROM USERS WHERE USR_POSITION = '$mail_responsa_taller'";
	$rs_u = executeQuery($sql_u);
}

@@sql_datos_taller = $sql_tm;

echo '<br>SQL TALLER:' . $sql_tm . '<br>';
@@tri_user_taller = $rs_u['1']['USR_UID'];
@@tri_tipo_taller = $rs_tm['1']['tipo'];
@@tri_nombre_taller = $rs_tm['1']['nombre_taller'];

if (@@tri_user_taller == null) {
	header("HTTP/1.1 500 Internal Server Error");

	$de = '';
	$para = @@tri_correo_desarrollador_cc;
	$cc =  @@tri_destinatarios_copias_cc;
	$bcc = @@tri_correo_desarrollador_bcc;
	$asunto = "PROBLEMA DE ASIGNACION DE TALLER";
	$texto .= '<p align="justify">"No existe el taller" ' . $mail_responsa_taller . '</tipo>
</p>';

	$plantilla_rec = 'Plantilla_mail.html';
	@@envio_mail_t1 = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' =>
	$texto));
	echo ("Correo enviado - No existe el taller " . $mail_responsa_taller);
	die();
}


