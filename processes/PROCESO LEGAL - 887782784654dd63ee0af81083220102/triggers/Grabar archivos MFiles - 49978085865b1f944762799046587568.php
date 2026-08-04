<?php
//<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida
$pro_uid = @@PROCESS;
//consulto del catalogo
//obtengo el api_key
$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Subir_archivos_MFILES'";
$rs_auth       = executeQuery($sql_cata_auth);
$token         = isset($rs_auth['1']['CAMPO2']) ? $rs_auth['1']['CAMPO2'] : '';

$url_mfiles      = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$url_mfils_param = $url_mfiles;

//consulto los documento
//output document
$caseUID = @@APPLICATION; //set to the Output Document's unique ID
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table

$query = "SELECT APP_DOC_FIELDNAME, APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
                FROM APP_DOCUMENT
                WHERE APP_UID='$caseUID'
                AND APP_DOC_TYPE IN ('INPUT', 'ATTACHED') AND APP_DOC_STATUS = 'ACTIVE'
                ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);

$g             = new G();
$number        = @@APP_NUMBER;
$ciRuc         = @@frm_busqueda_identificacion;
$Nombre        = @@frm_busqueda_nombres;
$Tipo          = 1;
$SubTipo       = "VEHICULOS";
$Ramo          = "TODO_RIESGO_DE_VEHICULOS";
$Sucursal      = @@frm_poliza_codSucursal;
$NumeroReclamo = @@tri_nro_stro;
$NumeroReporte = @@tri_id_stro;

if (is_array($outDoc)) {
    $cont = 1;
    foreach ($outDoc as $dataoutDoc) {
        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];

        $filename = str_replace("N/A", $number, $dataoutDoc['FILENAME']);
        //separate by dot and take the last part
        $extension = end(explode(".", $filename));

        //$arch_base64 = base64_encode($path);
        $Clase    = 2;
        $SubClase = 1;

        $name = $dataoutDoc['APP_DOC_FIELDNAME'];
        echo "<p>" . $name . "</p>";

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

        /*frm_archivos
		frm_cartaNegativa
		frm_carta_noDeducible
		frm_cierre_actaFiscalia
		frm_cierre_cierreFiscalia
		frm_cierre_comprobantePago
		frm_cierre_facturaHonorarios
		frm_cierre_infoCierre
		frm_doc_analista
		frm_poliza*/

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
            case "frm_archivos":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
            case "frm_cartaNegativa":
                $TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
                break;
            case "frm_carta_noDeducible":
                $TipoDocumento = "NEGATIVAS_DEMANDAS_Y_RESOLUCION_SBS";
                break;
            case "frm_cierre_actaFiscalia":
                $TipoDocumento = "DOCUMENTOS_LEGALES_PT";
                break;
            case "frm_cierre_cierreFiscalia":
                $TipoDocumento = "DOCUMENTOS_LEGALES_PT";
                break;
            case "frm_cierre_comprobantePago":
                $TipoDocumento = "FACTURAS_Y_CHEQUE";
                break;
            case "frm_cierre_facturaHonorarios":
                $TipoDocumento = "FACTURAS_Y_CHEQUE";
                break;
            case "frm_cierre_infoCierre":
                $TipoDocumento = "DOCUMENTOS_LEGALES_PT";
                break;
            case "frm_doc_analista":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
            case "frm_poliza":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;

            default:
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
        }

        //strip first character in path
        $path = substr($path, 1);
        $path = $path . "." . $extension;
        echo "<p>" . $path . "</p>";
        //$arch_base64 = base64_encode($data);
        $arch_base64 = file_get_contents($path);
        //transform to base64
        $arch_base64 = base64_encode($arch_base64);
        echo("<p>");
        echo($arch_base64);
        echo("</p>");
        $json_param = ["DatoGenerico" => [
            "ciRuc"         => $ciRuc,
            "Nombre"        => $Nombre,
            "Tipo"          => $Tipo,
            "SubTipo"       => $SubTipo,
            "Ramo"          => $Ramo,
            "NumeroReclamo" => $NumeroReclamo,
            "NumeroReporte" => $NumeroReporte,
            "Sucursal"      => $Sucursal],
            "ArchivoGenerico"                  => [
                "Clase"            => $Clase,
                "SubClase"         => $SubClase,
                "TipoDocumento"    => $TipoDocumento,
                "NombreArchivo"    => $TipoDocumento . "_" . date('m_d_Yhis', time()),
                "ExtensionArchivo" => $extension,
                "ArchivoBase64"    => $arch_base64]];

        $json = json_encode($json_param);
        echo("<p>");
        echo $json;
        echo("</p>");
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url_mfils_param);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                [
                    "Accept: application/json",
                    "Content-Type: application/json",
                    "Accept-Language: application/json",
                    "Sesa-Key : 20aa9c2054a642939bbd3e9cc30f72e9",
                    "Connection: Keep-Alive",
                    "apikey: " . $token,
                ]
            );

            $res = curl_exec($ch);

            if (curl_errno($ch)) {
                $msg_m                 = curl_error($ch);
                @@tri_msg_error        = $msg_m;
                @@tri_bandera_recupera = 'true';
            }

            curl_close($ch);
            $result = json_decode($res);

            PMFBitacoraServicios(
                @@APP_NUMBER,
                'trigger',
                'GDMF-PL-258',
                $url_mfils_param,
                'POST',
                "apikey: " . $token,
                json_encode($json),
                json_encode($result),
                json_encode($msg_m));

            echo("<p>");
            print_r($result);
            echo("</p>");
        } catch (Exception $e) {
            //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
            $result['mensaje']         = 'false';
            $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
            @@tri_msg_error            = $msg_m;
        }
    }
}

