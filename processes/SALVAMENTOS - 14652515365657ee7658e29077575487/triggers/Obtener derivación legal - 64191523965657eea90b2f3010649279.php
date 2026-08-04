<?php
//<?
//Obtener Regla Derivacion LEGAL

$process = @@PROCESS;

//se basa en la ciudad de la póliza

$ciudad = @@frm_poliza_sucursal;
$ciudad = "QUITO";
$sql_a = "SELECT INTEGRACION FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'ABOGADOS'
AND CAMPO2 = '$ciudad'
LIMIT 1";
$rs_a = executeQuery($sql_a);


$abogado = $rs_a['1']['INTEGRACION'];
$sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$abogado'";
$rs_u = executeQuery($sql_u);

@@tri_usr_legal =  $rs_u['1']['USR_UID'];


