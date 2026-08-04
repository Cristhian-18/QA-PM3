<?php
 
$app_number = @@APP_NUMBER;
$caseUID = @@APPLICATION;

  
$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '35087580064a18c9776b638006106795' AND CODIGO = 'Subir_archivos_MFILES'";
$rs_auth = executeQuery($sql_cata_auth);
$token = isset($rs_auth['1']['CAMPO2']) ? $rs_auth['1']['CAMPO2'] : '';
$url_mfiles = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$url_mfils_param = $url_mfiles;
 
 

$ciRuc         = @@frm_busqueda_identificacion ?? '';
$Nombre        = @@frm_busqueda_nombres ?? '';
$Sucursal      = @@frm_poliza_codSucursal ?? '';
$NumeroReclamo = @@tri_nro_stro ?? '';
$NumeroReporte = @@tri_id_stro ?? '';
$Tipo          = getTipoDocumento($ciRuc);
$SubTipo = "VEHICULOS";
$Ramo = "TODO_RIESGO_DE_VEHICULOS";
 

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

        switch ($name) {
            case "638000730656567afd3af09035720407":
                $TipoDocumento = "AVISO_DE_ACCIDENTE";
                break;
            case "269801414656567afd38f59034813067":
                $TipoDocumento = "ACTA_DESISTIMIENTO_Y_FINIQUITO";
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
            echo "<p>RAW RESPONSE: " . htmlspecialchars($res) . "</p>";
           

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
			case "file_validacionSRI":
				$TipoDocumento = "DOCUMENTOS_LEGALES_PT";
				break;
			case "file_reporte_sat":
				$TipoDocumento = "SOLICITUD_DOCUMENTOS_E_INFORMES_PT";
				break;
			case "file_cartaNegativa":
				$TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
				break;
			case "file_ContratoLegalizado":
				$TipoDocumento = "CONTRATOS_PT";
				break;
			case "frm_informe_friss":
				$TipoDocumento = "CERTIFICADOS_PT";
				break;
			case "file_informePerito":
				$TipoDocumento = "PERITAZGO";
				break;
			case "file_poliza":
				$TipoDocumento = "OTROS_PT";
				break;
			case "file_liberacionVehiculo":
				$TipoDocumento = "DOCUMENTOS_LEGALES_PT";
				break;
			case "file_contratosFirmados":
				$TipoDocumento = "CONTRATOS_PT";
				break;
			case "file_documentoOpcional":
				$TipoDocumento = "OTROS_PT";
				break;
			case "file_saldoInsoluto":
				$TipoDocumento = "DOCUMENTOS_LEGALES_PT";
				break;
			case "file_pagoParcial":
				$TipoDocumento = "DOCUMENTOS_LEGALES_PT";
				break;
			case "fle_finiquito":
				$TipoDocumento = "ACTA_DESISTIMIENTO_Y_FINIQUITO";
				break;
			case "file_validacionMultas":
				$TipoDocumento = "DOCUMENTOS_LEGALES_PT";
				break;
			case "frm_rastreoSatelital2":
				$TipoDocumento = "OTROS_PT";
				break;		
			case "file_documentos_respaldoIMVEC":
				$TipoDocumento = "OTROS_PT";
				break;	
			default:
				$TipoDocumento = "OTROS_DOCUMENTOS";
				break;
		}

        $path = substr($path, 1);
        $path = $path . "." . $extension;
        echo "<p>ruta:" . $path . "</p>";
      

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
            echo "<p>RAW RESPONSE: " . htmlspecialchars($res) . "</p>";

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
