<?php
//@@frm_valor_asegurado= '1000'; //luego borrar esta linea <- solo para pruebas
//Identificar correo y telefono preferido
$pref_correo=@=frm_trabajo_correo_preferido_label;
$pref_telefono=@=frm_trabajo_contacto_preferido_label;
$email=@@frm_correo_electronico_personal;
$telefono=	@@frm_celular;

//Buscar cual es el correo preferido 0: trabajo, y validar que no este vacio
	if(($pref_telefono=='Trabajo' )&& (!empty(@@frm_trabajo_celular)||(strlen(trim(@@frm_trabajo_celular))!=0))){
		$telefono=@@frm_trabajo_celular;
	}
	if(($pref_correo=='Trabajo')&&  (!empty(@@frm_trabajo_correo_trabajo)||(strlen(trim(@@frm_trabajo_correo_trabajo))!=0))){
		$email=@@frm_trabajo_correo_trabajo;
	}


@@telefono_preferido=$telefono;
@@correo_preferido=$email;
@@sw_fam = 'PASA';

