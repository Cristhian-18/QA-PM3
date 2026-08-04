<?php
//creator Stalin

$cnx= "1665078345d09b448804c01043460634";
$grid = @=grd_detalle;
$rows = count($grid);

for ($i=1; $i <= $rows; $i++) {
   $frm_producto = $grid[$i]["frm_producto"];
 
 if($frm_producto != ''){
	 
   $centro_costo = @@frm_solicitante_ccostos;
   $partida = $grid[$i]["frm_producto_partida"];
   $total = ($grid[$i]["frm_producto_total"]) * 1;
   
   
   $anio = @@presupuesto_anio;

   /*   $query = "UPDATE rp_equivida.COM_PRESUPUESTO SET 
				SALDO_DISPONIBLE =  (SALDO_DISPONIBLE + $total), 
				SALDO_RESERVADO =  (SALDO_RESERVADO - $total)
				WHERE CENTRO_COSTOS = '$centro_costo' and 
				PARTIDA= '$partida' and ANIO = $anio";*/
   
   $query = "UPDATE certificacion.COM_PRESUPUESTO SET 
				SALDO_DISPONIBLE =  (SALDO_DISPONIBLE + $total), 
				SALDO_RESERVADO =  (SALDO_RESERVADO - $total)
				WHERE CENTRO_COSTOS = '$centro_costo' and 
				PARTIDA= '$partida' and ANIO = $anio";
	@@tmp_req =  $query;
	$rs_update = executeQuery($query,$cnx);
 }
}