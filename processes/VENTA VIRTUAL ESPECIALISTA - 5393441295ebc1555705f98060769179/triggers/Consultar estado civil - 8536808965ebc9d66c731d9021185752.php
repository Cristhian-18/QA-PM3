<?php
try{
	$url = "http://10.10.43.41:8080/cu-rest/api/estados-civil/S";
	$result = file_get_contents($url);
	$datos['data'] = json_decode($result,true);
	
	if (is_array($datos)) {
		foreach ($datos['data'] as $row) {
			$matriz[$row['codEstadoCivil']] = array($row['estadoCivil']);
		}
	}
	
	asort($matriz);	//Ordenar por alfabeto
	
	@@datos_cantones = "";
	foreach ($matriz as $key => $array) {
		@@datos_cantones[] = array($key, $array[0]);
	}
	//@@datos_estado_civil = $datos['data'];
}
catch(SoapFault $result){
	$datos['error'] = 'SI';
	echo json_encode($datos);
}