<?php
//created by Henry modified by Jean
echo 'Docs';

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
FROM  SINIESTRO_VH_BITACORA WHERE APP_UID = '$app_uid' order by ID_BITACORA";

$sql2 = "SELECT TASK_UID AS tarea,
USR_UID_ACTUAL AS usuario,
FECHA_DERIVACION AS f_tranferencia,
FECHA_INICIO AS f_inicio,
FECHA_FIN AS f_fin,
ACCION AS accion,
COMENTARIO AS txt_comentario
FROM  SINIESTRO_VH_BITACORA_TOTAL WHERE APP_UID = '$app_uid_padre' order by ID_BITACORA";


$rs_comentarios = executeQuery($sql);
$rs_comentarios2 = executeQuery($sql2);


$grd_historial = array();
$i=1;

foreach ($rs_comentarios2 as $data) {

    try {
        // Validar que $data sea un array
        if (!is_array($data)) {
            throw new Exception("El elemento no es un array válido.");
        }

        // Validar existencia de claves
        $camposObligatorios = ['tarea', 'usuario', 'f_tranferencia', 'f_inicio', 'f_fin', 'accion', 'txt_comentario'];

        foreach ($camposObligatorios as $campo) {
            if (!array_key_exists($campo, $data)) {
                throw new Exception("Falta el campo '$campo' en el registro.");
            }
        }

        // Asignaciones con validación individual
        $grd_historial[$i]['tarea']          = PMFGetTaskName($data['tarea'], 'es') ?? "Valor no válido en tarea";
        $grd_historial[$i]['usuario']        = NomUsuario($data['usuario']) ?? "Valor no válido en usuario";
        $grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'] ?: "Fecha de transferencia inválida";
        $grd_historial[$i]['f_inicio']       = $data['f_inicio'] ?: "Fecha inicio inválida";
        $grd_historial[$i]['f_fin']          = $data['f_fin'] ?: "Fecha fin inválida";
        $grd_historial[$i]['accion']         = $data['accion'] ?: "Acción inválida";
        $grd_historial[$i]['txt_comentario'] = $data['txt_comentario'] ?: "Comentario inválido";

        $i++;


    } catch (Exception $e) {
        // Muestra exactamente el error del registro problemático
        echo "Error en registro $i: " . $e->getMessage() . "<br>";
    }
}

foreach($rs_comentarios as $data){

    try {
        // Validar que $data sea un array
        if (!is_array($data)) {
            throw new Exception("El elemento no es un array válido.");
        }

        // Validar existencia de claves
        $camposObligatorios = ['tarea', 'usuario', 'f_tranferencia', 'f_inicio', 'f_fin', 'accion', 'txt_comentario'];

        foreach ($camposObligatorios as $campo) {
            if (!array_key_exists($campo, $data)) {
                throw new Exception("Falta el campo '$campo' en el registro.");
            }
        }

        // Asignaciones con validación individual
        $grd_historial[$i]['tarea'] = PMFGetTaskName($data['tarea'],'es');
        $grd_historial[$i]['usuario'] = NomUsuario($data['usuario']);
        $grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'];
        $grd_historial[$i]['f_inicio'] = $data['f_inicio'];
        $grd_historial[$i]['f_fin'] = $data['f_fin'];
        $grd_historial[$i]['accion'] = $data['accion'];
        $grd_historial[$i]['txt_comentario'] = $data['txt_comentario'];
        $i++;

    } catch (Exception $e) {
        // Muestra exactamente el error del registro problemático
        echo "Error en registro $i: " . $e->getMessage() . "<br>";
    }

}

@=grd_historial_caso = $grd_historial;
$case_id=@@APPLICATION;
$aVars = array(
    'grd_historial_caso' => $grd_historial);

    $result = PMFSendVariables($case_id, $aVars);

    $_SESSION['beesmartec'] = '/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/inf?id=365';


    $host = @@URL_SERVER_SQL;

    $url = "$host";

    @@tri_url_bpm = $url;


