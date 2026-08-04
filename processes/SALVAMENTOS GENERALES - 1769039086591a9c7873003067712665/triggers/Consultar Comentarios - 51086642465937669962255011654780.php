<?php
//created by Henry modified by Jean
$newCaseId = @@process_uid_padre;
$c = new Cases();
$aCase = $c->loadCase($newCaseId);
@@tri_id_stro= $aCase['APP_DATA']['tri_id_stro'];
@@tri_nro_stro= $aCase['APP_DATA']['tri_nro_stro'];
@@frm_as_valorTotal= $aCase['APP_DATA']['frm_as_valorTotal'];
@@frm_rif_valorLuegoDeducible= $aCase['APP_DATA']['frm_rif_valorLuegoDeducible'];
@@tri_usr_aprobador = $aCase['APP_DATA']['tri_usr_aprobador'];


$cnx = '934957180650c74e8ed0e10096114321';
$app_uid = @@APPLICATION;
$app_uid_padre = @@process_uid_padre;

$sql = "SELECT TASK_UID AS tarea,
USR_UID_ACTUAL AS usuario,
FECHA_DERIVACION AS f_tranferencia,
FECHA_INICIO AS f_inicio,
FECHA_FIN AS f_fin,
ACCION AS accion,
COMENTARIO AS txt_comentario
FROM SINIESTRO_GN_BITACORA WHERE APP_UID = '$app_uid' order by ID_BITACORA";

$sql2 = "SELECT TASK_UID AS tarea,
USR_UID_ACTUAL AS usuario,
FECHA_DERIVACION AS f_tranferencia,
FECHA_INICIO AS f_inicio,
FECHA_FIN AS f_fin,
ACCION AS accion,
COMENTARIO AS txt_comentario
FROM SINIESTRO_GN_BITACORA WHERE APP_UID = '$app_uid_padre' order by ID_BITACORA";

$rs_comentarios = executeQuery($sql);
$rs_comentarios2 = executeQuery($sql2);

$grd_historial = array();
$i=1;
foreach($rs_comentarios2 as $data){
    $grd_historial[$i]['tarea'] = PMFGetTaskName($data['tarea'],'es');
    $grd_historial[$i]['usuario'] = NomUsuario($data['usuario']);
    $grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'];
    $grd_historial[$i]['f_inicio'] = $data['f_inicio'];
    $grd_historial[$i]['f_fin'] = $data['f_fin'];
    $grd_historial[$i]['accion'] = $data['accion'];
    $grd_historial[$i]['txt_comentario'] = $data['txt_comentario'];
    $i++;
    /*$aux_comentarios_padre++;
    if($aux_comentarios_padre == $limit ||	$aux_comentarios_padre > 3){
        break;
    }*/
}
foreach($rs_comentarios as $data){
    $grd_historial[$i]['tarea'] = PMFGetTaskName($data['tarea'],'es');
    $grd_historial[$i]['usuario'] = NomUsuario($data['usuario']);
    $grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'];
    $grd_historial[$i]['f_inicio'] = $data['f_inicio'];
    $grd_historial[$i]['f_fin'] = $data['f_fin'];
    $grd_historial[$i]['accion'] = $data['accion'];
    $grd_historial[$i]['txt_comentario'] = $data['txt_comentario'];
    $i++;
}

@=grd_historial_caso = $grd_historial;

$case_id=@@APPLICATION;
$aVars = array(
    'grd_historial_caso' => $grd_historial);

    $result = PMFSendVariables($case_id, $aVars);

    $_SESSION['beesmartec'] = '/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/inf?id=365';


  $config = parse_ini_file('/code/shared/sites/certificacion/env.ini', true);
    @@URL_SERVER_SQL =  $config['configuracion_entorno']['url'];
    $host = @@URL_SERVER_SQL;

    $url = "$host/syscertificacion/es/3sesa/login/login";

    @@tri_url_bpm = $url;
