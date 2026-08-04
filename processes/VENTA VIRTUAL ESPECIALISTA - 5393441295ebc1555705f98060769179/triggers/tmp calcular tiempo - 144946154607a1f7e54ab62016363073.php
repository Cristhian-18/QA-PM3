<?php

$calendario = '00000000000000000000000000000001';
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;
@@tri_tiempo_atencion = 0;
@@tri_tiempo_sla = 0;


$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);

$desde = $rs[1]['DEL_DELEGATE_DATE'];
$hasta = $rs[1]['DEL_FINISH_DATE'];
$vencimiento = $rs[1]['DEL_TASK_DUE_DATE'];

//@@tmp_d = $desde;
//@@tmp_h = $hasta;
//@@tmp_v = $vencimiento;

// Validar que las fechas existan y sean válidas



if (empty($desde) || empty($hasta) || empty($vencimiento)) {
   @@tmp_tiempo_atencion = 0;
   @@tmp_tiempo_sla = 0;
}else{
  // desde, hasta, uid_usuario, uid_proceso, uid_tarea
  $total = calcular_tiempo_por_fechas_y_calendario($desde, $hasta, null, null, $calendario);
  @@tmp_tiempo_atencion = $total;
  //@@tri_tiempo_atencion = $total['MINUTOS_TOTALES_SIN_CALENDARIO_TRABAJO'];
  @@tri_tiempo_atencion = $total['MINUTOS_TOTALES_HORARIO_TRABAJO'];
  // total tarea
  $total = calcular_tiempo_por_fechas_y_calendario($desde, $vencimiento, null, null, $calendario);
  @@tmp_tiempo_sla = $total;
  @@tri_tiempo_sla = $total['MINUTOS_TOTALES_HORARIO_TRABAJO'];
}

