<?php
$application='';
$application = @@APPLICATION;

if(@@tri_creado_parcial == 1){
return;
}

$accion = @@frm_accion;
@@frm_accion = $accion;


if(@@frm_accion == 'CREARPARCIAL'){

        $taskUID  = '47793586864a1915c3740e7013393106';
        echo $taskUID;
            $newCaseUID = PMFNewCase('35087580064a18c9776b638006106795',
             @@USER_LOGGED,
             $taskUID, array('app_padre_totales' => $application), "TO_DO");
            $g = new G();
            if ($newCaseUID) {
                $c = new Cases();
                $aCaseInfo = $c->LoadCase($newCaseUID, 1);
                $msg = 'New Case #' . $aCaseInfo['APP_NUMBER'] . ' is assigned to ' . $aCaseInfo["CURRENT_USER"];
                $g->SendMessageText($msg, 'INFO');
                @@tri_creado_parcial = 1;
            }
            else {
                $msg = "Unable to create new case." . isset(@@__ERROR__) ? @@__ERROR__ : '';
                $g->SendMessageText($msg, 'ERROR');
            }

          // PMFDerivateCase($newCaseUID, 1, true, @@USER_LOGGED);
}

 @@frm_accion = $accion;
