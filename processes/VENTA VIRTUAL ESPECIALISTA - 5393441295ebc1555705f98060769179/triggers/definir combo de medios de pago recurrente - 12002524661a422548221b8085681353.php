<?php


$eqfx_cliente = @@ajx_eqfx_cliente_tipo;
$eqfx_pagador = @@ajx_eqfx_pagador_tipo;
$tercero = @@frm_pago_terceros;
$tiene_tarjeta = @@frm_tiene_tarjeta;
@@frm_provisional_pago = @@frm_monto;
@@aMedio = array();

@=aMedio[] = array("CTAAHO", "CUENTA AHORROS");
@=aMedio[] = array("CTACTE", "CUENTA CORRIENTE");
if ($tiene_tarjeta == 'SI') @=aMedio[] = array("TARJETA", "TARJETA");

