<?php
$usr_uid = @@USER_LOGGED;
$sql = "SELECT * FROM USERS WHERE USR_UID = '$usr_uid'";
$rs = executeQuery($sql);

$jefe_uid = $rs['1']['USR_REPORTS_TO'];

$sql = "SELECT * FROM USERS WHERE USR_UID = '$jefe_uid'";
$rs = executeQuery($sql);
@@tri_directorBroker_nombre = $rs[1]['USR_FIRSTNAME'].' '.$rs[1]['USR_LASTNAME'];
@@tri_directorBroker_email = $rs[1]['USR_EMAIL'];
@@tri_directorBroker_cedula = $rs[1]['USR_ZIP_CODE'];
@@tri_depto_directorBroker = $rs[1]['DEP_UID'];

// consultar nombre departamento
$tri_depto_vendedor = @@tri_depto_directorBroker;
$sql = "SELECT * FROM DEPARTMENT WHERE DEP_UID = '$tri_depto_vendedor'";
$rs = executeQuery($sql);
@@tri_nom_depto_directorBroker = $rs[1]['DEP_TITLE'];