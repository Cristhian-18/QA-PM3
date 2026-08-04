<?php
@@frm_tipo_seguro_contratado = @@frm_producto;
@@frm_provisional_pago = @@frm_prima_total;
//@@frm_sucursal = @@frm_Sucursal;

if (@@frm_producto == '101'){
	@@frm_provisional_pago = @@frm_prima_primer_pago;
}

// inicializar variables de la cotizacion
@@frm_frecuencia_pago = @@frm_frecuencia_cotizacion;
@@frm_frecuencia_pago_label = @@frm_frecuencia_cotizacion_label;

