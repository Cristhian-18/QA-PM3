<?php
//created by Henry
//9-12-2020
//obtener el user sac ramdom

$sql = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = 'abenavides'";
$rs = executeQuery($sql);

@@tri_user_sac = $rs['1']['USR_UID'];
@@tri_user_cc = @@USER_LOGGED;
@@tri_user_sac_mail = $rs['1']['USR_EMAIL'];


$host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
@@URL_SERVER_SQL =  $server;
