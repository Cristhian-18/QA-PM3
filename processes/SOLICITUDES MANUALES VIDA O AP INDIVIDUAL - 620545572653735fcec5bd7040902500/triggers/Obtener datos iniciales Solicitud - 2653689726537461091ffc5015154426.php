<?php
//Obtener datos iniciales Solicitud

@@frm_datosSolicitud_fechaSolicitud = date('Y-m-d');
@@tri_user_inicial = @@USER_LOGGED;

@@frm_datosSolicitud_solicitante = @@USR_USERNAME;


$sql = "SELECT USR_USERNAME, USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '" . @@tri_user_inicial . "'";
$rs = executeQuery($sql);
@@tri_user_inicial_mail = $rs['1']['USR_EMAIL'];


$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
$server = $config['configuracion_entorno']['url'];

@@URL_SERVER_SQL = $server;
@@tri_url_bpm = $server;
