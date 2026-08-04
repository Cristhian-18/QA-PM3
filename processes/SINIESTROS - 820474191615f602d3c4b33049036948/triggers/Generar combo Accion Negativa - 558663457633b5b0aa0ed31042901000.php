<?php
//created by Henry
//Generar combo Numero de dias
//7-4-2022
try{
    if(@@tri_bandera_negado == 'NEGADO'){
        $combo_accion = array(
            '1' => array('','--- Seleccione ---'),
            '2' => array('FINALIZAR','Notificar negativa'),
            '3' => array('REGRESAR_N', 'Regresar para ajuste de la negativa por el Auditor')
        );
        @@frm_fecha_negativa =  date('Y-m-d');
        @@frm_user_negativa = @@USR_USERNAME;
    }else{
        $combo_accion = array(
            '1' => array('','--- Seleccione ---'),
            '2' => array('FINALIZAR','Notificar negativa'),
            '3' => array('REGRESAR', 'Regresar para ajuste de la negativa por el Auditor')
        );
    }

    # Then make $contactOptions available to be queried
    # in the DynaForm like a table from a database:
    global $_DBArray;
    $_DBArray['combo_accion'] = $combo_accion;

    @@tri_combo_accion = $combo_accion;
    @@tri_bandera_update_aux = '';

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
