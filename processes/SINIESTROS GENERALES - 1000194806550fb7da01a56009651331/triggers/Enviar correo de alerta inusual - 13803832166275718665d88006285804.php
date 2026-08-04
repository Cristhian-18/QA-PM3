<?php
//Enviar correo inusual

$siniestro_inusual = @@frm_siniestroInusual_check;
$bandera_correo_enviado_alerta_inusual = @@bandera_correo_enviado_alerta_inusual;
//if != 1 then exit



if ($siniestro_inusual != 1) {
    return;
}

if ($bandera_correo_enviado_alerta_inusual == 1) {
    return;
}

$process = @@PROCESS;

$sql = "SELECT CODIGO, VALOR FROM ADMIN_CATALOGOS WHERE
COD_CATALOGO = 'CORREOS_ALERTAS_INUSUALES'
AND PRO_UID = '$process' AND ESTADO = 1";

$rs = executeQuery($sql);

//JOIN ALL VALOR INTO A STRING SEPARATED BY COMMAS
$correos = "";
print_r($rs);

foreach ($rs as $row) {
    //check if the value is not empty and is a valid email
    if (!empty($row['VALOR']) && filter_var($row['VALOR'], FILTER_VALIDATE_EMAIL)) {
        $correos .= $row['VALOR'] . ",";
    }
    //$correos .= $row['VALOR'].",";
}



try {
    $app_number = @@APP_NUMBER;
    $categoria_alerta = @@frm_siniestroInusual_categoria_label;
    $causal_alerta = @@sub_siniestroInusual_causal_label;
    $observaciones = @@frm_siniestroInusual_observaciones;

    $de = '';
    $para = $correos;
    $cc = @@tri_destinatarios_copias_cc;
    $bcc = @@tri_correo_desarrollador_bcc;
    $asunto = "Notificación de alerta temprana en caso BPM $app_number";
    $texto = '<p align="justify">Estimado(a),&nbsp;Colaborador</p>';
    $texto .= '<p align="justify">Se le notifica que el caso de BPM '
        . $app_number . ' fue alertado por un analista</p>
    <p align="justify"><b>Categoria de alerta: <b> ' . $categoria_alerta . '</p>
    <p align="justify"><b>Causal de alerta: <b> ' . $causal_alerta . '</p>
    <p align="justify"><b>Observaciones: <b> ' . $observaciones . '</p>

    ';
    $comentario = '';
    $plantilla_rec = 'Mail_alerta_inusual.html';
    $message = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' => $texto));
    echo "<br> $message <br> ";
    echo "Correo enviado";

    @@bandera_correo_enviado_alerta_inusual = 1;
    //die();
} catch (Exception $e) {
    echo $e->getMessage();
    //die();
}
