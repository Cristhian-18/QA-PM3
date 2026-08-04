<?php
//created y Henry

$app_uid        = @@APPLICATION;
$pro_uid        = @@PROCESS;
$cnx = '258697213652197616c32a8032176915';

$sql            = "SELECT
TASK_UID tarea,
USR_UID_ACTUAL usuario,
FECHA_DERIVACION f_tranferencia,
FECHA_INICIO f_inicio,
FECHA_FIN f_fin,
ACCION accion,
COMENTARIO txt_comentario
FROM
EMISIONES_RENOVACION_BITACORA WHERE APP_UID = '$app_uid' order by ID_BITACORA";
$rs_comentarios = executeQuery($sql);


$grd_historial = array();
$i=1;

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
