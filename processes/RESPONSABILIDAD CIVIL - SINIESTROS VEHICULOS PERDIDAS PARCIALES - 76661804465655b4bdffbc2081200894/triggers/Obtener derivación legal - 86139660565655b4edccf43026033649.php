<?php
//<?
//Obtener Regla Derivacion LEGAL

$process = @@PROCESS;

//se basa en la ciudad de la póliza

$ciudad = @@frm_poliza_sucursal;
//$ciudad = "QUITO";

$ciudad_siniestro = @@frm_accidente_provincia;
if (!is_numeric($ciudad_siniestro)) {
    $ciudad_siniestro = 17;
}

$sql_region = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'PROVINCIAS_DERIVACION_LEGAL'
AND CODIGO = '$ciudad_siniestro'";

$rs_region = executeQuery($sql_region);
$region = $rs_region['1']['VALOR'];
echo $sql_region;
print_r($rs_region);

//OBTENER ANALISTA DE NEGATIVAS
$sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'NEGATIVA_VEHICULOS'
AND VALOR = '$region'";

@@sql_analista_negativas = $sql_a;

$rs_a = executeQuery($sql_a);
print_r($rs_a);
$abogado = $rs_a['1']['INTEGRACION'];
$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$abogado'";
$rs_u = executeQuery($sql_u);

@@tri_usr_negativa_legal =  $rs_u['1']['USR_UID'];



echo "<br>";

//OBTENER ABOGADO DE ASISTENCIA

$sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'ASISTENCIA_VEHICULOS'
AND CODIGO = '$ciudad_siniestro'
ORDER BY RAND()";

@@sql_abogado = $sql_a;


$rs_a = executeQuery($sql_a);

$abogado = $rs_a['1']['INTEGRACION'];

$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$abogado'";
$rs_u = executeQuery($sql_u);

@@tri_usr_legal =  $rs_u['1']['USR_UID'];

if (empty(@@tri_usr_negativa_legal)) {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'kolvera'";
    $rs_u = executeQuery($sql_u);

    @@tri_usr_negativa_legal =  $rs_u['1']['USR_UID'];
}

if (empty(@@tri_usr_legal)) {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'clamorales'";
    $rs_u = executeQuery($sql_u);

    @@tri_usr_legal =  $rs_u['1']['USR_UID'];
}

/*
if (@@APP_NUMBER == '4540') {
    echo 'ABOGADOS';
    die();
}*/




/*
$sql_region = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'CATALOGO_PROVINCIAS'
AND CODIGO = '$provincia_accidente'
AND ESTADO = 1
";


$sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'ABOGADOS'
AND CAMPO2 = '$ciudad'
ORDER BY RAND()
LIMIT 1";
$rs_a = executeQuery($sql_a);
//print_r($rs_a);
$ciudad = @@frm_taller_ciudad;

if(empty($rs_a)){
    //$ciudad = "QUITO";
    $sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS 
    WHERE COD_CATALOGO = 'ABOGADOS'
    ORDER BY RAND()
    LIMIT 1";
    $rs_a = executeQuery($sql_a);
}

$abogado = $rs_a['1']['INTEGRACION'];
$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$abogado'";
@@tri_username_abogado = $abogado;
$rs_u = executeQuery($sql_u);

@@tri_usr_legal =  $rs_u['1']['USR_UID'];

if(empty(@@tri_usr_legal)){
$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'departamento.legal'";
	$rs_u = executeQuery($sql_u);

@@tri_usr_legal =  $rs_u['1']['USR_UID'];
}
*/

