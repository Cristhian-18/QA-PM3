<?php
if(@@frm_accion == "CONTINUAR"){
	$alcances = @@grd_valores_siniestros_alcance;

    
$rep_proformado = @@frm_alcanceAdicional_valorRepuestos;
$mano_proformado = @@frm_alcanceAdicional_valorMano;
$total_proformado = @@frm_alcanceAdicional_total;
$rep_aprobado = @@frm_alcanceAdicional_valorRepuestosAprobado;
$mano_aprobado = @@frm_alcanceAdicional_valorManoAprobado;
$total_aprobado = @@frm_alcanceAdicional_valorTotalAprobado;

$array_registro_alcances = array();
$array_registro_alcances = @@frm_reg_alcances ? @@frm_reg_alcances : array();

$array_alcance = array(
    "rep_proformado" => $rep_proformado,
    "mano_proformada" => $mano_proformado,
    "total_proformado" => $total_proformado,
    "separador"=> "",
    "rep_aprobado" => $rep_aprobado,
    "mano_aprobado" => $mano_aprobado,
    "total_aprobado" => $total_aprobado
);
/*
$aprobadoTotal = @@frm_totalMasAlcances;

if($aprobadoTotal == "" || $aprobadoTotal == null){
    @@frm_totalMasAlcances = @@frm_valoresAprobados_totalProformado;
}

$aprobado_final = @@frm_totalMasAlcances + $total_aprobado;

@@frm_totalMasAlcances = $aprobado_final;

@=frm_reg_alcances[] = $array_alcance;*/

$index = count($array_registro_alcances);

$array_registro_alcances[$index+1] = $array_alcance;

$aprobadoTotal = @@frm_totalMasAlcances;

if($aprobadoTotal == "" || $aprobadoTotal == null){
    @@frm_totalMasAlcances = @@frm_valoresAprobados_totalProformado;
}
echo "array alcance: ";

$aprobado_final = @@frm_totalMasAlcances + $total_aprobado;
echo "array alcance: ";

@@frm_totalMasAlcances = $aprobado_final;
@@ultimo_alcance = $array_alcance;
@@array_anterior = $array_registro_alcances;
$array_total = array();

echo "count: " . count($array_registro_alcances) . "<br>";
if(isset($array_registro_alcances[0])){
    for($i = 1; $i <= count($array_registro_alcances); $i++){
        $array_total[$i] = $array_registro_alcances[$i-1];
    }
} else {
    $array_total = $array_registro_alcances;
}
echo "Checking last element <br>". count($array_total) . "<br>";
print_r($array_total[count($array_total)]);
if (isset($array_total[count($array_total)]) && 
   $array_total[count($array_total)]['rep_proformado'] == "" && 
   $array_total[count($array_total)]['mano_proformada'] == "" && 
   $array_total[count($array_total)]['total_proformado'] == "" && 
   $array_total[count($array_total)]['separador'] == "" && 
   $array_total[count($array_total)]['rep_aprobado'] == "" && 
   $array_total[count($array_total)]['mano_aprobado'] == "" && 
   $array_total[count($array_total)]['total_aprobado'] == "") {
    unset($array_total[count($array_total)]);
    echo "last element deleted<br>";
}
@@frm_reg_alcances = $array_total;


@@frm_alcanceAdicional_valorRepuestos = null;
@@frm_alcanceAdicional_valorMano = null;
@@frm_alcanceAdicional_total = null;
@@frm_alcanceAdicional_valorRepuestosAprobado = null;
@@frm_alcanceAdicional_valorManoAprobado = null;
@@frm_alcanceAdicional_valorTotalAprobado = null;
}

	 
 