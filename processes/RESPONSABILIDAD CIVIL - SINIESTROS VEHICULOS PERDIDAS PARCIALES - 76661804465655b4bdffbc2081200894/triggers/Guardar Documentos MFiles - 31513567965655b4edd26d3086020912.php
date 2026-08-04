<?php
//<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida
$pro_uid = @@PROCESS;
$server = @@URL_SERVER_SQL;

//consulto del catalogo
//obtengo el api_key
$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Subir_archivos_MFILES'";
$rs_auth =  executeQuery($sql_cata_auth);
$token = isset($rs_auth['1']['CAMPO2']) ? $rs_auth['1']['CAMPO2'] : '';

$url_mfiles = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$url_mfils_param = $url_mfiles;

//consulto los documento
//output document
$caseUID = @@APPLICATION; //set to the Output Document's unique ID
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
$query = "SELECT DOC_UID, APP_DOC_FIELDNAME, APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$caseUID'
                AND APP_DOC_TYPE = 'OUTPUT' AND APP_DOC_STATUS = 'ACTIVE'
                ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);

$g = new G();
$number = @@APP_NUMBER;
$ciRuc = @@frm_busqueda_identificacion;
$Nombre = @@frm_busqueda_nombres;
$Tipo = 1;
$SubTipo = "VEHICULOS";
$Ramo = "TODO_RIESGO_DE_VEHICULOS";
$Sucursal = @@frm_poliza_codSucursal;
$NumeroReclamo = @@tri_nro_stro;
$NumeroReporte = @@tri_id_stro;

if (is_array($outDoc)) {
	$cont = 1;
	foreach ($outDoc as $dataoutDoc) {
		$path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs'. PATH_SEP .$dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];

		$filename = str_replace("N/A",$number,$dataoutDoc['FILENAME']);
		//separate by dot and take the last part
		$extension = "pdf";

		//$arch_base64 = base64_encode($path);
		$Clase = 2;
		$SubClase = 1;

		$name = $dataoutDoc['DOC_UID'];
		echo "<p>".$name."</p>";
		switch($name){
			case "12365527065655b4ed94873047159722":
				$TipoDocumento = "AVISO_DE_ACCIDENTE";
				break;
			case "94967813065655b4ed92c76028411660":
				$TipoDocumento = "ACTA_DESISTIMIENTO_Y_FINIQUITO";
				break;
			default:
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
		}

        //strip first character in path
        $path = substr($path, 1);
		$path = $path. ".".$extension;
		//echo "<p>".$path."</p>";
        //$arch_base64 = base64_encode($data);
        $arch_base64 = file_get_contents($path);
		//transform to base64
		$arch_base64 = base64_encode($arch_base64);
		//echo ("<p>");
        //echo ($arch_base64);
        //echo ("</p>");
		$json_param = array("DatoGenerico"=>
		array(
         "ciRuc"=> $ciRuc,
         "Nombre"=> $Nombre,
         "Tipo"=>$Tipo,
         "SubTipo"=>$SubTipo,
		 "Ramo"=>$Ramo,
         "NumeroReclamo"=>$NumeroReclamo,
         "NumeroReporte"=>$NumeroReporte,
         "Sucursal"=>$Sucursal),
		"ArchivoGenerico"=> array(
            "Clase"=>$Clase,
            "SubClase"=>$SubClase,
            "TipoDocumento"=>$TipoDocumento,
            "NombreArchivo"=>$TipoDocumento. "_". date('m_d_Yhis', time()),
            "ExtensionArchivo"=>$extension,
            "ArchivoBase64"=>$arch_base64));

		$json = json_encode($json_param);
		//echo ("<p>");
		//echo $json;
		//echo ("</p>");
        try{
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url_mfils_param);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
				array(
					"Accept: application/json",
					"Content-Type: application/json",
					"Accept-Language: application/json",
					"Sesa-Key : 20aa9c2054a642939bbd3e9cc30f72e9",
					"Connection: Keep-Alive",
					"apikey: ". $token
				)
			);

		$res = curl_exec($ch);

		if(curl_errno($ch)){
			$msg_m = curl_error($ch);
			@@tri_msg_error = $msg_m;
			@@tri_bandera_recupera = 'true';
		}

		curl_close($ch);
		$result = json_decode($res);

		  PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'GDMF-RC-135',
      $url_mfils_param,
      'POST',
      "apikey: ". $token,
      json_encode($json),
      json_encode($result),
      json_encode($msg_m));

		} catch(Exception $e)
			{
				//echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
				$result['mensaje'] = 'false';
				$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
				@@tri_msg_error = $msg_m;
			}
	}
}

$query = "SELECT APP_DOC_FIELDNAME, APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$caseUID'
                AND APP_DOC_TYPE IN ('INPUT', 'ATTACHED') AND APP_DOC_STATUS = 'ACTIVE'
                ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);


$g = new G();
$number = @@APP_NUMBER;
$ciRuc = @@frm_busqueda_identificacion;
$Nombre = @@frm_busqueda_nombres;
$Tipo = 1;
$SubTipo = "VEHICULOS";
$Ramo = "TODO_RIESGO_DE_VEHICULOS";
$Sucursal = @@frm_poliza_codSucursal;
$NumeroReclamo = @@tri_nro_stro;
$NumeroReporte = @@tri_id_stro;

if (is_array($outDoc)) {
	$cont = 1;
	foreach ($outDoc as $dataoutDoc) {
		$path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP  .$dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];

		$filename = str_replace("N/A",$number,$dataoutDoc['FILENAME']);
		//separate by dot and take the last part
		$extension = end(explode(".", $filename));

		//$arch_base64 = base64_encode($path);
		$Clase = 2;
		$SubClase = 1;

		$name = $dataoutDoc['APP_DOC_FIELDNAME'];
		echo "<p>".$name."</p>";

		/*file_ajusteCotizacion
		fle_cedula
		fle_denuncia
		fle_licencia
		fle_matricula
		fle_partePolicial
		frm_alcance_adicional
		frm_cartaDeducible
		frm_cartaNegativa
		frm_cartaNegativaLega
		frm_carta_noDeducible
		frm_documentos_cotizacion
		frm_documentos_cotizacionMundo
		frm_documentos_evidencia
		frm_documentos_evidenciaMundo
		frm_documentos_otros
		frm_documento_perito
		frm_emisionNegativa_certificadoPoliza
		frm_emisionNegativa_clausulaNombrada
		frm_emisionNegativa_condicionesGenerales
		frm_emisionNegativa_textoPoliza*/

		switch($name){
			case "file_ajusteCotizacion":
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
			case "fle_cedula":
				$TipoDocumento = "CREDENCIALES";
				break;
			case "fle_denuncia":
				$TipoDocumento = "PARTE_POLICIAL_Y_DENUNCIA_FISCALIA_COMISARIA";
				break;
			case "fle_licencia":
				$TipoDocumento = "CREDENCIALES";
				break;
			case "fle_matricula":
				$TipoDocumento = "CREDENCIALES";
				break;
			case "fle_partePolicial":
				$TipoDocumento = "PARTE_POLICIAL_Y_DENUNCIA_FISCALIA_COMISARIA";
				break;
			case "frm_alcance_adicional":
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
			case "frm_cartaDeducible":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			case "frm_cartaNegativa":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			case "frm_cartaNegativaLega":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			case "frm_carta_noDeducible":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			case "frm_documentos_cotizacion":
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
			case "frm_documentos_cotizacionMundo":
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
			case "frm_documentos_evidencia":
				$TipoDocumento = "FOTOS_SINIESTROS";
				break;
			case "frm_documentos_evidenciaMundo":
				$TipoDocumento = "FOTOS_SINIESTROS";
				break;
			case "frm_documentos_otros":
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
			case "frm_documento_perito":
				$TipoDocumento = "PERITAZGO";
				break;
			case "frm_emisionNegativa_certificadoPoliza":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			case "frm_emisionNegativa_clausulaNombrada":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			case "frm_emisionNegativa_condicionesGenerales":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			case "frm_emisionNegativa_textoPoliza":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			default:
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
		}

        //strip first character in path
        $path = substr($path, 1);
		$path = $path. ".".$extension;
		//echo "<p>".$path."</p>";
        //$arch_base64 = base64_encode($data);
        $arch_base64 = file_get_contents($path);
		//transform to base64
		$arch_base64 = base64_encode($arch_base64);
		//echo ("<p>");
        //echo ($arch_base64);
        //echo ("</p>");
		$json_param = array("DatoGenerico"=>
		array(
         "ciRuc"=> $ciRuc,
         "Nombre"=> $Nombre,
         "Tipo"=>$Tipo,
         "SubTipo"=>$SubTipo,
		 "Ramo"=>$Ramo,
         "NumeroReclamo"=>$NumeroReclamo,
         "NumeroReporte"=>$NumeroReporte,
         "Sucursal"=>$Sucursal),
		"ArchivoGenerico"=> array(
            "Clase"=>$Clase,
            "SubClase"=>$SubClase,
            "TipoDocumento"=>$TipoDocumento,
            "NombreArchivo"=>$TipoDocumento. "_". date('m_d_Yhis', time()),
            "ExtensionArchivo"=>$extension,
            "ArchivoBase64"=>$arch_base64));

		$json = json_encode($json_param);
		//echo ("<p>");
		//echo $json;
		//echo ("</p>");
        try{
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url_mfils_param);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
				array(
					"Accept: application/json",
					"Content-Type: application/json",
					"Accept-Language: application/json",
					"Sesa-Key : 20aa9c2054a642939bbd3e9cc30f72e9",
					"Connection: Keep-Alive",
					"apikey: ". $token
				)
			);

		$res = curl_exec($ch);

		if(curl_errno($ch)){
			$msg_m = curl_error($ch);
			@@tri_msg_error = $msg_m;
			@@tri_bandera_recupera = 'true';
		}

		curl_close($ch);
		$result = json_decode($res);


		  PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'GDMF-RC-348',
      $url_mfils_param,
      'POST',
      "apikey: ". $token,
      json_encode($json),
      json_encode($result),
      json_encode($msg_m));

		} catch(Exception $e)
			{
				//echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
				$result['mensaje'] = 'false';
				$result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
				@@tri_msg_error = $msg_m;
			}
	}
}

//<?

$case_id=@@APPLICATION;
$case_uid_padre = @@app_uid_rc;
@@tri_bandera_sac = 'true';

$query = "SELECT
  APP_DOC_CREATE_DATE AS FECHA,
  APP_DOC_FILENAME AS FILENAME,
  'HOJA DE AUDITORIA' AS COMENTARIO,
  USR_UID,
  DOC_UID,
  APP_DOC_UID,
  DOC_VERSION
FROM
  APP_DOCUMENT
WHERE APP_UID = '$case_id'
AND APP_DOC_TYPE='OUTPUT'";

//input document
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
$query_i = "SELECT APP_DOC_UID, APP_DOC_CREATE_DATE AS FECHA, USR_UID, APP_DOC_COMMENT AS COMENTARIO, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, APP_DOC_FIELDNAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$case_id'
                AND APP_DOC_TYPE IN ('INPUT', 'ATTACHED') AND APP_DOC_STATUS = 'ACTIVE'
                ORDER BY APP_DOC_CREATE_DATE, DOC_VERSION DESC";
$inDoc = executeQuery($query_i);

$result = executeQuery($query);
if (empty($result) or count($result) == 0) {
   //die("Error: Unable to find Output Document file for case $case_id.");
}

$query_i_padre = "SELECT APP_DOC_UID, APP_DOC_CREATE_DATE AS FECHA, USR_UID, APP_DOC_COMMENT AS COMENTARIO, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, APP_DOC_FIELDNAME
				FROM APP_DOCUMENT
				WHERE APP_UID='$case_uid_padre'
				AND APP_DOC_TYPE IN ('INPUT', 'ATTACHED') AND APP_DOC_STATUS = 'ACTIVE'
				ORDER BY APP_DOC_CREATE_DATE, DOC_VERSION DESC";
$inDoc_padre = executeQuery($query_i_padre);
//$result_padre = executeQuery($query_padre);
$limit = @@limite_documentos_padre;
/*if($limit == null){
	$count = count($inDoc_padre);
	@@limite_documentos_padre = $count;
	//echo("Se ha establecido el limite de documentos a $count");
}
if($limit>5){
	$limit = 5;
}*/

$arr_docs = array();
$con = 1;
$rand = rand(0,9999999999);
$nocache = rand(0,9999999999);

foreach($inDoc_padre as $dataind){
	$fileId = $dataind['APP_DOC_UID'];
	$version = $dataind['DOC_VERSION'];
	$arr_docs[$con]['gridDocumentos_Fecha'] = $dataind['FECHA'];
	$arr_docs[$con]['gridDocumentos_Archivo'] = $dataind['FILENAME'];
	$arr_docs[$con]['gridDocumentos_Comentario'] = ($dataind['COMENTARIO']  == '' ? $dataind['APP_DOC_FIELDNAME'] : $dataind['COMENTARIO']);
	$arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($dataind['USR_UID']);
	$arr_docs[$con]['gridDocumentos_Descarga'] = "$server/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId&v=$version&p=1";
	$con++;
	//$limit++;
	/*if($limit == @@limite_documentos_padre){
		break;
	}*/
}

foreach($result as $datadoc){
		$fileId = $datadoc['APP_DOC_UID'];
		$version = $datadoc['DOC_VERSION'];
		$arr_docs[$con]['gridDocumentos_Fecha'] = $datadoc['FECHA'];
		$arr_docs[$con]['gridDocumentos_Archivo'] = $datadoc['FILENAME'];
		$arr_docs[$con]['gridDocumentos_Comentario'] = $datadoc['COMENTARIO'];
		$arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($datadoc['USR_UID']);
		$arr_docs[$con]['gridDocumentos_Descarga'] = "$server/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf&random=$rand&nocachetime=$nocache";
		$con++;
}

foreach($inDoc as $dataind){
	$fileId = $dataind['APP_DOC_UID'];
	$version = $dataind['DOC_VERSION'];
	$arr_docs[$con]['gridDocumentos_Fecha'] = $dataind['FECHA'];
	$arr_docs[$con]['gridDocumentos_Archivo'] = $dataind['FILENAME'];
	$arr_docs[$con]['gridDocumentos_Comentario'] = ($dataind['COMENTARIO']  == '' ? $dataind['APP_DOC_FIELDNAME'] : $dataind['COMENTARIO']);
	$arr_docs[$con]['gridDocumentos_Usuario'] = nomUsuario($dataind['USR_UID']);
	$arr_docs[$con]['gridDocumentos_Descarga'] = "$server/syscertificacion/es/3sesa/cases/cases_ShowDocument?a=$fileId&v=$version&p=1";
	$con++;
}

@=gridDocumentos = $arr_docs;
