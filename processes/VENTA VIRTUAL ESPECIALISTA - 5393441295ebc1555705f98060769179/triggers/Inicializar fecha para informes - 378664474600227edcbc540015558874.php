<?php
//<?php
@@tri_fecha_informe = date('Y-m-d H:i:s');

@@html_ec_aps = '';
if(@@tri_es_broker == 'SI'){
	@@tri_broker_ejecutivo = 'APS a cargo';
	@@tri_broker_ejecutivo_text = 'Nombre del APS';
	@@frm_aps_ec_nombre = @@frm_vendedor_nombre;
	@@html_ec_aps = '<div class="cajas ancho_3 amarillo">'.@@frm_aps_nombre.'</div><div class="cajas ancho_3 amarillo">'.@@frm_aps_ec_nombre.'</div><div class="cajas ancho_3 amarillo">'.@@frm_aps_cargo.'</div>';
	@@html_ec_aps_etiqueta = '
					<div class="cajas ancho_3">Nombre del APS</div><div class="cajas ancho_3">Nombre Ejecutivo APS</div><div class="cajas ancho_3">Cargo Ejecutivo APS</div>';
}else{
	@@tri_broker_ejecutivo = 'Ejecutivo a cargo';
	@@tri_broker_ejecutivo_text = 'Nombre de Ejecutivo';
	@@html_ec_aps = '<div class="cajas ancho_3 amarillo">'.@@frm_vendedor_nombre.'</div><div class="cajas ancho_3 amarillo">'.@@frm_vendedor_cargo.'</div>';
	@@html_ec_aps_etiqueta = '<div class="cajas ancho_3">Nombre Ejecutivo Comercial</div><div class="cajas ancho_3">Cargo Ejecutivo Comercial</div>';
}

//nuevo para cargar datos en la solicitud
if(empty(@@frm_ocupacion_cargo)){@@frm_ocupacion_cargo="N/A";}
	// if(empty(@@frm_ocupacion_otras_ocupaciones)){@@frm_ocupacion_otras_ocupaciones="N/A";}
	if(empty(@@frm_frecuencia_viajes)){@@frm_frecuencia_viajes="N/A";}
	if(empty(@@frm_otra_actividad_relacion_habitual)){@@frm_otra_actividad_relacion_habitual="N/A";}
	if(empty(@@frm_nombre_hijos)){@@frm_nombre_hijos="N/A";}
	if(empty(@@frm_aclaraciones_observacion)){@@frm_aclaraciones_observacion="NINGUNA";}


	if(empty(@@frm_pago_unico_porcentaje)||(@@frm_pago_unico_porcentaje=="0"))
	{
		@@frm_pago_unico_porcentaje_temp="N/A";
	}
	else{
		@@frm_pago_unico_porcentaje_temp=@@frm_pago_unico_porcentaje;
	}

	if(empty(@@frm_pago_cuota_porcentaje)||(@@frm_pago_cuota_porcentaje=="0"))
	{
		@@frm_pago_cuota_porcentaje_temp="N/A";
	}
	else{
		@@frm_pago_cuota_porcentaje_temp=@@frm_pago_cuota_porcentaje;
	}

	if(empty(@@frm_plazo_cuotas_liquidacion)||(@@frm_plazo_cuotas_liquidacion=="0"))
	{
		@@frm_plazo_cuotas_liquidacion_temp="N/A";
	}
	else{
		@@frm_plazo_cuotas_liquidacion_temp=@@frm_plazo_cuotas_liquidacion;
	}

	if(empty(@@frm_plazo_cuotas_liquidacion_combinada)||(@@frm_plazo_cuotas_liquidacion_combinada=="0"))
	{
		@@frm_plazo_cuotas_liquidacion_combinada_temp="N/A";
	}
	else{
		@@frm_plazo_cuotas_liquidacion_combinada_temp=@@frm_plazo_cuotas_liquidacion_combinada;
	}
	if(empty(@@frm_causa_negacion))
	{
		@@frm_causa_negacion_temp="N/A";
	}
	else{
		@@frm_causa_negacion_temp=@@frm_causa_negacion;
	}


	if(empty(@@frm_declaracion_peso_ganado))
	{
		@@frm_declaracion_peso_ganado_temp="N/A";
	}
	else{
		@@frm_declaracion_peso_ganado_temp=@@frm_declaracion_peso_ganado;
	}

	if(empty(@@frm_declaracion_causa_ganancia_peso))
	{
		@@frm_declaracion_causa_ganancia_peso_temp="N/A";
	}
	else{
		@@frm_declaracion_causa_ganancia_peso_temp=@@frm_declaracion_causa_ganancia_peso;
	}

	if(empty(@@frm_declaracion_peso_perdido))
	{
		@@frm_declaracion_peso_perdido_temp="N/A";
	}
	else{
		@@frm_declaracion_peso_perdido_temp=@@frm_declaracion_peso_perdido;
	}


	if(empty(@@frm_declaracion_causa_perdida_peso))
	{
		@@frm_declaracion_causa_perdida_peso_temp="N/A";
	}
	else{
		@@frm_declaracion_causa_perdida_peso_temp=@@frm_declaracion_causa_perdida_peso;
	}

	if(empty(@@frm_origen_otros_ingresos))
	{
		@@frm_origen_otros_ingresos_temp="N/A";
	}
	else{
		@@frm_origen_otros_ingresos_temp=@@frm_origen_otros_ingresos_label;
	}

	if(@@frm_tiene_otra_actividad == 'N')
	{
		@@frm_financiera_otros_ingresos_temp="0.00";
		@@frm_financiera_otros_ingresos="0.00";
	}
	else{
		@@frm_financiera_otros_ingresos_temp=@@frm_financiera_otros_ingresos;
	}
	if(empty(@@frm_producto))
	{
		//consultamos en base al codigo
	}
	else{
		@@frm_tipo_seguro_contratado_label=@@frm_producto_label;
	}

if(@@frm_pago_terceros == 'S'){
	@@frm_tipo_identificacion_pagador_label_temp = @@frm_tipo_identificacion_pagador_label;
	@@frm_cedula_pagador_temp = @@frm_cedula_pagador;
	@@frm_apellidos_pagador_temp = @@frm_apellidos_pagador;
	@@frm_nombre_pagador_temp =  @@frm_nombre_pagador;
	@@frm_correo_electronico_debito_temp = @@frm_correo_electronico_debito;
	@@frm_parentesco_label_temp = @@frm_parentesco_label;
}else{
	@@frm_tipo_identificacion_pagador_label_temp = 'N/A';
	@@frm_cedula_pagador_temp = 'N/A';
	@@frm_apellidos_pagador_temp = '';
	@@frm_nombre_pagador_temp =  'N/A';
	@@frm_correo_electronico_debito_temp = 'N/A';
	@@frm_parentesco_label_temp = 'N/A';
}

if(@@frm_plan_diferente_asegurado == 'N'){
	@@frm_plan_tipo_identificacion_label = 'N/A';
	@@frm_plan_numero_identificacion = 'N/A';
	@@frm_plan_nombre = 'N/A';
	@@frm_plan_mail = 'N/A';
	@@frm_plan_relacion_poliza_label = 'N/A';
}

//PARA LAS FECHA DE NACIMEINTO

$arr_date=explode('-',@@frm_fecha_nacimiento);
@@frm_fecha_nacimiento_format = $arr_date['2'].'-'.$arr_date['1'].'-'.$arr_date['0'];

if(@@frm_fecha_expedicion_pasaporte != ''){
$arr_date_exp=explode('-',@@frm_fecha_expedicion_pasaporte);
@@frm_fecha_expedicion_pasaporte_format = $arr_date_exp['2'].'-'.$arr_date_exp['1'].'-'.$arr_date_exp['0'];
}

if(@@frm_fecha_caducidad_pasaporte != ''){
$arr_date_cadexp=explode('-',@@frm_fecha_caducidad_pasaporte);
@@frm_fecha_caducidad_pasaporte_format = $arr_date_cadexp['2'].'-'.$arr_date_cadexp['1'].'-'.$arr_date_cadexp['0'];
}

if(@@frm_fecha_ingreso_pais != ''){
$arr_date_cadepais=explode('-',@@frm_fecha_ingreso_pais);
@@frm_fecha_ingreso_pais_format = $arr_date_cadepais['2'].'-'.$arr_date_cadepais['1'].'-'.$arr_date_cadepais['0'];
}
