<?php
//<?php
$frm_accion = @@frm_accion;
$frm_accion_cu = @@frm_accion_cu;
$frm_accion_dependientes = @@frm_accion_dependientes;
$frm_accion_emision = @@frm_accion_emision;
$frm_accion_emisiona = @@frm_accion_emisiona;
$frm_accion_suscripcion = @@frm_accion_suscripcion;
$html_decision_magnum = @@html_decision_magnum;

if ($frm_accion == 'CONTINUAR' && $frm_accion_cu == 'CONTINUAR' && $frm_accion_dependientes == 'CONTINUAR' && $frm_accion_emision == 'CONTINUAR' &&
	$frm_accion_suscripcion == 'APROBAR' && $frm_accion_emisiona == 'CONTINUAR' && strpos(strtoupper($html_decision_magnum), 'EXTRAPRIMA') === false) {
	$rutat7 = 'ACEPTO';
} else {
	if ($frm_accion == 'CONTINUAR' && $frm_accion_cu == 'CONTINUAR' && $frm_accion_dependientes == 'CONTINUAR' && $frm_accion_emision == 'CONTINUAR' &&  $frm_accion_suscripcion == 'ERROR') {
		$rutat7 = 'SUSCRIPCION_MANUAL';
		@@frm_accion = 'REFERIR';
	} else {
		if ($frm_accion == 'CONTINUAR' && ($frm_accion_cu == 'ERROR' || $frm_accion_cu == 'REFERIR')) {
			$rutat7 = 'SUSCRIPCION_MANUAL';
			@@frm_accion = 'REFERIR';
		} else {
			if ($frm_accion == 'CONTINUAR' && $frm_accion_emisiona == 'ERROR') {
				@@frm_accion = 'EMISION';
				$rutat7 = 'EMISION_MANUAL';
			} else {
				$rutat7 = 'SUSCRIPCION_MANUAL';
				@@frm_accion = 'REFERIR';
			}
		}
	}
}


@@rutat7 = $rutat7;

