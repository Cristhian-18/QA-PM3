<?php
@@tri_user_pago = @@frm_uid_vendedor; 
if (@@frm_pago_medios_estado != 'PAGADO'){
	@@tri_user_pago = @@frm_uid_vendedor; 
}
if (@@frm_accion_t4 == 'REPROCESAR' && @@frm_pago_medios_estado != 'PAGADO'){
	@@tri_user_pago = @@dana_pago_uid;
}
@@tmp_pasot4 = 'SI';

