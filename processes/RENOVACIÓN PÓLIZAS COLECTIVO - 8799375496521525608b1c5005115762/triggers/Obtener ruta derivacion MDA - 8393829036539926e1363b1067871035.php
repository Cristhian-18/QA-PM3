<?php
if(@@frm_accion_c == 'RECHAZAR' || @@frm_accion_t == 'RECHAZAR'){
	@@frm_accion_aux = 'REGRESAR';
}else{
	@@frm_accion_aux = 'CONTINUAR';
}