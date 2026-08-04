<?php
try {
    $caseId = @@APPLICATION;
    $indice = @#INDEX+1;



    $host = @@URL_SERVER_SQL;


    $url = "$host/syscertificacion/es/3sesa/beesmartec/services/siniestrosVida/derivacion_liquidacion.php?app_uid=$caseId";


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);

    $data = curl_exec($curl);

    curl_close($curl);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'DLAB-SV-26',
        $url,
        'GET',
        '',
        '',
        $data,
        '');
} catch (Exception $e) {
    $errorMessage =  $e->getMessage();
}
