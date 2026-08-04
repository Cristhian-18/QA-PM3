<?php
//<?

$array_valores = array();
$array_valores = @@grd_registro_pagos;

$valor_pagado = 0;

$valor_venta = @@frm_precioVendidoSubasta;


foreach($array_valores as $valor){

	if($valor['estado'] == 'REGISTRADO' && $valor['valor_transf']>0){
		echo "valor transf". $valor['valor_transf'];
		$valor_pagado = $valor_pagado + $valor['valor_transf'];
	}
}


@=frm_accion_dum = array();
@=frm_accion_dum[] = array("", "-- Seleccione uno --");
@=frm_accion_dum[] = array("REGRESAR", "Validar nuevo cobro");

/*echo($valor_pagado);
echo('-');
echo($valor_venta);
die();*/

if($valor_pagado >= $valor_venta){ 
	@=frm_accion_dum[] = array("CONTINUAR", "Finalizar proceso de pago");
}


