<?php
//created by Henry
//9-12-2020
//Obtener datos usuario Auditor monto superior

$cnx_rp = '98304643465452bb4b4f927027857546';
$process = @@PROCESS;

$taskId = '2854390996537373e2f2a91057355991'; 
$d = new Derivation();
//G::LoadClass('derivation');
$aAssigned = $d->getAllUsersFromAnyTask($taskId);
$totUser = count($aAssigned);
$rsTask = executeQuery("Select TAS_USER FROM TASK WHERE TAS_UID = '$taskId'");
$curUser = $rsTask[1]['TAS_USER'];
$newUser = ($curUser +1 >= $totUser ? 0 : $curUser + 1);
$rsUTask = executeQuery("update TASK set TAS_USER = $newUser  WHERE TAS_UID = '$taskId'");
@@tri_user_emisor = $aAssigned[$newUser];

$sql = "SELECT USR_USERNAME, USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = '".@@tri_user_suscriptor."'";
$rs = executeQuery($sql);
@@tri_user_emisor_mail = $rs['1']['USR_EMAIL'];