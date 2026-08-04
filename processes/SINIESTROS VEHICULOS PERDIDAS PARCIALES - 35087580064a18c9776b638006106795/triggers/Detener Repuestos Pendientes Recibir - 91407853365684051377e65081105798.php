<?php
//<?

if(@@frm_accion == "REPUESTOS"){
	$repuestos = array();
$repuestos=@@grd_valores_siniestros;
$bandera_stop = false;
foreach($repuestos as $repuesto){
  $estado = $repuesto['frm_gvs_estado'];
  if($estado == 'Aprobado'){
    $recibido = $repuesto['frm_gvs_recibido'];
    if($recibido != "SI"){
      echo("El repuesto ".$repuesto['frm_gvs_descripcion']." no ha sido recibido.");
      echo("<br>");
      $bandera_stop = true;
    }
  }
}
}
if($bandera_stop){
  echo("No se puede cerrar el siniestro porque hay repuestos pendientes por recibir.");
  die();
}
