<?php
//created by Henry
//9-12-2020
//Obtener datos usuario Auditor monto superior

$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$process = @@PROCESS;
/*
//@#tri_monto_total_coberturas = 150000;
$monto = @#tri_monto_total_coberturas*1;
$contratante = @@frm_plan_diferente_asegurado_label;

$sql_cat = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$process' AND COD_CATALOGO = 'ATENCION_SUSCRIPCION' AND  $monto > VALOR AND $monto <= INTEGRACION AND CAMPO1 = '$contratante'";
$rs_cat = executeQuery($sql_cat, $cnx_rp);

$username = $rs_cat['1']['CAMPO2'];

$sql = "SELECT USR_USERNAME, USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = '".$username."'";
$rs = executeQuery($sql);

@@tri_user_suscriptor = $rs['1']['USR_UID'];
@@tri_user_suscriptor_mail = $rs['1']['USR_EMAIL'];
*/
if (empty(@@tri_user_suscriptor)){
    $taskId = '4033495885f982c8ce12631090926236';
    $d = new Derivation();
    //G::LoadClass('derivation');
    $aAssigned = $d->getAllUsersFromAnyTask($taskId);
    $totUser = count($aAssigned);
    $rsTask = executeQuery("Select TAS_USER FROM TASK WHERE TAS_UID = '$taskId'");
    $curUser = $rsTask[1]['TAS_USER'];
    $newUser = ($curUser +1 >= $totUser ? 0 : $curUser + 1);
    $rsUTask = executeQuery("update TASK set TAS_USER = $newUser  WHERE TAS_UID = '$taskId'");
    @@tri_user_suscriptor = $aAssigned[$newUser];

    $sql = "SELECT USR_USERNAME, USR_UID, USR_EMAIL FROM USERS WHERE USR_USERNAME = '".@@tri_user_suscriptor."'";
    $rs = executeQuery($sql);
    @@tri_user_suscriptor_mail = $rs['1']['USR_EMAIL'];
}
