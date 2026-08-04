<?php
//<?
$query = "SELECT APPLICATION.APP_UID, APPLICATION.APP_NUMBER, APPLICATION.APP_STATUS, APPLICATION.APP_UPDATE_DATE, APP_DELEGATION.DEL_INDEX, APP_DELEGATION.USR_UID, APP_DELEGATION.PRO_ID, APP_DELEGATION.TAS_ID, APP_DELEGATION.USR_ID
FROM APPLICATION
LEFT JOIN APP_DELEGATION ON (APPLICATION.APP_NUMBER = APP_DELEGATION.APP_NUMBER)
WHERE DEL_LAST_INDEX = 1 AND APP_STATUS_ID IN (3,4)
and APPLICATION.APP_UID= '8519501926616be9a8c08a8096615143'
";
echo($query);
die();
$cases = executeQuery($query);
/*print_r($cases);
die();
*/
     $caseId = $cases[1]['APP_UID'];
      $index  = $cases[1]['DEL_INDEX'];
      $userId = $cases[1]['USR_UID'];
      $c = new Cases();
      $result = $c->ReactivateCurrentDelegation($caseId, $index);
   
      $aCaseLoaded = $c->loadCase($caseId);
      $aCaseLoaded['APP_STATUS'] = 'TO_DO';
      $aCaseLoaded['APP_STATUS_ID'] = 2; //only in version 3.2 and later
      $c->updateCase($caseId, $aCaseLoaded);
print_r($cases);
die();