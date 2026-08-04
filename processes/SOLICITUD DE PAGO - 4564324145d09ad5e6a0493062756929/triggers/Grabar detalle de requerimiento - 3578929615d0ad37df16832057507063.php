<?php
$cnx = "1665078345d09b448804c01043460634";
$i= 0;
$app_uid =   @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status = 'SOLICITADO';	
$ccostos = @@frm_solicitante_ccostos;

@@SQL_D1 = '';

foreach (@=grd_detalle as $row)
{
	++$i;
	$frm_partida_presupuesto =  $row['frm_partida_presupuesto'];
	$frm_producto_cantidad =  $row['frm_producto_cantidad'];
	$frm_producto_codigo =  $row['frm_producto_codigo'];
	$frm_producto_detalle =  $row['frm_producto_detalle'];
	$frm_producto_iva =  $row['frm_producto_iva'];
	$frm_producto_nombre =  $row['frm_producto'];
	$frm_producto_partida =  $row['frm_producto_partida'];
	$frm_producto_por_iva =  $row['frm_producto_por_iva'];
	$frm_producto_precio =  $row['frm_producto_precio'];
	$frm_producto_subtotal =  $row['frm_producto_subtotal'];
	$frm_producto_total =  $row['frm_producto_total'];
	$frm_producto_unidad =  $row['frm_producto_unidad'];
	$frm_resp_compra =  $row['frm_resp_compra'];
	$frm_tipo_compra = $row['frm_tipo_compra'];
	
	if ($frm_producto_codigo != ''){
		$sql = "INSERT INTO COM_DETALLE_APROBACION (
  APP_UID,
  APP_NUMBER,
  APP_STATUS,
  `ROW`,
  FRM_CENTRO_COSTO,
  FRM_PARTIDA_PRESUPUESTO,
  FRM_PRODUCTO_CANTIDAD,
  FRM_PRODUCTO_CODIGO,
  FRM_PRODUCTO_DETALLE,
  FRM_PRODUCTO_IVA,
  FRM_PRODUCTO_NOMBRE,
  FRM_PRODUCTO_PARTIDA,
  FRM_PRODUCTO_POR_IVA,
  FRM_PRODUCTO_PRECIO,
  FRM_PRODUCTO_SUBTOTAL,
  FRM_PRODUCTO_TOTAL,
  FRM_PRODUCTO_UNIDAD,
  FRM_RESP_COMPRA,
  FRM_TIPO_COMPRA
) 
VALUES
(
'$app_uid',
$app_number,
'$app_status',
$i,
'$ccostos',
$frm_partida_presupuesto,
$frm_producto_cantidad,
'$frm_producto_codigo',
'$frm_producto_detalle',
$frm_producto_iva,
'$frm_producto_nombre',
'$frm_producto_partida',
'$frm_producto_por_iva',
$frm_producto_precio,
$frm_producto_subtotal,
$frm_producto_total,
'$frm_producto_unidad',
'$frm_resp_compra',
'$frm_tipo_compra'
)" ;
		@@SQL_D1 .= $sql;
		$rs = executeQuery($sql,$cnx);
	}
}