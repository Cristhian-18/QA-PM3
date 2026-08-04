<?php
//creatde by Henry
//Obtener bandera de fechas atencion
try {
    $cnx = '11264850561d723f004d5c2072943786';
    $app_uid = @@APPLICATION;

    $dias_respuesta = @@frm_dias_respuesta;
    $date_actual = date('Y-m-d');

    $date_respuesta = date("Y-m-d", strtotime($date_actual . "+ $dias_respuesta days"));

    @@frm_fecha_respuesta = $date_respuesta;

    //actualizamos la tabla para las notificaciones
    $sql = "UPDATE SINIESTRO_REGISTRADO SET fecha_retorno = '$date_respuesta' WHERE app_uid = '$app_uid'";
    $rs = executeQuery($sql, $cnx);
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
