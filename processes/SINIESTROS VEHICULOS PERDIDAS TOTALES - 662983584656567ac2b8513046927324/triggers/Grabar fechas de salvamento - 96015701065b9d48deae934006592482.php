<?php
date_default_timezone_set('Ecuador/Quito');

$hoy = date("Y-m-d H:i:s", time());
@@frm_gestionSalvamento_fechaNotificacion = $hoy;
@@frm_gestionSalvamento_fechaInicio = date('Y-m-d H:i:s', strtotime($hoy . ' +1 day'));

