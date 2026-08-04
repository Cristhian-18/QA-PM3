<?php
 
$app_number = @@APP_NUMBER;
$caseUID = @@APPLICATION;

 
 
$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '35087580064a18c9776b638006106795' AND CODIGO = 'Subir_archivos_MFILES'";
$rs_auth = executeQuery($sql_cata_auth);
$token = isset($rs_auth['1']['CAMPO2']) ? $rs_auth['1']['CAMPO2'] : '';
$url_mfiles = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$url_mfils_param = $url_mfiles;
 
 
 

$ciRuc         = @@frm_da_NoDocumentoContratate ?? '';
$Nombre        = @@frm_da_apellidoPaterno ?? '';
$aux_tipo      = @@frm_da_tipoDocumentoContratante ?? '';

if($aux_tipo == '1'){
	$Tipo = 0; //Cedula
}else if($aux_tipo == '2'){
	$Tipo = 1; //RUC
}else {
	$Tipo = 2; //Pasaporte
}

$NumeroReclamo = @@tri_nro_stro ?? '';
$NumeroReporte = @@tri_id_stro ?? '';
 
$SubTipo = "GENERALES";
$Ramo = @@frm_poliza_ramo ?? '';
$Ramo = str_replace(" ", "_", $Ramo);
$aux_sucursal =  @@frm_ds_sucursalEmision ?? '';

switch($aux_sucursal){
	case "QUITO": 
		$Sucursal = "1";
		break;
	case "MACHALA":
		$Sucursal = "2";
		break;
	case "RIOBAMBA":
		$Sucursal = "3";
		break;
	case "LATACUNGA":
		$Sucursal = "4";
		break;
	case "GUAYAQUIL":
		$Sucursal = "5";
		break;
	case "CUENCA":
		$Sucursal = "6";
		break;
	case "PERSONAS":
		$Sucursal = "7";
		break;
	case "MANTA":
		$Sucursal = "8";
		break;
	case "IBARRA":
		$Sucursal = "9";
		break;
	case "AMBATO":
		$Sucursal = "10";
		break;
	case "LOJA":
		$Sucursal = "11";
		break;
	case "FUSION":
		$Sucursal = "12";
		break;
	default:
		$Sucursal = "1";
		break;
}


// FLAG DE CONTROL GLOBAL
$todosEnviados = true;
$errores = [];

// =============================================
// LOOP OUTPUTS
// =============================================
$query = "SELECT DOC_UID, APP_DOC_FIELDNAME, APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
          FROM APP_DOCUMENT
          WHERE APP_UID='$caseUID'
          AND APP_DOC_TYPE = 'OUTPUT' AND APP_DOC_STATUS = 'ACTIVE'
          ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);

$g = new G();

if (is_array($outDoc)) {
    foreach ($outDoc as $dataoutDoc) {

        // Verificar si ya fue enviado a MFiles
        $checkEnviado = executeQuery("SELECT APP_DOC_DRIVE_DOWNLOAD FROM APP_DOCUMENT
            WHERE APP_DOC_UID = '{$dataoutDoc['APP_DOC_UID']}'
            AND DOC_VERSION = '{$dataoutDoc['DOC_VERSION']}'");

        if (strpos($checkEnviado[1]['APP_DOC_DRIVE_DOWNLOAD'] ?? '', 'ENVIADO_MFILES') !== false) {
            echo "<p>OUTPUT ya enviado a MFiles, saltando: {$dataoutDoc['FILENAME']}</p>";
            continue;
        }

        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs' . PATH_SEP . $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
        $filename = str_replace("N/A", $app_number, $dataoutDoc['FILENAME']);
        $extension = "pdf";
        $Clase = 2;
        $SubClase = 1;

        $name = $dataoutDoc['DOC_UID'];
        echo "<p>" . $name . "</p>";

        switch($name){
			case "205924720657a6bf3cc5bd0029061968": 
				$TipoDocumento = "INFORME_INICIAL_PRELIMINAR";
				break;
			case "476350808657a6c1315d823097412788": 
				$TipoDocumento = "INFORME_FINAL";
				break;
			case "5763899696579c198b65386035369936": 
				$TipoDocumento = "CARTA_O_MAIL_DE_FROMALIZACION_DEL_RECLAMO";
				break;
			default:
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
		}

        $path = substr($path, 1);
        $path = $path . "." . $extension;
        echo "<p>" . $path . "</p>";
    

        $arch_base64 = base64_encode(file_get_contents($path));

        $json_param = array(
            "DatoGenerico" => array(
                "ciRuc"          => $ciRuc,
                "Nombre"         => $Nombre,
                "Tipo"           => $Tipo,
                "SubTipo"        => $SubTipo,
                "Ramo"           => $Ramo,
                "NumeroReclamo"  => $NumeroReclamo,
                "NumeroReporte"  => $NumeroReporte,
                "Sucursal"       => $Sucursal
            ),
            "ArchivoGenerico" => array(
                "Clase"            => $Clase,
                "SubClase"         => $SubClase,
                "TipoDocumento"    => $TipoDocumento,
                "NombreArchivo"    => $TipoDocumento . "_" . date('m_d_Yhis', time()),
                "ExtensionArchivo" => $extension,
                "ArchivoBase64"    => $arch_base64
            )
        );
        $json = json_encode($json_param);

       

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_mfils_param);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "Sesa-Key : 20aa9c2054a642939bbd3e9cc30f72e9",
                "Connection: Keep-Alive",
                "apikey: " . $token
            ));

            $res = curl_exec($ch);
            
           

            if (curl_errno($ch)) {
                $msg_m = curl_error($ch);
                $todosEnviados = false;
                $errores[] = "OUTPUT - {$dataoutDoc['FILENAME']}: $msg_m";
                curl_close($ch);
                echo "<p>" . $msg_m . "</p>";
                continue;
            }

            curl_close($ch);
            $result = json_decode($res, true);
            echo "<p>Respuesta (OUTPUTS docs) MFiles: ";
            print_r($result);
            echo "</p>";

            if (isset($result['data']['uploaded']) && $result['data']['uploaded'] === true) {
                $nombreMFiles = $result['data']['fileName'];
                $fechaEnvio = date('Y-m-d H:i:s');
                executeQuery("UPDATE APP_DOCUMENT
                    SET APP_DOC_DRIVE_DOWNLOAD = 'ENVIADO_MFILES:$nombreMFiles:$fechaEnvio'
                    WHERE APP_DOC_UID = '{$dataoutDoc['APP_DOC_UID']}'
                    AND DOC_VERSION = '{$dataoutDoc['DOC_VERSION']}'");
                echo "<p>Documento marcado como enviado: $nombreMFiles</p>";
            } else {
                $todosEnviados = false;
                $errores[] = "OUTPUT - {$dataoutDoc['FILENAME']}: MFiles no confirmo la subida. Respuesta: " . json_encode($result);
                echo "<p>MFiles no confirmo la subida: " . print_r($result, true) . "</p>";
            }

        } catch (Exception $e) {
            $todosEnviados = false;
            $errores[] = "OUTPUT - {$dataoutDoc['FILENAME']}: " . $e->getMessage();
            echo "<p>Excepcion capturada: " . $e->getMessage() . "</p>";
        }
    }
}

// =============================================
// LOOP INPUTS / ATTACHED
// =============================================
$query = "SELECT APP_DOC_FIELDNAME, APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
          FROM APP_DOCUMENT
          WHERE APP_UID='$caseUID'
          AND APP_DOC_TYPE IN ('INPUT', 'ATTACHED') AND APP_DOC_STATUS = 'ACTIVE'
          ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);

if (is_array($outDoc)) {
    foreach ($outDoc as $dataoutDoc) {

        // Verificar si ya fue enviado a MFiles
        $checkEnviado = executeQuery("SELECT APP_DOC_DRIVE_DOWNLOAD FROM APP_DOCUMENT
            WHERE APP_DOC_UID = '{$dataoutDoc['APP_DOC_UID']}'
            AND DOC_VERSION = '{$dataoutDoc['DOC_VERSION']}'");

        if (strpos($checkEnviado[1]['APP_DOC_DRIVE_DOWNLOAD'] ?? '', 'ENVIADO_MFILES') !== false) {
            echo "<p>INPUT ya enviado a MFiles, saltando: {$dataoutDoc['FILENAME']}</p>";
            continue;
        }

        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
        $filename = str_replace("N/A", $app_number, $dataoutDoc['FILENAME']);
        $partes = explode(".", $filename);
        $extension = end($partes);
        $Clase = 2;
        $SubClase = 1;

         if (strtolower($extension) === 'zip') {
            echo "<p>Saltando archivo ZIP: {$dataoutDoc['FILENAME']}</p>";
            continue;
        }

        $name = $dataoutDoc['APP_DOC_FIELDNAME'];
        echo "<p>" . $name . "</p>";

        switch($name){
			case "file_borrador_negativa": 
				$TipoDocumento = "NEGATIVAS";
				break;
			case "file_cartaDeducible":
				$TipoDocumento = "NEGATIVAS";
				break;
			case "file_cartaDeducibleFirmada":
				$TipoDocumento = "NEGATIVAS";
				break;
			case "file_cartaNegativaFirmada":
				$TipoDocumento = "NEGATIVAS";
				break;
			case "file_confimacionBroker":
				$TipoDocumento = "MAILS";
				break;
			case "file_finiq":
				$TipoDocumento = "FINIQUITO_FIRMADO_ASEGURADO";
				break;
			case "fle_docs_analista":
				$TipoDocumento = "VARIOS_GENERALES";
				break;
			case "fle_docs_cliente":
				$TipoDocumento = "VARIOS_GENERALES";
				break;
			case "fle_respaldosInspeccion":
				$TipoDocumento = "VARIOS_GENERALES";
				break;
			case "fle_rif_gastosFinal":
				$TipoDocumento = "FACTURA_AJUSTADOR";
				break;
			case "fle_rip_gastosPreliminar":
				$TipoDocumento = "FACTURA_AJUSTADOR";
				break;
			case "frm_cartaNegativa":
				$TipoDocumento = "NEGATIVAS";
				break;
			case "frm_emisionNegativa_certificadoPoliza":
				$TipoDocumento = "NEGATIVAS";
				break;
			case "frm_emisionNegativa_clausulaNombrada":
				$TipoDocumento = "NEGATIVAS";
				break;
			case "frm_emisionNegativa_condicionesGenerales":
				$TipoDocumento = "NEGATIVAS";
				break;
			case "frm_emisionNegativa_textoPoliza":
				$TipoDocumento = "NEGATIVAS";
				break;
			case "frm_notaCredito":
				$TipoDocumento = "NOTAS_DE_DEBITO_COASEGURO_CEDIDO";
				break;
			default:
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
		}

        $path = substr($path, 1);
        $path = $path . "." . $extension;
       
      

        if (!file_exists($path)) {
           echo "<p>ADVERTENCIA: Archivo no encontrado: {$path}</p>";
           continue;
        }

        $arch_base64 = base64_encode(file_get_contents($path));

        $json_param = array(
            "DatoGenerico" => array(
                "ciRuc"          => $ciRuc,
                "Nombre"         => $Nombre,
                "Tipo"           => $Tipo,
                "SubTipo"        => $SubTipo,
                "Ramo"           => $Ramo,
                "NumeroReclamo"  => $NumeroReclamo,
                "NumeroReporte"  => $NumeroReporte,
                "Sucursal"       => $Sucursal
            ),
            "ArchivoGenerico" => array(
                "Clase"            => $Clase,
                "SubClase"         => $SubClase,
                "TipoDocumento"    => $TipoDocumento,
                "NombreArchivo"    => $TipoDocumento . "_" . date('m_d_Yhis', time()),
                "ExtensionArchivo" => $extension,
                "ArchivoBase64"    => $arch_base64
            )
        );
        $json = json_encode($json_param);

    
 

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_mfils_param);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "Sesa-Key : 20aa9c2054a642939bbd3e9cc30f72e9",
                "Connection: Keep-Alive",
                "apikey: " . $token
            ));

            $res = curl_exec($ch);
            echo $res;

            if (curl_errno($ch)) {
                $msg_m = curl_error($ch);
                $todosEnviados = false;
                $errores[] = "INPUT - {$dataoutDoc['FILENAME']}: $msg_m";
                curl_close($ch);
                echo "<p>" . $msg_m . "</p>";
                continue;
            }

            curl_close($ch);
            $result = json_decode($res, true);
            

            if (isset($result['data']['uploaded']) && $result['data']['uploaded'] === true) {
                $nombreMFiles = $result['data']['fileName'];
                $fechaEnvio = date('Y-m-d H:i:s');
                executeQuery("UPDATE APP_DOCUMENT
                    SET APP_DOC_DRIVE_DOWNLOAD = 'ENVIADO_MFILES:$nombreMFiles:$fechaEnvio'
                    WHERE APP_DOC_UID = '{$dataoutDoc['APP_DOC_UID']}'
                    AND DOC_VERSION = '{$dataoutDoc['DOC_VERSION']}'");
                echo "<p>Documento marcado como enviado: $nombreMFiles</p>";
            } else {
                $todosEnviados = false;
                $errores[] = "INPUT - {$dataoutDoc['FILENAME']}: MFiles no confirmo la subida. Respuesta: " . json_encode($result);
                echo "<p>MFiles no confirmo la subida: " . print_r($result, true) . "</p>";
            }

        } catch (Exception $e) {
            $todosEnviados = false;
            $errores[] = "INPUT - {$dataoutDoc['FILENAME']}: " . $e->getMessage();
            echo "<p>Excepcion capturada: " . $e->getMessage() . "</p>";
        }
    }
}

// =============================================
// CIERRE DEL CASO
// =============================================
if ($todosEnviados) {
    executeQuery("UPDATE APP_DELEGATION
        SET DEL_THREAD_STATUS = 'CLOSED', DEL_FINISH_DATE = NOW()
        WHERE APP_UID = '$caseUID' AND DEL_LAST_INDEX = 1");

    executeQuery("UPDATE APPLICATION
        SET APP_STATUS = 'COMPLETED', APP_STATUS_ID = 3, APP_FINISH_DATE = NOW()
        WHERE APP_UID = '$caseUID'");

    echo "<p>Caso $app_number cerrado exitosamente.</p>";
} else {
     // Marcar el caso como fallido para que no lo vuelva a tomar el LIMIT 1
    $erroresJson = addslashes(json_encode($errores));
    executeQuery("UPDATE APPLICATION
        SET APP_DRIVE_FOLDER_UID = 'ERROR_MFILES'
        WHERE APP_UID = '$caseUID'");

    echo "<p>Caso $app_number NO cerrado. Marcado como ERROR_MFILES.</p>";
    foreach ($errores as $error) {
        echo "<p>ERROR: $error</p>";
    }
    echo "<p>Corrija los errores y vuelva a ejecutar. Los documentos ya enviados no se duplicaran.</p>";
}
