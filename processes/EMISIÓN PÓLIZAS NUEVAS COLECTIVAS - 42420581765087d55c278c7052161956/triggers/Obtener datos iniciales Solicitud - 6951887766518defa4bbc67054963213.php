<?php
//Obtener datos iniciales Solicitud

@@frm_datosSolicitud_fechaSolicitud = date('Y-m-d');
@@tri_user_inicial = @@USER_LOGGED;


$frm_responsable_asignado = @@USER_LOGGED;
$sql_cot = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '$frm_responsable_asignado'";
$rs_cot = executeQuery($sql_cot);
@@frm_responsable_comercial_mail = $rs_cot['1']['USR_EMAIL'];

$host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
@@URL_SERVER_SQL =  $server;


$host = @@URL_SERVER_SQL;



$url = "$host/syscertificacion/es/3sesa/login/login";

@@tri_url_bpm = $url;
