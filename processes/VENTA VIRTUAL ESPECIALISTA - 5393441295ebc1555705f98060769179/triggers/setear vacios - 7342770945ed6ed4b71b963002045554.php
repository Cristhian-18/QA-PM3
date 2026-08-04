<?php
if(@@frm_modificar_solicitud_label == 'SI'){
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
		@@frm_origen_otros_ingresos_temp=@@frm_origen_otros_ingresos;
	}
	if(empty(@@frm_financiera_otros_ingresos))
	{
		@@frm_financiera_otros_ingresos_temp="0.00";
	}
	else{
		@@frm_financiera_otros_ingresos_temp=@@frm_financiera_otros_ingresos;
	}

}

//FORMULARIO COVID
if(@@frm_modificar_covid_label == 'SI' ){
	if(empty(@@frm_covid_uno_fecha) || @@frm_covid_uno == 'N')
	{
		@@frm_covid_uno_fecha_temp="N/A";
		@@frm_covid_uno_hospitalizado_label="N/A";
		@@frm_covid_uno_persistentes_label="N/A";
		@@frm_covid_uno_recuperado_label="N/A";
	}
	else{
		@@frm_covid_uno_fecha_temp=@@frm_covid_uno_fecha;
	}
	if(empty(@@frm_covid_uno_fecha_aisla) || @@frm_covid_uno == 'N')
	{
		@@frm_covid_uno_fecha_aisla_temp="N/A";
	}
	else{
		@@frm_covid_uno_fecha_aisla_temp=@@frm_covid_uno_fecha_aisla;
	}
	if(empty(@@frm_covid_uno_hospitalizado_label)){
		@@frm_covid_uno_hospitalizado_label_temp="N/A";
	}else{
		@@frm_covid_uno_hospitalizado_label_temp=@@frm_covid_uno_hospitalizado_label;
	}

	if(empty(@@frm_covid_dos_sintomas_fecha)){
		@@frm_covid_dos_sintomas_fecha_temp="N/A";
	}
	else{
		@@frm_covid_dos_sintomas_fecha_temp=@@frm_covid_dos_sintomas_fecha;
	}
	if(empty(@@frm_covid_dos_atencion_label)){
		@@frm_covid_dos_atencion_label_temp="N/A";
	}
	else{
			@@frm_covid_dos_atencion_label_temp=@@frm_covid_dos_atencion_label;
	}
	if(empty(@@frm_covid_tres_fecha)){
		@@frm_covid_tres_fecha_temp="N/A";
	}
	else{
		@@frm_covid_tres_fecha_temp=@@frm_covid_tres_fecha;
	}
	if(empty(@@frm_covid_cuatro_vacuna)){
		@@frm_covid_cuatro_vacuna_temp="N/A";
	}
	else{
		@@frm_covid_cuatro_vacuna_temp=@@frm_covid_cuatro_vacuna;
	}
	if(empty(@@frm_covid_cuatro_dosis)){
		@@frm_covid_cuatro_dosis_temp="N/A";
	}
	else{
		@@frm_covid_cuatro_dosis_temp=@@frm_covid_cuatro_dosis;
	}
	if(empty(@@frm_covid_cuatro_fecha_dosis)){
		@@frm_covid_cuatro_fecha_dosis_temp="N/A";
	}
	else{
		@@frm_covid_cuatro_fecha_dosis_temp=@@frm_covid_cuatro_fecha_dosis;
	}
	if(empty(@@frm_covid_cuatro_refuerzo) || @@frm_covid_cuatro_refuerzo == 'N'){
		@@frm_covid_cuatro_refuerzo_temp="N/A";
		@@frm_covid_cuatro_fecha_refuerzo="";
		@@frm_covid_cuatro_detalle_refuerzo="N/A";
	}
	else{
		@@frm_covid_cuatro_refuerzo_temp=@@frm_covid_cuatro_refuerzo;
	}
	if(empty(@@frm_covid_cuatro_fecha_refuerzo)){
		@@frm_covid_cuatro_fecha_refuerzo_temp="N/A";
	}
	else{
		@@frm_covid_cuatro_fecha_refuerzo_temp=@@frm_covid_cuatro_fecha_refuerzo;
	}
}

