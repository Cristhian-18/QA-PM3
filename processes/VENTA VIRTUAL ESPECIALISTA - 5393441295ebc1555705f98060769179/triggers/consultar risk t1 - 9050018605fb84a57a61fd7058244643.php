<?php
// CONSULTAR DATOS DEL WS PARA CONSULTAR
// DECSION 

@@tmp_ingreso = "damian 1";
$cnx = '1479570925ec29f1d8d1d57019959618';
$sqlws  = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'RISK'";
$rsws   = executeQuery($sqlws,$cnx);
$ip     = $rsws['1']['VALOR'];
@@tmp_ip = $ip;
$primer = @@frm_primer_nombre;
$segundo = @@frm_segundo_nombre;	
$paterno = @@frm_apellido_paterno;
$materno = @@frm_apellido_materno;
$tipo = @@frm_tipo_identificacion;
$id = @@frm_numero_identificacion;
$user = 'BPM-'.@@USR_USERNAME;
@@tri_usr_rcs = $user;
$fecha_inicio = date('Y-m-d H:i:s');

@@tri_rcs_v1_estado = '';
@@tri_rcs_v1_mensaje = '';
@@tri_rcs_v1_novedad = '';

@@tri_rcs_v1_conyuge_estado = '';
@@tri_rcs_v1_conyuge_novedad = '';
@@tri_rcs_v1_conyuge_mensaje = '';

$param['item'] = array(
	'apellidoMaterno' => $materno,
	'apellidoPaterno' => $paterno,		
	'identificacion' => $id,
	'primerNombre' => $primer,		
	'segundoNombre' => $segundo,		
	'tipoIndentificacion' => $tipo);
@@tmp_rcs1 = $param;
//consulta de datos cliente
$resultado = '';
try{

	$client = new SoapClient($ip, array('exceptions' => true));
	$respuesta['data']['error']   = 'NO'; 
	$respuesta['data']['mensaje'] = '';

	$result = $client->__SoapCall('buscarRcs',array($param,$user));

	$resultado = $result->item; 
	@@tmp_rcs_result = $result;

	$resultado1 = json_decode(json_encode($resultado), true);
	$resultado2 = $resultado1['contenidoXml'];
	@@TMP_resultado = json_decode(json_encode($resultado2), true);
	$resultado3 = substr($resultado2,357,-59);
	@@tri_rcs_v1_novedad = (strlen($resultado3) > 0 ? $resultado3 : 'PENDIENTE' );
	@@tri_rcs_v1_estado =  (strlen($resultado3) > 0 ? 'PENDIENTE' : 'APROBADO') ;
	@@tri_rcs_v1_mensaje = (@@tri_rcs_v1_estado == 'PENDIENTE' ? 'CLIENTE EN ANÁLISIS, NECESITA DE AUTORIZACIÓN' : '');

	@@tri_rcs_error = ($result == "" ? 'SI' : 'NO');
	// CAMBIAR PROD
	//	@@tri_rcs_v1_estado = 'APROBADO';

}	
 catch (SoapFault $fault) {
	 @@TMP_FAULT = $fault;
    trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
	 @@tri_rcs_error = 'SI';
}

// grabacion en tabla de log ws

$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$ws = $ip;
$nombre_ws = 'RCS V1';
$id_consultada = $id;
$tipo_interviniente = 'Cliente';
$respuesta = @@tri_rcs_v1_estado;
$fecha_fin = date('Y-m-d H:i:s');

$sql = "INSERT INTO VV_LOG_WS (
  APP_UID,
  APP_NUMBER,
  WS,
  NOMBRE_WS,
  ID_CONSULTADA,
  TIPO_INTERVINIENTE,
  RESPUESTA,
  FECHA_INICIO,
  FECHA_FIN
) 
VALUES
  (
    '$app_uid',
    '$app_number',
    '$ws',
    '$nombre_ws',
    '$id_consultada',
    '$tipo_interviniente',
    '$respuesta',
	'$fecha_inicio',
	'$fecha_fin'
  )" ;
$rs   = executeQuery($sql,$cnx);