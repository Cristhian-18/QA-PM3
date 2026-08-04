<?php
try{

//echo "<br>Verificando Bandera Alcance<br>";
foreach(@=grd_coberturas as $datagrid_cober){
	//echo "<br>Cobertura: ".$datagrid_cober['grd_txt_alcance']."<br>";
	if($datagrid_cober['grd_txt_alcance'] == 'SI'){
		foreach(@=grd_siniestros_alcances as $datagrid_alcance){

			if(($datagrid_alcance['grd_cobertura3'] == $datagrid_cober['grd_cob_madre']) && ($datagrid_alcance['grd_reanudar3'] == 'SI')){
				@@tri_bandera_alcance = 'ALCANCE';
				//echo "<br>Bandera Alcance: ".@@tri_bandera_alcance."<br>";
			}
		}
	}
}


 } catch (Exception $e) {

	$errorMessage =  $e->getMessage();

}
