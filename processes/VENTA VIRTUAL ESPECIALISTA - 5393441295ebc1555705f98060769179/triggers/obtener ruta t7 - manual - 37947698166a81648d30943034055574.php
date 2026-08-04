<?php
//<?php
//obtener ruta t7


if (@@tri_decision_magnum_result ===  'REFER'){
	@@frm_accion = 'REFERIR';
}
else if (@@tri_decision_magnum_result ===  'ACCEPT' && stripos(strtoupper(@@html_decision_magnum),'EXTRAPRIMA') == false){
	@@frm_accion = 'CONTINUAR';
	@@frm_accion_emisiona = 'CONTINUAR';
}else{
	@@frm_accion = 'REFERIR';
}

//@@frm_accion_emisiona = 'CONTINUAR';

$frm_accion = @@frm_accion;
$frm_accion_cu = @@frm_accion_cu;
$frm_accion_dependientes = @@frm_accion_dependientes;
$frm_accion_emision = @@frm_accion_emision;
$frm_accion_emisiona = @@frm_accion_emisiona;
$frm_accion_suscripcion = @@frm_accion_suscripcion;

if ($frm_accion == 'CONTINUAR' && $frm_accion_cu == 'CONTINUAR' && $frm_accion_dependientes == 'CONTINUAR' && $frm_accion_emision == 'CONTINUAR' &&  $frm_accion_suscripcion == 'APROBAR' && $frm_accion_emisiona == 'CONTINUAR' && @@frm_accion_cierre == 'CONTINUAR') {
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

