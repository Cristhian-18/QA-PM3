<?php
//Consultar Informacion Director Comercial
//created by beesmart
//27-12-2024

$cnx = '4647520625f3ca6ed2d2621030136501';
$pro_uid = @@PROCESS;
$sql = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'CONFIGURACION' AND CODIGO = 'DIRECTOR' AND PRO_UID = '$pro_uid' AND ESTADO = 1";

$rs = executeQuery($sql, $cnx);
$usr_uidDIrector = $rs['1']['DESCRIPCION'];

$sql_user = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$usr_uidDIrector'";
$rs_user = executeQuery($sql_user);

@@tri_user_director_comercial = $rs_user['1']['USR_UID'];