<?php
//created by Henry
//Inicializar Variables Negados
try{



    @@frm_monto_asegurado = 0;
    //@@frm_monto_liquidar = (@@frm_monto_liquidar == '' ? 0 : @@frm_monto_liquidar);
    @@frm_monto_liquidar = 0;
    //@@frm_monto_reportado = 0;
    @@frm_monto_aprobado = 0;

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
