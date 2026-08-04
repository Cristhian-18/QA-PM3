<?php
$pro_uid = '35087580064a18c9776b638006106795';
$app_number = @@APP_NUMBER;
$caseUID = @@APPLICATION;


$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Subir_archivos_MFILES'";
$rs_auth = executeQuery($sql_cata_auth);
$token = isset($rs_auth['1']['CAMPO2']) ? $rs_auth['1']['CAMPO2'] : '';
$url_mfiles = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$url_mfils_param = $url_mfiles;


$ciRuc = @@frm_busqueda_identificacion ?? '';
$Nombre = @@frm_busqueda_nombres ?? '';
$Sucursal = @@frm_poliza_codSucursal ?? '';
$NumeroReclamo = @@tri_nro_stro ?? '';
$NumeroReporte = @@tri_id_stro ?? '';
$Tipo = getTipoDocumento($ciRuc);
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
            continue;
        }

        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs' . PATH_SEP . $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
        $filename = str_replace("N/A", $app_number, $dataoutDoc['FILENAME']);
        $extension = "pdf";
        $Clase = 2;
        $SubClase = 1;

        $name = $dataoutDoc['DOC_UID'];

        switch ($name) {
            case "563796961654b0c94578a15070715888":
                $TipoDocumento = "AVISO_DE_ACCIDENTE";
                break;
            case "19117045165407c364ef026071461159":
                $TipoDocumento = "ACTA_DESISTIMIENTO_Y_FINIQUITO";
                break;
            default:
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
        }


        $arch_base64 = base64_encode(file_get_contents($path));

        $json_param = array(
            "DatoGenerico" => array(
                "ciRuc" => $ciRuc,
                "Nombre" => $Nombre,
                "Tipo" => $Tipo,
                "SubTipo" => $SubTipo,
                "Ramo" => $Ramo,
                "NumeroReclamo" => $NumeroReclamo,
                "NumeroReporte" => $NumeroReporte,
                "Sucursal" => $Sucursal
            ),
            "ArchivoGenerico" => array(
                "Clase" => $Clase,
                "SubClase" => $SubClase,
                "TipoDocumento" => $TipoDocumento,
                "NombreArchivo" => $TipoDocumento . "_" . date('m_d_Yhis', time()),
                "ExtensionArchivo" => $extension,
                "ArchivoBase64" => $arch_base64
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
            continue;
        }

        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
        $filename = str_replace("N/A", $app_number, $dataoutDoc['FILENAME']);
        $partes = explode(".", $filename);
        $extension = end($partes);
        $Clase = 2;
        $SubClase = 1;

        //exclusion de los .zip
        if (strtolower($extension) === 'zip') {
            echo "<p>Saltando archivo ZIP: {$dataoutDoc['FILENAME']}</p>";
            continue;
        }


        switch ($name) {
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
            case "file_finiquitoFirmado":
                $TipoDocumento = "ACTA_DESISTIMIENTO_Y_FINIQUITO";
                break;
            case "file_facturasTaller":
                $TipoDocumento = "FACTURAS_Y_CHEQUE";
                break;
            default:
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
        }

        $path = substr($path, 1);
        $path = $path . "." . $extension;


        $path_completo = $path;

        if (!file_exists($path_completo)) {
            echo "<p>ADVERTENCIA: Archivo no encontrado: {$path_completo}</p>";
            continue;
        }

        $arch_base64 = base64_encode(file_get_contents($path));

        $json_param = array(
            "DatoGenerico" => array(
                "ciRuc" => $ciRuc,
                "Nombre" => $Nombre,
                "Tipo" => $Tipo,
                "SubTipo" => $SubTipo,
                "Ramo" => $Ramo,
                "NumeroReclamo" => $NumeroReclamo,
                "NumeroReporte" => $NumeroReporte,
                "Sucursal" => $Sucursal
            ),
            "ArchivoGenerico" => array(
                "Clase" => $Clase,
                "SubClase" => $SubClase,
                "TipoDocumento" => $TipoDocumento,
                "NombreArchivo" => $TipoDocumento . "_" . date('m_d_Yhis', time()),
                "ExtensionArchivo" => $extension,
                "ArchivoBase64" => $arch_base64
            )
        );
        $json = json_encode($json_param);
        // echo ("<p>");
        // echo $json;
        // echo ("</p>");
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
