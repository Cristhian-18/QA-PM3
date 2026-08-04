<?php
//<?php 

$accion2 = '';
if (@@tri_rcs_v1_estado == 'PENDIENTE'){
	@@tri_comentario = 'Respuesta de RCS_2 cliente '.@@tri_rcs_v2_estado;
	@@TMP_ENTRAc = 'Si_rcscli';
	$accion2 = (@@tri_rcs_v2_codestado == 'R' ? 'RECHAZADO' : 'PENDIENTE');
	$accion2 = (@@tri_rcs_v2_codestado == 'A' ? 'APROBADO' : $accion2);
	$accion2 = (@@tri_rcs_v2_codestado == 'P' ? 'PENDIENTE' : $accion2);	
}

if (@@tri_rcs_v1_conyuge_estado == 'PENDIENTE'){
	@@TMP_ENTRA = 'Si_rcscony';
	@@tri_comentario .= ' Respuesta de RCS_2 Conyuge '.@@tri_rcs_v2_conyuge_estado;
	if ($accion2 == 'APROBADO' || $accion2 == '' ){
		$accion2 = (@@tri_rcs_v2_conyuge_codestado == 'R' ? 'RECHAZADO' : $accion2);
		$accion2 = (@@tri_rcs_v2_conyuge_codestado == 'A' ? 'APROBADO' : $accion2);
		$accion2 = (@@tri_rcs_v2_conyuge_codestado == 'P' ? 'PENDIENTE' : $accion2);	
	}
}

// PARA LAS PRUEBAS
//$accion2 = 'APROBADO';

@@tri_ruta_aprobacion = $accion2;
@@tri_comentario .= ' Resultado '.@@tri_ruta_aprobacion;

// controlar sla  termina si el contador es menor al sla controlado por numero de minutos
$contador = @@tri_contador_rcs2;
$contador = $contador + 1 ;

@@tri_contador_rcs2 = $contador;
//if ($contador < 4   ){ die();}
	
	

@@tri_comm_rcs = ($accion2 == 'RECHAZADO' ? 'cliente no admisible RCS' : @@tri_comm_rcs);

// para los mensajes 
@@texto_rcs = '';
if (@@tri_rcs_v1_estado == 'PENDIENTE') {
	@@texto_rcs = "cliente con identificación: ".@@frm_numero_identificacion.' Nombre: '.@#tri_cliente_nombres;
}
if (@@tri_rcs_v1_conyuge_estado == 'PENDIENTE') {
	@@texto_rcs .= 'y conyuge con Identificacion: '.@@frm_conyuge_numero_identificacion.' Nombre: '.@#tri_conyuge_nombres;
}

