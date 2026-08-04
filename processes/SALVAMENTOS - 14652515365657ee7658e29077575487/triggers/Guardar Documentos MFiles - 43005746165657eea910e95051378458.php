<?php
//<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida
$pro_uid = @@PROCESS;

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
$query = "SELECT APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
FROM APP_DOCUMENT
WHERE APP_UID='$caseUID'
AND APP_DOC_TYPE = 'OUTPUT' AND APP_DOC_STATUS = 'ACTIVE'
ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);

$g = new G();
$number = @@APP_NUMBER;
$ciRuc = @@frm_busqueda_identificacion;
$Nombre = @@frm_busqueda_nombres;
$Tipo = 'CEDULA';
$Sucursal = @@frm_poliza_codSucursal;

if (is_array($outDoc)) {
    $cont = 1;
    foreach ($outDoc as $dataoutDoc) {
        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs'. PATH_SEP .$dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
        $filename = str_replace("N/A",$number,$dataoutDoc['FILENAME']);
        $arch_base64 = base64_encode($path);
        $Clase = 2;
        $SubClase = 1;
        $TipoDocumento = 8;

        $json_param = array("DatoGenerico"=> array("ciRuc"=>, "Nombre"=>, "Tipo"=>$Tipo, "Sucursal"=>$Sucursal), "ArchivoGenerico"=> array("Clase"=>$Clase, "SubClase"=>$SubClase, "TipoDocumento"=>$TipoDocumento, "NombreArchivo"=>$filename, "ExtensionArchivo"=>"pdf", "ArchivoBase64"=>$arch_base64));

        $json = json_encode($json_param);

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
                "APIKEY: ". $token
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

        PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
        'Guardar documentos MFiles', $url_mfils_param,
        'POST', 'SI', $token, $result, $msg_m);

    } catch(Exception $e)
    {
        //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
        $result['mensaje'] = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
        @@tri_msg_error = $msg_m;
    }
}
}
