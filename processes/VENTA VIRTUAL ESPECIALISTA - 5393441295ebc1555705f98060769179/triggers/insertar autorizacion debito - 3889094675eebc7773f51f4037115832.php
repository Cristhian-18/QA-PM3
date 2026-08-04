<?php
//created by Fausto Loja
//insercion datos de autorizaciones de débito
$cnx = "1479570925ec29f1d8d1d57019959618";
$app_uid =  @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status =  'APROBADO';
$fecha_creacion = getCurrentDate().' '.getCurrentTime();
$tipo_id=@@frm_tipo_identificacion_pagador ;
$cli_identificacion=@@frm_cedula_pagador;
$cli_nombres=@@frm_nombre_pagador;
$cli_apellidos=@@frm_apellidos_pagador;
$cli_correo=@@frm_correo_electronico_debito;
$cli_telefono=@@frm_celular_debito;
$cli_medio_pago=@@frm_medio_pago_label;
$ban_id=(@@frm_entidad_financiera == ''? 0 : @@frm_entidad_financiera);
$ban_nombre=@@frm_entidad_financiera_label;
$numero_cuenta=@@frm_numero_tarjeta;
$tipo_tarjeta=@@frm_tipo_tarjeta;
$fecha_caducidad=(@@frm_fecha_caducidad_tarjeta == '' ? '2020-01-01': @@frm_fecha_caducidad_tarjeta);
$monto=@@frm_monto;
$frecuencia_pago=@@frm_frecuencia_pago;
$ven_identificacion=@@frm_vendedor_identificacion ;
$ven_nombres=@@frm_vendedor_nombre;
$ven_correo=@@frm_vendedor_email;
$ven_celular=@@frm_vendedor_telefono;
$ven_estado=@@frm_respuesta_cliente;

// primer pago_anticipado
$pago_anticipado=@@frm_recibio_deposito;
$frm_deposito_medio =  @@frm_deposito_medio;
$monto_provisional = (@@frm_provisional_saldo_inicial == ''? 0 : @@frm_provisional_saldo_inicial);
$estado_pago = ($pago_anticipado == 'S' ? 'PAGADO' :'PENDIENTE');
$estado_pago = ($frm_deposito_medio == 'PAGOSMEDIOS' ? 'PENDIENTE' : $estado_pago);
$primer_pago_medio = ($frm_deposito_medio == 'PAGOSMEDIOS' ? 'TARJETA' : $frm_deposito_medio);

$frm_banco_equivida = @@frm_banco_equivida;
$frm_banco_ccontable = @@frm_banco_ccontable;
$frm_deposito_comprobante = @@frm_deposito_comprobante;
$frm_deposito_fecha = @@frm_deposito_fecha;


$primer_pago_modalidad = @@frm_provisional_tipo_tarjeta;
$primer_pago_plan = @@frm_provisional_plan_pago;
$primer_pago_subtotal = @@frm_provisional_pago;
$primer_pago_dscto = @@frm_provisional_descuento;
$primer_pago_total = @@frm_monto_deposito_provisional;

$primer_pago_subtotal = ($primer_pago_subtotal == ''? 0.0 : $primer_pago_subtotal);
$primer_pago_dscto = ($primer_pago_dscto == ''? 0.0 : $primer_pago_dscto);
$primer_pago_total = ($primer_pago_total == '' ? 0.0 : $primer_pago_total);


// 1	Domicilio
// 0	Trabajo
$direccion = "";
if(@@frm_trabajo_envio_correspondencia == 1){
	//	$direccion.=@@frm_barrio.", ";
	$direccion.=@@frm_calle_principal." ";
	//	$direccion.=@@frm_calle_transversal.", ";
	$direccion.=@@frm_numero." ";
	//	$direccion.=@@frm_conjunto_edificio.", ";
	//	$direccion.=@@frm_departamento_casa;
}else{
	//	$direccion.=@@frm_trabajo_sector_barrio.", ";
	$direccion.=@@frm_trabajo_calle_principal." ";
	//	$direccion.=@@frm_trabajo_calle_transversal.", ";
	$direccion.=@@frm_trabajo_numero." ";
	//	$direccion.=@@frm_trabajo_edificio.", ";
	//	$direccion.=@@frm_trabajo_oficina;
}

$tipoPersona = "";
switch (@@frm_tipo_identificacion_pagador) {
	case "C":
		$tipoPersona = "NATURAL";
		break;
	case "R":
		$tipoPersona = "JURIDICA";
		break;
	case "P":
		$tipoPersona = "NATURAL";
		break;
	default:
		$tipoPersona = "";
}

$impuestos = 0; //iva = 0.12;
$monto_con_impuestos =  0;
//@@frm_monto * (1 + $impuestos);

$sql_d = "SELECT COUNT(*) AS contar FROM VV_AUTORIZACIONES_DEBITO
WHERE APP_UID = '$app_uid'
AND APP_NUMBER = '$app_number'
";
$rs_d = executeQuery($sql_d,$cnx);
$contar = $rs_d[1]['contar'];


//$link_pago = @@link_idPago; //<- traigo de trigger "crear link de pago"
$link_pago = @@link_url; //<- traigo de trigger "crear link de pago"
//tabla de poliza
if($contar*1 == 0){
	$sql_d = "INSERT INTO VV_AUTORIZACIONES_DEBITO (
	APP_UID ,
	APP_NUMBER ,
	APP_STATUS ,
	FECHA_CREACION ,
	FECHA_ATENCION ,
	CLI_TIPO_ID ,
	CLI_IDENTIFICACION ,
	CLI_NOMBRES ,
	CLI_APELLIDOS ,
	CLI_CORREO ,
	CLI_TELEFONO ,
	MEDIO_PAGO ,
	BAN_NOMBRE ,
	BAN_ID ,
	NUMERO_CUENTA,
	TIPO_TARJETA,
	FECHA_CADUCIDAD,
	MONTO ,
	FRECUENCIA_PAGO ,
	VEN_IDENTIFICACION,
	VEN_NOMBRES ,
	VEN_CORREO ,
	VEN_CELULAR ,
	ESTADO,	
	CANAL,
	PAGO_ANTICIPADO,
	CLI_TIPO_PERSONA,
	CLI_DIRECCION,
	PRIMER_PAGO_MEDIO,
	PRIMER_PAGO_MODALIDAD,
	PRIMER_PAGO_PLAN,
	PRIMER_PAGO_SUBTOTAL,
	PRIMER_PAGO_DSCTO,
	PRIMER_PAGO_TOTAL,	
	IMPUESTOS,
	MONTO_CON_IMPUESTOS,
	ESTADO_PAGO,
	MEDIO_PAGO_PRIMER,
	BANCO_EQUIVIDA,
	CUENTA_CONTABLE,
	NUMERO_REFERENCIA,
	FECHA_CONFIRMACION,
	MONTO_PROVISIONAL,
	PRIMER_PAGO_FECHA_PAGO,
	LINK_PAGO
	) 
	VALUES
	('$app_uid',
	'$app_number',
	'$app_status',
	'$fecha_creacion',
	'$fecha_creacion',
	'$tipo_id',
	'$cli_identificacion',
	'$cli_nombres',
	'$cli_apellidos',
	'$cli_correo',
	'$cli_telefono',
	'$cli_medio_pago',
	'$ban_nombre',
	'$ban_id',
	'$numero_cuenta',
	'$tipo_tarjeta',
	'$fecha_caducidad',
	'$monto',
	'$frecuencia_pago',
	'$ven_identificacion',
	'$ven_nombres',
	'$ven_correo',
	'$ven_celular',
	'$ven_estado',
	'ESPECIALISTA',
	'$pago_anticipado',
	'$tipoPersona',  
	'$direccion',
	'$primer_pago_medio',
	'$primer_pago_modalidad',
	'$primer_pago_plan',
	'$primer_pago_subtotal',
	'$primer_pago_dscto',
	'$primer_pago_total',
	'$impuestos',
	'$monto_con_impuestos',
	'$estado_pago',
	'$frm_deposito_medio',
	'$frm_banco_equivida',
	'$frm_banco_ccontable',
	'$frm_deposito_comprobante',
	'$frm_deposito_fecha',
	$monto_provisional,
	'$frm_deposito_fecha',
	'$link_pago'
	)";

	$rs_d = executeQuery($sql_d,$cnx);

}else{

	$sql_d = "UPDATE VV_AUTORIZACIONES_DEBITO
	SET 
	APP_STATUS = '$app_status',
	FECHA_CREACION = '$fecha_creacion',
	FECHA_ATENCION = '$fecha_creacion',
	CLI_TIPO_ID = '$tipo_id',
	CLI_IDENTIFICACION = '$cli_identificacion',
	CLI_NOMBRES = '$cli_nombres',
	CLI_APELLIDOS = '$cli_apellidos',
	CLI_CORREO = '$cli_correo',
	CLI_TELEFONO = '$cli_telefono',
	MEDIO_PAGO = '$cli_medio_pago',
	BAN_NOMBRE = '$ban_nombre',
	BAN_ID = '$ban_id',
	NUMERO_CUENTA = '$numero_cuenta',
	TIPO_TARJETA = '$tipo_tarjeta',
	FECHA_CADUCIDAD = '$fecha_caducidad',
	MONTO = '$monto',
	FRECUENCIA_PAGO = '$frecuencia_pago',
	VEN_IDENTIFICACION = '$ven_identificacion',
	VEN_NOMBRES = '$ven_nombres',
	VEN_CORREO = '$ven_correo',
	VEN_CELULAR = '$ven_celular',
	ESTADO = '$ven_estado',
	CANAL = 'ESPECIALISTA',
	PAGO_ANTICIPADO = '$pago_anticipado',
	
	PRIMER_PAGO_MEDIO = '$primer_pago_medio',
	PRIMER_PAGO_MODALIDAD = '$primer_pago_modalidad',
	PRIMER_PAGO_PLAN =	'$primer_pago_plan',
	PRIMER_PAGO_SUBTOTAL = '$primer_pago_subtotal',
	PRIMER_PAGO_DSCTO = '$primer_pago_dscto',
	PRIMER_PAGO_TOTAL = '$primer_pago_total',

	CLI_TIPO_PERSONA = '$tipoPersona',
	CLI_DIRECCION = '$direccion',
	IMPUESTOS = '$impuestos',
	MONTO_CON_IMPUESTOS = '$monto_con_impuestos',
	ESTADO_PAGO = '$estado_pago',
	CASO_RECHAZADO = 'SI',
	MEDIO_PAGO_PRIMER = '$frm_deposito_medio',
	BANCO_EQUIVIDA = '$frm_banco_equivida',
	CUENTA_CONTABLE = '$frm_banco_ccontable',
	NUMERO_REFERENCIA = '$frm_deposito_comprobante',
	FECHA_CONFIRMACION = '$frm_deposito_fecha',
	MONTO_PROVISIONAL = $monto_provisional,
	PRIMER_PAGO_FECHA_PAGO = '$frm_deposito_fecha',
	LINK_PAGO = '$link_pago'
	WHERE APP_UID = '$app_uid'
	AND APP_NUMBER = '$app_number'
	";

	$rs_d = executeQuery($sql_d,$cnx);	
}

@@tmp_sql_d = $sql_d ;
