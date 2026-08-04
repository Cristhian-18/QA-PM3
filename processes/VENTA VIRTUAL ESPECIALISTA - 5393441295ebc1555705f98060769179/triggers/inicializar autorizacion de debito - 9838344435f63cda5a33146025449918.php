<?php
//@@sw_debito = 0;
@@frm_pago_terceros = (@@frm_pago_terceros == ''? 'N': @@frm_pago_terceros);

@@frm_nombres_completos = @@tri_cliente_nombres;

//if (@@sw_debito != 1){
if (@@frm_modificar_debito_label == 'SI' || @@frm_debito_si == 'SI'){
	if(@@frm_pago_terceros == 'N'){
		$frm_nombres = str_replace('  ',' ',@@frm_primer_nombre.' '.@@frm_segundo_nombre);
		$frm_apellidos = str_replace('  ',' ',@@frm_apellido_paterno.' '.@@frm_apellido_materno);
		@@frm_tipo_identificacion_pagador = @@frm_tipo_identificacion;
		@@frm_cedula_pagador = @@frm_numero_identificacion;
		@@frm_nombre_pagador = $frm_nombres;
		@@frm_apellidos_pagador = $frm_apellidos;
		
		@@frm_correo_electronico_debito = @@correo_preferido;
		@@frm_celular_debito = @@telefono_preferido;
	}
	else
	{
		@@frm_pagador_tipo = 'OTRA';
		@@frm_correo_electronico_debito = '';
		@@frm_celular_debito = '';
		@@frm_medio_pago = '';
		@@frm_numero_tarjeta = '';
		@@frm_entidad_financiera = '';
		
	}
}


@@frm_monto = @@frm_prima_total;
@@sw_debito = 1;
/*
// inicializar el pago
$pago = @@frm_recibio_deposito;
if ($pago == 'S'){
	@@frm_primera_cuota_medio_pago = '';
	@@frm_primera_cuota_modalidad = '';
	@@frm_primera_cuota_total_primer_pago = '';
	@@frm_primera_cuota_descuento = '';
	@@frm_primera_cuota_total_pagar = '';
	@@frm_primera_cuota_plan = '';
}
else
{
	@@frm_monto_deposito_provisional = '';
	//@@frm_deposito_medio = '';
	@@frm_banco_equivida = '';
	@@frm_deposito_comprobante = '';
	@@frm_deposito_fecha = '';
	@@frm_banco_ccontable = '';
}
*/