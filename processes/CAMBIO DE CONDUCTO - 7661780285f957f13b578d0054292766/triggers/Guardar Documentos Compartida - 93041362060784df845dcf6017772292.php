<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida

$cnx_rp = '9690765645f958391b6c2e8035729611';
$pro_uid = @@PROCESS;

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

$folder = @#frm_concepto_debito.'_'.@#frm_concepto_pago.'_'.@#frm_endoso_numCC.'_'.date('Ymd');

//para la ruta
$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'RUTA'";
$rs =  executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$structure = $url.$folder.'/';

$g = new G();
if (is_array($outDoc)) {
	$cont = 1;
	foreach ($outDoc as $dataoutDoc) {
		$path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs'. PATH_SEP .
		  $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
	   //$filename = $cont.'_'.@#frm_concepto_debito.'_'.date('Y-m-d').'_'.@#frm_concepto_pago;
		$fecha = date('Ymd');
		switch($dataoutDoc['FILENAME']){
			case 'Autorizacion_de_debito':
				$filename = @@frm_concepto_debito.'-'.@@frm_concepto_pago.'-'.@@frm_endoso_numCC.'-'.$fecha.'-Autorizacion';
			break;
				
			default;
				$filename = $dataoutDoc['FILENAME'];
			break;
		}
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
			PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
		}
	$cont++;
	}
}
//input
if (is_array($inDoc)) {
	$cont_i = 1;
	$i = 1;
	foreach ($inDoc as $datainDoc) {		
	  $d = new AppDocument();
      $aDoc = $d->Load($datainDoc['APP_DOC_UID'], $datainDoc['DOC_VERSION']);
      	$filename_aux = $aDoc['APP_DOC_FILENAME'];
		$ext = pathinfo($filename_aux, PATHINFO_EXTENSION);
		$fecha = date('Ymd');
		switch($aDoc['APP_DOC_FIELDNAME']){
			case 'frm_copia_ci':
				$filename = @@frm_concepto_debito.'-'.@@frm_concepto_pago.'-'.@@frm_endoso_numCC.'-'.$fecha.'-Identificacion.'.$ext;
			break;
			case 'frm_doc_cta':
				$filename = @@frm_concepto_debito.'-'.@@frm_concepto_pago.'-'.@@frm_endoso_numCC.'-'.$fecha.'-RespaldoCuenta.'.$ext;
			break;
				
			default;
				$filename = $aDoc['APP_DOC_FILENAME'];
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
			PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2391424775f98ce6ad2b822054977332');
		}
	$cont_i++;
	}
}