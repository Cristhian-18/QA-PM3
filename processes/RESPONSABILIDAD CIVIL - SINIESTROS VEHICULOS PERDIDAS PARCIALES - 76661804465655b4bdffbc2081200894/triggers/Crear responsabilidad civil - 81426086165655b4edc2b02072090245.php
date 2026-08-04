<?php
//<?

$vehiculos_siniestrados = array();
$vehiculos_siniestrados = @@grd_vehiculos_afectados;
$aux = 1;
if(@@frm_siniestro_OtrosVehiculos == "SI"){

    foreach($vehiculos_siniestrados as $vehiculos){
        $estado = $vehiculos['frm_vafectado_estado'];
        $marca = $vehiculos['frm_vafectado_marca_label'];
        $modelo = $vehiculos['frm_vafectado_modelo'];
        $placa = $vehiculos['frm_vafectado_placa'];
        $propietario = $vehiculos['frm_vafectado_propietario'];
        $danos = $vehiculos['frm_vafectado_danios'];
        $anio = $vehiculos['frm_vafectado_anio'];


        switch ($estado){

            case 'INDEMNIZACION':
            $taskUID  = '635581575655d9666bec540065327674';
            $newCaseUID = PMFNewCase('825131544655d966690baf3008380613',
            @@USER_LOGGED,
            $taskUID, array('app_uid_rc' => @@APPLICATION,
            'app_number_padre' => @@tri_nro_stro . ' - RC'.$aux,
            'marca' => $marca,
            'modelo' => $modelo,
            'placa' => $placa,
            'propietario' => $propietario,
            'danos' => $danos,
            'anio' => $anio,
            'estado' => $estado
        ), "TO_DO");
        $g = new G();



        if ($newCaseUID) {
            $c = new Cases();
            $aCaseInfo = $c->LoadCase($newCaseUID, 1);
            $index = $aCaseInfo['DEL_INDEX'];
            $user = $aCaseInfo['CURRENT_USER_UID'];
            $msg = 'New Case #' . $aCaseInfo['APP_NUMBER'] . ' is assigned to ' . $aCaseInfo["CURRENT_USER"];
            $g->SendMessageText($msg, 'INFO');
        }
        else {
            $msg = "Unable to create new case." . isset(@@__ERROR__) ? @@__ERROR__ : '';
            $g->SendMessageText($msg, 'ERROR');
        }


        PMFDerivateCase($newCaseUID,1,true,@@USER_LOGGED);
        break;

        case 'TALLER':
        $taskUID  = '635581575655d9666bec540065327674';
        $newCaseUID = PMFNewCase('825131544655d966690baf3008380613',
        @@USER_LOGGED,
        $taskUID, array('app_uid_rc' => @@APPLICATION,
        'app_number_padre' => @@tri_nro_stro . ' - RC'.$aux,
        'marca' => $marca,
        'modelo' => $modelo,
        'placa' => $placa,
        'propietario' => $propietario,
        'danos' => $danos,
        'anio' => $anio,
        'estado' => $estado

    ), "TO_DO");
    $g = new G();

    if ($newCaseUID) {
        $c = new Cases();
        $aCaseInfo = $c->LoadCase($newCaseUID, 1);
        $msg = 'New Case #' . $aCaseInfo['APP_NUMBER'] . ' is assigned to ' . $aCaseInfo["CURRENT_USER"];
        $g->SendMessageText($msg, 'INFO');
    }
    else {
        $msg = "Unable to create new case." . isset(@@__ERROR__) ? @@__ERROR__ : '';
        $g->SendMessageText($msg, 'ERROR');
    }
    $nextIndex = @%INDEX ;

    PMFDerivateCase($newCaseUID,1,true,@@USER_LOGGED);
    break;
}
$aux++;

}
}


