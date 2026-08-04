<?php
//created by Henry
//9-12-2020
//obtener el user sac ramdom
try{
$sql = "SELECT USR_USERNAME, USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '".@@USER_LOGGED."'";
$rs = executeQuery($sql);

@@tri_user_sac = $rs['1']['USR_UID'];
@@tri_user_sac_mail = $rs['1']['USR_EMAIL'];
@@tri_user_sac_uname = $rs['1']['USR_USERNAME'];

@@tri_bandera_alcance = "";

 } catch (Exception $e) {
	
	$errorMessage =  $e->getMessage();
	
 
}