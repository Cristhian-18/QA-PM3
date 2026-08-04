<?php
//created by Henry
//07-09-2020
//Consulta Tabla de amortizacion

$cnx = '1471226895f49403bebfa26089899906';
@@tri_mes_TablaBPM = '';

$id_proceso = @@frm_proceso_id;
$id_pv_cero = @@id_pev_cero;
$tipo = (@@frm_tipo_solicitud == 'P' ? 1 : 2); //prestamo;

echo $sql_p = "EXECUTE dbo.spc_PC_ConsCuotPrest_BPM $id_proceso, $id_pv_cero, $tipo";

$rs_p = executeQuery($sql_p, $cnx);

@@tri_table_amor = $rs_p;



