<?php
try{

$aGrid = @=grd_coberturas;

$montoSolicitado = 0;
foreach ($aGrid as $fila) {
    $montoSolicitado += floatval($fila["grd_txt_valor"]);
}

@@frmValorReservaInsurance = $montoSolicitado;
 } catch (Exception $e) {

	$errorMessage =  $e->getMessage();


}
