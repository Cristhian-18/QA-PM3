<?php
if (@@frm_siniestro_seConsidera == "AFECTADO") {
	@@frm_informacion_tipo = "SUBROGACIÓN";
} else {
	@@frm_informacion_tipo = "CIERRE LEGAL - RC";
}

@@frm_informacion_fechaSubrogacion = @@hoy;
@@frm_informacion_horaSubrogacion = @@ahora;

@@frm_busqueda_ejecutivoAsignado = @@frm_busqueda_ejecutivoAsignado;

$config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
$server = $config['configuracion_entorno']['url'];


@@URL_SERVER_SQL = $server;
@@tri_url_bpm = $server;
