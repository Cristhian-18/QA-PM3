<?php
//<?php
//Consultar Datos Solicitud$banderaMundo = "0";
$alcances = array();
$alcances = @@grd_valores_siniestros_alcance;


@@aux_alcances = 0;



if(@@frm_taller == "MUNDO MOTRIZ"){
	

	
$banderaMundo = "1";
$suma = 0;
@@tri_bandera_alcance = "1";
$array = @@grd_valores_siniestros_alcance;
//foreach to array

foreach($array as $row){
    $suma = $suma + $row['frm_gvs_pvp'];
}

$rep_proformado = $suma;
$rep_proformado =  number_format($rep_proformado, 2, '.', '');
$mano_proformado = @@frm_alcanceAdicional_valorMano;
$mano_proformado = number_format($mano_proformado, 2, '.', '');
$total_proformado = $suma + $mano_proformado;
$total_proformado = number_format($total_proformado, 2, '.', '');

$rep_aprobado = $rep_proformado;
$mano_aprobado = $mano_proformado;
$total_aprobado = $total_proformado;

$array_registro_alcances = array();
$array_registro_alcances = @@frm_reg_alcances;


$array_alcance = array(
"rep_proformado" => $rep_proformado,
"mano_proformada" => $mano_proformado,
"total_proformado" => $total_proformado,
"separador"=> "",
"rep_aprobado" => $rep_aprobado,
"mano_aprobado" => $mano_aprobado,
"total_aprobado" => $total_aprobado
);



@=frm_reg_alcances[] = $array_alcance;



@@frm_alcanceAdicional_valorMano = null;
@@frm_alcanceAdicional_valorRepuestos = null;
@@frm_alcanceAdicional_total = null;

$aprobadoTotal = @@frm_totalMasAlcances;

if($aprobadoTotal == "" || $aprobadoTotal == null){
@@frm_totalMasAlcances = @@frm_valoresAprobados_totalProformado;
}

$aprobado_final = @@frm_totalMasAlcances + $total_aprobado;

@@frm_totalMasAlcances = $aprobado_final;

}

@@tri_bandera_mundo = $banderaMundo;
