<?php
$cnx = "9883777355bd4040ead1301037184174";
$app_uid = @@APPLICATION ;
$app_number = @@APP_NUMBER ;
$orden_compra = @@frm_ordencompra_numero ;
$orden_pago = @@num_recepcion ;
$frm_fecha_pago = @@frm_pago_fecha ;
$frm_num_factura = @@frm_pago_numfactura ;
$frm_reg_contable = @@frm_pago_registro ;
$frm_valor_factura = @@frm_pago_valor ;
$frm_com_pago = @@frm_comentario ;
$usr_uid = @@USER_LOGGED ;

$sql = "INSERT INTO COM_PAGOS_BITACORA (
  APP_UID,
  APP_NUMBER,
  ORDEN_COMPRA,
  ORDEN_PAGO,  
  FRM_FECHA_PAGO,
  FRM_NUM_FACTURA,
  FRM_REG_CONTABLE,
  FRM_VALOR_FACTURA,
  FRM_COM_PAGO,
  USR_UID
) 
VALUES
  (
    '$app_uid',
    '$app_number',
    '$orden_compra',
    '$orden_pago',	
    '$frm_fecha_pago',
    '$frm_num_factura',
    '$frm_reg_contable',
    $frm_valor_factura,
    '$frm_com_pago',
    '$usr_uid'
  )" ;

$rs = executeQuery($sql,$cnx);

@@frm_pago_fecha = '' ;
@@frm_pago_numfactura = '' ;
@@frm_pago_registro = '' ;
@@frm_pago_valor = '' ;
