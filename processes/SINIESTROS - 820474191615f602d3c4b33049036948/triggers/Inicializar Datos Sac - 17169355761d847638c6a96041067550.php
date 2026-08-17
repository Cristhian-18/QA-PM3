<?php
//created by Henry
//incializa datos de la pantalla inicial
//7-1-2021
try {
    @@frm_fecha_notificacion =  date('Y-m-d');
    @@frm_fecha_notificacion_real =  date('Y-m-d');
    @@frm_fecha_registro =  date('Y-m-d');
    @@frm_fecha_inicio_mes =  date('Y-m-01');

    $host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
@@URL_SERVER_SQL =  $server;
    $host = @@URL_SERVER_SQL;

    @@$link_seguimiento = $host . "/syscertificacion/es/3sesa/tracker/login";

    @@frm_canal_entrada = 'SAC';
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
