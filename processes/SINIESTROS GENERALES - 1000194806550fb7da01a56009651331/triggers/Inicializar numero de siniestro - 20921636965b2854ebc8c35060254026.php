<?php
//<?
//get current year

$year = date("Y");
/*
@@tri_id_stro = @@APP_NUMBER . " - " . $year;
@@tri_nro_stro = @@APP_NUMBER . " - " . $year;*/

$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
$server = $config['configuracion_entorno']['url'];

@@URL_SERVER_SQL = $server;
@@tri_url_bpm = $server;
