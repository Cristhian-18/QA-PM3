<?php
@@grd_valores_siniestros_alcance = array();
@@frm_alcanceAdicional_valorMano = null;
$valores = array();
$valores = @@frm_reg_alcances;
@@frm_reg_alcances = array();
$i = 1;
foreach($valores as $row){

    $repProf   = ($row['rep_proformado']    ?? '') === '' ? 0 : $row['rep_proformado'];
    $manoProf  = ($row['mano_proformada']   ?? '') === '' ? 0 : $row['mano_proformada'];
    $totalProf = ($row['total_proformado']  ?? '') === '' ? 0 : $row['total_proformado'];
    $repApro   = ($row['rep_aprobado']      ?? '') === '' ? 0 : $row['rep_aprobado'];
    $manoApro  = ($row['mano_aprobado']     ?? '') === '' ? 0 : $row['mano_aprobado'];
    $totalApro = ($row['total_aprobado']    ?? '') === '' ? 0 : $row['total_aprobado'];

    @@frm_reg_alcances[$i]['rep_proformado']    = number_format(round((float)$repProf, 2), 2, '.', '');
    @@frm_reg_alcances[$i]['mano_proformada']   = number_format(round((float)$manoProf, 2), 2, '.', '');
    @@frm_reg_alcances[$i]['total_proformado']  = number_format(round((float)$totalProf, 2), 2, '.', '');
    @@frm_reg_alcances[$i]['separador']         = $row['separador'] ?: "";
    @@frm_reg_alcances[$i]['rep_aprobado']      = number_format(round((float)$repApro, 2), 2, '.', '');
    @@frm_reg_alcances[$i]['mano_aprobado']     = number_format(round((float)$manoApro, 2), 2, '.', '');
    @@frm_reg_alcances[$i]['total_aprobado']    = number_format(round((float)$totalApro, 2), 2, '.', '');
    $i++;
}
if(!empty($valores)){
    foreach($valores as $row){
        $total_aprobado_grid = floatval($row['total_aprobado'] ?? 0);
        $total_aprobado = $total_aprobado + $total_aprobado_grid;
    }
}
$aprobadoTotal = floatval(@@frm_valoresAprobados_totalProformado) + $total_aprobado;
@@frm_totalMasAlcances = number_format(round($aprobadoTotal, 2), 2, '.', '');