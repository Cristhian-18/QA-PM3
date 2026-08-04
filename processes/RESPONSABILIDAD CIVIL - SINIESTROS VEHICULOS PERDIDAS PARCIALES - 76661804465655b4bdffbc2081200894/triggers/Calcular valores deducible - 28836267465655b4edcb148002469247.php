<?php
//Jean
//<?php

//Calcular valores deducible
$total_aprobado = 0;

$valores = @@frm_reg_alcances;
    if(!empty($valores)){
        foreach($valores as $row){

            $repuesto_proformado_grid = $row['rep_proformado'] ? $row['rep_proformado'] : 0;
            $mano_proformado_grid = $row['mano_proformada'] ? $row['mano_proformada'] : 0;
            $total_proformado_grid = $row['total_proformado'] ? $row['total_proformado'] : 0;

            $rep_aprobado_grid = $row['rep_aprobado'] ? $row['rep_aprobado'] : 0;
            $mano_aprobado_grid = $row['mano_aprobado'] ? $row['mano_aprobado'] : 0;
            $total_aprobado_grid = $row['total_aprobado'] ? $row['total_aprobado'] : 0;

            $rep_proformado = $rep_proformado + $repuesto_proformado_grid ;
            $mano_proformado = $mano_proformado + $mano_proformado_grid;
            $total_proformado = $total_proformado +  $total_proformado_grid;

            $rep_aprobado = $rep_aprobado + $rep_aprobado_grid;
            $mano_aprobado = $mano_aprobado + $mano_aprobado_grid ;
            $total_aprobado = round($total_aprobado + $total_aprobado_grid,2);
        }
    }
	/*@@frm_valoresAprobados_valorRepuestosProformado = $rep_aprobado;
if(@@frm_valoresAprobados_valorRepuestosProformado==null){
	@@frm_valoresAprobados_valorRepuestosProformado=1;
}
@@frm_valoresAprobados_manoObraProformada = $total_aprobado;
if(@@frm_valoresAprobados_totalProformado==null){
	@@frm_valoresAprobados_totalProformado=1;
}*/
//$total_aprobado = @@frm_valoresAprobados_totalProformado;

$valorAlcance = $total_aprobado ? $total_aprobado : 0;
if($valorAlcance == null){
	$valorAlcance = 0;
}

//@@frm_valoresAprobados_totalProformado = 0;
if(@@frm_valoresAprobados_totalProformado == null){
return;
}
$valorSiniestro_t = @@frm_valoresAprobados_totalProformado + $valorAlcance;

$deducible1 = 0;//((@@frm_deducible_ProcentajeSiniestro)/100)* $valorSiniestro_t;
//$deducible2 = @@frm_deducible_ValorAsegurado * (@@frm_deducible_PorcentajeAsegurado/100);
$deducible2 = 0;
$deducible3 = 0;// @@frm_deducible_ValorMinimo;

//get the highest
$deducible = max($deducible1, $deducible2, $deducible3);
$valorSiniestro = @@frm_valoresAprobados_totalProformado + $valorAlcance - $deducible;


@@tri_valorReclamo = @@frm_valoresAprobados_totalProformado +  $valorAlcance;
@@tri_valorDeducible = $deducible;
@@tri_valorSiniestro = $valorSiniestro;

$tasa = @@frm_tasa;
/*
$fechaSiniestro = @@frm_busqueda_fechaSiniestro;
$fechaFinVigencia = @@frm_poliza_FechaFin;

$datetime1 = new DateTime($fechaSiniestro);
$datetime2 = new DateTime($fechaFinVigencia);
$interval = $datetime1->diff($datetime2);
$days = $interval->format('%a');

//get days as integer
$days = (int)$days;

//borrar en prod
if($tasa == null){
    $tasa=1;
}



$prima_neta = ((($valorSiniestro * $tasa/100) / 365));

$prima_neta = $prima_neta * $days;

@@frm_deducible_prima = $prima_neta;
@@frm_deducible_prima = number_format((float)$prima_neta, 2, '.', '');

@@frm_deducible_porcentajeBancos = '3.5%';
$porcentajeBancos = 3.5;

$supBancos = ($prima_neta * $porcentajeBancos) / 100;
@@frm_deducible_bancos = $supBancos;
@@frm_deducible_bancos = number_format((float)$supBancos, 2, '.', '');

@@frm_deducible_sscampesinoPorcentaje = '0.05%';
$porcentajeSSC = 0.5;

$supSSC = ($prima_neta * $porcentajeSSC) / 100;
@@frm_deducible_sscampesino = $supSSC;
@@frm_deducible_sscampesino = number_format((float)$supSSC, 2, '.', '');

$sql_iva = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'CONFIGURACION'
 AND CODIGO ='IVA'";
$iva = executeQuery($sql_iva);
$porcentajeIVA = $iva[1]['VALOR'];

@@frm_deducible_ivaPorcentaje = $porcentajeIVA .'%';
*/
/*$porcentajeIVA = 15;
@@frm_deducible_ivaPorcentaje = '15%';*/
/*
$supIVA = (($prima_neta+ $supBancos+ $supSSC) * $porcentajeIVA) / 100;
@@frm_deducible_iva = $supIVA;
@@frm_deducible_iva = number_format((float)$supIVA, 2, '.', '');

@@frm_deducible_deducible = $deducible;
@@frm_deducible_deducible = number_format((float)$deducible, 2, '.', '');

$valorRasa = @@frm_deducible_prima + @@frm_deducible_bancos + @@frm_deducible_sscampesino + @@frm_deducible_iva;
if($valorRasa < 5){
    $valorRasa = 5.84;
}
@@frm_deducible_rasa = $valorRasa;
@@frm_deducible_rasa = number_format((float)@@frm_deducible_rasa, 2, '.', '');

if($valorRasa == 5.84){
@@frm_deducible_totalCliente = @@frm_deducible_rasa + @@frm_deducible_deducible;
}else{
@@frm_deducible_totalCliente = @@frm_deducible_prima + @@frm_deducible_bancos + @@frm_deducible_sscampesino + @@frm_deducible_iva + @@frm_deducible_deducible;
}

@@frm_deducible_totalCliente = number_format((float)@@frm_deducible_totalCliente, 2, '.', '');
*/

