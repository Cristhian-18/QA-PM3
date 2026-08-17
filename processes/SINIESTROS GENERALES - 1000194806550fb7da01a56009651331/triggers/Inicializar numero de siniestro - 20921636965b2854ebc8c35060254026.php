<?php
//<?
//get current year

$year = date("Y");
/*
@@tri_id_stro = @@APP_NUMBER . " - " . $year;
@@tri_nro_stro = @@APP_NUMBER . " - " . $year;*/

$host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
@@URL_SERVER_SQL =  $server;
@@tri_url_bpm = $server;
