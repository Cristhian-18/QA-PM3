<?php
 
$cnx = '736600101659ece82736670094820028';
//estado de la bandera
$sql = "SELECT id, bandera FROM SINIESTRO_GN_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_GN_CONFIGURACION)";
$rs = executeQuery($sql, $cnx);
echo 'portal';
$id_bandera = $rs['1']['bandera'];
@@tri_bandera_cierreMes = $id_bandera;


//codigo Jean - Borrar en caso de que no funcione

if(@@frm_ds_tipoOperacion == 'FACULTADO' || @@frm_ds_tipoOperacion == 'DIRECTA(FC)'){
	@@tri_tipo_operacion = '1';
}
/*else {
	@@tri_tipo_operacion = '0';
}*/

switch(@@tri_tipo_operacion){
	case "1":
		@@frm_ac_accion = 'REASEGUROS';
		@@string_facultado = 'FACULTADO';
	break;
	case "0":
		@@frm_ac_accion = 'CONTINUAR';
		@@string_facultado = 'NO FACULTADO';
	break;
	default:
		@@frm_ac_accion = 'CONTINUAR';
		break;
}

if(@@tri_bandera_cierreMes == "SI"){
		@@frm_ac_accion = 'CIERRE_MES';
}

$grid_ramo = array();
$grid_ramo = @@frm_grd_siniestrosRegsitrados;
foreach($grid_ramo as $ramo){
	@@tri_ramo_correo = $ramo['grd_ramo'];
}

if ( @@frm_origen_core_insurance == "INSURANCE" ){
	echo 'EQUISUIZA<br>';
    @@frm_ac_accion = 'EQUISUIZA';
}
 

