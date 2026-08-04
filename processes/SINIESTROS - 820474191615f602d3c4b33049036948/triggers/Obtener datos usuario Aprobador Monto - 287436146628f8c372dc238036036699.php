<?php
//created by Henry
//9-12-2020
//Obtener datos usuario Auditor monto superior
try {
    $cnx_rp = '11264850561d723f004d5c2072943786';

    $sql = "SELECT USR_USERNAME, USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '" . @@USER_LOGGED . "'";
    $rs = executeQuery($sql);

    @@tri_user_auditor_monto = $rs['1']['USR_UID'];
    @@tri_user_auditor_mail_monto = $rs['1']['USR_EMAIL'];
    @@tri_user_auditor_uname_monto = $rs['1']['USR_USERNAME'];


    @@tri_bandera_grid = 'true';
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
