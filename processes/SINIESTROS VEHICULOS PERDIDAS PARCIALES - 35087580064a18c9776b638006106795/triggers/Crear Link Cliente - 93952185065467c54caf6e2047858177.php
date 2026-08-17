<?php
//Crear Link Cliente

//@@frm_accion = "CONTINUAR";

$host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
@@URL_SERVER_SQL =  $server;

$host = @@URL_SERVER_SQL;
$app_uid = @@APP_NUMBER;
$url = "$host/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/abrir?id=$app_uid";

@@link_abrir = $url;

