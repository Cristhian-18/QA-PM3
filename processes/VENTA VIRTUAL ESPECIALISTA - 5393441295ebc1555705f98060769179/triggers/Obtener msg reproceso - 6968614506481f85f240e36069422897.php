<?php
//created by Henry

if(@@frm_modificar_solicitud_label == 'SI'){
	if(@@frm_modificar_debito_label == 'SI'){
		if(@@frm_debito_si == 'SI' && @@frm_pago_terceros =='N'){
			//4 docs
			@@tri_msg_dana = 'SOLICITUD_CLIENTE';
		}else{
			// 3 docs
			@@tri_msg_dana = 'SOLICITUD_CLIENTE_PAGADOR';
		}
	}else{
		if(@@frm_debito_si == 'SI' && @@frm_pago_terceros =='N'){
			//4 docs
			@@tri_msg_dana = 'SOLICITUD_CLIENTE';
		}else{
			//3 docs
			@@tri_msg_dana = 'SOLICITUD_CLIENTE_PAGADOR';
		}
	}
}else{
	if(@@frm_modificar_debito_label == 'SI'){
		if(@@frm_debito_si == 'SI' && @@frm_pago_terceros =='N'){
			// 4 docs
			@@tri_msg_dana = 'SOLICITUD_CLIENTE';
		}else{
			// 3 docs
			@@tri_msg_dana = 'SOLICITUD_CLIENTE_PAGADOR';
		}
	}
}
