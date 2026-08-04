<?php
try{
    @@cobertura_aplicada = 'N/A';
    $rs = @=grd_coberturas;
    $grd_coberturas_seleccionadas = array();
    $i = 1;
    foreach ($rs as $row)
    {
        if ($row['grd_txt_aplicar'] == 'SI') {
            $grd_coberturas_seleccionadas[$i]['grd_txt_desc_riesgo'] = $row['grd_txt_desc_riesgo'];
            @@cobertura_aplicada = $row['grd_txt_desc_riesgo'];
            $i = $i +1;
        }

    }
    @=grd_coberturas_seleccionadas = array();
    @=grd_coberturas_seleccionadas = $grd_coberturas_seleccionadas;
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

}
