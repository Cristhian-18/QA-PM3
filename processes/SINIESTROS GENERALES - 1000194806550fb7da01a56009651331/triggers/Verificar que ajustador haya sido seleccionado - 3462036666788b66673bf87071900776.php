<?php


if(@@tri_tipo_operacion == 1 && (@@tri_usr_ajustador == '' || @@tri_usr_ajustador == null) && @@frm_accion_ac == 'CONTINUAR'){
	echo 'Aun no se ha seleccionado un ajustador, por favor, espere a que Reaseguros determine uno';
	die();
}

if((@@tri_usr_ajustador == '' || @@tri_usr_ajustador == null)  && @@frm_accion_ac == 'CONTINUAR'){
	echo 'Aun no se ha seleccionado un ajustador, por favor, espere a que Reaseguros determine uno';
	die();
}
