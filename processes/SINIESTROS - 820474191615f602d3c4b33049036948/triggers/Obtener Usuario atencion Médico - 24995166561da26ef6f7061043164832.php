<?php
//created by Henry
//Obtener Usuario atencion Médico
//8-1-2022
try {

    $cnx = "11264850561d723f004d5c2072943786";
    $app_uid        = @@APPLICATION;
    $pro_uid        = @@PROCESS;

    //codigo de la tabla
    $sql = "SELECT INTEGRACION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'COBERTURA_MADRE' AND CODIGO = '" . @@frm_cobertura_madre . "'";

    $rs = executeQuery($sql, $cnx);
    $cod_user = $rs['1']['INTEGRACION'];

    //codigo de user
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$cod_user'";
    $rs_u = executeQuery($sql_u);

    @@tri_user_medico = $rs_u['1']['USR_UID'];
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
