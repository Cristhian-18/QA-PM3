<?php
if(@@sw_rel != 'PASA'){
	@@grd_vinculos = array();

	@@grd_vinculos[1]['frm_plan_relacion'] = "SOLICITANTE- CANDIDATO";
	@@grd_vinculos[2]['frm_plan_relacion'] = "SOLICITANTE - BENEFICIARIO";
	@@grd_vinculos[3]['frm_plan_relacion'] = "CANDIDATO - BENEFICIARIO";
	@@sw_rel = 'PASA';
}