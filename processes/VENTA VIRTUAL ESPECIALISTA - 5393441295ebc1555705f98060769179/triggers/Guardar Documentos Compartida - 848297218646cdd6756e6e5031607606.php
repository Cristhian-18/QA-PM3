<?php
//<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida

set_time_limit(0);
$pro_uid = @@PROCESS;
$cnx_rp = '1479570925ec29f1d8d1d57019959618';
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
                AND APP_DOC_TYPE IN ('INPUT','ATTACHED') AND APP_DOC_STATUS = 'ACTIVE'
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
		
		if($dataoutDoc['FILENAME'] == 'confidencial_'){
			$filename = "confidencial_".$number;			
		}
		//echo $filename;
	   $aAttachFiles[$filename . '.pdf'] = $path . '.pdf';  //remove if not generating a PDF file
		if (!file_exists($structure)) {
			mkdir($structure, 0777, true);
		}
		
	
		if(copy($path . '.pdf', $structure. $filename . '.pdf')){
			@@tri_msg_file = 'Se copio';
		}
		else{
			@@tri_msg_file = 'NO se copio Output';
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
				$filename = $datainDoc['FILENAME'];
				//$filename = $filename_aux.'-'.$i.'.'.$ext;
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
