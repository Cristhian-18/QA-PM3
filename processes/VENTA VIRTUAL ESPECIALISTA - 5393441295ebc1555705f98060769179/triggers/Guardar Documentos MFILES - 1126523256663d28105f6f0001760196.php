<?php
//<?php
//created by Hugo
//05-08-2024
//Guardar Documentos Compartida
$pro_uid = @@PROCESS;
$task = @@TASK;
$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$app_number = @@APP_NUMBER;
$caseUID = @@APPLICATION;

$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Subir_archivos_MFILES'";
$rs_auth =  executeQuery($sql_cata_auth, $cnx_rp);
$token = isset($rs_auth['1']['CAMPO2']) ? $rs_auth['1']['CAMPO2'] : '';

$url_mfiles = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$url_mfils_param = $url_mfiles;

$query = "SELECT DOC_UID, APP_DOC_FIELDNAME, APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, date(APP_DOC_CREATE_DATE) APP_DOC_CREATE_DATE FROM APP_DOCUMENT
WHERE APP_UID='$caseUID' AND APP_DOC_TYPE IN ('OUTPUT') AND APP_DOC_STATUS = 'ACTIVE'
ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);

$g = new G();

$number = @@APP_NUMBER;
$ciRuc = @@frm_numero_identificacion;
$Nombre = @@frm_nombres_completos;
$Tipo = 1;
$Sucursal = @@frm_Sucursal;
$banderaDiferenteAsegurado = false;
$contranteDiferenteAsegurado = @@frm_plan_diferente_asegurado_label;
$ciBoker = isset(@@frm_aps_codigo_agente) && !empty(@@frm_aps_codigo_agente) ? @@frm_aps_codigo_agente : "1234";
$nombreBroker = @@frm_vendedor_nombre;
$codigoRamo = @@frm_ramo;
$ramo = @@frm_producto_label;
$numeroPoliza = (@@frm_numero_poliza === null || trim(@@frm_numero_poliza) === '') ? @@nro_poliza : @@frm_numero_poliza;
$endoso = (@@nro_solicitud === null || trim(@@nro_solicitud) === '')?"0":@@nro_solicitud;
$motivoMovimiento = @@frm_motivo_seguro_label;

if ($contranteDiferenteAsegurado ==='SI'){
    $banderaDiferenteAsegurado = true;
    $NombreContratante = @@frm_plan_nombre_label;
    $ciRucContatante = @@frm_plan_numero_identificacion_label;
}


if (is_array($outDoc)) {
    $cont = 1;
    foreach ($outDoc as $dataoutDoc) {
        $name = strtoupper($dataoutDoc['FILENAME']);
        $tipoDocumentoInsertar = 27;
        $fechaEmision = $dataoutDoc['APP_DOC_CREATE_DATE'];
        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs' . PATH_SEP . $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];

        $filename = "";
        $extension = "pdf";

        $Clase = 7;
        $SubClase = 0;

        $idName = $dataoutDoc['DOC_UID'];
        switch ($idName) {
            case "15098206867bde87105ac23049309375":
            $filename = "Caratula de archivo";
            $tipoDocumentoInsertar = 18;
            break;
            case "7496627105ece994927e011097866968":
            $filename = "Solicitud de seguro asegurado";
            $tipoDocumentoInsertar = 27;
            break;
            case "5028443425ee7d8a823c0b4062936539":
            $filename = "Impresion de impuesto a la renta causado";
            $tipoDocumentoInsertar = 23;
            break;
            case "2243400975ec74080523606085555297":
            $filename = "Autorizacion de debito";
            $tipoDocumentoInsertar = 17;
            break;
            case "6876503365f9a3bdb1e03a3065992251":
            $filename = "Informe confidencial del agente";
            $tipoDocumentoInsertar = 25;
            break;
            case "308255212646cd4d0b3b6a5006332297":
            $filename = "Dictamen de Suscripcion";
            $tipoDocumentoInsertar = 21;
            break;
            default:
            $filename = str_replace("N/A","",$name);
            break;
        }

        $fechaHora = date("YmdHis");
        $path = substr($path, 1);
        $path = $path . "." . $extension;
        $arch_base64 = file_get_contents($path);
        $arch_base64 = base64_encode($arch_base64);

        $json_param = array(
            "datoGenerico" => array(
                "asegurado" => array(
                    "ciRuc" => $ciRuc,
                    "Nombre" => $Nombre,
                    "Tipo" => $Tipo
                ),
                "contratante" => array(
                    "ciRuc" => ($banderaDiferenteAsegurado) ? $ciRucContatante : $ciRuc,
                    "Nombre" => ($banderaDiferenteAsegurado) ? $NombreContratante : $Nombre,
                    "Tipo" => 8
                ),
                "broker" => array(
                    "ciRuc" => $ciBoker,
                    "Nombre" => $nombreBroker,
                    "Tipo" => 3
                ),
                "poliza" => array(
                    "codigoRamo" => $codigoRamo,
                    "endoso" => $endoso,
                    "estado" => 1,
                    "estadoPoliza" => 4,
                    "fechaEmision" => $fechaEmision,
                    "motivoMovimiento" => $motivoMovimiento,
                    "numeroPoliza" => $numeroPoliza,
                    "ramo" => $ramo,
                    "sucursal" => $Sucursal,
                    "tipoMovimiento" => $motivoMovimiento,
                    "tipoPoliza" => 1
                ),
                "tipoDocumentoInsertar" => $tipoDocumentoInsertar
            ),
            "archivoGenerico" => array(
                "Clase" => $Clase,
                "SubClase" => $SubClase,
                "tipoDocumento" => 0,
                "nombreArchivo" => $numeroPoliza . " - ". $endoso . " " .$filename."_" . $fechaHora,
                "extensionArchivo" => $extension,
                "archivoBase64" => $arch_base64
            )
        );

        $json = json_encode($json_param, JSON_UNESCAPED_UNICODE);
        @@json_mfiles = $json;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_mfils_param);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
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
                    "Accept-Language: application/json",
                    "Sesa-Key : 99b7c550a8724df7837f7940c80008af",
                    "Connection: Keep-Alive",
                    "apikey: " . $token
                )
            );

            $res = curl_exec($ch);
            $err = curl_error($ch);

            PMFBitacoraServicios(
                @@APP_NUMBER,
                'trigger',
                'Guardar Documentos MFILES',
                $url_mfils_param,
                'POST',
                "apikey ". $token,
                $json,
                $res,
                $err
            );

            if (curl_errno($ch)) {
                $msg_m = curl_error($ch);
                $tri_msg_error = $msg_m;
                $tri_bandera_recupera = 'true';
            }

            curl_close($ch);
            $result = json_decode($res);
        } catch (Exception $e) {
            $result['mensaje'] = 'false';
            $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
            $tri_msg_error = $msg_m;
        }
    }
}



$query = "SELECT DOC_UID, APP_DOC_FIELDNAME, APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, date(APP_DOC_CREATE_DATE) APP_DOC_CREATE_DATE FROM APP_DOCUMENT
WHERE APP_UID='$caseUID' AND APP_DOC_TYPE IN ('INPUT','ATTACHED') AND APP_DOC_STATUS = 'ACTIVE' ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);


if (is_array($outDoc)) {
    $cont = 1;
    foreach ($outDoc as $dataoutDoc) {
        $tipoDocumentoInsertar = 27;
        $fechaEmision = $dataoutDoc['APP_DOC_CREATE_DATE'];
        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP  . $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];

        $filename = "";
        $Clase = 7;
        $SubClase = 0;

        $idName = $dataoutDoc['APP_DOC_UID'];
        $name = strtoupper($dataoutDoc['FILENAME']);
        $extension = pathinfo($dataoutDoc['FILENAME'], PATHINFO_EXTENSION);
        $fieldName = $dataoutDoc['APP_DOC_FIELDNAME'];

        if (trim((string)$fieldName) === 'file_cotizacion'){
            $filename = "Cotizacion";
            $tipoDocumentoInsertar = 20;
        }else if (trim((string)$fieldName) === 'fle_poliza' ) {
            $filename = "Caratula de archivo";
            $tipoDocumentoInsertar = 18;
        }else{
            switch ($idName) {
                case "7496627105ece994927e011097866968":
                $filename = "Solicitud de seguro asegurado";
                $tipoDocumentoInsertar = 27;
                break;
                case "5028443425ee7d8a823c0b4062936539":
                $filename = "Impresion de impuesto a la renta causado";
                $tipoDocumentoInsertar = 23;
                break;
                case "2243400975ec74080523606085555297":
                $filename = "Autorizacion de debito";
                $tipoDocumentoInsertar = 17;
                break;
                case "6876503365f9a3bdb1e03a3065992251":
                $filename = "Informe confidencial del agente";
                $tipoDocumentoInsertar = 25;
                break;
                case "308255212646cd4d0b3b6a5006332297":
                $filename = "Dictamen de Suscripcion";
                $tipoDocumentoInsertar = 21;
                break;
                case "64003312567bcc0884d65e2046088063":
                case "68214100967d08de3175ae8067323160":
                case "79404093867d191c414b377099923127":
                $filename = "Fotocopia del DI_RUC del asegurado";
                $tipoDocumentoInsertar = 22;
                break;
                case "84935795667bd07e6ac26a0097363000":
                $filename = str_replace(".PDF","",$name);
                $tipoDocumentoInsertar = 24;
                break;
                case "97485995467bcc0e411ac29037273039":
                $filename = str_replace(".PDF","",$name);
                $tipoDocumentoInsertar = 24;
                break;
                default:
                $filename = pathinfo(basename($name), PATHINFO_FILENAME);
                break;
            }
        }

        $fechaHora = date("YmdHis");
        $path = substr($path, 1);
        $path = $path . "." . $extension;
        $arch_base64 = file_get_contents($path);
        $arch_base64 = base64_encode($arch_base64);
        $json_param = array(
            "datoGenerico" => array(
                "asegurado" => array(
                    "ciRuc" => $ciRuc,
                    "Nombre" => $Nombre,
                    "Tipo" => $Tipo
                ),
                "contratante" => array(
                    "ciRuc" => ($banderaDiferenteAsegurado) ? $ciRucContatante : $ciRuc,
                    "Nombre" => ($banderaDiferenteAsegurado) ? $NombreContratante : $Nombre,
                    "Tipo" => 8
                ),
                "broker" => array(
                    "ciRuc" => $ciBoker,
                    "Nombre" => $nombreBroker,
                    "Tipo" => 3
                ),
                "poliza" => array(
                    "codigoRamo" => $codigoRamo,
                    "endoso" => "0",
                    "estado" => 1,
                    "estadoPoliza" => 4,
                    "fechaEmision" => $fechaEmision,
                    "motivoMovimiento" => $motivoMovimiento,
                    "numeroPoliza" => $numeroPoliza,
                    "ramo" => $ramo,
                    "sucursal" => $Sucursal,
                    "tipoMovimiento" => $motivoMovimiento,
                    "tipoPoliza" => 1
                ),
                "tipoDocumentoInsertar" => $tipoDocumentoInsertar
            ),
            "archivoGenerico" => array(
                "Clase" => $Clase,
                "SubClase" => $SubClase,
                "tipoDocumento" => 0,
                "nombreArchivo" => $numeroPoliza . " - ". $endoso . " " .$filename."_" . $fechaHora,
                "extensionArchivo" => $extension,
                "archivoBase64" => $arch_base64
            )
        );

        $json = json_encode($json_param, JSON_UNESCAPED_UNICODE);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_mfils_param);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
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
                    "Accept-Language: application/json",
                    "Sesa-Key : 99b7c550a8724df7837f7940c80008af",
                    "Connection: Keep-Alive",
                    "apikey: " . $token
                )
            );

            $res = curl_exec($ch);

            PMFBitacoraServicios(
                @@APP_NUMBER,
                'trigger',
                'Guardar Documentos MFILES',
                $url_mfils_param,
                'POST',
                "apikey ". $token,
                $json,
                $res,
                $err
            );

            if (curl_errno($ch)) {
                $msg_m = curl_error($ch);
                $tri_msg_error = $msg_m;
                $tri_bandera_recupera = 'true';
            }

            curl_close($ch);
            $result = json_decode($res);
        } catch (Exception $e) {
            $result['mensaje'] = 'false';
            $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
            $tri_msg_error = $msg_m;
            $tri_bandera_recupera = 'true';
            echo '<br>Error segundo lote:<br><p>';
            echo $result['mensaje_mostrar'];
            echo '</p>';
        }

    }
}
echo ("<p>Documentacion Guardada Correctamente</p>");
@@tri_enviado_MFiles = '1';

