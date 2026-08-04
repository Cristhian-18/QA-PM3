<?php
//Inicializar datos min y max de fechas

$fecha_actual = date("Y-m-d");

//fecha de aceptacion
@@frm_resultadoNegociacion_fechaAceptacion_Mi = date("Y-m-d",strtotime($fecha_actual."- 1 month"));
@@frm_resultadoNegociacion_fechaAceptacion_Ma = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));

//fecha de ultimos
@@frm_resultadoNegociacion_fechaUltimoEnvio_Mi = date("Y-m-d",strtotime($fecha_actual."- 1 month"));
@@frm_resultadoNegociacion_fechaUltimoEnvio_Ma = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));

@@frm_datosEmision_fechaEmision = $fecha_actual;