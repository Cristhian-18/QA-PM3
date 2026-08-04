<?php
//Verificar si falta algun documento
@@bandera = true;

for ($i = 1; $i <= count(@=grd_obligatorios); $i++) {
	if(@@grd_obligatorios[$i]['frm_obli_descripcion'] != "" AND @@grd_obligatorios[$i]['doc_obli'] == ""){
		@@bandera = false;
	}
}

for ($i = 1; $i <= count(@=grd_especificos); $i++) {
	if(@@grd_especificos[$i]['frm_espe_descripcion'] != "" AND @@grd_especificos[$i]['doc_opc'] == ""){
		@@bandera = false;
	}
}

if(@@bandera == true){
	@@frm_control_adjuntos = "COMPLETO";
	@@frm_control_adjuntos_fecha = date("Y-m-d H:i:s");
}else{
	@@frm_control_adjuntos = "";
}


@@frm_control_adjuntos = "COMPLETO";
