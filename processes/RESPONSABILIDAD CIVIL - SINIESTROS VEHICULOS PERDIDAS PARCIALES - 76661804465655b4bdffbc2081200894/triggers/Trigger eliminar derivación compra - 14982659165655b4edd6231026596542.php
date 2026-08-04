<?php
if (@@frm_accion === 'SOLICITAR') {
   $caseId = @@APPLICATION;
   $index = @%INDEX;
   $g = new G();

   //Select all the other parallel tasks for the current case that are still open
   $query = "SELECT * FROM APP_CACHE_VIEW WHERE APP_UID='$caseId' AND ".
      "DEL_THREAD_STATUS='OPEN' AND DEL_INDEX<>$index";
   $aTasks = executeQuery($query);

   if (!empty($aTasks) > 0) {
     $g->sessionVarSave();
     $msg = array();

      foreach ($aTasks as $aTask) {
         PMFDerivateCase($aTask['APP_UID'], $aTask['DEL_INDEX'], false, $aTask['USR_UID']);
         $msg[] = "Routed on task '{$aTask['APP_TAS_TITLE']}' assigned to {$aTask['APP_CURRENT_USER']}.";
      }   
      $g->sessionVarRestore();
      $g->sendMessageText(implode("\n", $msg), 'INFO'); 
   }
}     