<?php
//created by Henry modified by Jean

$pro_uid = @@PROCESS;
$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS_GEN' AND DESCRIPCION = 'COPIA_GENERICA' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
$destinatarios_copias = ',';
$destinatarios_copias = ',';
if(!empty($rs_mails_copias)){
	@@tri_destinatarios_copias_cc = ',';
	@@tri_destinatarios_copias_cc .= $rs_mails_copias[1]['CAMPO1'];
	$destinatarios_copias .= $rs_mails_copias[1]['CAMPO1'];
	@@tri_destinatarios_copias_bcc = ',';
	@@tri_destinatarios_copias_bcc .= $rs_mails_copias[1]['CAMPO2'];
	//CONCAT CAMPO2
	$destinatarios_copias .= ','.$rs_mails_copias[1]['CAMPO2'];
}

@@tri_destinatarios_copias = $destinatarios_copias;


$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS_GEN' AND DESCRIPCION = 'DESARROLLADOR' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
@@tri_correo_desarrollador_cc = ',';
if(!empty($rs_mails_copias)){
	@@tri_correo_desarrollador_cc .= $rs_mails_copias[1]['CAMPO1'];
}
@@tri_correo_desarrollador_bcc = ',';
if(!empty($rs_mails_copias)){
	@@tri_correo_desarrollador_bcc .= $rs_mails_copias[1]['CAMPO2'];
}


@@tri_usr_analista_2 = @@tri_usr_analista;
@@tri_usr_analista = @@tri_usr_analista_2;
$cnx = '934957180650c74e8ed0e10096114321';
$app_uid = @@APPLICATION;
@@tri_nro_stro = @@nro_inspeccion ? @@nro_inspeccion : @@tri_nro_stro;
@@tri_id_stro = @@nro_stro ? @@nro_stro : @@tri_id_stro;
$tri_nro_stro = @@tri_nro_stro;

if(@@APP_NUMBER == '1753'){
	$sql = "select * from USERS where usr_username = 'LSALCEDO'";
	$rs = executeQuery($sql);
	print_r($rs);
	@@tri_usr_analista = $rs[1]['USR_UID'];

	//@@tri_usr_analista = '17274489065be3f1a45d784008020115';
	echo (@@tri_usr_analista);
	//die();
}

$analista = @@tri_usr_analista;

$ramo = array();
$ramo = @@grd_ramos;
$cobertura = @@grd_cobertura;
echo 'el valor de cobertura es:';
print_r(@@grd_cobertura);
echo 'fin valor cobertura';
$cod_ramo = $ramo[1]['grd_r_Codramo'];
@@aplicacion_texto = $ramo[1]['grd_r_nAplicacion'];


@@ramo_texto = $ramo[1]['grd_r_ramo'];
@@sucursal_texto = $ramo[1]['grd_r_sucursal'];
@@subramo_texto = @@grd_cobertura[1]['grd_c_subramo'];

@@inciso_texto = @@grd_items[1]['grd_i_direccion'];
@@objeto_texto = @@grd_cobertura[1]['grd_c_objeto'];
@@amparo_texto =  @@grd_cobertura[1]['grd_c_amparo'];

@@valor_solicitado = $cobertura[1]['grd_c_lim_monto_reportado'];
@@suma_asegurada = $cobertura[1]['grd_c_suma_aseg'];
echo 'prueba linea 72 <br>';
print_r($cobertura);
echo 'fin prueba linea 72 <br>';
$suma_asegurada_texto = @@suma_asegurada;
echo @@suma_asegurada;
echo 'prueba linea 74';
@@suma_asegurada_texto = number_format($suma_asegurada_texto, 2, ",",".");
echo 'prueba linea 75';
$valor_solicitado_texto = @@valor_solicitado;
@@valor_solicitado_texto = number_format($valor_solicitado_texto, 2, ",",".");

$fecha_registro = @@frm_ds_fechaOcurrencia;
echo $fecha_registro." Fecha ocurrencia";
	$fecha_registro = new DateTime($fecha_registro);
	$fecha_formateada = $fecha_registro->format('d/m/Y');
	$fecha_formateada = $fecha_formateada. ' '. @@frm_ds_horaOcurrencia;
	@@fecha_formateada_fechaOcurrencia = $fecha_formateada;

$fecha_ocurrencia = @@frm_da_FechaRegistro;

echo $fecha_ocurrencia." Fecha registro ";

$fecha_ocurrencia_formateada = date("d/m/Y H:i:s", strtotime($fecha_ocurrencia . ' +5 hours'));
echo $fecha_ocurrencia_formateada." Fecha registro ";
//add five hours
//$fecha_ocurrencia_formateada = $fecha_ocurrencia->format('d/m/Y H:i:s');
@@fecha_formateada_fechaSiniestro = $fecha_ocurrencia_formateada;
echo $fecha_ocurrencia_formateada." Fecha registro ";
if($analista == '17274489065be3f1a45d784008020115'){
	@@tri_usr_analista = "16827000765be3f1062eb35040661615";
	/*echo "caso reasignado";
	die();*/
}
if($analista == '95282121465bdc1213b5351076915024'){
	@@tri_usr_analista = "289826748664bb06d8b1a82010029742";
	/*echo "caso reasignado";
	die();*/
}

//95282121465bdc1213b5351076915024
//if @@tri_id_stro contains a -
$year = date('Y');

if(strpos($tri_nro_stro, '-') === false){

	$tri_nro_stro = @@tri_nro_stro. ' - ' . $year;
	@@tri_nro_stro = $tri_nro_stro;
}

$sql = "SELECT TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM certificacion.SINIESTRO_GN_BITACORA WHERE APP_UID = '$app_uid' order by ID_BITACORA";

$rs_comentarios = executeQuery($sql);

$grd_historial = array();
$i=1;

foreach($rs_comentarios as $data){
	$grd_historial[$i]['tarea'] = PMFGetTaskName($data['tarea'],'es');
	$grd_historial[$i]['usuario'] = NomUsuario($data['usuario']);
	$grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'];
	$grd_historial[$i]['f_inicio'] = $data['f_inicio'];
	$grd_historial[$i]['f_fin'] = $data['f_fin'];
	$grd_historial[$i]['accion'] = $data['accion'];
	$grd_historial[$i]['txt_comentario'] = $data['txt_comentario'];
	$i++;
}

@=grd_historial_caso_1 = $grd_historial;

$case_id=@@APPLICATION;
$aVars = array(
     'grd_historial_caso_1' => $grd_historial);

$result = PMFSendVariables($case_id, $aVars);

$_SESSION['beesmartec'] = '/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/inf?id=365';



//CONDICIONES DE POLIZA

try {
	//Consultar condiciones Poliza

	$pro_uid = '35087580064a18c9776b638006106795';
	/*echo(@@frm_cod_asec);
	die();*/
	@@proccess_padre = '35087580064a18c9776b638006106795';

	$app = @@APPLICATION;
	//catalogos de marcas modelos
	//obtengo el token
	$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN'";
	$rs_auth =  executeQuery($sql_cata_auth);

	$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

	$sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
	$rs_apikey = executeQuery($sql_apikey);
	$apikey = isset($rs_apikey['1']['DESCRIPCION']) ? $rs_apikey['1']['DESCRIPCION'] : '';

	$sql_cata_condicionesPoliza = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_Condiciones_Poliza'";
	$rs_condicionesPoliza =  executeQuery($sql_cata_condicionesPoliza);

	$url_condicionesPoliza = isset($rs_condicionesPoliza['1']['DESCRIPCION']) ? $rs_condicionesPoliza['1']['DESCRIPCION'] : '';
	$idPv = @@frm_idpv;

	$url_inCondiciones_param = $url_condicionesPoliza . $idPv;

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url_inCondiciones_param);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt(
		$ch,
		CURLOPT_HTTPHEADER,
		array(
			"Accept: application/json",
			"Content-Type: application/json",
			"apikey: " . $apikey,
			"Authorization: ". $token

		)
	);

	$res = curl_exec($ch);
	$msg_m = '';

	if (curl_errno($ch)) {
		$msg_m = curl_error($ch);
		@@tri_msg_error = $msg_m;
		/*if ($app == '363676371661ec3b87c4571094776238') {
			echo "<pre>";
			print_r($msg_m);

			die();
		}*/

	}
	curl_close($ch);
	$result = json_decode($res, true);
	/*if ($app == '363676371661ec3b87c4571094776238') {
		echo "<pre>";
		echo $url_inCondiciones_param;
		echo '<br>';
		echo $apikey;
		echo '<br>';
		print_r($result);
		die();
	}*/
	$id_poliza = $result['response']['nroPoliza'];
	$text_poliza = $result['response']['descripcion'];

	$text_poliza_replaced = str_replace("\t", "<br />", $text_poliza);
	$text_poliza_replaced = str_replace("\n", "<br />", $text_poliza);
	@@tri_condiciones_poliza = $text_poliza_replaced;

	PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'CC-SG-244',
    $url_inCondiciones_param,
    'GET',
    "Accept: application/json",
	"Content-Type: application/json",
	"apikey: " . $apikey,
	"Authorization: ". $token,
    '',
    json_encode($result),
    json_encode($msg_m));

} catch (Exception $e) {
	//echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
	$result['mensaje'] = 'false';
	$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
	@@tri_msg_error = $msg_m;
}
