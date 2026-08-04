<?php


if (@@app_padre != null && @@app_padre != '') {

	if (@@frm_accion == "PARCIAL") {
		@@app_totales_uid = @@APPLICATION;
		@@tri_bandera_parciales = "1";
	} else {
		@@tri_bandera_parciales = "0";
	}
} else {
	@@tri_bandera_parciales = "0";
}
