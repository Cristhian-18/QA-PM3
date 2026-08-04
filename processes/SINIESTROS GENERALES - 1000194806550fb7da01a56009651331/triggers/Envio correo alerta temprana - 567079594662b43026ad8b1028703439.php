<?php
//Envio correo alerta temprana

$app_uid = @@APPLICATION;

$process = @@PROCESS;
$sql = "SELECT CODIGO, VALOR FROM ADMIN_CATALOGOS WHERE 
COD_CATALOGO = 'CORREOS_ALERTAS_INUSUALES' 
AND PRO_UID = '$process' AND ESTADO = 1";
echo $sql;
$rs = executeQuery($sql);

//JOIN ALL VALOR INTO A STRING SEPARATED BY COMMAS
$correos = "";

foreach ($rs as $row) {
    //check if the value is not empty and is a valid email
    if (!empty($row['VALOR']) && filter_var($row['VALOR'], FILTER_VALIDATE_EMAIL)) {
        $correos .= $row['VALOR'] . ",";
    }
    //$correos .= $row['VALOR'].",";
}
//correos to string 
$correos = rtrim($correos, ',');

//get current time
$inicio_vigencia = @@frm_ds_polizaInicioVigencia;
//01/01/2024 00:00:00 - DD/MM/YYYY
$inicio_vigencia = DateTime::createFromFormat('d/m/Y H:i:s', $inicio_vigencia);
$inicio_vigencia = $inicio_vigencia->format('Y-m-d H:i:s');
//echo $inicio_vigencia;

//check how many days have passed since it started (today - inicio_vigencia)
$today = date('Y-m-d H:i:s');
$today = new DateTime($today);
$inicio_vigencia = new DateTime($inicio_vigencia);
$inicio_vigencia_string = $inicio_vigencia->format('Y-m-d H:i:s');
$diff = $today->diff($inicio_vigencia);
$days = $diff->days;
echo $days;

if ($days > 30) {
    return;
}

try {
    $app_number = @@APP_NUMBER;
    $categoria_alerta = "Alerta temprana";
    $causal_alerta = "La póliza fue emitida hace $days días";
    $observaciones = "La póliza fue emitida el dia $inicio_vigencia_string";

    $de = '';
    $para = $correos;
    //$para = @@tri_destinatarios_copias;
    $cc = '';
    $bcc = @@tri_correo_desarrollador_bcc;
    $asunto = "Notificación de alerta temprana en caso BPM $app_number";
    $texto = '<p align="justify">Estimado(a),&nbsp;Colaborador</p>';
    $texto .= '<p align="justify">Se le notifica que el caso de BPM '
        . $app_number . ' ha registrado un siniestro antes de que su póliza haya cumplido 30 dias.</p>
    <p align="justify"><b>Categoria de alerta: <b> ' . $categoria_alerta . '</p>
    <p align="justify"><b>Causal de alerta: <b> ' . $causal_alerta . '</p>
    <p align="justify"><b>Observaciones: <b> ' . $observaciones . '</p>

    ';
    $comentario = '';
    $plantilla_rec = 'Mail_alerta_inusual.html';
    $message = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' => $texto));
    echo "<br> $message <br> ";
    echo "Correo enviado";

    @@bandera_alerta_temprana = 1;
    //die();
} catch (Exception $e) {
    echo $e->getMessage();
    //die();
}
