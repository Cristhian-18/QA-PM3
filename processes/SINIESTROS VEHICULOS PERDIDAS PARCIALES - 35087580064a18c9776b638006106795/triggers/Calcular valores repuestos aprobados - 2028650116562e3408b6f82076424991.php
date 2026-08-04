<?php
if (
	@@frm_valoresAprobados_totalProformado != null &&
	@@frm_valoresAprobados_totalProformado != '' &&
 	!is_nan(@@frm_valoresAprobados_totalProformado)
 ) {
	return;
 }


$taller = @@frm_taller;

$tipo = @@frm_taller_tipo;
$array_valores = array();
$array_valores = @@grd_valores_siniestros;
$suma = 0;
$suma_aux = 0;
$repuestos_len = isset($array_valores);
 
foreach ($array_valores as $valor) {
	 
	if (
		$valor['frm_gvs_cantidad'] != '' && $valor['frm_gvs_cantidad'] != null && $valor['frm_gvs_pvp'] > 0
		&& is_numeric($valor['frm_gvs_pvp'])
	) {
		 
		$valor_pvp =  $valor['frm_gvs_pvp'] ?  $valor['frm_gvs_pvp'] : 0;
	 
		$pvp = $valor_pvp;
		$suma = $suma + $pvp;
		$suma_aux = $suma;
	} else {
		echo "Nan";
	}
}

$suma = round($suma, 2);

 
 

$valores_repuestos = (@@frm_valoresSiniestro_valoresRepuestos1 == '' || @@frm_valoresSiniestro_valoresRepuestos1 == 'NaN' ? 0 : @@frm_valoresSiniestro_valoresRepuestos1);
 

if ($valores_repuestos == 'NaN') {
	echo "is_nan";
}

try {
	if ($valores_repuestos != null && $valores_repuestos != '' && !is_nan($valores_repuestos) && $valores_repuestos != 'NaN') {
	 
		$suma = $valores_repuestos;
		$suma_aux = $suma;
	 
	} else {
		echo "is_nan3";
	}
} catch (Exception $e) {
	echo $e;
}


 

if ($suma == 0 || $suma == "0" || is_nan($suma)) {
	$suma = @@frm_valoresSiniestro_valoresRepuestos1 ? @@frm_valoresSiniestro_valoresRepuestos1 : 0;
	$suma_aux = ($suma == 'NaN' ? 0 : $suma);
	$suma = ($suma == 'NaN' ? 0 : $suma);
}
 

try {
	$suma = number_format($suma, 2, '.', '');
} catch (Exception $e) {
	$suma = 0;
}
 
if ($tipo == "TALLER AUTORIZADO MULTIMARCA" && $suma > 0.01) {

	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	if (@@frm_valoresSiniestro_procentajeDescuentoProformado == null || @@frm_valoresSiniestro_procentajeDescuentoProformado == '') {
		@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	}
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;
}

 
if (stripos($taller, "MUNDO MOTRIZ") !== false && $suma > 1) {
	$suma = $suma_aux;
	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;

	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;

	@@frm_valoresAprobados_valoresRepuestos1 = $suma;
	@@frm_valoresAprobados_procentajeDescuentoProformado = 0;
	@@frm_valoresAprobados_valorRepuestosProformado = $suma;

	@@frm_valoresAprobados_manoObraProformada = @@frm_valoresSiniestro_manoObraProformada;
	@@frm_valoresAprobados_diasEstimadosReparacion = @@frm_valoresSiniestro_diasEstimadosReparacion;
}

if (stripos($taller, "MUNDO MOTRIZ") !== false && $suma <= 1) {
	$suma = 0;

	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;

	@@frm_valoresSiniestro_valoresRepuestos1 = $suma;
	@@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
	@@frm_valoresSiniestro_valorRepuestosProformado = $suma;

	@@frm_valoresAprobados_valoresRepuestos1 = $suma;
	@@frm_valoresAprobados_procentajeDescuentoProformado = 0;
	@@frm_valoresAprobados_valorRepuestosProformado = $suma;

	@@frm_valoresAprobados_manoObraProformada = @@frm_valoresSiniestro_manoObraProformada;
	@@frm_valoresAprobados_diasEstimadosReparacion = @@frm_valoresSiniestro_diasEstimadosReparacion;
}


 
 