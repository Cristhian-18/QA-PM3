<?php
//<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida

$pro_uid = @@PROCESS;
/*$cnx_rp = '1479570925ec29f1d8d1d57019959618';
//consulto los documento
//output document
$caseUID = @@APPLICATION; //set to the Output Document's unique ID
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
$query = "SELECT APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$caseUID'
                AND APP_DOC_TYPE = 'OUTPUT' AND APP_DOC_STATUS = 'ACTIVE'
                ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);

//input document
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
$query_i = "SELECT APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, APP_DOC_FIELDNAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$caseUID'
                AND APP_DOC_TYPE = 'INPUT' AND APP_DOC_STATUS = 'ACTIVE'
                ORDER BY DOC_VERSION DESC";
$inDoc = executeQuery($query_i);

$folder = @#frm_numero_poliza.'_'.@#APP_NUMBER;
$number = @@APP_NUMBER;
$year_mes = date('Y').PATH_SEP.date('M').PATH_SEP.$folder;

//para la ruta
$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'PARAMETROS_GENERALES' AND CODIGO = 'RUTA'";
$rs =  executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';

$structure = $url.$year_mes.'/';

$g = new G();
if (is_array($outDoc)) {
	$cont = 1;
	foreach ($outDoc as $dataoutDoc) {
		$path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs'. PATH_SEP .
		  $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
		$filename = str_replace("N/A",$number,$dataoutDoc['FILENAME']);

	   $aAttachFiles[$filename . '.pdf'] = $path . '.pdf';  //remove if not generating a PDF file
		if (!file_exists($structure)) {
			mkdir($structure, 0777, true);
		}


		if(copy($path . '.pdf', $structure. $filename . '.pdf')){
			@@tri_msg_file = 'Se copio';
		}
		else{
			@@tri_msg_file = 'NO se copio';
			$g = new G();
			$g->SendMessageText("Error al copiar los archivos", "WARNING");
			PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', $dyn_id);
		}
	$cont++;
	}
}
//input
if (is_array($inDoc)) {
	$cont_i = 1;
	$i = 1;
	$j = 1;
	foreach ($inDoc as $datainDoc) {
	  $d = new AppDocument();
      $aDoc = $d->Load($datainDoc['APP_DOC_UID'], $datainDoc['DOC_VERSION']);
      	$filename_aux = $aDoc['APP_DOC_FILENAME'];
		$ext = pathinfo($filename_aux, PATHINFO_EXTENSION);
		$fecha = date('Ymd');
		switch($aDoc['APP_DOC_FIELDNAME']){
			default;
				$name = $datainDoc['FILENAME'];
				$filename = $name.'-'.$i.'.'.$ext;
				$i++;
			break;
		}

      $g = new G();
      $filePath = PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP .
         $datainDoc['APP_DOC_UID'] .'_'. $datainDoc['DOC_VERSION'] .'.'. $ext;
		if (!file_exists($structure)) {
			mkdir($structure, 0777, true);
		}
		if(copy($filePath, $structure. $filename)){
			@@tri_msg_file_i = 'Se copio';
		}
		else{
			@@tri_msg_file_i = 'NO se copio';
			$g = new G();
			$g->SendMessageText("Error al copiar los archivos", "WARNING");
			PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', $dyn_id);
		}
	$cont_i++;
	}
}


//para mails a archivo
$sql_mails = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'MAILS_ARCHIVO'";
$rs_mails =  executeQuery($sql_mails, $cnx_rp);
@@tri_mails_archivo = isset($rs_mails['1']['DESCRIPCION']) ? $rs_mails['1']['DESCRIPCION'] : 'pmartinez@segurosequinoccial.com';
*/

//grabar comentario
$cnx = '98304643465452bb4b4f927027857546';
$app_uid   = @@APPLICATION;
$task_uid  = '201580248654471f68dda23082015000';
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX+1;
$cod_negativa = 0;
$ticket 			 = @@APP_NUMBER;
$usr_uid_actual      = @@USER_LOGGED;

$fecha_inicio        = date('Y-m-d H:i:s');
$fecha_fin           = date('Y-m-d H:i:s');
$fecha_vencimiento   = date('Y-m-d H:i:s');
$fecha_derivacion    = date('Y-m-d H:i:s');

$usr_uid_receptor    = @@USER_LOGGED;
$tas_uid_actual    = '201580248654471f68dda23082015000';
$tarea_actual    = PMFGetTaskName('201580248654471f68dda23082015000');
$comentario = 'Enviado al archivo digital';
$accion     = 'FINALIZAR';
$accion_label     = 'Enviar al archivo digital';
$cod_estado = 2;

$sql = "INSERT INTO certificacion.EMISIONES_NUEVAS_AP_BITACORA (
  APP_NUMBER,
  APP_UID,
  TASK_UID,
  FECHA_INICIO,
  FECHA_FIN,
  FECHA_DERIVACION,
  FECHA_VENCIMIENTO,
  DEL_INDEX,
  COD_ACCION,
  USR_UID_ACTUAL,
  USR_UID_RECEPTOR,
  COMENTARIO, ACCION, COD_NEGATIVA, COD_ESTADO)
	values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario','$accion_label', '$cod_negativa','$cod_estado')";

$rs_i = executeQuery($sql);

$sql = "SELECT TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM certificacion.EMISIONES_NUEVAS_AP_BITACORA WHERE APP_UID = '$app_uid' ORDER BY ID_BITACORA";

$rs_comentarios = executeQuery($sql);

try{

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

@=grd_historial_caso = $grd_historial;

$case_id=@@APPLICATION;
$aVars = array(
     'grd_historial_caso' => $grd_historial);

$result = PMFSendVariables($case_id, $aVars);
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	die();
}
