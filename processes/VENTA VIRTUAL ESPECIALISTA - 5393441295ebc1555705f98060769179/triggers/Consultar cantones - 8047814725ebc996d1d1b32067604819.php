<?php
try{

	$frm_auxiliar = "";
	@@frm_canton_auxiliar = "";

	for ($i = 0; $i <= 25; $i++) {
		$url = "http://10.10.43.41:8080/cu-res/api/"."cantones/".$i;
		$result = file_get_contents($url);
		$datos['data'] = json_decode($result,true);
	
		if (is_array($datos)) {
		  foreach ($datos['data'] as $row) {
			  $matriz[$row['secCanton']] = array($row['nombre']);
			  $frm_auxiliar = $frm_auxiliar.$row['provincia']['secProvincia'].",".$row['secCanton'].",";
		  }		
		}
	}	
	
	$frm_auxiliar = substr($frm_auxiliar, 0, -1);
	@@frm_canton_auxiliar = $frm_auxiliar;		
	
	asort($matriz);	//Ordenar por alfabeto
	
	@@datos_cantones = "";
	foreach ($matriz as $key => $array) {	
		@@datos_cantones[] = array($key, $array[0]);
	}		
}		
catch(SoapFault $result){
	$datos['error'] = 'SI';
	echo json_encode($datos);
}