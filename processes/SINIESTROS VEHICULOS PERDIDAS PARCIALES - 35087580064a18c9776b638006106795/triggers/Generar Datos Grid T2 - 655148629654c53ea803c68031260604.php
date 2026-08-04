<?php
$$grid_causa = array();
$grid_causa = @@grd_registro_siniestro;

@=grid_id_causa = array();
$count = 1;
foreach($grid_causa as $row){
    $aplicar = $row["grd_s_aplicar"];
    if($aplicar == "SI"){
        @=grid_id_causa[$count] = $row;
		$count++;
    }
}
if($count == 1){
	echo("SIN CAUSAS");
	 @=grid_id_causa = $grid_causa;
}

if(@@frm_sumaAseguradaTotal != ""){
    @@frm_vehiculo_valor_asegurado_accesorios = @@frm_sumaAseguradaTotal;
}


/*print_r(@@grid_id_causa);
echo("<br \>");
print_r(@@grd_registro_siniestro);

die();*/
