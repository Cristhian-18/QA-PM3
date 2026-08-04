<?php
$frm_pago_terceros = @@frm_pago_terceros;
$frm_cedula_pagador = @@frm_cedula_pagador;
$frm_numero_identificacion = @@frm_numero_identificacion;

@@frm_respuesta_cliente = strtoupper(trim(@@frm_respuesta_cliente));
if (@@frm_respuesta_cliente=="Acepto" || @@frm_respuesta_cliente=="ACEPTO"){
	$rutat8 = 'ACEPTO';
	if(@@frm_pago_si == 'SI'){
		if($frm_pago_terceros == 'S'){
			if(@@frm_modificar_debito_label == 'SI'){
				$rutat8 = 'APROBACION';	
			}else{
				$rutat8 = 'ACEPTO';	
			}
		}else{
			$rutat8 = 'ACEPTO';
		}
	}else{
		if($frm_pago_terceros == 'S'){
			if(@@frm_modificar_debito_label == 'SI'){
				$rutat8 = 'APROBACION';	
			}else{
				$rutat8 = 'OPERACIONES_S';
			}
		}else{
			$rutat8 = 'ACEPTO';
		}
	}
}
else {
	$rutat8 = 'RECHAZO';
}

@@rutat8 = $rutat8;