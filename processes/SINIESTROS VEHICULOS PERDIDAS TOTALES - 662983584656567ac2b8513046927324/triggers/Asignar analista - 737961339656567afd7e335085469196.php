<?php
$groupUID = PMFGetGroupUID("PROVEEDORES_SALVAMENTOS");

$groupArray = PMFGetGroupUsers($groupUID);

$provincia_accidente = strval(@@frm_accidente_provincia) ;

$array_sierra = array("1","2","3","4","5","6","10","17", "18");

$array_costa_amazonia = array("7","8","9","12","13","14","20","21","22","23","24");


print_r($groupArray);

if(in_array($provincia_accidente, $array_sierra)){
    $value_taller = "0";
	$sql_u = "SELECT USR_UID, USR_USERNAME, USR_EMAIL, USR_POSITION FROM USERS WHERE USR_USERNAME = 'provemovil'";
}else{
    $value_taller = "1";
	$sql_u = "SELECT USR_UID, USR_USERNAME, USR_EMAIL, USR_POSITION FROM USERS WHERE USR_USERNAME = 'offerchocados'";
}
$rs_u = executeQuery($sql_u);

echo ("<br>"."USUARIOS DE PROVEEDORES DE SALVAMENTOS"."<br>");
print_r($rs_u);


$usr_uid = $groupArray['0']['USR_UID'];
$usr_name = $groupArray['0']['USR_USERNAME'];


@@tri_usr_salvamentos = $rs_u['1']['USR_UID'];
@@tri_salvamentos_nombre = $rs_u['1']['USR_USERNAME'];
@@tri_salvamentos_nombre = strtoupper($rs_u['1']['USR_USERNAME']);



@@tri_salvamentos_mail = $rs_u['1']['USR_EMAIL'];

//CHECK IF $rs_u['1']['USR_POSITION'] is not empty
if($rs_u['1']['USR_POSITION'] != ''){
	//add a comma to tri_salvamentos_mail and then position
	@@tri_salvamentos_mail .= ", ".$rs_u['1']['USR_POSITION'];

}

@@app_totales_uid = @@APPLICATION;


if(@@tri_usr_salvamentos == null || @@tri_usr_salvamentos == ''){
	echo ("Proveedor de salvamentos no existe");
	die();
}
