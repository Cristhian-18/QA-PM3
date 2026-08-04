<?php
//Created by Jean
$label = @@frm_suscriptor_asignado_label;
@@frm_datosSolicitud_suscriptorAsignado = $label;

$label = date("Y-m-d H:i:s");
@@frm_datosSolicitud_fechaAsignacion = $label;

$frm_responsable_asignado = @@frm_suscriptor_asignado;
$sql_cot = "SELECT USR_UID, USR_EMAIL FROM USERS WHERE USR_UID = '$frm_responsable_asignado'";
$rs_cot = executeQuery($sql_cot);
@@frm_responsable_suscripcion_mail = $rs_cot['1']['USR_EMAIL'];



