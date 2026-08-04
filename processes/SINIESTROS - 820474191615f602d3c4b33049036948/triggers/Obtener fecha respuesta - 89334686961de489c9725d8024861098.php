<?php
//creatde by Henry
//Obtener bandera de fechas atencion
try {

    $cnx = '11264850561d723f004d5c2072943786';
    $app_uid = @@APPLICATION;
    $fecha_notificacion = @@frm_fecha_notificacion;
    $dias_respuesta = @@frm_dias_respuesta;

    $date_actual = date('Y-m-d');

    $date_respuesta = date("Y-m-d", strtotime($fecha_notificacion . "+ $dias_respuesta days"));

    @@frm_fecha_respuesta = $date_respuesta;

    //actualizamos la tabla para las notificaciones
    $sql = "UPDATE SINIESTRO_REGISTRADO SET fecha_retorno = '$date_respuesta' WHERE app_uid = '$app_uid'";
    $rs = executeQuery($sql, $cnx);

    //para el tiempo de la poliza
    @@frm_fecha_ingreso_poliza_aux = (@@frm_fecha_ingreso_poliza_aux == '' ? @@frm_fecha_ingreso_poliza : @@frm_fecha_ingreso_poliza_aux);
    $date_poliza = explode(" ", @@frm_fecha_ingreso_poliza_aux);
    $arr_date_poliza = explode("/", $date_poliza[0]);
    $mes_pol = $arr_date_poliza[0];
    $dia_pol = $arr_date_poliza[1];
    $anio_pol = $arr_date_poliza[2];

    //@@frm_fecha_ingreso_poliza = substr(@@frm_fecha_ingreso_poliza, 0, 10);
    //@@frm_fecha_ingreso_poliza = str_replace("/","-",@@frm_fecha_ingreso_poliza);
    @@frm_fecha_ingreso_poliza = $anio_pol . '-' . $mes_pol . '-' . $dia_pol;
    $firstDate = date("Y-m-d", strtotime(@@frm_fecha_ingreso_poliza));
    //formatDate(@@frm_fecha_ingreso_polizass, "yyyy-mm-dd");
    $secondDate = date("Y-m-d");
    $dateDifference = abs(strtotime($secondDate) - strtotime($firstDate));

    $years  = floor($dateDifference / (365 * 60 * 60 * 24));
    $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    $time = $years . " años,  " . $months . " meses y " . $days . " días";


    @@frm_tiempo_poliza = $time;
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
