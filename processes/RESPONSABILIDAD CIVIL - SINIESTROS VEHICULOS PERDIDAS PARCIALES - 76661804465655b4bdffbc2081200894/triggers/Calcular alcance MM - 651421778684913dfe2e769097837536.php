<?php
//frm_alcanceAdicional_valorRepuestosAprobado

try {
  $array = array();
  $array = @@grd_valores_siniestros_alcance;
  $valor_repuestos_aprobado = 0;
  print_r($array);
  foreach ($array as $row) {

    $alcance = $row['frm_gvs_pvp'] ? $row['frm_gvs_pvp'] : 0;
    if ($alcance == 'NaN') {
      $alcance = 0;
    }

    $valor_repuestos_aprobado = $valor_repuestos_aprobado + $alcance;
  }


  if (@@frm_taller == 'MUNDO MOTRIZ') {
    
    if (@@frm_alcanceAdicional_valorManoAprobado != '' && @@frm_alcanceAdicional_valorManoAprobado != null) {
      
    } else {
      @@frm_alcanceAdicional_valorManoAprobado = @@frm_alcanceAdicional_valorMano_label;
    }
    if (@@frm_alcanceAdicional_valorRepuestosAprobado == '') {
      @@frm_alcanceAdicional_valorRepuestosAprobado = $valor_repuestos_aprobado;
    }
  }
} catch (Exception $e) {
  echo "error";
  echo $e;
}
