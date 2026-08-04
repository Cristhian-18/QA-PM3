<?php
//vs1
$cnx = "1479570925ec29f1d8d1d57019959618";
$app_uid =  @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status =  ' ';
$fecha_creacion = getCurrentDate().' '.getCurrentTime();
$tipo_id=@@frm_tipo_identificacion_pagador ;
$cli_identificacion=@@frm_cedula_pagador;
$cli_nombres=@@frm_nombre_pagador;
$cli_apellidos=@@frm_apellidos_pagador;
$cli_correo=@@frm_correo_electronico_personal;
$cli_telefono=@@frm_celular;
$cli_medio_pago=@@frm_medio_pago_label;
$ban_id=@@frm_entidad_financiera;
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
$pago_anticipado=@@frm_recibio_deposito;

$sql_d = "SELECT COUNT(*) AS contar FROM VV_AUTORIZACIONES_DEBITO
WHERE APP_UID = '$app_uid'
AND APP_NUMBER = '$app_number'";
$rs_d = executeQuery($sql_d,$cnx);
$contar = $rs_d[1]['contar'];
$sql_d = "UPDATE VV_AUTORIZACIONES_DEBITO
	SET
	APP_STATUS = 'DEBITO-ACTUALIZADO',
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
	CANAL = 'ESPECIALISTA'
	WHERE APP_UID = '$app_uid'
	AND APP_NUMBER = '$app_number'
	";

$rs_d = executeQuery($sql_d,$cnx);

@@tmp_sql_d = $sql_d ;

