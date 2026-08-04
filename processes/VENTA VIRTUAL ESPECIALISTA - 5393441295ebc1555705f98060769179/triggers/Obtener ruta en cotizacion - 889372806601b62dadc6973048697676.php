<?php
//<?PHP 
@@tri_ruta = '';
$error_ws = @@tri_rcs_error;
$error_ws_cony = @@tri_rcs_error_cony;
@@tmp_error_ws = strlen(@@tri_rcs_resultado);

if ($error_ws != 'SI' && $error_ws_cony != 'SI'){
	// decision sobre equifax

if (@@ajx_eqfx_cliente_tipo == 'D' && @@frm_pago_terceros == 'N')
{
	@@ajx_eqfx_cliente_estado = 'PENDIENTE';
}	

if (@@ajx_eqfx_pagador_tipo == 'D')
{
	@@ajx_eqfx_pagador_estado = 'PENDIENTE';
}		
	
	
$accion = 'PASA';
$eqfx_cliente =(@@ajx_eqfx_cliente_estado == ''? 'PASA' : @@ajx_eqfx_cliente_estado );
$eqfx_pagador =(@@ajx_eqfx_pagador_estado == ''? 'PASA' : @@ajx_eqfx_pagador_estado );
	
$accion = ($eqfx_cliente == 'NOPASA' || $eqfx_pagador == 'NOPASA' ? 'NOPASA' : $accion );
//$accion = ($eqfx_cliente == 'NOPASA' && $eqfx_pagador == 'PASA' ? 'PASA' : $accion );
$accion = ($eqfx_cliente == 'PENDIENTE' && $eqfx_pagador == 'PENDIENTE'? 'PENDIENTE' : $accion);
$accion = ($eqfx_cliente == 'PASA' && $eqfx_pagador == 'PASA'? 'PASA' : $accion);
$accion = ($eqfx_cliente == 'PASA' && $eqfx_pagador == ''? 'PASA' : $accion);
$accion = ($eqfx_cliente == 'PENDIENTE' && $eqfx_pagador == ''? 'PENDIENTE' : $accion);
	
@@accion_eqfx = $accion ;

$mensaje = ($accion == 'NOPASA'? 'Rechazado por Equifax' :'');
$mensaje = ($accion == 'PENDIENTE'? 'Pendiente de autorización por Equifax' : $mensaje);

	// quitar para cuandoe este equifax
	//$accion = 'APROBADO';

	// decision sobre risk
	$accion1 = 'APROBADO';

	// comentado para sprint 5
	$tri_rcs_v1_estado = (@@tri_rcs_v1_estado == '' ? 'APROBADO' : @@tri_rcs_v1_estado);
	$tri_rcs_v1_conyuge_estado = (@@tri_rcs_v1_conyuge_estado == '' ? 'APROBADO' : @@tri_rcs_v1_conyuge_estado);
	
//	$tri_rcs_v1_estado = 'APROBADO';
//	$tri_rcs_v1_conyuge_estado = 'APROBADO';

	$accion1 = ($tri_rcs_v1_estado == 'PENDIENTE' || $tri_rcs_v1_conyuge_estado == 'PENDIENTE' ? 'PENDIENTE' : $accion1);
	$accion1 = ($tri_rcs_v1_estado == 'APROBADO' && $tri_rcs_v1_conyuge_estado == 'APROBADO' ? 'APROBADO' : $accion1);
	$accion1 = ($tri_rcs_v1_estado == 'APROBADO' && $tri_rcs_v1_conyuge_estado == '' ? 'APROBADO' : $accion1);

	@@accion_rcs = $accion1 ;
	$mensaje1 = ($accion1 == 'PENDIENTE'? 'CLIENTE EN ANALISIS, NECESITA AUTORIZACION' : '');
/*
	// DECISION DE RUTA

	$ruta = '';
	$ruta = ($accion == 'PASA' && $accion1 == 'APROBADO' ? 'APROBADO' : 'PENDIENTE');
	$ruta = ($accion == 'PENDIENTE' || $accion1 == 'PENDIENTE' ? 'PENDIENTE' : $ruta);
	$ruta = ($accion == 'NOPASA' ? 'RECHAZADO' : $ruta);
	@@tri_comm_rcs = ($ruta != 'APROBADO'? 'Validacion RCS' : '');

	@@tri_ruta_cot = $ruta;
	@@tri_mensaje = '';
	@@tri_mensaje = $mensaje.'<br>'.$mensaje1;
	@@tri_contador_rcs2 = 0;
*/	
}
else
{
	@@tri_comm_rcs = 'Error en WS de RCS';
	@@tri_ruta_cot = 'ERROR';
	@@tri_mensaje  = 'Error de WS RCS';
}
