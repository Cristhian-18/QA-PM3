<?php
@@sql = '';
@@SQL = '';
$cnx = "1665078345d09b448804c01043460634";
$app_uid =  @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status =  'SOLICITADO';
$fecha_solicitud =  @@frm_fecha_solicitud;
$solicitante =  @@USER_LOGGED;
$ccostos =  @@frm_solicitante_ccostos;
$presupuesto_anio =  @@presupuesto_anio;
$uid_jefecc =  @@uid_jefecc;
$gerencia =  @@frm_solicitante_gerencia;
$sucursal =  @@frm_solicitante_sucursal;
$ruc = @@frm_proveedor_ruc;
$nom = @@frm_proveedor_nombre;

$total = @@frm_valor_total;
$subtotal = @@frm_valor_subtotal;
$iva = @@frm_valor_iva;

$accion = 'INGRESADA';

$sql = "INSERT INTO COM_SOLICITUD_PAGO (
  APP_UID,
  APP_NUMBER,
  APP_STATUS,
  FECHA_SOLICITUD,
  SOLICITANTE,
  CCOSTOS,
  PRESUPUESTO_ANIO,
  UID_JEFECC,
  GERENCIA,
  SUCURSAL,
  ACCION,
  SUBTOTAL,
  IVA,
 TOTAL,
 RUC_PROVEEDOR,
 NOM_PROVEEDOR 
) 
VALUES
  (
    '$app_uid',
    '$app_number',
    '$app_status',
    '$fecha_solicitud',
    '$solicitante',
    '$ccostos',
    '$presupuesto_anio',
    '$uid_jefecc',
    '$gerencia',
    '$sucursal',
    '$accion',
	'$subtotal',
	'$iva',
	'$total',
'$ruc',
'$nom'
	) ";
@@sql = $sql;
$rs = executeQuery($sql,$cnx);