<?php
//<?php
//created by Hugo
//05-08-2024
//Guardar Documentos Compartida
$pro_uid = @@PROCESS;
//consulto del catalogo
//obtengo el api_key

$task = @@TASK;
$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$app_number = @@APP_NUMBER;

$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Subir_archivos_MFILES'";
$rs_auth =  executeQuery($sql_cata_auth, $cnx_rp);
$token = isset($rs_auth['1']['CAMPO2']) ? $rs_auth['1']['CAMPO2'] : '';

$url_mfiles = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$url_mfils_param = $url_mfiles;

/*echo ("<p>");
echo $url_mfils_param;
echo ("</p>");*/
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
$ciRuc = @@frm_numero_identificacion;
$Nombre = @@frm_nombres_completos;
$Tipo = 1;
$SubTipo = "VEHICULOS";
$Ramo = "TODO_RIESGO_DE_VEHICULOS";
$Sucursal = @@frm_Sucursal;
$NumeroReclamo = '12345';
$NumeroReporte = '12345';

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
        //echo "<p>".$name."</p>";
        switch($name){
            case "1465807915ecc74912c13c2030426904":
            $TipoDocumento = "OTROS_DOCUMENTOS";
            break;
            case "2243400975ec74080523606085555297":
            $TipoDocumento = "OTROS_DOCUMENTOS";
            break;
            case "255220557657445a1bda1f1047276130":
            $TipoDocumento = "OTROS_DOCUMENTOS";
            break;
            case "308255212646cd4d0b3b6a5006332297":
            $TipoDocumento = "OTROS_DOCUMENTOS";
            break;
            case "6876503365f9a3bdb1e03a3065992251":
            $TipoDocumento = "OTROS_DOCUMENTOS";
            break;
            case "7496627105ece994927e011097866968":
            $TipoDocumento = "OTROS_DOCUMENTOS";
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
        /*echo ("<p>");
        echo ($arch_base64);
        echo ("</p>");  */
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
                /*echo ("<p>");
                echo $json;
                echo ("</p>");*/
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
                $err 		= curl_error($ch);

                PMFBitacoraServicios(
                    @@APP_NUMBER,
                    'trigger',
                    'Enviar a Dana Connect 4 Docs',
                    $url_mfils_param,
                    'POST',
                    "apikey: ". $token,
                    $json,
                    $res,
                    $err
                );

                if(curl_errno($ch)){
                    $msg_m = curl_error($ch);
                    @@tri_msg_error = $msg_m;
                    @@tri_bandera_recupera = 'true';
                }

                curl_close($ch);
                $result = json_decode($res);
            } catch(Exception $e)
            {
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
    $ciRuc = @@frm_numero_identificacion;
    $Nombre = @@frm_nombres_completos;
    $Tipo = 1;
    $SubTipo = "VEHICULOS";
    $Ramo = "TODO_RIESGO_DE_VEHICULOS";
    $Sucursal = @@frm_Sucursal;
    $NumeroReclamo = '12345';
    $NumeroReporte = '12345';


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
            //echo "<p>".$name."</p>";

            switch($name){
                case "file_cedula_fechaCaducidad":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "file_requisitosMedicos":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "file_requisitosFinancieros":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "file_primeraCuota":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "file_documentosDesgravamen":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "fle_docs_cliente":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "file_cotizacion":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "file_cotizacion_csv":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "fle_mas_docs":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "fle_otros_docs":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "fle_docs_repro":
                $TipoDocumento = "OTROS_DOCUMENTOS";
                break;
                case "fle_docs_aprobar":
                $TipoDocumento = "OTROS_DOCUMENTOS";
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
            /*echo ("<p>");
            echo ($arch_base64);
            echo ("</p>");*/
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
                    /*echo ("<p>");
                    echo $json;
                    echo ("</p>");*/
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
                } catch(Exception $e)
                {
                    $result['mensaje'] = 'false';
                    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
                    @@tri_msg_error = $msg_m;
                    @@tri_bandera_recupera = 'true';
                    echo ("<p>");
                    echo $result['mensaje_mostrar'];
                    echo ("</p>");
                    die();
                }
            }
        }
        die();
