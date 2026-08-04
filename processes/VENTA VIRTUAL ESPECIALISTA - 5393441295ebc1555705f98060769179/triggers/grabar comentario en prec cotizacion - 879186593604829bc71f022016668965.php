<?php
$cedula = @@frm_numero_identificacion;	
$eqfxcli = @@ajx_eqfx_cliente_tipo;
$eqfxdcli = @@ajx_eqfx_cliente_tipo_label;
$rcs = @@tri_rcs_v1_estado;
$civil = @@frm_estado_civil;
$cliente = @@tri_cliente_nombres;

$accion = (@@tri_ruta_cot == 'EQUIFAX' ? 'Calificación Pagador' :@@tri_ruta_cot);

$comentario = "El candidato $cliente con Identificación $cedula  tiene un score $eqfxdcli ($eqfxcli) resultado de control RCS $rcs";
//$comentario = " El candidato $cliente con Identificación $cedula resultado de control RCS $rcs";

$comentario_conyuge= '';
if ($civil == 2 || $civil == 5){
	$conyuge = @@frm_conyuge_numero_identificacion;	
	$rcsconyuge = @@tri_rcs_v1_conyuge_estado;
	$conyugenom = @@tri_conyuge_nombres; 
	$comentario = $comentario . "<br>Conyuge de candidato $conyugenom con Identificación $conyuge resultado de control RCS $rcsconyuge";	
}


$tercero = @@frm_pago_terceros;
if ($tercero  == 'S'){
	$pagador = @@tri_pagador_nombres;
	$cedulatercero = @@frm_cedula_pagador;	
	$eqfxtercero   = @@ajx_eqfx_pagador_tipo;
	$eqfxdtercero  = @@ajx_eqfx_pagador_tipo_label;
	$comentario = $comentario . "<br>Pagador $pagador con Identificación $cedulatercero tiene un score $eqfxdtercero ($eqfxtercero)";	
}


$comentario = $comentario . "<br>Resultado de aprobacion $accion";
@@frm_accion = $accion;
@@frm_comentario = $comentario;