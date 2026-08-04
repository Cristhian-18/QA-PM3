<?php
//bandera cierre de mes
 
//estado de la bandera

$sql = "SELECT id, bandera FROM SINIESTRO_VH_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_VH_CONFIGURACION)";

$rs = executeQuery($sql);

$id_bandera = $rs['1']['bandera'];
@@tri_bandera_cierreMes = $id_bandera;

@@bandera_manual = "0";

if(@@frm_tipo_solitud == "2"){
    $bandera_manual = "1";
	$bandera_manual_texto = "Manual";
} else {
    $bandera_manual = "0";
	$bandera_manual_texto = "Automático";
}
@@bandera_manual = $bandera_manual;
@@bandera_manual_texto = $bandera_manual_texto;

if(@@bandera_manual == "1"){
	//echo 'manual';
    @@frm_accion = 'REGISTRAR';
}
else if ( @@frm_origen_core_insurance == "INSURANCE" ){
	//echo 'EQUISUIZA<br>';
    @@frm_accion = 'EQUISUIZA';
}
//else if(@@tri_bandera_error == "1" || @@frm_accion == "ERROR"){
else if(@@tri_bandera_error == "1"/* || @@frm_accion == "ERROR"*/){
	@@frm_accion = 'ERROR';
	@@tri_estado = 'INGRESADO';
}
else {
	//echo 'continuar';
  @@frm_accion = 'CONTINUAR';
	@@tri_estado = '';
}

if(@@tri_bandera_cierreMes == "SI"){
	@@frm_accion = 'CIERRE_MES';
	@@tri_estado = 'INGRESADO';
}

if (@@frm_origen_core_insurance == "INSURANCE"){
    @@frm_accion = 'EQUISUIZA';
}

