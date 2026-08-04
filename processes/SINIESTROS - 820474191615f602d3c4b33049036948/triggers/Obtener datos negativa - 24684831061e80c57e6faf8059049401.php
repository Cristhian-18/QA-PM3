<?php
//creatde by Henry
//Obtener bandera de fechas atencion
try{
    $fecha_notificacion = @@frm_fecha_notificacion;
    $dias_respuesta = @@frm_dias_respuesta;

    $date_actual = date('Y-m-d');

    $date_respuesta = date("Y-m-d",strtotime($fecha_notificacion."+ $dias_respuesta days"));

    @@frm_fecha_respuesta = $date_respuesta;


    @@frm_numero_poliza = @@frm_numero_poliza_label;
    @@frm_contratante = @@frm_contratante_label;
    @@frm_broker = @@frm_broker_label;
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
