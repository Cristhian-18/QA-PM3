<?php
//<?phpcreated by Henry
//Consultar Bandera Mes
try {
	$cnx = '11264850561d723f004d5c2072943786';
	$process = @@PROCESS;

	$sql = "SELECT id, bandera FROM SINIESTRO_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_CONFIGURACION)";

	$rs = executeQuery($sql, $cnx);

	$id_bandera = $rs['1']['bandera'];
	@@tri_bandera_cierreMes = $id_bandera;

	//validacion de bandera cierre mes
	if ($id_bandera == 'SI') {
		@@frm_accion = 'CIERRE';
		@@tri_estado_evento = 10;
		//validacion documentos
		if (@@frm_check_documentos == 'NO') {
			@@frm_accion = 'CIERRE_DOCS';
		}
	} else {
		if (@@frm_check_documentos == 'NO') {
			@@frm_accion = 'ESPERAR';
			@@tri_estado_evento = 11;
		} else {
			@@frm_accion = 'CONTINUAR';
			@@tri_estado_evento = 2;
		}
	}
} catch (Exception $e) {

	$errorMessage =  $e->getMessage();
}
