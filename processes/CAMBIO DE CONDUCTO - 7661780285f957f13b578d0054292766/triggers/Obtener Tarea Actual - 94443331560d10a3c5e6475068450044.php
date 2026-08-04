<?php
//Obtener Tarea Actual

$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;

$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);
$rs_actual    = $rs['1'];

$rs_siguiente = $rs['2'];
$usr_uid_receptor    = ($rs_siguiente['USR_UID'] == '' ? @@USER_LOGGED : $rs_siguiente['USR_UID']);
$tas_uid    = ($rs_siguiente['TAS_UID'] == '' ? @@TASK : $rs_siguiente['TAS_UID']);

@@tri_task_actual = $tas_uid;
@@tri_user_actual = $usr_uid_receptor;