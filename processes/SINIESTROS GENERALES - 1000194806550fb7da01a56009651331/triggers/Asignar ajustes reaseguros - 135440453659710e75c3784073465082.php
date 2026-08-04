<?php
$tipo = @@frm_ds_tipoOperacion;

if ($tipo == 'DIRECTA(FC)') {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'mcarrera'";
    $rs_u = executeQuery($sql_u);
    @@tri_usr_reaseguros = $rs_u['1']['USR_UID'];
} else {
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'ravelasco'";
    $rs_u = executeQuery($sql_u);
    @@tri_usr_reaseguros = $rs_u['1']['USR_UID'];
}



if (@@tri_bandera_coaseguros == 1){
    return;
} else {
    try {


        echo "Entro a la asignación de ajustes reaseguros";
        $process = @@PROCESS;

        $sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_API_GENERALES'
        AND CODIGO = 'apikey_generales'";

        $sql_url = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_API_GENERALES'
        AND CODIGO = 'Consultar_siniestros_generales'";

        $rs_apikey = executeQuery($sql_apikey);
        $rs_url = executeQuery($sql_url);


        $apikey = $rs_apikey['1']['DESCRIPCION'];
        $url = $rs_url['1']['DESCRIPCION'];

        $idpv = @@frm_idpv;
        $post_data = array(
            'idpv' => $idpv
            //'idpv' => '9880539'
        );

        $post_data = json_encode($post_data);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'apikey: ' . $apikey
        ));

        $msg_m = '';
        $response = curl_exec($curl);
        $msg_m = curl_error($curl);
        @@response_coaseguros = $response;

        // Decodificar el JSON
        $response_data = json_decode($response, true);
        // Verificar si hay datos de coaseguro
        if (isset($response_data['data']['coaseguro']['companias'])) {
            $companias = $response_data['data']['coaseguro']['companias'];

            // Crear el array filtrado con codCia y pjePrimaTotal
            $resultado = array_map(function ($compania) {
                return [
                    'codCia' => $compania['codCia'],
                    'pjePrimaTotal' => $compania['pjePrimaTotal']
                ];
            }, $companias);
        } else {
            echo "No hay datos de coaseguro disponibles.";
        }
       
        curl_close($curl);
        PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'AAR-SG-83', $url, 'POST', 'apikey',  $post_data, $response, $msg_m);

        $porcentajes_aseguradoras = array();
        $i = 1;
        foreach ($resultado as $compania) {
            $codCia = $compania['codCia'];
            $sql_compania = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
            WHERE COD_CATALOGO = 'COASEGURADORES' AND CODIGO = '$codCia'";
            $rs_compania = executeQuery($sql_compania);
            if (is_array($rs_compania) && count($rs_compania) > 0) {
                $compania_label = $rs_compania[1]['DESCRIPCION'];
            } else {
                $compania_label = '';
            }
            $pjePrimaTotal = $compania['pjePrimaTotal'];
            $porcentajes_aseguradoras[$i] = [
                'frm_compania' => $codCia,
                //'frm_compania_label' => $compania_label,
                'frm_porcentajePrima' => number_format(round($pjePrimaTotal, 2, PHP_ROUND_HALF_UP), 2, '.', '')
            ];
            $i++;
        }
        @@tri_bandera_coaseguros = 1;

        @@frm_companias_coaseguradas = $porcentajes_aseguradoras;
    } catch (Exception $e) {
	 
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
 

}
