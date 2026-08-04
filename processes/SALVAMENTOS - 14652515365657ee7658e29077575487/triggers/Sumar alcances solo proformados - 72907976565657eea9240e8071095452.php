<?php
if(@@frm_taller_tipo == "TALLER AUTORIZADO MULTIMARCA"){
    $array_alcance = $array;
    $array_alcance = @@grd_valores_siniestros_alcance;
    $valor = 0;
    foreach($array_alcance as $row){
		$alcance = $row['frm_gvs_pvp'] ? $row['frm_gvs_pvp'] : 0;
        $valor = $valor + $alcance;
    }
	
    @@frm_alcanceAdicional_valorRepuestos = $valor;

}

