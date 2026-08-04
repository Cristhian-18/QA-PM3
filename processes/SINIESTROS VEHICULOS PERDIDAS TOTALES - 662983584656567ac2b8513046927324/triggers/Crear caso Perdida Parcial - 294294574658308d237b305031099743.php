<?php
if(@@frm_accion == "PARCIAL"){
	if(@@app_padre == null || @@app_padre == ''){
		$taskUID  = '47793586864a1915c3740e7013393106';
            $newCaseUID = PMFNewCase('35087580064a18c9776b638006106795',
             @@USER_LOGGED, 
             $taskUID, array(
			'app_padre' => @@APPLICATION,
        ), "TO_DO");
            $g = new G();
            //echo($newCaseUID);
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
		            PMFDerivateCase($newCaseUID, 1, true);

	}
}