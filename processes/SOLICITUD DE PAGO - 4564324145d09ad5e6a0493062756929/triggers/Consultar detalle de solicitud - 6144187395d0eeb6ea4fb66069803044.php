<?php
@@grd_detalle = '';
$cnx = '1665078345d09b448804c01043460634'; 
$app = @@APPLICATION;
$anio = @@presupuesto_anio;
$cc = @@frm_solicitante_ccostos;
$sql = "SELECT   ID     id,
  APP_UID   app_uid,
  APP_NUMBER   app_number,
  APP_STATUS   app_status,
  FRM_PARTIDA_PRESUPUESTO   frm_partida_presupuesto,
  FRM_PRODUCTO_CANTIDAD   frm_producto_cantidad,
  FRM_PRODUCTO_CODIGO   frm_producto_codigo,
  FRM_PRODUCTO_DETALLE   frm_producto_detalle,
  FRM_PRODUCTO_IVA   frm_producto_iva,
  FRM_PRODUCTO_NOMBRE  frm_producto,
  FRM_PRODUCTO_PARTIDA   frm_producto_partida,
  FRM_PRODUCTO_POR_IVA   frm_producto_por_iva,
  FRM_PRODUCTO_PRECIO   frm_producto_precio,
  FRM_PRODUCTO_SUBTOTAL   frm_producto_subtotal,
  FRM_PRODUCTO_TOTAL   frm_producto_total,
  FRM_PRODUCTO_UNIDAD   frm_producto_unidad,
  FRM_RESP_COMPRA   frm_resp_compra,
  FRM_TIPO_COMPRA   frm_tipo_compra 
FROM COM_DETALLE_APROBACION
WHERE APP_UID = '$app'
AND APP_STATUS = 'SOLICITADO'
ORDER BY FRM_PRODUCTO_PARTIDA";
$rs = executeQuery($sql,$cnx);

$partida1 = '';
$i= 1;
@@saldos = array();
foreach ($rs as $row){
	$partida = $row['frm_producto_partida'];
	if ($partida1 != $partida) {  
		// CONSULTAR DISPONIBLE DE LA PARTIDA
		$sqlp = "SELECT SALDO_DISPONIBLE disponible FROM COM_PRESUPUESTO 
WHERE ANIO = $anio
AND PARTIDA = '$partida'
AND CENTRO_COSTOS = '$cc'";
	
		$rsp = executeQuery($sqlp,$cnx);
		$pres = $rsp[1]['disponible'];
		$partida1 = $row['frm_producto_partida']; 
		@@saldos[$partida1] = $pres;		
	}
	$total = $row['frm_producto_total'];
	$rs [$i]['frm_partida_presupuesto'] =$pres - $total ;
	$pres = $rs [$i]['frm_partida_presupuesto'];
	$rs [$i]['novedad_presupuesto'] = ($pres < 0 ? 'SI' : 'ok');
	$i = $i +1;
}
@@grd_detalle = $rs;