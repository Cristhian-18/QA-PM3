<?php
$sql = "SELECT VALOR, DESCRIPCION, INTEGRACION, CAMPO1
            FROM ADMIN_CATALOGOS
            WHERE CODIGO = 'PORTAL_AUTH'
            AND PRO_UID = '820474191615f602d3c4b33049036948'
            LIMIT 1;";

    $result = executeQuery($sql);
    $token_portal = $result[1]['DESCRIPCION'] ?? '';
    $url_portal = $result[1]['VALOR']       ?? '';
    $user = $result[1]['INTEGRACION'] ?? '';
    $password = $result[1]['CAMPO1']      ?? '';

    // Solicitar nuevo token al API
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url_portal,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode([
            'usuarioAcceso' => $user,
            'clave'         => $password,
            ]),
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Accept: application/json',
        'API-KEY: ' . $token_portal,
        ],
        ]);

    

    //fin
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    

    curl_close($ch);

    if ($error || $httpCode < 200 || $httpCode >= 300) {
        die(json_encode(['error' => 'No se pudo obtener el token']));
    }

    $datos = json_decode($response, true);
 
    $token = $datos['token'];

    @@token_portal =  $token;
