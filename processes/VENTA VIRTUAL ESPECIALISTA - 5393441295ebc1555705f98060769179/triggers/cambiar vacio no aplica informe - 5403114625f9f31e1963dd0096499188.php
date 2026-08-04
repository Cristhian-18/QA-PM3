<?php
if(@@frm_infconf_b != 'N'){
	@@frm_infconf_b_detalle = '';
}

if(@@frm_infconf_c != 'N'){
	@@frm_infconf_c_detalle = '';
}

if(@@frm_infconf_d != 'N'){
	@@frm_infconf_d_detalle = '';
}

if(@@frm_infconf_f != 'OTRO'){
	@@frm_infconf_f_detalle = '';
}

if(@@frm_infconf_g != 'OTRO'){
	@@frm_infconf_g_detalle = '';
}



function vacio_na_infConf($arg)
{
	return (empty($arg)||(($arg)=='Seleccione')||(strlen(trim($arg))==0))? 'N/A' : $arg;
}
//Pasar a variables PHP
$frm_infconf_a_parentesco_label = @@frm_infconf_a_parentesco_label;
$frm_infconf_a_detalle_label = @@frm_infconf_a_detalle_label;
$frm_infconf_a_contacto_label = @@frm_infconf_a_contacto_label;

$frm_infconf_b_detalle = @@frm_infconf_b_detalle;
$frm_infconf_c_detalle = @@frm_infconf_c_detalle;
$frm_infconf_d_detalle = @@frm_infconf_d_detalle;
$frm_infconf_f_detalle = @@frm_infconf_f_detalle;
$frm_infconf_g_detalle = @@frm_infconf_g_detalle;
$frm_infconf_observaciones = @@frm_infconf_observaciones;

//Pasar de vacio a N/A
@@frm_infconf_a_parentesco_label = vacio_na_infConf($frm_infconf_a_parentesco_label);
@@frm_infconf_a_detalle_label = vacio_na_infConf($frm_infconf_a_detalle_label);
@@frm_infconf_a_contacto_label = vacio_na_infConf($frm_infconf_a_contacto_label);

@@frm_infconf_b_detalle = vacio_na_infConf($frm_infconf_b_detalle);
@@frm_infconf_c_detalle = vacio_na_infConf($frm_infconf_c_detalle);
@@frm_infconf_d_detalle = vacio_na_infConf($frm_infconf_d_detalle);
@@frm_infconf_f_detalle = vacio_na_infConf($frm_infconf_f_detalle);
@@frm_infconf_g_detalle = vacio_na_infConf($frm_infconf_g_detalle);
@@frm_infconf_observaciones = vacio_na_infConf($frm_infconf_observaciones);
