<?php
//<?


@@grd_valores_siniestros_alcance = array();
@@frm_alcanceAdicional_valorMano = null;
$valores = array();
$valores = @@frm_reg_alcances;

@@frm_reg_alcances = array();

$i = 1;


foreach($valores as $row){
    //[rep_proformado] => 10.00 [mano_proformada] => 10.00 [total_proformado] => 20.00 [separador] => [rep_aprobado] => 10.00 [mano_aprobado] => 10.00 [total_aprobado] =
    @@frm_reg_alcances[$i]['rep_proformado'] = $row['rep_proformado'] ?  $row['rep_proformado'] :0;
    @@frm_reg_alcances[$i]['mano_proformada'] = $row['mano_proformada'] ?  $row['mano_proformada'] :0;
    @@frm_reg_alcances[$i]['total_proformado'] = $row['total_proformado'] ?  $row['total_proformado'] :0;
    @@frm_reg_alcances[$i]['separador'] = $row['separador'] ?  $row['separador'] :"";
    @@frm_reg_alcances[$i]['rep_aprobado'] = $row['rep_aprobado'] ?  $row['rep_aprobado'] :"";
    @@frm_reg_alcances[$i]['mano_aprobado'] = $row['mano_aprobado'] ?  $row['mano_aprobado'] :0;
    @@frm_reg_alcances[$i]['total_aprobado'] = $row['total_aprobado'] ?  $row['total_aprobado'] :0;
    $i++;
}

if(!empty($valores)){
    foreach($valores as $row){
        
        $total_aprobado_grid = $row['total_aprobado'] ? $row['total_aprobado'] : 0;
        $total_aprobado = $total_aprobado + $total_aprobado_grid;
    }
}



$aprobadoTotal = @@frm_valoresAprobados_totalProformado + $total_aprobado;
@@frm_totalMasAlcances = $aprobadoTotal;



/*if($aprobadoTotal == "" || $aprobadoTotal == null){
@@frm_totalMasAlcances = @@frm_valoresAprobados_totalProformado;
	$aprobado_final = @@frm_valoresAprobados_totalProformado + $total_aprobado;
} else {
$aprobado_final = @@frm_totalMasAlcances + $total_aprobado;
	@@frm_totalMasAlcances = $aprobado_final;
}*/

