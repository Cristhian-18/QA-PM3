<?php
@@fecha_actual = date('Y/m');
$usuario = @@USER_LOGGED;
@@tri_user_sac = @@USER_LOGGED;
@@tri_user_cc = @@USER_LOGGED;

$sql = "SELECT * FROM USERS WHERE USR_UID = '$usuario'";
$rs = executeQuery($sql);
//date_default_timezone_set('America/Guayaquil');

@@frm_asesor_nombre = $rs[1]['USR_FIRSTNAME'] . ' ' . $rs[1]['USR_LASTNAME'];
@@frm_asesor_email = $rs[1]['USR_EMAIL'];
@@frm_asesor_telefono = ($rs[1]['USR_PHONE'] == '' ? 'NO_DISPONIBLE ----------------------' : $rs[1]['USR_PHONE']);
@@frm_asesor_identificacion = $rs[1]['USR_ZIP_CODE'];
@@tri_depto_assor = $rs[1]['DEP_UID'];
@@tri_asesor_ciudad = $rs[1]['USR_LOC : ATION'];
$tri_asesor_ciudad = @@tri_vendedor_ciudad;
//select LOCATION

$sql_2 = "SELECT * FROM ISO_LOCATION WHERE IC_UID = 'EC' AND IL_UID = '$tri_asesor_ciudad'";
$rs_2 = executeQuery($sql_2);
@@tri_asesor_ciudad_label = ($rs_2[1]['IL_NAME'] == '' ? 'NO_DEFINIDO --------------------' : $rs_2[1]['IL_NAME']);

@@tri_ban_sac = 'true';

$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
@@URL_SERVER_SQL =  $config['configuracion_entorno']['url'];
