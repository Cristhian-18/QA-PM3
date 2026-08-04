<?php
//creatde by Henry

$date_final_mes = date('Y-m-t');
$frm_fecha_pausa = date("Y-m-d 11:00:00",strtotime($date_final_mes."+ 1 days"));
$date_actual = date('Y-m-d');
$resta = strtotime($date_final_mes)-strtotime($date_actual);
$dias = $resta / (24*3600);

if($dias < 3){
//get the user assigned to the next task:
$c = new Cases();
$aCaseInfo = $c->LoadCase(@@APPLICATION, @%INDEX+1);
//if next task is a subprocess then no assigned user:
if (empty($aCaseInfo['CURRENT_USER_UID']))
    $userId = @@USER_LOGGED;
else
    $userId = $aCaseInfo['CURRENT_USER_UID'];

@@tri_pausa = PMFPauseCase(@@APPLICATION, @%INDEX+1, $userId, $frm_fecha_pausa);
}