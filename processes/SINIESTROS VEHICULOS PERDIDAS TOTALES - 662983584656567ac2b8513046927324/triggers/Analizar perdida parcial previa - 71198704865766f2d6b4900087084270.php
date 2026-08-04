<?php
if(@@frm_taller != '' && @@frm_taller!=null){
	@@tri_bandera_analisisParcial = "1";
} else {
	@@tri_bandera_analisisParcial = "0";
}

if(@@frm_AT != null && @@frm_AT != ""){
	@@tri_bandera_analisisParcial = "0";
}
