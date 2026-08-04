<?php
if(@@frm_taller_tipo == "TALLER AUTORIZADO MULTIMARCA"){
    $array_alcance = $array;
    $array_alcance = @@grd_valores_siniestros_alcance;
    $valor = 0;
    /*echo "array_alcance: ";
    print_r($array_alcance);
    die();*/
    foreach($array_alcance as $row){
		$alcance = $row['frm_gvs_pvp'] ? $row['frm_gvs_pvp'] : 0;
    if ($alcance == 'NaN') {
        $alcance = 0;
    }
        $valor = $valor + $alcance;
		echo($valor);
    }
	
    @@frm_alcanceAdicional_valorRepuestos = $valor;

}

