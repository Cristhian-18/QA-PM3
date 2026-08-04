<?php
$cnx = '7477305145e37562849cda7003565620';
$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status = 'INGRESADO';
@@frm_estado = $app_status;

$frm_cliente_cedula = @@frm_cliente_cedula;
$frm_cliente_celular = @@frm_cliente_celular;
$frm_cliente_email = @@frm_cliente_email;
$frm_cliente_estadocivil = @@frm_cliente_estadoCivil;
$frm_cliente_fechanacimiento = @@frm_cliente_fechaNacimiento;
$frm_cliente_nombre = @@frm_cliente_nombre;
$frm_cliente_apellidoPaterno = @@frm_cliente_apellidoPaterno;
$frm_cliente_apellidoMaterno = @@frm_cliente_apellidoMaterno;
$frm_cliente_direccion = @@frm_cliente_direccion;

$frm_prima = trim(@@frm_prima);
$frm_producto = @@frm_producto;
$frm_monto = @@frm_monto;


$frm_vendedor = @@frm_uid_vendedor;
$frm_vendedor_nombre = @@frm_vendedor_nombre;
$frm_vendedor_dpto = @@frm_vendedor_nombre;

//$rse = executeQuery("delete from PE_TICKET where APP_UID = '$app_uid'");

$sql = "INSERT INTO PE_TICKET (
  APP_UID,
  APP_NUMBER,
  APP_STATUS,
  CLIENTE_CEDULA,
  CLIENTE_NOMBRE,
  CLIENTE_APELLIDO_PATERNO,
  CLIENTE_APELLIDO_MATERNO,  
  CLIENTE_CELULAR,
  CLIENTE_EMAIL,
  CLIENTE_ESTADOCIVIL,
  CLIENTE_FECHANACIMIENTO,
  CLIENTE_DIRECCION,
  CLIENTE_INGRESOS,
  CLIENTE_OTROSINGRESOS,
  CLIENTE_TOTAL_INGRESOS,
  CAPACIDAD_PAGO,
  PRODUCTO,
  MODALIDAD_PAGO,
  PRIMA,
  MONTO,
  EDAD,
  FECHA_COTIZACION,
  VENDEDOR_UID,
  VENDEDOR_NOMBRE
  
) 
VALUES (
    '$app_uid',
    '$app_number',
    '$app_status',
    '$frm_cliente_cedula',
    '$frm_cliente_nombre',
    '$frm_cliente_apellidoPaterno',
    '$frm_cliente_apellidoMaterno',	
    '$frm_cliente_celular',
    '$frm_cliente_email',
    '$frm_cliente_estadocivil',
    '$frm_cliente_fechanacimiento',
    '$frm_cliente_direccion',	
    '$frm_cliente_ingresos',
    '$frm_cliente_otrosingresos',
    '$frm_ingresos_familiar',
    '$frm_capacidad_pago',
    '$frm_producto',
    '$frm_modalidad_pago',
    '$frm_prima',
    '$frm_monto',
	$edad,
	now(),
    '$frm_vendedor',
    '$frm_vendedor_nombre')" ;

//@@djins = $sql;
$rs = executeQuery($sql,$cnx);
@@sw_ins_t1 = $rs;

//@@djins = @@frm_cliente_edad;
