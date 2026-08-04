<?php
$bandera_indemnizacion = "0";
if(@@frm_accion == "CONTINUAR"){
	$bandera_indemnizacion = "1";
}

@@tri_bandera_indemnizacion = $bandera_indemnizacion;

