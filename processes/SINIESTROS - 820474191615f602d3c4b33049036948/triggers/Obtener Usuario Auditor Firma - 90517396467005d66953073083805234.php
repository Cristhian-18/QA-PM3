<?php
//created by Henry
//Obtener Usuario Auditor firma
//8-1-2022
try {


    $cnx = "11264850561d723f004d5c2072943786";
    $app_uid        = @@APPLICATION;
    $pro_uid        = @@PROCESS;

    $host = @@URL_SERVER_SQL;

    $dns_user = "$host/syscertificacion/es/3sesa/beesmartec/services/firma/servicioFirma.php?codigo=" . @@tri_user_auditor;

    //echo $dns_user;
    // Función para validar si la imagen existe
    // Función para validar si la imagen existe usando cURL
    function imageExists($url)
    {
        $ch = curl_init($url);

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_NOBODY, true); // No descargar el cuerpo, solo los headers
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);



        // Si el código de respuesta HTTP es 200, la imagen existe
        return ($http_code == 200);
    }
    // Verificar si la imagen existe
    if (imageExists($dns_user)) {
        echo "Si existe";
    } else {
        // Si no existe, mostrar una imagen por defecto
        $g = new G();
        $g->SendMessageText("El usuario no tiene la firma cargada", "ERROR");
        PMFRedirectToStep(@@APPLICATION, @@INDEX, 'DYNAFORM', '19704822661d89a84dc5eb6067966042');
    }

    @@tri_user_auditor_firma = '<img style="height:70px;" src="' . $dns_user . '" />';
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
