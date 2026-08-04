<?php
//created by Henry
//valida que los docs se encuentren generados antes de derivar

$linkFV = trim((string)@@link_solicitud_fecha_fv);
$linkFecha = trim((string)@@link_solicitud_fecha);

if(empty($linkFV) || empty($linkFecha)){
    $msg = "ERROR DOCUMENTOS - No se generaron los documentos, intente nuevamente";
    $g = new G();
    $g->SendMessageText($msg, "ERROR");
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '3864572005ec43c29d876d4033811628');
    die();
}

