<?php
$grd_detalle= @=grd_detalle;
$cnx = '1665078345d09b448804c01043460634'; 
$app = @@APPLICATION;
$anio = @@presupuesto_anio;
$cc = @@frm_solicitante_ccostos;

$partida1 = '';
$i= 1;
@@saldos = array();
foreach ($grd_detalle as $row){
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
	$grd_detalle [$i]['frm_partida_presupuesto'] =$pres - $total ;
	$pres = $rs [$i]['frm_partida_presupuesto'];
	$grd_detalle [$i]['novedad_presupuesto'] = ($pres < 0 ? 'SI' : 'ok');
	$i = $i +1;
}
@=grd_detalle = $grd_detalle;