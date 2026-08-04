<?php
$resultado = @@frm_accion_label;
@@frm_resultadoNegociacion_resultado = $resultado;

$hoy = date("Y-m-d H:i:s");
@@frm_resultadoNegociacion_fechaUltimoEnvio = $hoy;

if($resultado == 'CONTINUAR'){
	@@frm_resultadoNegociacion_fechaAceptacion = $hoy;
}