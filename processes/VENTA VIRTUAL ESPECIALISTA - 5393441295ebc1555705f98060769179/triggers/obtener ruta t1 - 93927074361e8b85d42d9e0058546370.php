<?php
//<?php

//consultamos si existe una solicitud ya ingresada y validada por magnum
$identifica = @@frm_numero_identificacion;
$sql = "SELECT COUNT(APP_NUMBER) AS total_casos FROM PMT_VV_MAGNUM WHERE FRM_NUMERO_IDENTIFICACION = '$identifica' AND TRI_DECISION_MAGNUM != ''";
$rs = executeQuery($sql);

$valida_magnum = ($rs['1']['total_casos'] > 0 ? 'true' : 'false');
@@tri_bandera_magnum = $valida_magnum;

/*
if (@@ajx_eqfx_cliente_tipo == 'D' && @@frm_pago_terceros == 'N')
{
	@@ajx_eqfx_cliente_estado = 'PENDIENTE';
}	
*/
@@tri_rcs_error = 'n';
@@tri_rcs_error_c = 'n';
if (@@tri_rcs_error != 'SI' && @@tri_rcs_error_c != 'SI'){
	$accion = 'PASA';
	if (@@eqfx_pagador_tipo == 'D'&& @@frm_tiene_tarjeta == 'NO' )
	{
		@@ajx_eqfx_pagador_estado = 'PENDIENTE';
		$accion = 'PENDIENTE';
	}else{
		if(@@ajx_eqfx_validacion == 'true'){
			@@ajx_eqfx_pagador_estado = 'PENDIENTE';
			$accion = 'PENDIENTE';
			@@tri_ruta_aprobacion = 'APROBADO';
		}
	}
	/*

$eqfx_cliente =(@@ajx_eqfx_cliente_estado == ''? 'PASA' : @@ajx_eqfx_cliente_estado );
$eqfx_pagador =(@@ajx_eqfx_pagador_estado == ''? 'PASA' : @@ajx_eqfx_pagador_estado );

$accion = ($eqfx_cliente == 'NOPASA' || $eqfx_pagador == 'NOPASA' ? 'NOPASA' : $accion );
//$accion = ($eqfx_cliente == 'NOPASA' && $eqfx_pagador == 'PASA' ? 'PASA' : $accion );
$accion = ($eqfx_cliente == 'PENDIENTE' || $eqfx_pagador == 'PENDIENTE'? 'PENDIENTE' : $accion);
$accion = ($eqfx_cliente == 'PASA' && $eqfx_pagador == 'PASA'? 'PASA' : $accion);
$accion = ($eqfx_cliente == 'PENDIENTE' && $eqfx_pagador == 'PASA'? 'PENDIENTE' : $accion);
*/
	@@accion_eqfx = $accion ;

	$mensaje = ($accion == 'NOPASA'? 'Esta operación no ha sido Aprobada. El caso se cerrará automáticamente.' :'');
	$mensaje = ($accion == 'PENDIENTE'? 'Esta operación se encuentra en Análisis del Director Comercial. Pronto recibirá la respuesta' : $mensaje);

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
	$mensaje1 = ($accion1 == 'PENDIENTE'? 'Cliente en validación de la unidad de cumplimiento espere su autorización,<br><br>este es un mensaje interno que NO debe ser comunicado al cliente.' : '');

	$rutat1 = 'CONTINUAR';

	if (@@accion_rcs == 'PENDIENTE'){
		if (@@tri_ruta_aprobacion == '') 			$rutat1 ='RCS2' ;
		if (@@tri_ruta_aprobacion == 'APROBADO') 	$rutat1 ='CONTINUAR' ;	
		if (@@tri_ruta_aprobacion == 'RECHAZADO') 	$rutat1 ='RECHAZADO' ;	
		if (@@tri_ruta_aprobacion == 'PENDIENTE') 	$rutat1 ='RCS2' ;
	}
	
	//validacion para magnum
	if ($valida_magnum == 'true'){
		$rutat1 = 'SUSCRIPTOR';
	}

	$accion_eqfx = @@accion_eqfx;
	if ($accion_eqfx == 'PENDIENTE' && $rutat1 == 'CONTINUAR'){
		if (@@decision_dir_eqfx == '') $rutat1 ='EQUIFAX' ;
		if (@@decision_dir_eqfx == 'APROBADO') $rutat1 ='CONTINUAR' ;	
		if (@@decision_dir_eqfx == 'RECHAZADO') $rutat1 ='RECHAZADO' ;	
		if (@@decision_dir_eqfx == 'PENDIENTE') $rutat1 ='EQUIFAX' ;
	}	

	$rutat1 = ((@@eqfx_pagador_tipo == 'E' ) ? 'RECHAZADO' : $rutat1 );
	
	$rutat1 = 'CONTINUAR';

	switch ($rutat1) {
		case 'EQUIFAX':
			@@tri_mensaje = 'Esta operación se encuentra en Análisis del Director Comercial. Pronto recibirá la respuesta';
			@@tri_rcs_label = 'Pendiente Aprobacion Pagador';
			break;
		case 'CONTINUAR':
			@@tri_mensaje = 'CLIENTE CONTINUA';
			@@tri_rcs_label = '';
			break;
		case 'RCS2':
			@@tri_mensaje = 'Cliente en validación de la unidad de cumplimiento espere su autorización,<br> <br>este es un mensaje interno que NO debe ser comunicado al cliente.';
			@@tri_rcs_label = 'Validación cumplimiento';
			break;
		case 'RECHAZADO':
			@@tri_mensaje = 'Esta operación no ha sido Aprobada. El caso se cerrará automáticamente';
			@@tri_rcs_label = 'No Aprobado';
			break;
		case 'SUSCRIPTOR':
			@@tri_mensaje = 'Cliente en validación de la unidad de suscripción espere su autorización,<br> <br>este es un mensaje interno que NO debe ser comunicado al cliente';
			@@tri_rcs_label = '';
			$rutat1 = 'CONTINUAR';
			break;
	}
}else{
	$rutat1 = 'ERROR';
	@@tri_mensaje = 'El proceso de esta operación se encuentre Pendiente. Por favor espere un momento e intente nuevamente.<br><br>Si el problema persiste comuniquese con el área de soporte.';
	@@tri_rcs_label = '';
	@@frm_frecuencia_cotizacion_aux = @@frm_frecuencia_cotizacion;
}

@@tri_ruta_cot = $rutat1;
