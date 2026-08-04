<?php
//Envio correo notificaciones taller - reparacion
//envio correo taller analista


$app_number = @@APP_NUMBER;
$tipo_req = @@frm_datosSolicitud_tipo_label;
$taller = @@frm_taller;

switch (@@TASK) {
    //tarea 1
    case '47793586864a1915c3740e7013393106':
        $de = '';
        $para = @@tri_correos_enviar;
        //$para = @@tri_correo_desarrollador_cc;
        $cc = '';
        $bcc = @@tri_correo_desarrollador_bcc;
        $asunto = "Notificación de caso en BPM " . $app_number;
        $texto =
            $comentario = @@frm_comentario;
        $accion = @@frm_accion;
        $id_analista = @@tri_usr_analista;
        $sql_analista = "SELECT USR_FIRSTNAME, USR_LASTNAME FROM USERS WHERE USR_UID = '$id_analista'";
        $rs_analista = executeQuery($sql_analista);
        $nombre_analista = $rs_analista['1']['USR_FIRSTNAME'] . ' ' . $rs_analista['1']['USR_LASTNAME'];

        $plantilla_rec = 'Notificacion_tracking.html';
        $texto_tracking = "Estimado cliente, se le notifica el taller y el analista asignado para su caso, por favor no responder este correo. <br><br>";
        @@envio_mail_t1 = PMFSendMessage(
            @@APPLICATION,
            $de,
            $para,
            $cc,
            $bcc,
            $asunto,
            $plantilla_rec,
            array(
                'texto_tracking' =>
                $texto_tracking,
                'frm_nombre_analista' => $nombre_analista,
            )
        );
        break;
    case '46680647864a194cc1ea273036601085':
        if (@@frm_accion == 'CONTINUAR' || @@frm_accion == 'INDEMNIZAR' || @@frm_accion == 'COMPRAR') {
            $de = '';
            $para = @@tri_correos_enviar;
            //$para = @@tri_correo_desarrollador_cc;
            $cc = '';
            $bcc = @@tri_correo_desarrollador_bcc;
            $asunto = "Notificación de caso en BPM " . $app_number;
            $texto =
                $comentario = @@frm_comentario;
            $accion = @@frm_accion;
            $id_analista = @@tri_usr_analista;
            $sql_analista = "SELECT USR_FIRSTNAME, USR_LASTNAME FROM USERS WHERE USR_UID = '$id_analista'";
            $rs_analista = executeQuery($sql_analista);
            $nombre_analista = $rs_analista['1']['USR_FIRSTNAME'] . ' ' . $rs_analista['1']['USR_LASTNAME'];

            $plantilla_rec = 'Notificacion_tracking.html';
            $texto_tracking = "Estimado cliente, se le notifica que su vehículo ha recibido una orden de reparación, por favor no responder este correo. <br><br>";
            @@envio_mail_t1 = PMFSendMessage(
                @@APPLICATION,
                $de,
                $para,
                $cc,
                $bcc,
                $asunto,
                $plantilla_rec,
                array(
                    'texto_tracking' =>
                    $texto_tracking,
                    'frm_nombre_analista' => $nombre_analista,
                )
            );
        }
        break;
}
