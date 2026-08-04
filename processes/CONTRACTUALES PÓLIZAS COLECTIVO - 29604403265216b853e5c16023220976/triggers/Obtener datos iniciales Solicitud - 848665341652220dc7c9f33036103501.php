<?php
//Obtener datos iniciales Solicitud

@@frm_datosSolicitud_fechaSolicitud = date('Y-m-d');
@@tri_user_inicial = @@USER_LOGGED;

$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
$server = $config['configuracion_entorno']['url'];


@@tri_url_bpm = $server;
