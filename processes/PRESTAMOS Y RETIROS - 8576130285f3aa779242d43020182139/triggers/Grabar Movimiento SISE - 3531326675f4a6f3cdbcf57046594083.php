<?php
//created by Henry
//29-08-2020
//Grabar Informacion SISE

$cnx = '1471226895f49403bebfa26089899906';

$id_pv_cero = @@
$id_proceso = @@
$tipo_movimiento = @@
$TipoOperacion = @@
$imp_monto_solicitar = @@
$nro_cuotas = @@
$cod_frecuencia_pago = @@
$fec_pago = @@
$tipo_identificacion = @@
$nro_identificacion = @@
$cod_banco_acreditar = @@
$cod_tipo_cta_acreditar = @@
$nro_cta_acreditar = @@
$sn_transferencia = @@
$email_contratante = @@
$cod_banco_debitar = @@
$cod_tipo_cta_debitar = @@
$nro_cta_debitar = @@


$sql = "EXECUTE dbo.spc_PC_informacion_BPM 8,3879392,2";

$rs = executeQuery($sql, $cnx);

