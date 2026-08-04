<?php
//Crear Link Cliente


$host = @@URL_SERVER_SQL;


$app_uid = @@APP_NUMBER;

$url = "$host/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/abrir?id=$app_uid";

@@link_abrir = $url;
