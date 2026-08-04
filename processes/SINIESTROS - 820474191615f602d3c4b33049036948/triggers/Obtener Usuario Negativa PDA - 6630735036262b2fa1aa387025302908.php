<?php
try {

    $cnx = "11264850561d723f004d5c2072943786";
    $app_uid        = @@APPLICATION;
    $pro_uid        = @@PROCESS;

    $host = @@URL_SERVER_SQL;



    $monto_liquidar = @@frm_monto_liquidar;


    $monto_liquidar = intval($monto_liquidar);

    @@tri_user_negativa_pda = @@USER_LOGGED;
    $cod_user = @@USER_LOGGED;

    //codigo de la tabla
    $sql = "SELECT CAMPO1, DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'APROBADORES_NEGATIVAS_PDA' AND PRO_UID = '$pro_uid' AND ESTADO = 1 AND  $monto_liquidar >= VALOR AND $monto_liquidar <= INTEGRACION  ";

    $rs = executeQuery($sql, $cnx);


    $cod_user = $rs['1']['CAMPO1'];
    $cod_user = ($cod_user == 'usuario' ? @@USR_USERNAME : $cod_user); //dj

    @@tri_user_negativa_pda_cargo = $rs['1']['DESCRIPCION'];  //dj
    //}
    //codigo de user
    $sql_u = "SELECT * FROM USERS WHERE USR_USERNAME = '$cod_user'";
    $rs_u = executeQuery($sql_u);
    @@tmp_rs = $rs_u;
    @@tri_user_negativa_pda = $rs_u['1']['USR_UID'];
    @@tri_user_pda_negativa_name = $rs_u['1']['USR_FIRSTNAME'] . ' ' . $rs_u['1']['USR_LASTNAME'];
    @@tri_user_pda_negativa_mail = $rs_u['1']['USR_EMAIL'];

    $dns_user = "$host/syscertificacion/es/3sesa/beesmartec/services/firma/servicioFirma.php?codigo=" . @@tri_user_negativa_pda;
    //echo $dns_user;
    @@tri_user_negativa_pda_firma = '<img src="' . $dns_user . '" />';

    @@tri_bandera_update_aux = '';
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
