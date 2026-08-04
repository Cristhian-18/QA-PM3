<?php
//<?phpcreated by Henry Bautista
//20-08-2020
//Grabar historial de caso

$cnx = '258697213652197616c32a8032176915';
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;
$cod_negativa = 0;
@@frm_accion_aux  = @@frm_accion;

$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);
$rs_actual    = $rs['1'];
$rs_siguiente = $rs['2'];

$ticket 			 = @@APP_NUMBER;
$usr_uid_actual      = @@USER_LOGGED;

$fecha_inicio        = ($rs_actual['DEL_INIT_DATE'] != '') ? $rs_actual['DEL_INIT_DATE'] : '';
$fecha_fin           = date('Y-m-d H:i:s');
$fecha_vencimiento   = ($rs_actual['DEL_TASK_DUE_DATE'] != '') ? $rs_actual['DEL_TASK_DUE_DATE'] :'';
$fecha_derivacion    = ($rs_actual['DEL_DELEGATE_DATE'] != '') ? $rs_actual['DEL_DELEGATE_DATE'] :'';

$usr_uid_receptor    = $rs_siguiente['USR_UID'];
$tas_uid_actual    = $rs_siguiente['TAS_UID'];
$tarea_actual    = PMFGetTaskName($rs_siguiente['TAS_UID'],'es');

@@tmp_entra = @@TASK;
//validacion por tarea
switch (@@TASK){
    //tarea 1
    case '425464187652152567c32c0021157413':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    if($accion == 'FINALIZAR'){
        @@frm_caso_estado = "FINALIZADO";
        //$sql = "UPDATE SINIESTRO_REGISTRADO SET usr_auditor = '$usr_uid_receptor' WHERE app_uid = '$app_uid'";
        //$rs = executeQuery($sql, $cnx);
    } else if ($accion == 'CONTINUAR'){
        @@frm_caso_estado = "EN PROCESO";
    } else if ($accion == 'REVISAR'){
        @@frm_caso_estado = "REVISADO";
    }
    //estado del flujo catalogo ESTADO_EVENTO
    //@@tri_estado_evento = 1;
    $cod_estado = @@frm_caso_estado;
    break;
    //tarea 2
    case '45952911965215256264370054809440':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion_c;
    $accion_label     = @@frm_accion_c_label;
    $cod_estado = @@tri_estado_evento;
    break;
    case '56790794265215256872664077973746':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion_t;
    $accion_label     = @@frm_accion_t_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //tarea 3
    case '35160580265215256541ab8094100787':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //tarea 4
    case '272989440652152565f2779059595363':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //TAREA 5
    case '86468730265215256b284b6071813170':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    case '8247927376521525676e1b9045713130':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    case '71065108665215256715fb0045960866':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion_c;
    $accion_label     = @@frm_accion_c_label;
    $cod_estado = @@tri_estado_evento;
    break;
    case '8961052146521525664ad68072679479':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion_t;
    $accion_label     = @@frm_accion_t_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //TAREA 6
    case '13941977965215256a2e7c1020727543':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //Tarea 7
    case '45377697965215256976d89082488170':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //Tarea 7
    case '3307487626521525620fea9042882681':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //Tarea 8
    case '926762764652152568160d9033064912':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //Tarea 9
    case '879775474652152561bba84010841596':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //Tarea 10
    case '286679760652152566b8eb9025659945':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    //Tarea 11
    case '46270677565215256ad8482021797184':
    $comentario = @@frm_comentario;
    $accion     = @@frm_accion;
    $accion_label     = @@frm_accion_label;
    $cod_estado = @@tri_estado_evento;
    break;
    default:
    $comentario = 'COMENTARIO BPM';
    $accion = 'CONTINUAR';
    break;
}

$sql = "INSERT INTO EMISIONES_RENOVACION_BITACORA (
    APP_NUMBER,
    APP_UID,
    TASK_UID,
    FECHA_INICIO,
    FECHA_FIN,
    FECHA_DERIVACION,
    FECHA_VENCIMIENTO,
    DEL_INDEX,
    COD_ACCION,
    USR_UID_ACTUAL,
    USR_UID_RECEPTOR,
    COMENTARIO, ACCION, COD_NEGATIVA, COD_ESTADO)
    values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario','$accion_label', '$cod_negativa','$cod_estado')";
    @@tmp_sql_com = $sql;
    $rs_i = executeQuery($sql);



