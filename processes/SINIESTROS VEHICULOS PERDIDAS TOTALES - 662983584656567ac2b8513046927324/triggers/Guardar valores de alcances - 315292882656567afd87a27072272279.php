<?php
if(@@frm_accion == "CONTINUAR"){
	$alcances = @@grd_valores_siniestros_alcance;


foreach($alcances as $alcance){
    $alcance['frm_gvs_cantidad'] = $alcance['frm_gvs_cantidad_1'];
    $alcance['frm_gvs_nparte'] = $alcance['frm_gvs_nparte_1'];
    $alcance['frm_gvs_descripcion'] = $alcance['frm_gvs_descripcion_1'];
    @=grd_valores_siniestros[] = $alcance;
}
	

$rep_proformado = @@frm_alcanceAdicional_valorRepuestos;
$mano_proformado = @@frm_alcanceAdicional_valorMano;
$total_proformado = @@frm_alcanceAdicional_total;
$rep_aprobado = @@frm_alcanceAdicional_valorRepuestosAprobado;
$mano_aprobado = @@frm_alcanceAdicional_valorManoAprobado;
$total_aprobado = @@frm_alcanceAdicional_valorTotalAprobado;

$array_alcance = array(
    "rep_proformado" => $rep_proformado,
    "mano_proformada" => $mano_proformado,
    "total_proformado" => $total_proformado,
    "separador"=> "",
    "rep_aprobado" => $rep_aprobado,
    "mano_aprobado" => $mano_aprobado,
    "total_aprobado" => $total_aprobado
);

$aprobadoTotal = @@frm_totalMasAlcances;

if($aprobadoTotal == "" || $aprobadoTotal == null){
    @@frm_totalMasAlcances = @@frm_valoresAprobados_totalProformado;
}

$aprobado_final = @@frm_totalMasAlcances + $total_aprobado;

@@frm_totalMasAlcances = $aprobado_final;

@=frm_reg_alcances[] = $array_alcance;

@@frm_alcanceAdicional_valorRepuestos = null;
@@frm_alcanceAdicional_valorMano = null;
@@frm_alcanceAdicional_total = null;
@@frm_alcanceAdicional_valorRepuestosAprobado = null;
@@frm_alcanceAdicional_valorManoAprobado = null;
@@frm_alcanceAdicional_valorTotalAprobado = null;
}
