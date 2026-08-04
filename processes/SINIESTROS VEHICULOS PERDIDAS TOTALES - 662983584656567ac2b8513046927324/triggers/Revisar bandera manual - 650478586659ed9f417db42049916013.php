<?php
//bandera cierre de mes

 

$sql = "SELECT id, bandera FROM SINIESTRO_VH_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_VH_CONFIGURACION)";

$rs = executeQuery($sql);

$id_bandera = $rs['1']['bandera'];

@@tri_bandera_cierreMes = $id_bandera;

if(@@tri_bandera_cierreMes == "SI"){
	@@frm_accion = 'CIERRE_MES';
} else {
	@@frm_accion = 'CONTINUAR';
}

 
if (@@frm_origen_core_insurance == "INSURANCE"){
    @@frm_accion = 'EQUISUIZA';
}