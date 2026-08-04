<?php

$civil = @@frm_estado_civil;
$tercero = @@frm_pago_terceros;
@@tri_cliente_nombres = str_replace('  ',' ',@@frm_primer_nombre.' '.@@frm_segundo_nombre.'
 '.@@frm_apellido_paterno.' '.@@frm_apellido_materno);
@@frm_nombres_completos = @@tri_cliente_nombres;
if ($civil == 2 || $civil == 5){
	@@tri_conyuge_nombres = str_replace('  ',' ',@@frm_conyuge_primer_nombre.' '.@@frm_conyuge_segundo_nombre.' '.@@frm_conyuge_apellido_paterno.' '.@@frm_conyuge_apellido_materno);
}
if ($tercero  == 'S'){
	@@tri_pagador_nombres = str_replace('  ',' ',@@frm_nombre_pagador.' '.@@frm_apellidos_pagador);
}
else
{
	@@tri_pagador_nombres = @@tri_cliente_nombres;
	@@frm_cedula_pagador = @@frm_numero_identificacion;

}

@@eqfx_pagador_tipo = @@ajx_eqfx_cliente_tipo;
@@eqfx_pagador_tipo = (@@frm_pago_terceros == 'S' ? @@ajx_eqfx_pagador_tipo :@@eqfx_pagador_tipo ) ;

