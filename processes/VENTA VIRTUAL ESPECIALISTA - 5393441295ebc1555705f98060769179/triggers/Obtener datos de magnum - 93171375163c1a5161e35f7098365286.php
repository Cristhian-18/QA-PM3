<?php
//created By Henry
//Obtener los casos de magnum

$server = @@URL_SERVER_SQL;
//consultamos si existe una solicitud ya ingresada y validada por magnum
$identifica = @@frm_numero_identificacion;
$app_number = @@APP_NUMBER;
$sql = "SELECT APP_NUMBER as grd_num_caso, TRI_FECHA_MAGNUM as grd_fecha_magnum, HTML_DECISION_MAGNUM as grd_decision_magnum, IF(TRI_ES_BROKER='SI','BROKER','FUERZA VENTAS') AS grd_canal_entrada FROM PMT_VV_MAGNUM WHERE FRM_NUMERO_IDENTIFICACION = '$identifica' AND APP_NUMBER <> $app_number AND HTML_DECISION_MAGNUM <> ''";
$rs = executeQuery($sql);

$arr_magn = array();
$con = 1;
foreach($rs as $datadoc){
		$number = $datadoc['grd_num_caso'];
		$des_magn = str_replace("<h4>", "", $datadoc['grd_decision_magnum']);
		$des_magn = str_replace("</h4>", "", $des_magn);
		$des_magn = str_replace("<br>", "\n", $des_magn);
		$des_magn = str_replace("<p>", "", $des_magn);
		$des_magn = str_replace("<b>", "", $des_magn);
		$des_magn = str_replace("</p>", "", $des_magn);
		$des_magn = str_replace("</b>", "", $des_magn);
		$des_magn = str_replace("<i>", " - ", $des_magn);
		$des_magn = str_replace("</i>", "\n", $des_magn);
		$arr_magn[$con]['grd_num_caso'] = $datadoc['grd_num_caso'];
		$arr_magn[$con]['grd_fecha_magnum'] = $datadoc['grd_fecha_magnum'];
		$arr_magn[$con]['grd_decision_magnum'] = $des_magn;
		$arr_magn[$con]['grd_canal_entrada'] = $datadoc['grd_canal_entrada'];
		$arr_magn[$con]['grd_decision_link'] = "$server/syscertificacion/es/3sesa/beesmartec/services/poliza_especialista/magnun_go/magnun2.php?case=$number";
		$arr_magn[$con]['grd_resumen_link'] =  "$server/syscertificacion/es/3sesa/beesmartec/services/poliza_especialista/magnun_go/magnun3.php?case=$number";
		$con++;
}

@=grd_datos_magnum = $arr_magn;
