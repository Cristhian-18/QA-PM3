<?php
//creatde by Henry

$date_actual = date('Y-m-d');
$date_final_mes = date("Y-m-t", strtotime($date_actual));
$dia=date("w", strtotime($date_final_mes));

if($dia == 6){
    $frm_fecha_pausa = date("Y-m-d 11:00:00",strtotime($date_final_mes."+ 2 days"));

    echo $frm_fecha_pausa;
}
if($dia == 0){
    $frm_fecha_pausa = date("Y-m-d",strtotime($date_final_mes."+ 1 days"));

    echo $frm_fecha_pausa;
}


$userId = @@USER_LOGGED;

@@tri_pausa_a = PMFPauseCase(@@APPLICATION, @%INDEX, $userId, $frm_fecha_pausa);
G::header("location: cases_List");
