<?php
if(@@frm_valoresAprobados_valoresRepuestos1 != '' && @@frm_valoresAprobados_valoresRepuestos1 != 0){
    return;
}

 


$taller = @@frm_taller;
$tipo = @@frm_taller_tipo;
$array_valores = @@grd_valores_siniestros;
$suma = 0.0;
foreach ($array_valores as $valor) {
    $pvp = floatval($valor['frm_gvs_pvp']);
    $suma = $suma + $pvp;
}

$suma =  round($suma, 2);


if($tipo == "TALLER AUTORIZADO MULTIMARCA"){

    @@frm_valoresSiniestro_valoresRepuestos1 = $suma;
    @@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
    @@frm_valoresSiniestro_valorRepuestosProformado = $suma;
}

if ($taller == "MUNDO MOTRIZ") {
    @@frm_valoresSiniestro_valoresRepuestos1 = $suma;
    @@frm_valoresSiniestro_procentajeDescuentoProformado = 0;
    @@frm_valoresSiniestro_valorRepuestosProformado = $suma;
    
    @@frm_valoresAprobados_valoresRepuestos1 = $suma;
    @@frm_valoresAprobados_procentajeDescuentoProformado = 0;
    @@frm_valoresAprobados_valorRepuestosProformado = $suma;

    @@frm_valoresAprobados_manoObraProformada = @@frm_valoresSiniestro_manoObraProformada;
    @@frm_valoresAprobados_diasEstimadosReparacion = @@frm_valoresSiniestro_diasEstimadosReparacion;
}
 

 