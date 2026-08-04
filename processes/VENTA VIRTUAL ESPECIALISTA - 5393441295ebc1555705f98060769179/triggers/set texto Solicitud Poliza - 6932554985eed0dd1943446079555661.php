<?php

function reemplazarVacio($arg)
{
	
   		return (empty($arg)||(($arg)=='Seleccione')||(strlen(trim($arg))==0))? 'N/A' : $arg;
}
//DATOS PERSONALES
																	  
@@html_personales='';
@@html_personales.='<tr>';
@@html_personales.='<td colspan="6"><strong>Apellidos:</strong></td>';
@@html_personales.='<td colspan="6"><strong>Nombres:</strong></td>';
@@html_personales.='</tr>';
@@html_personales.='<tr>';
@@html_personales.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_apellido_paterno).'</td>';
@@html_personales.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_apellido_materno).'</td>';
@@html_personales.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_primer_nombre).'</td>';
@@html_personales.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_segundo_nombre).'</td>';
@@html_personales.='</tr>';
@@html_personales.='<tr>';
@@html_personales.='<td colspan="3" class="txt_normal ctr">Paterno</td>';
@@html_personales.='<td colspan="3" class="txt_normal ctr">Materno</td>';
@@html_personales.='<td colspan="3" class="txt_normal ctr">Primero</td>';
@@html_personales.='<td colspan="3" class="txt_normal ctr">Segundo</td>';
@@html_personales.='</tr>';
@@html_personales.='<tr>';
@@html_personales.='<td colspan="3"><strong>Tipo de identificaci&oacute;n:</strong></td>';
@@html_personales.='<td colspan="3"><strong>N&uacute;mero de identificaci&oacute;n:</strong></td>';
@@html_personales.='<td colspan="6"><strong>Lugar de residencia habitual:</strong></td>';
@@html_personales.='</tr>';
@@html_personales.='<tr>';
@@html_personales.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_tipo_identificacion_label).'</td>';
@@html_personales.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_numero_identificacion).'</td>';
@@html_personales.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_lugar_residencia_habitual_label).'</td>';
@@html_personales.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_pais_nacimiento_label).'</td>';
@@html_personales.='</tr>';

///DAUSTO DIRECCION

@@html_direccion_domicilio='';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="8"><strong>Ciudad y Fecha de nacimiento:</strong></td>';
@@html_direccion_domicilio.='<td colspan="4"><strong>Nacionalidad:</strong></td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_ciudad_nacimiento_label).'</td>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_fecha_nacimiento).'</td>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_nacionalidad_label).'</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="4" class="txt_normal ctr">Ciudad</td>';
@@html_direccion_domicilio.='<td colspan="4" class="txt_normal ctr">dd / mm / aaaa</td>';
@@html_direccion_domicilio.='<td colspan="4" class="txt_normal ctr">&nbsp;</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="4"><strong>Sexo:</strong></td>';
@@html_direccion_domicilio.='<td colspan="4"><strong>Estado Civil Actual:</strong></td>';
@@html_direccion_domicilio.='<td colspan="4"><strong>N&uacute;mero de hijos:</strong></td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
$sexo_label = @#frm_sexo_label == 'M' ? 'MASCULINO' : 'FEMENINO';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio($sexo_label).'</td>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_estado_civil_label).'</td>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_numero_hijos).'</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="12"><strong>Direcci&oacute;n del domicilio:</strong></td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_provincia_label).'</td>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_canton_label).'</td>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_barrio).'</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="4" class="txt_normal ctr">Provincia</td>';
@@html_direccion_domicilio.='<td colspan="4" class="txt_normal ctr">Cant&oacute;n o Ciudad</td>';
@@html_direccion_domicilio.='<td colspan="4" class="txt_normal ctr">Barrio o Sector</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="3"><strong>Calle Principal:</strong></td>';
@@html_direccion_domicilio.='<td colspan="1"><strong>Nro.:</strong></td>';
@@html_direccion_domicilio.='<td colspan="4"><strong>Calle Transversal:</strong></td>';
@@html_direccion_domicilio.='<td colspan="2"><strong>Conjunto / Edificio:</strong></td>';
@@html_direccion_domicilio.='<td colspan="3"><strong>Dpto. / Casa:</strong></td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_calle_principal).'</td>';
@@html_direccion_domicilio.='<td colspan="1" class="inp01">'.reemplazarVacio(@#frm_numero).'</td>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_calle_transversal).'</td>';
@@html_direccion_domicilio.='<td colspan="2" class="inp01">'.reemplazarVacio(@#frm_conjunto_edificio).'</td>';
@@html_direccion_domicilio.='<td colspan="2"  class="inp01">'.reemplazarVacio(@#frm_departamento_casa).'</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="7"><strong>Telefonos:</strong></td>';
@@html_direccion_domicilio.='<td>&nbsp;</td>';
@@html_direccion_domicilio.='<td colspan="3"><strong>Llamar preferentemente de:</strong></td>';
@@html_direccion_domicilio.='<td>&nbsp;</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="1" class="inp01">'.reemplazarVacio(@#frm_codigo_provincia).'</td>';
@@html_direccion_domicilio.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_convencional).'</td>';
@@html_direccion_domicilio.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_celular).'</td>';
@@html_direccion_domicilio.='<td class="inp01 rgt">'.reemplazarVacio(@#frm_hora_inicial_label).'</td>';
@@html_direccion_domicilio.='<td colspan="2" class="ctr">hs.a</td>';
@@html_direccion_domicilio.='<td  class="inp01 rgt">'.reemplazarVacio(@#frm_hora_final_label).'</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="1" class="txt_normal ctr">Cod. Prov</td>';
@@html_direccion_domicilio.='<td colspan="3" class="txt_normal ctr">Convencional</td>';
@@html_direccion_domicilio.='<td colspan="4" class="txt_normal ctr">Celular</td>';
@@html_direccion_domicilio.='<td class="txt_normal ctr">&nbsp;</td>';
@@html_direccion_domicilio.='<td colspan="2" class="txt_normal ctr">&nbsp;</td>';
@@html_direccion_domicilio.='<td class="txt_normal ctr">&nbsp;</td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="12"><strong>Correo electr&oacute;nico personal:</strong></td>';
@@html_direccion_domicilio.='</tr>';
@@html_direccion_domicilio.='<tr>';
@@html_direccion_domicilio.='<td colspan="12" class="inp01">'.reemplazarVacio(@#frm_correo_electronico_personal).'</td>';
@@html_direccion_domicilio.='</tr>	';		

/////////////
// Pasaporte
/////////////

//@@frm_tipo_identificacion = 'P'; // despues quitar
@@html_pasaporte = '';
if (@@frm_tipo_identificacion == 'P') {
	@@html_pasaporte.='<tr>';
	@@html_pasaporte.='<td colspan="3"><strong>Fecha de expedici&oacute;n del pasaporte</strong></td>';
	@@html_pasaporte.='<td colspan="3"><strong>Fecha de caducidad del pasaporte</strong></td>';
	@@html_pasaporte.='<td colspan="3"><strong>Tipo de Visa</strong></td>';
	@@html_pasaporte.='<td colspan="3"><strong>Fecha de ingreso al pa&iacute;s</strong></td>';
	@@html_pasaporte.='</tr>';
	@@html_pasaporte.='<tr>';
	@@html_pasaporte.='    <td colspan="3" class="inp01">'.reemplazarVacio(@#frm_fecha_expedicion_pasaporte).'</td>';
	@@html_pasaporte.='    <td colspan="3" class="inp01">'.reemplazarVacio(@#frm_fecha_caducidad_pasaporte).'</td>';
	@@html_pasaporte.='    <td colspan="3" class="inp01">'.reemplazarVacio(@#frm_tipo_visa_label).'</td>';
	@@html_pasaporte.='    <td colspan="3" class="inp01">'.reemplazarVacio(@#frm_fecha_ingreso_pais).'</td>';
	@@html_pasaporte.='</tr>';
}
																		   
																		   
////////////////////////
// 1.2 DATOS DEL CÓNYUGE
////////////////////////
//@@frm_estado_civil = 5; 																		   
																		   
@@html_conyugue = '';
	
if (@@frm_estado_civil == 5 || @@frm_estado_civil == 2) {
	@@html_conyugue.='<tr>';
    @@html_conyugue.='<td colspan="12">&nbsp;</td>';
    @@html_conyugue.='</tr>';
	@@html_conyugue.='<tr>';
	@@html_conyugue.='<td colspan="12" class="cbg01 ctp06"><strong>DATOS DEL C&Oacute;NYUGE / CONVIVIENTE</strong></td>';
	@@html_conyugue.='</tr>';
	@@html_conyugue.='<tr>';
	@@html_conyugue.='<td colspan="6"><strong>Apellidos:</strong></td>';
	@@html_conyugue.='<td colspan="6"><strong>Nombres:</strong></td>';
	@@html_conyugue.='</tr>';
	@@html_conyugue.='<tr>';
	@@html_conyugue.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_conyuge_apellido_paterno).'</td>';
	@@html_conyugue.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_conyuge_apellido_materno).'</td>';
	@@html_conyugue.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_conyuge_primer_nombre).'</td>';
	@@html_conyugue.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_conyuge_segundo_nombre).'</td>';
	@@html_conyugue.='</tr>';
	@@html_conyugue.='<tr>';
	@@html_conyugue.='<td colspan="3" class="txt_normal ctr">Paterno</td>';
	@@html_conyugue.='<td colspan="3" class="txt_normal ctr">Materno</td>';
	@@html_conyugue.='<td colspan="3" class="txt_normal ctr">Primero</td>';
	@@html_conyugue.='<td colspan="3" class="txt_normal ctr">Segundo</td>';
	@@html_conyugue.='</tr>';
	@@html_conyugue.='<tr>';
	@@html_conyugue.='<td colspan="6"><strong>Tipo de identificaci&oacute;n:</strong></td>';
	@@html_conyugue.='<td colspan="6"><strong>N&uacute;mero de identificaci&oacute;n:</strong></td>';
	@@html_conyugue.='</tr>';
	@@html_conyugue.='<tr>';
	@@html_conyugue.='<td colspan="6" class="inp01">'.reemplazarVacio(@#frm_conyuge_tipo_identificacion_label).'</td>';
	@@html_conyugue.='<td colspan="6" class="inp01">'.reemplazarVacio(@#frm_conyuge_numero_identificacion).'</td>';
	@@html_conyugue.='</tr>';
	@@html_conyugue.='<tr>';
	@@html_conyugue.='<td colspan="12">&nbsp;</td>';
	@@html_conyugue.='</tr>';
}									
@@html_seccion_personales=@@html_personales.@@html_pasaporte.@@html_direccion_domicilio.@@html_conyugue;
																	  
																	  
																	  
////DIRECCION TRABAJO
																		   
/////
@@html_direccion_trabajo='';
/*@@frm_tiene_otra_actividad='S';																	 if(@@frm_tiene_otra_actividad=='S'){
	$ocupacion=@#frm_ocupacion_tipo.' '.@#frm_ocupacion_otras_ocupaciones;
	@@html_direccion_trabajo.='<tr>';
	@@html_direccion_trabajo.='    <td colspan="6"><strong>Cual es la actividad economica que genera a mayor parte de sus ingresos?</strong></td>';
	@@html_direccion_trabajo.='    <td colspan="6"><strong>Otras ocupaciones y que tiempo le demandan</strong></td>';
	@@html_direccion_trabajo.='  </tr>';
	@@html_direccion_trabajo.='<tr>';
	@@html_direccion_trabajo.='    <td colspan="6" class="inp01">'.reemplazarVacio(@#frm_ocupacion_mayor_ingresos_label).'</td>';
	@@html_direccion_trabajo.='    <td colspan="6" class="inp01">'.reemplazarVacio($ocupacion).'</td>';
	@@html_direccion_trabajo.='  </tr>';
}*/
																		   
//@@frm_ocupacion_tipo_empleo ='ama casa';	//boraar																	  
if (@@frm_ocupacion_tipo_empleo =='DEPENDIENTE'  || @@frm_ocupacion_tipo_empleo == 'INDEPENDIENTE') {
		@@html_direccion_trabajo.='<td colspan="4"><strong>Direcci&oacute;n del trabajo:</strong></td>';
		@@html_direccion_trabajo.='<td colspan="8">&nbsp;</td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_trabajo_provincia_label).'</td>';
		@@html_direccion_trabajo.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_trabajo_canton_label).'</td>';
		@@html_direccion_trabajo.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_trabajo_sector_barrio).'</td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="4" class="txt_normal ctr">Provincia</td>';
		@@html_direccion_trabajo.='<td colspan="4" class="txt_normal ctr">Cant&oacute;n o Ciudad</td>';
		@@html_direccion_trabajo.='<td colspan="4" class="txt_normal ctr">Barrio o Sector</td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="3"><strong>Calle Principal:</strong></td>';
		@@html_direccion_trabajo.='<td colspan="1"><strong>Nro.:</strong></td>';
		@@html_direccion_trabajo.='<td colspan="4"><strong>Calle Transversal:</strong></td>';
		@@html_direccion_trabajo.='<td colspan="2"><strong>Edificio:</strong></td>';
		@@html_direccion_trabajo.='<td colspan="2"><strong>Oficina:</strong></td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_trabajo_calle_principal).'</td>';
		@@html_direccion_trabajo.='<td colspan="1" class="inp01">'.reemplazarVacio(@#frm_trabajo_numero).'</td>';
		@@html_direccion_trabajo.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_trabajo_calle_transversal).'</td>';
		@@html_direccion_trabajo.='<td colspan="2" class="inp01">'.reemplazarVacio(@#frm_trabajo_edificio).'</td>';
		@@html_direccion_trabajo.='<td colspan="2" class="inp01">'.reemplazarVacio(@#frm_trabajo_oficina).'</td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="7"><strong>Telefonos:</strong></td>';
		@@html_direccion_trabajo.='<td colspan="5"><strong>Llamar preferentemente de:</strong></td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="1" class="inp01">'.reemplazarVacio(@#frm_trabajo_codigo_provincia).'</td>';
		@@html_direccion_trabajo.='<td colspan="3" class="inp01">'.reemplazarVacio(@#frm_trabajo_convencional).'</td>';
		@@html_direccion_trabajo.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_trabajo_celular).'</td>';
		@@html_direccion_trabajo.='<td class="inp01 rgt">'.reemplazarVacio(@#frm_trabajo_hora_inicial_label).'</td>';
		@@html_direccion_trabajo.='<td colspan="2" class="ctr">hs:a</td>';
		@@html_direccion_trabajo.='<td  class="inp01 rgt">'.reemplazarVacio(@#frm_trabajo_hora_final_label).'</td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="1" class="txt_normal ctr">Cod. Prov</td>';
		@@html_direccion_trabajo.='<td colspan="3" class="txt_normal ctr">Convencional</td>';
		@@html_direccion_trabajo.='<td colspan="4" class="txt_normal ctr">Celular</td>';
		@@html_direccion_trabajo.='<td class="txt_normal ctr">&nbsp;</td>';
		@@html_direccion_trabajo.='<td colspan="2" class="txt_normal ctr">&nbsp;</td>';
		@@html_direccion_trabajo.='<td class="txt_normal ctr">&nbsp;</td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="12"><strong>Correo electr&oacute;nico del trabajo:</strong></td>';
		@@html_direccion_trabajo.='</tr>';
		@@html_direccion_trabajo.='<tr>';
		@@html_direccion_trabajo.='<td colspan="12" class="inp01">'.reemplazarVacio(@#frm_trabajo_correo_trabajo_label).'</td>';
		@@html_direccion_trabajo.='</tr>';																		  																  
}						   
///TIPO OCUPACION
///
@@html_info_trabajo='';																		   
	//@@frm_ocupacion_tipo_empleo ='DEPENDIENTE' 	;//borrar															  
if (@@frm_ocupacion_tipo_empleo =='DEPENDIENTE'  ) {
	@@html_info_trabajo.='<tr>';
	@@html_info_trabajo.='<td colspan="6"><strong>Nombre de la empresa</strong></td>';
	@@html_info_trabajo.='<td colspan="6"><strong>Cargo</strong></td>';
	@@html_info_trabajo.='</tr>';
	@@html_info_trabajo.='<tr>';
	@@html_info_trabajo.='<td colspan="6" class="inp01">'.reemplazarVacio(@#frm_ocupacion_nombre_empresa).'</td>';
	@@html_info_trabajo.='<td colspan="6" class="inp01">'.reemplazarVacio(@#frm_ocupacion_cargo).'</td>';
	@@html_info_trabajo.='</tr>';
}
if (@@frm_ocupacion_tipo_empleo =='INDEPENDIENTE'  ) {
	@@html_info_trabajo.='<tr>';
	@@html_info_trabajo.='<td colspan="12"><strong>Nombre del negocio:</strong></td>';
	@@html_info_trabajo.='</tr>';
	@@html_info_trabajo.='<tr>';
	@@html_info_trabajo.='<td colspan="12" class="inp01">'.reemplazarVacio(@#frm_ocupacion_nombre_negocio).'</td>';
	@@html_info_trabajo.='</tr>';
}

																		   ///REFERENCIAS
//@@frm_valor_asegurado=200000;//eliminar
@@html_referencias='';
if (@@frm_valor_asegurado >=200000  ) {

	@@html_referencias.='<tr>';
	@@html_referencias.='<td colspan="12" class="cbg01 ctp06"><strong>REFERENCIAS</strong></td>';
	@@html_referencias.='</tr>';
	@@html_referencias.='<tr>';
	@@html_referencias.='<td colspan="12"><strong>Llene este numeral si la suma asegurada total supera los $ 200.000</strong></td>';
	@@html_referencias.='</tr>';
	@@html_referencias.='<tr>';
	@@html_referencias.='<td colspan="6" class="txt_normal ctr"><strong>Referencias Personales</strong></td>';
	@@html_referencias.='<td colspan="6" class="txt_normal ctr"><strong>Referencias Comerciales</strong></td>';
	@@html_referencias.='</tr>';
	@@html_referencias.='<tr>';
	@@html_referencias.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_referencia_personal_nombre).'</td>';
	@@html_referencias.='<td colspan="2" class="inp01">'.reemplazarVacio(@#frm_referencia_personal_telefono).'</td>';
	@@html_referencias.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_referencia_comercial_nombre).'</td>';
	@@html_referencias.='<td  colspan="2"class="inp01">'.reemplazarVacio(@#frm_referencia_comercial_telefono).'</td>';
	@@html_referencias.='</tr>';
	@@html_referencias.='<tr>';
	@@html_referencias.='<td colspan="4" class="txt_normal ctr">Apellidos y Nombres</td>';
	@@html_referencias.='<td colspan="2" class="txt_normal ctr">Tel&eacute;fono</td>';
	@@html_referencias.='<td colspan="4" class="txt_normal ctr">Nombre de la casa comercial</td>';
	@@html_referencias.='<td colspan="2" class="txt_normal ctr">Tel&eacute;fono</td>';
	@@html_referencias.='</tr>';
	@@html_referencias.='<tr>';
	@@html_referencias.='<td colspan="12" class="txt_normal ctr"><strong>Referencia Bancarias / Tarjeta de Cr&eacute;dito</strong></td>';
	@@html_referencias.='</tr>';
	@@html_referencias.='<tr>';
	@@html_referencias.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_referencia_bancaria_nombre_label).'</td>';
	@@html_referencias.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_referencia_bancaria_tipo_label).'</td>';
	@@html_referencias.='<td colspan="4" class="inp01">'.reemplazarVacio(@#frm_referencia_bancaria_numero).'</td>';
	@@html_referencias.='</tr>';
	@@html_referencias.='<tr>';
	@@html_referencias.='<td colspan="4" class="txt_normal ctr">Instituci&oacute;n Financiera</td>';
	@@html_referencias.='<td colspan="4" class="txt_normal ctr">Tipo</td>';
	@@html_referencias.='<td colspan="4" class="txt_normal ctr">N&uacute;mero</td>';
	@@html_referencias.='</tr>';																		   
}
///dental
//@@frm_incluye_dental='S';//eliminar
																		 
@@html_dental='';
if(@@frm_incluye_dental=='S'){
	@@html_dental.='<tr>';
	@@html_dental.='<td height="29" colspan="12" class="raya"><strong>Dependientes Plan Dental:</strong> En caso de haber tomado Plan Dental, favor llenar la informaci&oacute;n de sus dependientes. Son dependientes admisibles el c&oacute;nyuge o conviviente e hijos solteros menores de 23 a&ntilde;os.</td>';
	@@html_dental.='</tr>';
	@@html_dental.='<tr>';
	@@html_dental.='<td colspan="12">';
	@@html_dental.='<table border="0" cellspacing="0" style="width: 100%;">';
	@@html_dental.='<tbody>';
	@@html_dental.='<tr><th width="25%"><strong>No. C.I / Pasaporte:</strong></th><th width="40%"><strong>Nombre y Apellidos completos:</strong></th><th width="20%"><strong>Parentesto:</strong></th><th width="15%">Fecha Nacimiento</th></tr>';
	@@html_dental.='</tbody>';
	@@html_dental.='<tbody>';	
	foreach (@=grid_dental as $row) {
		$nombres=$row[frm_dental_primer_nombre].' '.$row[frm_dental_segundo_nombre] .' '.$row[frm_dental_primer_apellido] .' '.$row[frm_dental_segundo_apellido];	
		@@html_dental.='<tr>';
		@@html_dental.='<td class="inp01">'.reemplazarVacio($row[frm_dental_identificacion]).'</td>';
		@@html_dental.='<td class="inp01">'.reemplazarVacio($nombres).'</td>';
		@@html_dental.='<td class="inp01">'.reemplazarVacio($row[frm_dental_parentesco_label]).'</td>';
		@@html_dental.='<td class="inp01">'.reemplazarVacio($row[frm_dental_fecha_nacimiento]).'</td>';
		@@html_dental.='</tr>';
	}

	@@html_dental.='</tbody>';
	@@html_dental.='</table>';
	@@html_dental.='</td>';
	@@html_dental.='</tr>';	
}												   
///EMBARAZO
////@@frm_sexo='F';//ELIMINIAR
@@html_embarazo='';
if(@@frm_sexo=='F'){																		 	
	@@html_embarazo.='<tr>';
	@@html_embarazo.='<td colspan="12"><strong>Preguntas para ser respondidas &uacute;nicamente por mujeres (*)</strong></td>';
	@@html_embarazo.='</tr>';
	@@html_embarazo.='<tr>';
	@@html_embarazo.='<td colspan="10" class="txt_normal jtf"><strong>* &iquest;Est&aacute; embarazada?</strong></td>';
	@@html_embarazo.='<td colspan="2" class="inp01">'.reemplazarVacio(@#frm_declaracion_embarazo_label).'</td>';
	@@html_embarazo.='</tr>';
	@@html_embarazo.='<tr>';
	@@html_embarazo.='<td colspan="6" class="inp01">'.reemplazarVacio(@#frm_declaracion_fecha_cita).'</td>';
	@@html_embarazo.='<td colspan="6" class="inp01">'.reemplazarVacio(@#frm_declaracion_resultado_cita).'</td>';
	@@html_embarazo.='</tr>';
	@@html_embarazo.='<tr>';
	@@html_embarazo.='<td colspan="6" class="txt_normal jtf">(*) Fecha de la &uacute;ltima citolog&iacute;a (Papanicolaou)</td>';
	@@html_embarazo.='<td colspan="6" class="txt_normal jtf">(*) Resultado de la &uacute;ltima citolog&iacute;a (Papanicolaou)</td>';
	@@html_embarazo.='</tr>';	
}																		 
//@@frm_aplica_vitality='S';//ELIMINIAR
@@html_vitality='';
$nombres=@#frm_vitality_titular.' '.@#frm_vitality_titular_apellidos;
if(@@frm_aplica_vitality=='S'){																		 

@@html_vitality.='<table width="100%" border="1" cellspacing="0" cellpadding="5">';

// Título
@@html_vitality.='<tr>';
@@html_vitality.='<td colspan="3" class="cbg01 ctp06"><strong>PROGRAMA DE BIENESTAR VITALITY</strong></td>';
@@html_vitality.='</tr>';

// Descripción
@@html_vitality.='<tr>';
@@html_vitality.='<td colspan="3"><strong>Acepto que de ser admitido el Candidato a Asegurado, todos los beneficios de devolución de efectivo que pudieran corresponder al Programa de Bienestar Vitality, sean transferidos a la cuenta bancaria que se declara a continuación:</strong></td>';
@@html_vitality.='</tr>';

// Encabezados
@@html_vitality.='<tr>';
@@html_vitality.='<td><strong>Tipo de Cuenta</strong></td>';
@@html_vitality.='<td><strong>Banco</strong></td>';
@@html_vitality.='<td><strong>Número de Cuenta</strong></td>';
@@html_vitality.='</tr>';

// Valores
@@html_vitality.='<tr>';
@@html_vitality.='<td class="inp01">'.reemplazarVacio(@#frm_vitality_tipo_cuenta_label_temp).'</td>';
@@html_vitality.='<td class="inp01">'.reemplazarVacio(@#frm_vitality_banco_label_temp).'</td>';
@@html_vitality.='<td class="inp01">'.reemplazarVacio(@#frm_vitality_numero_cuenta).'</td>';
@@html_vitality.='</tr>';

// Identificación
@@html_vitality.='<tr>';
@@html_vitality.='<td><strong>Número de identificación del titular</strong></td>';
@@html_vitality.='<td colspan="2" class="inp01">'.reemplazarVacio(@#frm_vitality_identificacion).'</td>';
@@html_vitality.='</tr>';

// Nombre
@@html_vitality.='<tr>';
@@html_vitality.='<td><strong>Nombre del titular</strong></td>';
@@html_vitality.='<td colspan="2" class="inp01">'.reemplazarVacio($nombres).'</td>';
@@html_vitality.='</tr>';

// Nota final
@@html_vitality.='<tr>';
@@html_vitality.='<td colspan="3">EQUISUIZA SEGUROS S.A se contactará con el Asegurado en caso de que el proceso de acreditación automática presente algún inconveniente para garantizar la devolución del programa.</td>';
@@html_vitality.='</tr>';

@@html_vitality.='</table>';																 
																		 
}																							   

																	  
//OCUPACION
@@html_ocupacion='';
@@html_ocupacion.='    <td colspan="12"><strong>&iquest;Cu&aacute;les de estas actividades tiene mayor relaci&oacute;n con su ocupaci&oacute;n habitual?</strong></td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.='  <tr>';	
@@html_ocupacion.='    <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_relacion_ocupacion_habitual_label).'</td>';	
@@html_ocupacion.='    <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_frecuencia_viajes).'</td>';	
@@html_ocupacion.='    <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_otra_actividad_relacion_habitual).'</td>';	
@@html_ocupacion.='    <td>&nbsp;</td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.='  <tr>';	
@@html_ocupacion.='    <td colspan="4">&nbsp;</td>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal ctr">Frecuencia de Viajes(Si aplica)</td>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal ctr">Detalle</td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.='  <tr>';	
@@html_ocupacion.='    <td colspan="12" style="font-size: 10px;" class="txt_normal jtf"><strong>Detalle sus principales actividades en su trabajo diario:</strong></td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.='  <tr>';	
@@html_ocupacion.='    <td colspan="12" class="inp01">'.reemplazarVacio(@=frm_actividades_trabajo_diario).'</td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.='  <tr>';	
@@html_ocupacion.='    <td colspan="8"><strong>&iquest;Qu&eacute; deportes practica?:</strong></td>';	
@@html_ocupacion.='    <td colspan="4"><span class="txt_normal jtf" style="font-size: 10px;"><strong>Se considera profesional si la pr&aacute;ctica del deporte le genera ingresos</strong></span></td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.=' <tr>';	
@@html_ocupacion.='    <td colspan="8" class="inp01">'.reemplazarVacio(@#frm_deporte_practica_label).'</td>';	
@@html_ocupacion.='   <td colspan="4" class="inp01">'.reemplazarVacio(@=frm_tipo_practica_deporte_label).'</td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.='  <tr>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><span class="txt_normal jtf" style="font-size: 10px;"><strong>&iquest;Conduce moto?</strong></span></td>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><strong>Cilindraje:</strong></td>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><strong>Tipo de Uso:</strong></td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.='  <tr>';	
@@html_ocupacion.='    <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_conduce_moto_label).'</td>';	
@@html_ocupacion.='    <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_cilindraje_moto).'</td>';	
 @@html_ocupacion.='   <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_tipo_uso_moto).'</td>';	
@@html_ocupacion.='  </tr>';	
 @@html_ocupacion.=' <tr>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><strong>&iquest;Ha tenido accidentes?</strong></td>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><strong>Fecha de Accidente:</strong></td>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><strong>Gravedad y consecuencias:</strong></td>';	
@@html_ocupacion.='  </tr>';	
@@html_ocupacion.='  <tr>';	
 @@html_ocupacion.='   <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_tiene_accidentes_label).'</td>';	
 @@html_ocupacion.='   <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_fecha_accidentes).'</td>';	
@@html_ocupacion.='    <td colspan="4" class="inp01">'.reemplazarVacio(@#frm_gravedad_accidente).'</td>';	
 @@html_ocupacion.=' </tr>';	
@@html_ocupacion.='  <tr>';	
@@html_ocupacion.='    <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><strong>&iquest;Es piloto o realiza estudios de aviaci&oacute;n?</strong></td>';	
@@html_ocupacion.='    <td colspan="8" class="inp01">'.reemplazarVacio(@#frm_piloto_label).'</td>';	
 @@html_ocupacion.=' </tr>';	
 @@html_ocupacion.=' <tr>';	
 @@html_ocupacion.='   <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><strong>&iquest;Se considera una persona expuesta pol&iacute;ticamente (PEP)?</strong></td>';	
 @@html_ocupacion.='   <td colspan="8" class="inp01">'.reemplazarVacio(@#frm_trabajo_expuesta_politicamente_label).'</td>';	
@@html_ocupacion.='  </tr>	';	
 @@html_ocupacion.=' <tr>';	
 @@html_ocupacion.='   <td colspan="4" class="txt_normal jtf" style="font-size: 10px;"><strong>Especif&iacute;que</strong></td>';	
 @@html_ocupacion.='   <td colspan="8" class="inp01">'.reemplazarVacio(@#frm_expuesta_especifique_label).'</td>';	
@@html_ocupacion.='  </tr>	';	
																	   
																	   
@@html_seguros_vigentes='';
@@html_seguros_vigentes.='<tr>';
@@html_seguros_vigentes.='<td colspan="12" class="raya"><strong>Datos sobre otros seguros personales vigentes</strong></td>';
@@html_seguros_vigentes.='</tr>';
@@html_seguros_vigentes.='<tr>';
@@html_seguros_vigentes.='<td colspan="12">';
@@html_seguros_vigentes.='<table border="0" cellspacing="0" style="width: 100%;">';
@@html_seguros_vigentes.='<tbody>';
@@html_seguros_vigentes.='<tr><th width="30%"><strong>Ramo / Plan</strong></th><th width="40%"><strong>Compa&ntilde;&iacute;a</strong></th><th width="30%"><strong>Valor Asegurado</strong></th></tr>';
@@html_seguros_vigentes.='</tbody>';
@@html_seguros_vigentes.='<tbody>';
foreach (@=grid_otros_seguros as $row) {
	@@html_seguros_vigentes.='<tr>';
	@@html_seguros_vigentes.='<td height="24" class="inp01">'.reemplazarVacio($row[frm_ramooplan_label]).'</td>';
	@@html_seguros_vigentes.='<td class="inp01">'.reemplazarVacio($row[frm_compania]).'</td>';
	@@html_seguros_vigentes.='<td class="inp01">'.reemplazarVacio($row[frm_valor_asegurado_otros]).'</td>';
	@@html_seguros_vigentes.='</tr>';
}
@@html_seguros_vigentes.='</tbody>';
@@html_seguros_vigentes.='</table>';
@@html_seguros_vigentes.='</td>';
@@html_seguros_vigentes.='</tr>';																	  
///MEDICOS CONSULTADOS
@@html_medicos_consultados='';
@@html_medicos_consultados.='<tr>';
@@html_medicos_consultados.='<td colspan="12" class="raya"><strong>Detalle los m&eacute;dicos consultados por el candidato a asegurado en los &uacute;ltimos 5 a&ntilde;os.</strong></td>';
@@html_medicos_consultados.='</tr>';
@@html_medicos_consultados.='<tr>';
@@html_medicos_consultados.='<td colspan="12">';
@@html_medicos_consultados.='<table border="0" cellspacing="0" style="width: 100%;">';
@@html_medicos_consultados.='<tbody>';
@@html_medicos_consultados.='<tr><th width="25%"><strong>Nombre del M&eacute;dico:</strong></th><th width="40%"><strong>Especialidad:</strong></th><th width="20%"><strong>Fecha de Consulta</strong></th><th width="15%">Causa</th></tr>';
@@html_medicos_consultados.='</tbody>';
@@html_medicos_consultados.='<tbody>';
foreach (@=grid_medicos_consultados as $row) {
	@@html_medicos_consultados.='<tr>';
	@@html_medicos_consultados.='<td class="inp01">'.reemplazarVacio($row[frm_nombre_medico]).'</td>';
	@@html_medicos_consultados.='<td class="inp01">'.reemplazarVacio($row[frm_especialidad_medico]).'</td>';
	@@html_medicos_consultados.='<td class="inp01">'.reemplazarVacio($row[frm_fecha_onsulta]).'</td>';
	@@html_medicos_consultados.='<td class="inp01">'.reemplazarVacio($row[frm_causa_consulta]).'</td>';
	@@html_medicos_consultados.='</tr>';
}

@@html_medicos_consultados.='</tbody>';
@@html_medicos_consultados.='</table>';
@@html_medicos_consultados.='</td>';
@@html_medicos_consultados.='</tr>';																
																	   
 ///BENEFICIARIOS CONTINGENTES
@@html_ben_cont='';
if(count(@=grid_beneficiarios_contingentes)>0){
		@@html_ben_cont.=' <tr>';
		@@html_ben_cont.='<td colspan="12" class="raya"><strong>Beneficiarios Contingentes (En caso de no vivir los anteriores)</strong></td>';
		@@html_ben_cont.='</tr>';
		@@html_ben_cont.='<tr>';
		@@html_ben_cont.='<td colspan="12"><table border="0" cellspacing="0" style="width: 100%;">';
		@@html_ben_cont.='<tbody>';
		@@html_ben_cont.='<tr>';
		@@html_ben_cont.='<th width="25%"><strong>No. C.I / Pasaporte:</strong></th>';
		@@html_ben_cont.='<th width="40%"><strong>Nombre y Apellidos completos:</strong></th>';
		@@html_ben_cont.='<th width="20%"><strong>Parentesto:</strong></th>';
		@@html_ben_cont.='<th width="15%">%</th>';
		@@html_ben_cont.='</tr>';
		@@html_ben_cont.='</tbody>';
		@@html_ben_cont.='<tbody>';
		foreach (@=grid_beneficiarios_contingentes as $row) {
			$nombres=$row[frm_plan_primer_nombre_contingente].' '.$row[frm_plan_segundo_nombre_contingente] .' '.$row[frm_plan_primer_apellido_contingente] .' '.$row[frm_plan_segundo_apellido_contingente];	
			@@html_ben_cont.='<tr>';
			@@html_ben_cont.='<td class="inp01">'.reemplazarVacio($row[frm_plan_numero_identificacion_beneficiario_contingente]).'</td>';
			@@html_ben_cont.='<td class="inp01">'.reemplazarVacio($nombres).'</td>';
			@@html_ben_cont.='<td class="inp01">'.reemplazarVacio($row[frm_plan_prentesco_contingente_label]).'</td>';
			@@html_ben_cont.='<td class="inp01">'.reemplazarVacio($row[frm_plan_porcentaje_contingente]).'</td>';
			@@html_ben_cont.='</tr>';
		}
		@@html_ben_cont.='</tbody>';
		@@html_ben_cont.=' </table></td>';
		@@html_ben_cont.=' </tr>';

}

																	  
// envio de variables al formulario
$aData = array(
	'html_seccion_personales' => @@html_seccion_personales,
	'html_direccion_trabajo'=>@@html_direccion_trabajo,
	'html_info_trabajo'=>@@html_info_trabajo,
	'html_referencias'=>@@html_referencias,
	'html_dental'=>@@html_dental,
	'html_seguros_vigentes'=>@@html_seguros_vigentes,
	'html_embarazo'=>@@html_embarazo,
	'html_vitality'=>@@html_vitality,
	'html_ocupacion'=>@@html_ocupacion,
	'html_medicos_consultados'=>@@html_medicos_consultados,
	'html_ben_cont'=>@@html_ben_cont
	
);
PMFSendVariables(@@APPLICATION, $aData);

