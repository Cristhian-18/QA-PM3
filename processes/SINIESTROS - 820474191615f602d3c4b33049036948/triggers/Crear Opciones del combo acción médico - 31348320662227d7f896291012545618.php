<?php
//created by Henry
//Crear Opciones del combo acción médico
try {
	if (@@tri_bandera_Negado_medico == 'true') {
		@@frm_accion_aux = array(
			array('REGRESAR', 'Regresar la respuesta del caso negado')
		);
	} else {
		@@frm_accion_aux = array(
			array('MEDICO', 'Esperar en la auditoria médica'),
			array('DEVOLVER', 'Devolver el caso al auditor técnico por aclaración'),
			array('APROBAR', 'Auditoría Aprobada'),
			array('NEGAR', 'Auditoría Negada')
		);
	}
} catch (Exception $e) {

	$errorMessage =  $e->getMessage();
}
