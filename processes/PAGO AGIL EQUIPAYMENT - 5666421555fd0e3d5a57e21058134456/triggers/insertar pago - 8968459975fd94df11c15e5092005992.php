<?php

$cnx = "8278346505fd796227e6981083172008";
$app_uid = @@APPLICATION   ;
$app_number = @@APP_NUMBER   ;
$app_status = (@@frm_accion == 'CONTINUAR'? 'ABIERTO':'CERRADO');

$cli_tipo_id = @@frm_cliente_tipo_identificacion   ;
$cli_identificacion = @@frm_cliente_cedula   ;
$cli_nombres = @@frm_cliente_nombre.' '.@@frm_cliente_segundo_nombre   ;
$cli_apellidos = @@frm_cliente_apellidoPaterno.' '.@@frm_cliente_apellidoMaterno   ;
$cli_correo = @@frm_cliente_email   ;
$cli_telefono = @@frm_cliente_celular   ;
$cli_direccion= @@frm_cliente_direccion;

$ven_uid = @@USER_LOGGED;
$ven_identificacion= @@frm_vendedor_identificacion   ;
$ven_nombres = @@frm_vendedor_nombre   ;
$ven_correo = @@frm_vendedor_email   ;
$ven_celular = @@frm_vendedor_telefono   ;

$pago_estado= (@@frm_accion == 'CONTINUAR'? 'PENDIENTE':@@frm_pago_medios_estado);
//$pago_estado = (@@frm_pago_medios_estado == '' ? 'PENDIENTE' : @@frm_pago_medios_estado);
$pago_proceso= @@frm_proceso   ;
$pago_proceso_detalle = @@frm_proceso_label   ;
$pago_concepto= @@frm_concepto   ;
$pago_concepto_detalle = @@frm_concepto_label   ;
$pago_subtotal= @@frm_primera_cuota_total_primer_pago   ;
$pago_dscto= @@frm_primera_cuota_descuento   ;
$pago_total = @@frm_primera_cuota_total_pagar   ;
$comentario = @@frm_comentario;

$link_pago = @@link_url;

$tipoPersona = "";
switch ($cli_tipo_id) {
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

$sql_d = "SELECT COUNT(*) AS contar FROM PA_PAGOS
WHERE APP_UID = '$app_uid'";
$rs_d = executeQuery($sql_d,$cnx);
$contar = $rs_d[1]['contar'];

//tabla de poliza
if($contar*1 == 0)
{
	$sql_d = "INSERT INTO PA_PAGOS (
	APP_UID ,
	APP_NUMBER ,
	APP_STATUS ,
	FECHA_CREACION ,
	CLI_TIPO_ID ,
	CLI_TIPO_PERSONA,
	CLI_IDENTIFICACION ,
	CLI_NOMBRES ,
	CLI_APELLIDOS ,
	CLI_CORREO ,
	CLI_TELEFONO ,
	CLI_DIRECCION,

	VEN_UID,
	VEN_IDENTIFICACION,
	VEN_NOMBRES ,
	VEN_CORREO ,
	VEN_CELULAR ,

	PAGO_ESTADO,	
	PAGO_PROCESO,
	PAGO_PROCESO_DES,	
	PAGO_CONCEPTO,
	PAGO_CONCEPTO_DES,	
	PAGO_SUBTOTAL,
	PAGO_DSCTO,
	PAGO_TOTAL,
	PAGO_OBS,
	LINK_PAGO
	) 
	VALUES
	(
	'$app_uid' ,
	'$app_number' ,
	'$app_status' ,
	now() ,

	'$cli_tipo_id',
	'$tipoPersona',
	'$cli_identificacion' ,
	'$cli_nombres' ,
	'$cli_apellidos' ,
	'$cli_correo' ,
	'$cli_telefono' ,
	'$cli_direccion',

	'$ven_uid',
	'$ven_identificacion',
	'$ven_nombres' ,
	'$ven_correo' ,
	'$ven_celular' ,

	'$pago_estado',	
	'$pago_proceso',
	'$pago_proceso_detalle',	
	'$pago_concepto',
	'$pago_concepto_detalle',	
	'$pago_subtotal',
	'$pago_dscto',
	'$pago_total',
	'$comentario',
	'$link_pago'
	)";
}
else
{

	$sql_d = "UPDATE PA_PAGOS
	SET 
APP_STATUS = '$app_status' ,
CLI_TIPO_ID = '$cli_tipo_id' ,
CLI_TIPO_PERSONA= '$tipoPersona',
CLI_IDENTIFICACION = '$cli_identificacion' ,
CLI_NOMBRES = '$cli_nombres' ,
CLI_APELLIDOS = '$cli_apellidos' ,
CLI_CORREO = '$cli_correo' ,
CLI_TELEFONO = '$cli_telefono' ,
CLI_DIRECCION= '$cli_direccion',
VEN_UID = '$ven_uid',
VEN_IDENTIFICACION= '$ven_identificacion',
VEN_NOMBRES = '$ven_nombres' ,
VEN_CORREO = '$ven_correo' ,
VEN_CELULAR = '$ven_celular',
PAGO_ESTADO= '$pago_estado',	
PAGO_PROCESO= '$pago_proceso',
PAGO_CONCEPTO= '$pago_concepto',
PAGO_PROCESO_DES= '$pago_proceso_detalle',
PAGO_CONCEPTO_DES= '$pago_concepto_detalle',
PAGO_SUBTOTAL= '$pago_subtotal',
PAGO_DSCTO= '$pago_dscto',
PAGO_TOTAL= '$pago_total',
PAGO_OBS = '$comentario',
	LINK_PAGO = '$link_pago'
	WHERE APP_UID = '$app_uid'
	AND APP_NUMBER = '$app_number'
	";

}
$rs_d = executeQuery($sql_d,$cnx);

@@tmp_sql_d = $sql_d ;

