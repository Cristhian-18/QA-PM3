<?php
$cnx = '7477305145e37562849cda7003565620';
$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status = 'INGRESADO';
@@frm_estado = $app_status;
$frm_capacidad_pago = @@frm_capacidad_pago;
$frm_cliente_cedula = @@frm_cliente_cedula;
$frm_cliente_celular = @@frm_cliente_celular;
$frm_cliente_email = @@frm_cliente_email;
$frm_cliente_estadocivil = @@frm_cliente_estadoCivil;
$frm_cliente_fechanacimiento = @@frm_cliente_fechaNacimiento;
$frm_cliente_nombre = @@frm_cliente_nombre;
$frm_cliente_apellidoPaterno = @@frm_cliente_apellidoPaterno;
$frm_cliente_apellidoMaterno = @@frm_cliente_apellidoMaterno;
$frm_cliente_direccion = @@frm_cliente_direccion;
$frm_cliente_ingresos = @@frm_cliente_ingresos;
$frm_cliente_otrosingresos = (@@frm_cliente_otrosIngresos == '' ? '0' : @@frm_cliente_otrosIngresos);
$frm_ingresos_familiar = @@frm_ingresos_familiar;
$frm_modalidad_pago = @@frm_tipo_consulta;
$frm_prima = trim(@@frm_prima);
$frm_producto = @@frm_producto;
$frm_monto = @@frm_monto;
$edad = @@frm_cliente_edad;

$frm_vendedor = @@frm_uid_vendedor;
$frm_vendedor_nombre = @@frm_vendedor_nombre;



$sql = "UPDATE PE_TICKET SET 
  APP_NUMBER = 	'$app_number',
  APP_STATUS = 	'$app_status',
  CLIENTE_CEDULA = 	'$frm_cliente_cedula',
  CLIENTE_NOMBRE = 	'$frm_cliente_nombre',
  CLIENTE_APELLIDO_PATERNO = 	'$frm_cliente_apellidoPaterno',
  CLIENTE_APELLIDO_MATERNO = 	'$frm_cliente_apellidoMaterno',	
  CLIENTE_CELULAR = 	'$frm_cliente_celular',
  CLIENTE_EMAIL =	'$frm_cliente_email',
  CLIENTE_ESTADOCIVIL = 	'$frm_cliente_estadocivil',
  CLIENTE_FECHANACIMIENTO = 	'$frm_cliente_fechanacimiento',
  CLIENTE_DIRECCION = 	'$frm_cliente_direccion',	
  CLIENTE_INGRESOS = '$frm_cliente_ingresos',
  CLIENTE_OTROSINGRESOS = '$frm_cliente_otrosingresos',
  CLIENTE_TOTAL_INGRESOS = '$frm_ingresos_familiar',
  CAPACIDAD_PAGO = '$frm_capacidad_pago',
  PRODUCTO = '$frm_producto',
  MODALIDAD_PAGO = '$frm_modalidad_pago',
  PRIMA = '$frm_prima',
  MONTO = '$frm_monto',
  EDAD = $edad,
  FECHA_COTIZACION = now(),
  VENDEDOR_UID = '$frm_vendedor',
  VENDEDOR_NOMBRE = '$frm_vendedor_nombre'
  WHERE   APP_UID =  	'$app_uid'" ;

$rs = executeQuery($sql,$cnx);
