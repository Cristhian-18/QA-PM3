<?php

@@html_pasaporte = '';

if (@@frm_tipo_identificacion == 'P') {

    @@html_pasaporte .= '<table role="presentation" style="width:100%; border-collapse:collapse; margin-bottom:10px;">';

    //  Encabezados (4 columnas)
    @@html_pasaporte .= '<tr>';
    @@html_pasaporte .= '<td style="; font-weight:bold; background:#b7e08a; font-size:11px;">Fecha de expedición del pasaporte</td>';
    @@html_pasaporte .= '<td style="; font-weight:bold; background:#b7e08a; font-size:11px;">Fecha de caducidad del pasaporte</td>';
    @@html_pasaporte .= '<td style="; font-weight:bold; background:#b7e08a;">Tipo de Visa</td>';
    @@html_pasaporte .= '<td style="; font-weight:bold; background:#b7e08a;">Fecha de ingreso al país</td>';
    @@html_pasaporte .= '</tr>';

    // Valores (4 columnas)
    @@html_pasaporte .= '<tr>';
    @@html_pasaporte .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_fecha_expedicion_pasaporte_format.'</td>';
    @@html_pasaporte .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_fecha_caducidad_pasaporte_format.'</td>';
    @@html_pasaporte .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_tipo_visa_label.'</td>';
    @@html_pasaporte .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_fecha_ingreso_pais_format.'</td>';
    @@html_pasaporte .= '</tr>';

    @@html_pasaporte .= '</table>';
}
////////////////////////
// 1.2 DATOS DEL CÓNYUGE
////////////////////////
 // @@frm_estado_civil = 1; // despues quitar

 @@html_conyuge = '';
@@html_conyuge_f = '';

if (@@frm_estado_civil == 5 || @@frm_estado_civil == 2) {

    /* =========================
       BLOQUE 1.2
    ========================= */

    @@html_conyuge_f .= '<table style="width:100%; border-collapse:collapse; margin-bottom:10px;">';

    @@html_conyuge_f .= '<tr>';
    @@html_conyuge_f .= '<td colspan="4" style="background:#b7e08a; font-weight:bold; border:1px solid #0b5d4f;">1.2 DATOS DEL CÓNYUGE / CONVIVIENTE</td>';
    @@html_conyuge_f .= '</tr>';

    @@html_conyuge_f .= '<tr>';
    @@html_conyuge_f .= '<td colspan="2" style="border:1px solid #0b5d4f; font-weight:bold;">Apellidos</td>';
    @@html_conyuge_f .= '<td colspan="2" style="border:1px solid #0b5d4f; font-weight:bold;">Nombres</td>';
    @@html_conyuge_f .= '</tr>';

    @@html_conyuge_f .= '<tr>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_apellido_paterno.'</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_apellido_materno.'</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_primer_nombre.'</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_segundo_nombre.'</td>';
    @@html_conyuge_f .= '</tr>';

    @@html_conyuge_f .= '<tr>';
    @@html_conyuge_f .= '<td>Paterno</td>';
    @@html_conyuge_f .= '<td>Materno</td>';
    @@html_conyuge_f .= '<td>Primero</td>';
    @@html_conyuge_f .= '<td>Segundo</td>';
    @@html_conyuge_f .= '</tr>';

    @@html_conyuge_f .= '<tr>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Tipo de identificación</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_tipo_identificacion_label.'</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Número de identificación</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_numero_identificacion.'</td>';
    @@html_conyuge_f .= '</tr>';

    @@html_conyuge_f .= '<tr>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Nacionalidad</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_nacionalidad_label.'</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Tipo de empleo</td>';
    @@html_conyuge_f .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_tipo_empleo_label.'</td>';
    @@html_conyuge_f .= '</tr>';

    @@html_conyuge_f .= '</table>';

    /* =========================
       BLOQUE 1.3
    ========================= */

    @@html_conyuge .= '<table style="width:100%; border-collapse:collapse; margin-bottom:10px;">';

    @@html_conyuge .= '<tr>';
    @@html_conyuge .= '<td colspan="4" style="background:#b7e08a; font-weight:bold; border:1px solid #0b5d4f;">1.3 DATOS DEL CÓNYUGE / CONVIVIENTE</td>';
    @@html_conyuge .= '</tr>';

    @@html_conyuge .= '<tr>';
    @@html_conyuge .= '<td colspan="2" style="border:1px solid #0b5d4f; font-weight:bold;">Apellidos</td>';
    @@html_conyuge .= '<td colspan="2" style="border:1px solid #0b5d4f; font-weight:bold;">Nombres</td>';
    @@html_conyuge .= '</tr>';

    @@html_conyuge .= '<tr>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_apellido_paterno.'</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_apellido_materno.'</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_primer_nombre.'</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_segundo_nombre.'</td>';
    @@html_conyuge .= '</tr>';

    @@html_conyuge .= '<tr>';
    @@html_conyuge .= '<td>Paterno</td>';
    @@html_conyuge .= '<td>Materno</td>';
    @@html_conyuge .= '<td>Primero</td>';
    @@html_conyuge .= '<td>Segundo</td>';
    @@html_conyuge .= '</tr>';

    @@html_conyuge .= '<tr>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Tipo de identificación</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_tipo_identificacion_label.'</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Número de identificación</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_numero_identificacion.'</td>';
    @@html_conyuge .= '</tr>';

    @@html_conyuge .= '<tr>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Nacionalidad</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_nacionalidad_label.'</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Tipo de empleo</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_tipo_empleo_label.'</td>';
    @@html_conyuge .= '</tr>';

    @@html_conyuge .= '<tr>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Teléfono</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_telefono.'</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Correo</td>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_correo.'</td>';
    @@html_conyuge .= '</tr>';

    @@html_conyuge .= '<tr>';
    @@html_conyuge .= '<td style="border:1px solid #0b5d4f; font-weight:bold;">Dirección</td>';
    @@html_conyuge .= '<td colspan="3" style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_conyuge_direccion.'</td>';
    @@html_conyuge .= '</tr>';

    @@html_conyuge .= '</table>';
}


//////////////////////////////
// DEPENDIENTE - INDEPENDIENTE
//////////////////////////////
// @@frm_ocupacion_tipo_empleo = ''; // despues quitar
// @@frm_ocupacion_tipo_empleo = 'DEPENDIENTE'; // despues quitar
// @@frm_ocupacion_tipo_empleo = 'INDEPENDIENTE'; // despues quitar
@@html_tipo_empleo = '';

if (@@frm_ocupacion_tipo_empleo == 'DEPENDIENTE' || @@frm_ocupacion_tipo_empleo == 'DEPENDIENTE_1') {

    @@html_tipo_empleo .= '<table role="presentation" style="width:100%; border-collapse:collapse; margin-bottom:10px;">';

    //  Encabezados
    @@html_tipo_empleo .= '<tr>';
    @@html_tipo_empleo .= '<td style="border:1px solid #0b5d4f; font-weight:bold; background:#b7e08a;">Nombre de la empresa</td>';
    @@html_tipo_empleo .= '<td style="border:1px solid #0b5d4f; font-weight:bold; background:#b7e08a;">Cargo</td>';
    @@html_tipo_empleo .= '</tr>';

    //   Valores
    @@html_tipo_empleo .= '<tr>';
    @@html_tipo_empleo .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_ocupacion_nombre_empresa.'</td>';
    @@html_tipo_empleo .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_ocupacion_cargo.'</td>';
    @@html_tipo_empleo .= '</tr>';

    @@html_tipo_empleo .= '</table>';
}

@@html_direccion_empleo = '';

if (@@frm_ocupacion_tipo_empleo == 'DEPENDIENTE' ||
    @@frm_ocupacion_tipo_empleo == 'DEPENDIENTE_1' ||
    @@frm_ocupacion_tipo_empleo == 'INDEPENDIENTE') {

     @@html_direccion_empleo .= '<div>';

@@html_direccion_empleo .= '<table role="presentation" style="width:100%; border-collapse:separate; border-spacing: 0 3px;">';
@@html_direccion_empleo .= '<tr>';
@@html_direccion_empleo .= '<td style="background-color: #c4f99b; font-weight: bold; solid #0b5d4f;">Dirección del trabajo:</td>';
@@html_direccion_empleo .= '</tr>';
@@html_direccion_empleo .= '<tr>';
@@html_direccion_empleo .= '<td style="border: 1px solid #0b5d4f;">' . htmlspecialchars(@#frm_trabajo_direccion) . '</td>';
@@html_direccion_empleo .= '</tr>';
@@html_direccion_empleo .= '</table>';

@@html_direccion_empleo .= '<table role="presentation" style="width:100%; border-collapse:separate; border-spacing: 0 3px;">';
@@html_direccion_empleo .= '<tr>';
@@html_direccion_empleo .= '<td style="background-color: #c4f99b; font-weight: bold; solid #0b5d4f;">Teléfono:</td>';
@@html_direccion_empleo .= '</tr>';
@@html_direccion_empleo .= '<tr>';
@@html_direccion_empleo .= '<td style="border: 1px solid #0b5d4f;">' . htmlspecialchars(@#frm_trabajo_celular) . '</td>';
@@html_direccion_empleo .= '</tr>';
@@html_direccion_empleo .= '</table>';

@@html_direccion_empleo .= '<table role="presentation" style="width:100%; border-collapse:separate; border-spacing: 0 3px;">';
@@html_direccion_empleo .= '<tr>';
@@html_direccion_empleo .= '<td style="background-color: #c4f99b; font-weight: bold; solid #0b5d4f;">Correo electrónico del trabajo:</td>';
@@html_direccion_empleo .= '</tr>';
@@html_direccion_empleo .= '<tr>';
@@html_direccion_empleo .= '<td style="border: 1px solid #0b5d4f;">' . htmlspecialchars(@#frm_trabajo_correo_trabajo) . '</td>';
@@html_direccion_empleo .= '</tr>';
@@html_direccion_empleo .= '</table>';

@@html_direccion_empleo .= '<table role="presentation" style="width:100%; border-collapse:separate; border-spacing: 0 3px;">';
@@html_direccion_empleo .= '<tr>';
@@html_direccion_empleo .= '<td style="background-color: #c4f99b; font-weight: bold; solid #0b5d4f;">Preferencias de contacto:</td>';
@@html_direccion_empleo .= '</tr>';
@@html_direccion_empleo .= '<tr>';
@@html_direccion_empleo .= '<td style="border: 1px solid #0b5d4f;">' . htmlspecialchars(@#frm_trabajo_envio_correspondencia_label) . '</td>';
@@html_direccion_empleo .= '</tr>';
@@html_direccion_empleo .= '</table>';

@@html_direccion_empleo .= '</div>';
}

///EMBARAZO
// @@frm_sexo='F';//ELIMINIAR
@@html_embarazo = '';

if(@@frm_sexo == 'F'){

    @@html_embarazo .= '<table role="presentation" style="width:100%; border-collapse:collapse; margin-bottom:10px;">';

    //  Pregunta embarazo
    @@html_embarazo .= '<tr>';
    @@html_embarazo .= '<td style="border:1px solid #0b5d4f; font-weight:bold; background:#b7e08a;">¿Está embarazada?</td>';
    @@html_embarazo .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_declaracion_embarazo_label.'</td>';
    @@html_embarazo .= '</tr>';

    //   Valores (fecha + resultado)
    @@html_embarazo .= '<tr>';
    @@html_embarazo .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_declaracion_fecha_cita.'</td>';
    @@html_embarazo .= '<td style="border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_declaracion_resultado_cita.'</td>';
    @@html_embarazo .= '</tr>';

    //   Labels inferiores
    @@html_embarazo .= '<tr>';
    @@html_embarazo .= '<td style="font-size:x-small;">Fecha de la última citología (Papanicolaou)</td>';
    @@html_embarazo .= '<td style="font-size:x-small;">Resultado de la última citología (Papanicolaou)</td>';
    @@html_embarazo .= '</tr>';

    @@html_embarazo .= '</table>';
}
////////////
// @@frm_aplica_vitality='K';//ELIMINIAR

@@html_vitality = '';

if(@@frm_aplica_vitality=='S'){

    @@html_vitality .= '<table style="width:100%; margin-bottom:12px;">';

    // HEADER VERDE
   @@html_vitality .= '<tr>';
@@html_vitality .= '<td colspan="4" style="padding:4px;">';

@@html_vitality .= '<table style="width:100%;  ">';
@@html_vitality .= '<tr>';
@@html_vitality .= '<td style="background-color:#00493c; color:#ffffff; font-size:8px; font-weight:bold; text-align:center; padding:4px 6px; border:2px solid #00493c;">';
@@html_vitality .= '5. PROGRAMA DE BIENESTAR VITALITY';
@@html_vitality .= '</td>';
@@html_vitality .= '</tr>';
@@html_vitality .= '</table>';

@@html_vitality .= '</td>';
@@html_vitality .= '</tr>';

    // TEXTO
    @@html_vitality .= '<tr  >';
    @@html_vitality .= '<td colspan="3" style="width:100%; padding:5px;">Acepto que de ser admitido el Candidato a Asegurado, todos los beneficios de devolución de efectivo que pudieran corresponder al Programa de Bienestar Vitality, sean transferidos a la cuenta bancaria que se declara a continuación:</td>';
    @@html_vitality .= '</tr>';

    // ENCABEZADOS 2
    @@html_vitality .= '<tr>';
    @@html_vitality .= '<td   style="width:50%; background-color: #c4f99b; font-weight:bold;">Nombre del titular</td>';
    @@html_vitality .= '<td   style=" width:50%; background-color: #c4f99b; font-weight:bold;">Número de identificación del titular</td>';
    @@html_vitality .= '<td></td>';
    @@html_vitality .= '</tr>';

    // VALORES 2
    @@html_vitality .= '<tr>';
    @@html_vitality .= '<td style="width:50%; border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_vitality_titular.' '.@#frm_vitality_titular_apellidos.'</td>';
    @@html_vitality .= '<td style="width:50%; border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_vitality_identificacion.'</td>';
    @@html_vitality .= '<td></td>';
    @@html_vitality .= '</tr>';

    // ENCABEZADOS 3
    @@html_vitality .= '<tr>';
    @@html_vitality .= '<td   style="width:33.33%;background-color: #c4f99b; font-weight:bold;">Banco</td>';
    @@html_vitality .= '<td   style="width:33.33%;background-color: #c4f99b; font-weight:bold;">Tipo de Cuenta</td>';
    @@html_vitality .= '<td  style="width:33.33%;background-color: #c4f99b; font-weight:bold;">Número de Cuenta</td>';
    @@html_vitality .= '</tr>';

    // VALORES 3
    @@html_vitality .= '<tr>';
    @@html_vitality .= '<td style="width:33.33%;border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_vitality_banco_label_temp.'</td>';
    @@html_vitality .= '<td style="width:33.33%;border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_vitality_tipo_cuenta_label_temp.'</td>';
    @@html_vitality .= '<td style="width:33.33%;border:1px solid #0b5d4f; background:#e9e9e9;">'.@#frm_vitality_numero_cuenta.'</td>';
    @@html_vitality .= '</tr>';

    // TEXTO FINAL
    @@html_vitality .= '<tr>';
    @@html_vitality .= '<td colspan="3" style="padding:5px;">EQUISUIZA SEGUROS S.A. se contactará con el Asegurado en caso de que el proceso de acreditación automática presente algún inconveniente para garantizar la devolución del programa</td>';
    @@html_vitality .= '</tr>';

    @@html_vitality .= '</table>';
}

////////////////////////
// 1.2 DATOS DEL PEP
////////////////////////

@@html_pep = '';
if (@@frm_trabajo_expuesta_politicamente == 'S') {
	@@frm_expuesta_especifique_label = @@frm_expuesta_especifique;
	@@frm_expuesta_insttucion_label = @@frm_expuesta_insttucion;
	$arr_fecha = explode("-",@@frm_expuesta_fecha);
	$anio = $arr_fecha[0];
	$mes = $arr_fecha[1];
	$dia = $arr_fecha[2];
	@@frm_expuesta_fecha_label = $dia.'-'.$mes.'-'.$anio;
}else{
	@@frm_expuesta_especifique_label = 'NA';
	@@frm_expuesta_insttucion_label = 'NA';
	@@frm_expuesta_fecha_label = 'NA';
}

@@html_pep .= '<table role="presentation" style="width:100%; border-collapse:collapse; margin-bottom:15px;">';

@@html_pep .= '<tr>';
@@html_pep .= '<td style="border: 1px solid #0b5d4f;font-weight: bold;">' . @#frm_expuesta_especifique_label . '</td>';
@@html_pep .= '<td style="border: 1px solid #0b5d4f;font-weight: bold;">' . @#frm_expuesta_insttucion_label . '</td>';
@@html_pep .= '<td style="border: 1px solid #0b5d4f;font-weight: bold;">' . @#frm_expuesta_fecha_label . '</td>';
@@html_pep .= '</tr>';

@@html_pep .= '<tr>';
@@html_pep .= '<td style="">Cargo que desempeña</td>';
@@html_pep .= '<td style="">Institución</td>';
@@html_pep .= '<td style="">Fecha de inicio del cargo</td>';
@@html_pep .= '</tr>';

@@html_pep .= '</table>';

@@html_pep_familiar= '';
if (@@frm_trabajo_expuesta_politicamente_familiar == 'S') {
	@@frm_expuesta_especifique_cargo_label = @@frm_expuesta_especifique_cargo;
	@@frm_expuesta_especifique_nombre_label = @@frm_expuesta_especifique_nombre;
	@@frm_expuesta_parentesco_label = @@frm_expuesta_parentesco_label;
}else{
	@@frm_expuesta_especifique_cargo_label = 'NA';
	@@frm_expuesta_especifique_nombre_label = 'NA';
	@@frm_expuesta_parentesco_label = 'NA';
}
if (@@frm_expuesta_parentesco == 'Otros') {
	@@frm_expuesta_parentesco_label = @@frm_expuesta_parentesco.' - '.@@frm_expuesta_parentesco_detalle;
}

	@@html_pep_familiar = '';

@@html_pep_familiar .= '<table role="presentation" style="width:100%; border-collapse:collapse; margin-bottom:15px;">';

@@html_pep_familiar .= '<tr>';
@@html_pep_familiar .= '<td style="border: 1px solid #0b5d4f; font-weight:bold; background:#b7e08a;">' . @#frm_expuesta_parentesco_label . '</td>';
@@html_pep_familiar .= '<td style="border: 1px solid #0b5d4f; font-weight:bold; background:#b7e08a;">' . @#frm_expuesta_especifique_nombre_label . '</td>';
@@html_pep_familiar .= '<td style="border: 1px solid #0b5d4f; font-weight:bold; background:#b7e08a;">' . @#frm_expuesta_especifique_cargo_label . '</td>';
@@html_pep_familiar .= '</tr>';

@@html_pep_familiar .= '<tr>';
@@html_pep_familiar .= '<td>Relación con el familiar o colaborador</td>';
@@html_pep_familiar .= '<td>Nombre completo del familiar o colaborador</td>';
@@html_pep_familiar .= '<td>Cargo que desempeña el familiar o colaborador</td>';
@@html_pep_familiar .= '</tr>';

@@html_pep_familiar .= '</table>';

	//para la ciudad
	if(@@frm_pais_nacimiento == '56'){
		@@tri_ciudad_nacimiento_label = @@frm_ciudad_nacimiento_label;
	}else{
		@@tri_ciudad_nacimiento_label = @@frm_ciudad_nacimiento_otro;
	}

     if(@@tri_ciudad_nacimiento_label == ''){
          @@tri_ciudad_nacimiento_label = 'NA';
      }


// envio de variables al formulario
$aData = array(

	'html_referencias'=>@@html_referencias,
	'html_pasaporte'=>@@html_pasaporte,
	'html_conyuge'=>@@html_conyuge,
	'html_pep'=>@@html_pep,
	'html_pep_familiar'=>@@html_pep_familiar,
	'html_tipo_empleo'=>@@html_tipo_empleo,
	'html_direccion_empleo'=>@@html_direccion_empleo,
	'tri_ciudad_nacimiento_label'=>@@tri_ciudad_nacimiento_label,
	'html_embarazo'=>@@html_embarazo,
	'html_vitality'=>@@html_vitality

);
PMFSendVariables(@@APPLICATION, $aData);
