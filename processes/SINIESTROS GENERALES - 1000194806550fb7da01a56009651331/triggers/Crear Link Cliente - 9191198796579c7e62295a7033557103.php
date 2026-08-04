<?php
//Crear Link Cliente

$server = @@URL_SERVER_SQL;
$app_uid = @@APP_NUMBER;

$url = "$server/syscertificacion/es/3sesa/beesmartec/services/siniestrosGen/abrir?id=$app_uid";

@@tri_url_bpm = $url;

