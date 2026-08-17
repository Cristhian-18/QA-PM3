<?php
//created by Henry
//inicilizar user creador

@@tri_usr_user_creador = @@USER_LOGGED;
$tri_usr_user_creador = @@USER_LOGGED;
@@frm_bandera_fidelizacion = 'false';

$host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
@@URL_SERVER_SQL =  $server;

//id de grupo fidelizacion = 486574050676f09e4808b52088969540
//nueva validacion para el grupo de fidelizacion

$sql = "SELECT GRP_UID FROM GROUP_USER WHERE USR_UID = '$tri_usr_user_creador'";
$rs = executeQuery($sql);

if (is_array($rs)) {
    foreach ($rs as $data) {
        $grp = $data['GRP_UID'];
        if ($grp == '486574050676f09e4808b52088969540') {
            @@frm_bandera_fidelizacion = 'true';
        }
    }
}
