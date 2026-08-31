<?php
//created by Henry
//9-12-2020
//Obtener datos usuario Auditor

try {



    $cnx_rp = '11264850561d723f004d5c2072943786';

    $sql = "SELECT USR_FIRSTNAME, USR_USERNAME,USR_LASTNAME, USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '" . @@USER_LOGGED . "'";
    $rs = executeQuery($sql);

    @@tri_user_auditor = $rs['1']['USR_UID'];
    @@tri_user_auditor_mail = $rs['1']['USR_EMAIL'];
    @@tri_user_auditor_uname = $rs['1']['USR_USERNAME'];

    //nuevo
    @@tri_user_auditor_cargo = "AUDITOR";
    @@tri_user_auditor_name = $rs['1']['USR_FIRSTNAME'] . ' ' . $rs['1']['USR_LASTNAME'];


    @@tri_bandera_grid = 'true';

    //datos de ramo y sucursal
    $sucursal = @@frm_sucursal;
    $sql_suc = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'SUCURSALES_SINIESTROS' AND PRO_UID = '820474191615f602d3c4b33049036948' AND CODIGO = '$sucursal'";

    $rs_suc = executeQuery($sql_suc, $cnx_rp);
    @@frm_sucursal_label = $rs_suc['1']['DESCRIPCION'];

    $ramo = @@frm_ramo;
    $sql_ram = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'RAMOS_SINIESTROS' AND PRO_UID = '820474191615f602d3c4b33049036948' AND CODIGO = '$ramo'";

    $rs_ramo = executeQuery($sql_ram, $cnx_rp);
    @@frm_ramo_label = $rs_ramo['1']['DESCRIPCION'];
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
