<?php
//created by Henry
//11-01-2021
//Guardar Reporte de Siniestro
try{
    $cnx = '11264850561d723f004d5c2072943786';

    $app_uid   = @@APPLICATION;
    $task_uid  = @@TASK;
    $ticket 			 = @@APP_NUMBER;
    $usr_uid_actual      = @@USER_LOGGED;
    $fecha_notificacion = @@frm_fecha_notificacion;
    $poliza = @@frm_polizas;
    $poliza_detalle = @@frm_polizas_label;
    $cod_causa = @@frm_causa_siniestro;
    $causa = @@frm_causa_siniestro_label;
    $cod_cobertura = @@frm_coberturas;
    $cobertura = @@frm_coberturas_label;
    $monto = @@frm_monto_reportado;
    $tipo_id = @@frm_tipo_documento;
    $identificacion = @@frm_numero_identificacion;
    $apellido_paterno = @@frm_apellido_paterno;
    $apellido_materno = @@frm_apellido_materno;
    $nombres = @@frm_nombres;
    $fecha_ocurrencia = @@frm_fecha_ocurrencia;
    $tipo_siniestro = @@frm_tipo_siniestro;
    $cobertura_madre = @@frm_cobertura_madre;
    $usr_registro = @@USER_LOGGED;
    $usr_username = @@USR_USERNAME;
    $peso = empty(@@tri_peso_caso) ? 0 : @@tri_peso_caso;
    $id_stro = @@tri_id_stro;
    $nro_stro = @@tri_nro_stro;
    $ramo_tec = @@frm_cod_ramo_tec;
    $subramo_tec = @@frm_cod_subramo_tec;
    $cod_riesgo = @@frm_cod_riesgo;
    $ind_riesgo = @@frm_ind_riesgo;

    $estado = (@@frm_accion == 'CONTINUAR' ? 2 : 1);

    $sql = "INSERT INTO SINIESTRO_REGISTRADO (
        app_uid,
        app_number,
        fecha_notificacion,
        poliza,
        cod_causa,
        causa,
        cod_cobertura,
        cobertura,
        monto,
        tipo_id,
        identificacion,
        apellido_paterno,
        apellido_materno,
        nombres,
        fecha_ocurrencia,
        tipo_siniestro,
        cobertura_madre,
        usr_registro,
        usr_username,
        estado,
        peso,
        detalle_poliza,
        id_stro,
        nro_stro,
        cod_ramo_tec,
        cod_subramo_tec,
        cod_riesgo,
        ind_riesgo
    )
    VALUES
    (
        '$app_uid',
        '$ticket',
        '$fecha_notificacion',
        '$poliza',
        '$cod_causa',
        '$causa',
        '$cod_cobertura',
        '$cobertura',
        '$monto',
        '$tipo_id',
        '$identificacion',
        '$apellido_paterno',
        '$apellido_materno',
        '$nombres',
        '$fecha_ocurrencia',
        '$tipo_siniestro',
        '$cobertura_madre',
        '$usr_registro',
        '$usr_username',
        $estado,
        $peso,
        '$poliza_detalle',
        '$id_stro',
        '$nro_stro',
        '$ramo_tec',
        '$subramo_tec',
        '$cod_riesgo',
        '$ind_riesgo'
    )";

    $rs = executeQuery($sql, $cnx);

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

  
}
