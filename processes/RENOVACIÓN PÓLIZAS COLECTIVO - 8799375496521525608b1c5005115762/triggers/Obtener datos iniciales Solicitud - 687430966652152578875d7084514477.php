<?php
//Obtener datos iniciales Solicitud

@@frm_datosSolicitud_fechaSolicitud = date('Y-m-d');
@@tri_user_inicial = @@USER_LOGGED;

@@frm_accion = null;

$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
@@URL_SERVER_SQL =  $config['configuracion_entorno']['url'];;
$host = @@URL_SERVER_SQL;


$url = "$host/syscertificacion/es/3sesa/login/login";

@@tri_url_bpm = $url;
