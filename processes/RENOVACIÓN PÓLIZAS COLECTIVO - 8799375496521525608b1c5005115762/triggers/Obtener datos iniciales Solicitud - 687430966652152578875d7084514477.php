<?php
//Obtener datos iniciales Solicitud

@@frm_datosSolicitud_fechaSolicitud = date('Y-m-d');
@@tri_user_inicial = @@USER_LOGGED;

@@frm_accion = null;

$host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
@@URL_SERVER_SQL =  $server;
$host = @@URL_SERVER_SQL;


$url = "$host/syscertificacion/es/3sesa/login/login";

@@tri_url_bpm = $url;
