<?php
//created by Henry
//27-04-2022
//Obtener Info secuencial Negativa
try {

    $cnx = '11264850561d723f004d5c2072943786';
    $pro_uid = @@PROCESS;


    //codigo de la tabla
    $sql = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SECUENCIAL_NEGATIVA' AND PRO_UID = '$pro_uid' AND ESTADO = 1 AND CODIGO = 1";
    $rs = executeQuery($sql, $cnx);
    $tri_anexo_negativa = ($rs['1']['DESCRIPCION'] == '' ? 0 : $rs['1']['DESCRIPCION']);

    @@tri_anexo_negativa = '00000' . $tri_anexo_negativa;

    $tri_anexo_negativa_aux = $tri_anexo_negativa + 1;

    //update de la tabla
    $sql = "UPDATE ADMIN_CATALOGOS SET DESCRIPCION = '$tri_anexo_negativa_aux' WHERE COD_CATALOGO = 'SECUENCIAL_NEGATIVA' AND PRO_UID = '$pro_uid' AND CODIGO = 1";
    $rs = executeQuery($sql, $cnx);
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
