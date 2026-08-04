<?php
//<?
//echo "Asignando coordinador SISE o INSURANCE<br>";
if (@@frm_origen_core_insurance == 'INSURANCE') {
    //echo '1';
    $group = 'COORDINADOR_INSURANCE_VH';
    $groupUID = PMFGetGroupUID($group);
    $groupArray = PMFGetGroupUsers($groupUID);
    //echo '1';
    //get a random user from the group
    $rand = array_rand($groupArray);

    $usr_uid = $groupArray[$rand]['USR_UID'];
    $usr_name = $groupArray[$rand]['USR_USERNAME'];
    //echo $usr_uid;
    @@tri_coordinador_sise_insurante = $usr_uid;
    @@tri_grupo_analistas = 'SINIESTROS_ANALISTAS_VH_INSURANCE';

} else {
    $group = 'SINIESTROS_PDA_VH';
    $groupUID = PMFGetGroupUID($group);
    $groupArray = PMFGetGroupUsers($groupUID);
    //get a random user from the group
    $rand = array_rand($groupArray);

    $usr_uid = $groupArray[$rand]['USR_UID'];
    $usr_name = $groupArray[$rand]['USR_USERNAME'];
    @@tri_coordinador_sise_insurante = $usr_uid;
    @@tri_grupo_analistas = 'SINIESTROS_ANALISTAS_VH';

}



$codigo = @@frm_codAgente;
$sucursal = @@frm_accidente_ciudad_nombre;
$process = @@PROCESS;

$provincia_accidente = @@frm_accidente_provincia;
if ($provincia_accidente == 'undefined') {
    $provincia_accidente = '17';
}
$provincia_accidente = intval($provincia_accidente);


$sql_region = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'CATALOGO_PROVINCIAS'
AND CODIGO = '$provincia_accidente'
AND ESTADO = 1
";



$rs_region = executeQuery($sql_region);



$sucursal = $rs_region['1']['VALOR'];
//echo $sucursal;
/*$provincias_costa = [7, 8, 9, 11, 12, 24, 13];*/
$codAseg = @@frm_codAseg;

//$codAseg = '197902';
/*$sucursal = 'COSTA';
$codigo = '214';*/

$sql_analista = "SELECT  INTEGRACION, CODIGO  FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'ANALISTAS_POR_CODASEG'
AND CODIGO = '$codAseg'
AND VALOR = '$sucursal'
AND ESTADO = 1";



$rs_a = executeQuery($sql_analista);



if (empty($rs_a)) {
    $sql_analista =
    "SELECT INTEGRACION, CODIGO FROM ADMIN_CATALOGOS
    WHERE PRO_UID = '$process'
    AND COD_CATALOGO = 'ANALISTAS'
    AND CODIGO = '$codigo'
    AND VALOR = '$sucursal'
    AND ESTADO = 1";

    $rs_a = executeQuery($sql_analista);
}



if (empty($rs_a)) {
    $sql_analista = "SELECT INTEGRACION, CODIGO FROM ADMIN_CATALOGOS
    WHERE PRO_UID = '$process'
    AND COD_CATALOGO = 'ANALISTAS_NO_PREFERENCIALES'
    AND VALOR = '$sucursal'
    AND ESTADO = 1
    ORDER BY RAND()
    ";
    $rs_a = executeQuery($sql_analista);
}



$analista = $rs_a['1']['INTEGRACION'];
@@sql_seleccion_analista = $sql_analista;
@@tri_codigo_analista_sise = $rs_a['1']['CODIGO'];

$sql_u = "SELECT USR_UID, USR_USERNAME FROM certificacion.USERS WHERE USR_USERNAME = '$analista'";

echo "Analista asignado: $analista <br>";

$rs_u = executeQuery($sql_u);



@@tri_usr_analista = $rs_u['1']['USR_UID'];



if (@@tri_usr_analista == '') {
    echo "No se encontro analista";
}
