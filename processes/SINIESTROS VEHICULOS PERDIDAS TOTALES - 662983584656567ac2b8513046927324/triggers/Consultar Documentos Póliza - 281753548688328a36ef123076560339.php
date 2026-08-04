<?php
//Consultar condiciones Poliza

$pro_uid = @@PROCESS;
/*echo(@@frm_cod_asec);
die();*/

//catalogos de marcas modelos
//obtengo el token
$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Consultar_idpvs_Poliza'";
$rs_auth =  executeQuery($sql_cata_auth);
print_r($rs_auth);
$token = isset($rs_auth['1']['CAMPO2']) ? $rs_auth['1']['CAMPO2'] : '';
/*
$sql_cata_condicionesPoliza = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_idpvs_Poliza'";
$rs_condicionesPoliza=  executeQuery($sql_cata_condicionesPoliza);
*/
$url_condicionesPoliza = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
echo "<br>";
echo $url_condicionesPoliza;
echo "<br>";
$idPv = @@frm_id_pv;

$url_inCondiciones_param = $url_condicionesPoliza;
$jsonData = array(
    "nombre_procedimiento" => "sp_rel_polizas1",
    "parametros" => array(
        array(
            "nombre" => "@id_pv",
            "valor" => "$idPv",
            "tipo_dato" => "NUMERO"
        )
    )
);

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inCondiciones_param);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonData));
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
            "apikey:" . $token
        )
    );

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "<br>Error: " . curl_error($ch);
        echo "<br>Error No: " . curl_errno($ch);
        echo "<br>";
        $msg_m = curl_error($ch);
        @@tri_msg_error = $msg_m;
    } else {
        echo http_response_code();
        $msg_m = 'Consulta realizada correctamente';
        @@tri_msg_error = $msg_m;
    }

    $result = json_decode($res, true);

    PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'CDP-SVPT-75',
    $url_inCondiciones_param,
    'POST',
    "APIKEY:". $apikey,
    json_encode($jsonData),
    json_encode($result),
    json_encode($msg_m));

    //form table with html
    $table = "<table class='table table-striped table-bordered table-hover'>";
    $table .= "<thead><tr><th>ID_PV - " . $idPv . "</th></tr></thead>";
    $table .= "<tbody>";

    $host = @@URL_SERVER_SQL;


    $url = "$host/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/consultar_documentos/obtener_base64.php?id_pv=";

    if (isset($result) && is_array($result)) {
        foreach ($result as $row) {
            $table .= "<tr>";
            //LINK para descargar el documento
            $text_poliza = "<a href='" . $url . $row['id_pv'] . "' target='_blank'>Descargar Póliza -" . $row['id_pv'] . "</a>";
            $table .= "<td>" . $text_poliza . "</td>";
            $table .= "</tr>";
        }
    }
    $table .= "</tbody>";
     $table .= "</table>";

    // Output the table

      @@tri_tabla_idpv = $table;

    //@@tri_idpvs_poliza = $text_poliza;
} catch (Exception $e) {
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error = $msg_m;
}
