<?php
//Crear Link Cliente
$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
@@URL_SERVER_SQL =  $config['configuracion_entorno']['url'];
$host = @@URL_SERVER_SQL;

$app_uid = @@APP_NUMBER;

$url = "$host/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/abrir?id=$app_uid";

@@link_abrir = $url;

