<?php
$valores = isset(@=frm_reg_alcances) ? @=frm_reg_alcances : array();

    if(!empty($valores)){
        foreach($valores as $row){
 
            $repuesto_proformado_grid = is_numeric($row['rep_proformado']) ? $row['rep_proformado'] : 0;
            $mano_proformado_grid = is_numeric($row['mano_proformada']) ? $row['mano_proformada'] : 0;
            $total_proformado_grid = is_numeric($row['total_proformado']) ? $row['total_proformado'] : 0;

            $rep_aprobado_grid = is_numeric($row['rep_aprobado']) ? $row['rep_aprobado'] : 0;
            $mano_aprobado_grid = is_numeric($row['mano_aprobado']) ? $row['mano_aprobado'] : 0;
            $total_aprobado_grid = is_numeric($row['total_aprobado']) ? $row['total_aprobado'] : 0;

            $rep_proformado = $rep_proformado + round($repuesto_proformado_grid,2 );
            $mano_proformado = $mano_proformado + round($mano_proformado_grid,2 );
            $total_proformado = $total_proformado +  round($total_proformado_grid,2 );

            $rep_aprobado = $rep_aprobado + $rep_aprobado_grid;
            $mano_aprobado = $mano_aprobado + $mano_aprobado_grid ;
            $total_aprobado = $total_aprobado + $total_aprobado_grid;
        }
    }
  


$valorAlcance = isset($total_aprobado) ? $total_aprobado : 0;
if($valorAlcance == null){
	$valorAlcance = 0;
}
 

$valorSiniestro_t = @@frm_valoresAprobados_totalProformado + $valorAlcance;

$deducible1 = ((@@frm_deducible_ProcentajeSiniestro)/100)* $valorSiniestro_t;

$deducible2 = @@frm_deducible_ValorAsegurado * (@@frm_deducible_PorcentajeAsegurado/100);

 

$deducible3 = @@frm_deducible_ValorMinimo;
//get the highest
$deducible = max($deducible1, $deducible2, $deducible3);

$valorSiniestro = @@frm_valoresAprobados_totalProformado + $valorAlcance - $deducible;

 
 

@@tri_valorReclamo = @@frm_valoresAprobados_totalProformado;// +  $valorAlcance;
@@tri_valorAlcance = $valorAlcance ? $valorAlcance : 0;
@@tri_valorDeducible = $deducible;

$tasa = (@@frm_tasa==''?1:@@frm_tasa);
$fechaSiniestro = @@frm_busqueda_fechaSiniestro;
$fechaFinVigencia = @@frm_poliza_FechaFin;
$fechaFinVigencia = str_replace("/", "-", $fechaFinVigencia);
 

$datetime1 = new DateTime($fechaSiniestro);

$datetime2 = new DateTime($fechaFinVigencia);

$num_pol = @@frm_poliza_numero;
if($fechaFinVigencia == null || $fechaFinVigencia == '' ){
	if($num_pol == '425879'){

		$fechaFinVigencia = '2024-04-01T00:00:00';
		$datetime2 = new DateTime($fechaFinVigencia);
		return;
	}
}

$interval = $datetime1->diff($datetime2);

$days = $interval->format('%a');

 
$days = (int)$days;
@@dias_restantes = $days;
 
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
@@frm_deducible_deducible_sin_rasa = number_format((float)@@frm_deducible_deducible, 2, '.', '');
@@tri_valorSiniestro = $valorSiniestro - @@frm_deducible_rasa;

 
