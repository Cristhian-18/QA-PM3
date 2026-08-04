<?php
/*******************************************************
 *
 * Trigger de envio de notifiación al Gestor de Emisión
 *
 *******************************************************/

$texto = 'Generación de Tarea Revisar solicitud del préstamo o retiro';
$de = '';
$nextTaskId = '8760052855f3aa896a9a815031066895';
$caseId = @@APPLICATION;

$query = "SELECT USR_UID FROM APP_DELEGATION WHERE APP_UID='$caseId' AND
DEL_INDEX=( SELECT MAX(DEL_INDEX) FROM APP_DELEGATION WHERE APP_UID='$caseId'
AND TASK_UID='$nextTaskId' )";
$result = executeQuery($query) or die("Error in query: $query");

$aUser = userInfo($result[1]['USR_UID']);
$to = $aUser['firstname'] . ' ' . $aUser['lastname'] . ' <' . $aUser['mail'] . '>';

//$para = @@tri_user_sac_mail;

$host = @@URL_SERVER_SQL;
@@adrr_server =  $host;

$cc = '';
$bcc = '';
$asunto = "Notificion asignación de solicitud " . @#frm_tipo_solicitud_label;

$plantilla_rec = 'Notificacion_gestor.html';

@@envio_mail = PMFSendMessage(@@APPLICATION, $de, $to, $cc, $bcc, $asunto, $plantilla_rec, array('texto' => $texto, 'adrr_server' => @@adrr_server));

