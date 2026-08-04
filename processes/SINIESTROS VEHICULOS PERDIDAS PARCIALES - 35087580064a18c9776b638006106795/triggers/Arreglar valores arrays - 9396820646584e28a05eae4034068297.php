<?php
//<?

$array_vehiculos = @@grd_vehiculos_afectados;
$array_personas = @@grd_personas_afectados;
$array_propiedades = @@grd_propiedad_afectados;

@@grd_vehiculos_afectados = array();
@@grd_personas_afectados = array();
@@grd_propiedad_afectados = array();
$i = 1;
foreach ($array_vehiculos as $vehiculo) {
	//Array ( [frm_vafectado_marca] => 360 [frm_vafectado_modelo] =>  SAIL STD TM 1.4 4P 4X2 [frm_vafectado_placa] => BNM1234 [frm_vafectado_propietario] => DIANA CASTILLO [frm_vafectado_danios] => CHASIS [frm_vafectado_taller] => [frm_vafectado_estado] => )
	//right format 
	//Array ( [frm_vafectado_marca] => 380 [frm_vafectado_marca_label] => BEICHI [frm_vafectado_modelo] => 123 [frm_vafectado_modelo_label] => 123 [frm_vafectado_placa] => 123 [frm_vafectado_placa_label] => 123 [frm_vafectado_anio] => 123 [frm_vafectado_anio_label] => 123 [frm_vafectado_propietario] => 123 [frm_vafectado_propietario_label] => 123 [frm_vafectado_danios] => 123 [frm_vafectado_danios_label] => 123 [frm_vafectado_estado] => TALLER [frm_vafectado_estado_label] => Atención en taller )
	@@grd_vehiculos_afectados[$i]['frm_vafectado_marca'] = $vehiculo['frm_vafectado_marca'];
	//@@grd_vehiculos_afectados[$i]['frm_vafectado_marca_label'] = $vehiculo['frm_vafectado_marca'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_modelo'] = $vehiculo['frm_vafectado_modelo'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_modelo_label'] = $vehiculo['frm_vafectado_modelo'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_placa'] = $vehiculo['frm_vafectado_placa'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_placa_label'] = $vehiculo['frm_vafectado_placa'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_anio'] = $vehiculo['frm_vafectado_anio'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_anio_label'] = $vehiculo['frm_vafectado_anio'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_propietario'] = $vehiculo['frm_vafectado_propietario'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_propietario_label'] = $vehiculo['frm_vafectado_propietario'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_danios'] = $vehiculo['frm_vafectado_danios'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_danios_label'] = $vehiculo['frm_vafectado_danios'];
	@@grd_vehiculos_afectados[$i]['frm_vafectado_estado'] = $vehiculo['frm_vafectado_estado'];
	$i++;
}
/*
$i = 1;
	//Wrong format
	//[1] => Array ( [frm_prafectado_nombre] => [frm_prafectado_telefono] => ) [2] => Array ( [frm_prafectado_nombre] => [frm_prafectado_telefono] => )
	//Right format
	//[1] => Array ( [frm_pafectado_nombre] => 174 [frm_pafectado_nombre_label] => 174 [frm_pafectado_telefono] => 17 [frm_pafectado_telefono_label] => 17 [frm_pafectado_email] => 71 [frm_pafectado_email_label] => 71 ) [2] => Array ( [frm_pafectado_nombre] => 18 [frm_pafectado_nombre_label] => 18 [frm_pafectado_telefono] => 18 [frm_pafectado_telefono_label] => 18 [frm_pafectado_email] => 18 [frm_pafectado_email_label] => 18 ) 
foreach ($array_personas as $persona) {
	@@grd_personas_afectados[$i]['frm_pafectado_nombre'] = $persona['frm_pafectado_nombre'];
	@@grd_personas_afectados[$i]['frm_pafectado_nombre_label'] = $persona['frm_pafectado_nombre'];
	@@grd_personas_afectados[$i]['frm_pafectado_telefono'] = $persona['frm_pafectado_telefono'];
	@@grd_personas_afectados[$i]['frm_pafectado_telefono_label'] = $persona['frm_pafectado_telefono'];
	@@grd_personas_afectados[$i]['frm_pafectado_email'] = $persona['frm_pafectado_email'];
	@@grd_personas_afectados[$i]['frm_pafectado_email_label'] = $persona['frm_pafectado_email'];
	$i++;
}

// [0] => Array ( ) [1] => Array ( [frm_prafectado_nombre] => [frm_prafectado_telefono] => ) [2] => Array ( [frm_prafectado_nombre] => [frm_prafectado_telefono] => ) )
// [1] => Array ( [frm_pafectado_nombre] => 174 [frm_pafectado_nombre_label] => 174 [frm_pafectado_telefono] => 17 [frm_pafectado_telefono_label] => 17 [frm_pafectado_email] => 71 [frm_pafectado_email_label] => 71 ) [2] => Array ( [frm_pafectado_nombre] => 18 [frm_pafectado_nombre_label] => 18 [frm_pafectado_telefono] => 18 [frm_pafectado_telefono_label] => 18 [frm_pafectado_email] => 18 [frm_pafectado_email_label] => 18 )

$i = 1;
foreach($array_propiedades as $propiedad){
	@@grd_propiedad_afectados[$i]['frm_prafectado_nombre'] = $propiedad['frm_prafectado_nombre'];
	@@grd_propiedad_afectados[$i]['frm_prafectado_nombre_label'] = $propiedad['frm_prafectado_nombre'];
	@@grd_propiedad_afectados[$i]['frm_prafectado_factura'] = $propiedad['frm_prafectado_factura'];
	@@grd_propiedad_afectados[$i]['frm_prafectado_factura_label'] = $propiedad['frm_prafectado_factura'];
	@@grd_propiedad_afectados[$i]['frm_prafectado_telefono'] = $propiedad['frm_prafectado_telefono'];
	@@grd_propiedad_afectados[$i]['frm_prafectado_telefono_label'] = $propiedad['frm_prafectado_telefono'];
	$i++;
}*/