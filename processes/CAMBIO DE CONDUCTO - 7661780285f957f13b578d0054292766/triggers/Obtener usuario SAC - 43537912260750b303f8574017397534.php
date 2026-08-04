<?php
//created by Henry
//9-12-2020
//obtener el user sac ramdom

$sql = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = 'abenavides'";
$rs = executeQuery($sql);

@@tri_user_sac = $rs['1']['USR_UID'];
@@tri_user_cc = @@USER_LOGGED;
@@tri_user_sac_mail = $rs['1']['USR_EMAIL'];


$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
@@URL_SERVER_SQL =  $config['configuracion_entorno']['url'];
