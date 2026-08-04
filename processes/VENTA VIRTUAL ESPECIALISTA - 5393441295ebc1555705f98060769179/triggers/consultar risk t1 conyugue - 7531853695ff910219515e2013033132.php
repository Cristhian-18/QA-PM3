<?php
// condicion (@@frm_estado_civil == 2 || @@frm_estado_civil == 5) && @@tri_ruta_aprobacion != 'APROBADO'
// CONSULTAR DATOS DEL WS PARA CONSULTAR
$cnx = '1479570925ec29f1d8d1d57019959618';
$sqlws  = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'RISK'";
$rsws   = executeQuery($sqlws,$cnx);
$ip     = $rsws['1']['VALOR'];

$primer = @@frm_conyuge_primer_nombre;
$segundo = @@frm_conyuge_segundo_nombre;	
$paterno = @@frm_conyuge_apellido_paterno;
$materno = @@frm_conyuge_apellido_materno;
$tipo = @@frm_conyuge_tipo_identificacion;
$id = @@frm_conyuge_numero_identificacion;
$fecha_inicio = date('Y-m-d H:i:s');

@@tri_rcs_v1_conyuge_estado = 'iniciado';
@@tri_rcs_v1_conyuge_novedad = '';
@@tri_rcs_v1_conyuge_mensaje = '';

$param['item'] = array(
	'apellidoMaterno' => $materno,
	'apellidoPaterno' => $paterno,		
	'identificacion' => $id,
	'primerNombre' => $primer,		
	'segundoNombre' => $segundo,		
	'tipoIndentificacion' => $tipo);
$user = 'BPM-'.@@USR_USERNAME;
@@tri_usr_rcs = $user;

//consulta de datos cliente
try{
	$client = new SoapClient($ip, array('exceptions' => true));	

	$respuesta['data']['error']   = 'NO'; 
	$respuesta['data']['mensaje'] = '';

	$result = $client->__SoapCall('buscarRcs',array($param,$user));
	$resultado = $result->item; 
	$resultado1 = json_decode(json_encode($resultado), true);
	$resultado2 = $resultado1['contenidoXml'];
	@@tmp_rcs_cony = $result;
	$resultado3 = substr($resultado2,357,-59);
	@@tri_rcs_v1_conyuge_novedad = (strlen($resultado3) > 0 ? $resultado3 : 'SIN NOVEDAD' );
	@@tri_rcs_v1_conyuge_estado =  (strlen($resultado3) > 0 ? 'PENDIENTE' : 'APROBADO') ;
	@@tri_mensaje .=  (@@tri_rcs_v1_conyuge_estado == 'PENDIENTE' ? ' CONYUGE DE CLIENTE EN ANÁLISIS, NECESITA DE AUTORIZACIÓN' : '');
}	
catch(SoapFault $client){

	@@tmp_risk_conyugue = $client ; 
	if (is_soap_fault($client)) {
		@@result_fault = $result->faultstring;
	}
	$respuesta['ws'] = 'NO';
	$respuesta['fecha_vt'] = 'ERROR EN WSDL'; 
	$respuesta['resultado_vt'] = 'ERROR EN WSDL'; 
	$respuesta['cod_msg_vt'] = 'ERROR EN WSDL'; 
	$respuesta['des_msg_vt'] = 'ERROR EN WSDL POR FAVOR COMUNICATE CON EL ADMINISTRADOR'; 
	@@respuesta_rcs_v1_conyuge = $respuesta;
}

@@tri_rcs_error_cony = ($result == ''? 'SI':'NO');

// grabacion en tabla de log ws

$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$ws = $ip;
$nombre_ws = 'RCS V1';
$id_consultada = $id;
$tipo_interviniente = 'Conyuge';
$respuesta = @@tri_rcs_v1_conyuge_estado;
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