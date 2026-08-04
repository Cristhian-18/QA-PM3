<?php
//<?
//Obtener Regla Derivacion LEGAL

$process = @@PROCESS;

//se basa en la ciudad de la póliza

$ciudad = @@frm_poliza_sucursal;

$ciudad_ocurrencia = @@frm_is_CodprovinciaOcurrencia;

$sql_region = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'PROVINCIAS_DERIVACION_LEGAL'
AND CODIGO = '$ciudad_ocurrencia'";
$rs_region = executeQuery($sql_region);
$region = $rs_region['1']['VALOR'];


//ABOGADO DE ASISTENCIA
$sql_legal = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'ASISTENCIA_GENERALES'";

$rs_legal = executeQuery($sql_legal);

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '".$rs_legal['1']['INTEGRACION']."'";
$rs_u = executeQuery($sql_u);

@@tri_usr_legal =  $rs_u['1']['USR_UID'];
echo (@@tri_usr_legal);
echo '<br>';

if (empty(@@tri_usr_legal)) {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'clamorales'";
    $rs_u = executeQuery($sql_u);
    @@tri_usr_legal =  $rs_u['1']['USR_UID'];
}

//ABOGADO DE NEGATIVA

$sql_negativa = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'NEGATIVA_GENERALES'
AND CODIGO = '$region'";

$rs_negativa = executeQuery($sql_negativa);

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '".$rs_negativa['1']['INTEGRACION']."'";
$rs_u = executeQuery($sql_u);

//print_r($rs_u);

@@tri_usr_negativa_legal =  $rs_u['1']['USR_UID'];
echo (@@tri_usr_negativa_legal);


if (empty(@@tri_usr_negativa_legal)) {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'kolvera'";
    $rs_u = executeQuery($sql_u);
    @@tri_usr_negativa_legal =  $rs_u['1']['USR_UID'];
}


/*
if(@@APP_NUMBER == '4517'){
    echo $region;
    die();
}*/

/*
//$ciudad = "QUITO";
$sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'ABOGADOS'
AND CAMPO2 = '$ciudad'
LIMIT 1";
$rs_a = executeQuery($sql_a);


if (empty($rs_a)) {
    $ciudad = "QUITO";
    $sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
    WHERE COD_CATALOGO = 'ABOGADOS'
    ORDER BY RAND()
    LIMIT 1";
    $rs_a = executeQuery($sql_a);
}

$abogado = $rs_a['1']['INTEGRACION'];
$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$abogado'";
$rs_u = executeQuery($sql_u);
if (empty($rs_u)) {
    $abogado = "departamento.legal";
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$abogado'";
    $rs_u = executeQuery($sql_u);
}

@@tri_usr_legal =  $rs_u['1']['USR_UID'];
*/
