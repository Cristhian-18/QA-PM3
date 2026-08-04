<?php
//created by Henry
//2/8/2022
//Validar Frecuencia de Pago

if(@@frm_frecuencia_cotizacion_aux != @@frm_frecuencia_cotizacion){	
	$g = new G();
	$g->SendMessageText("<h3>Error en la frecuencia de pago de la cotización</h3>", "ERROR");
	PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '5104185456006ed1e5b8fc2023497272');
}