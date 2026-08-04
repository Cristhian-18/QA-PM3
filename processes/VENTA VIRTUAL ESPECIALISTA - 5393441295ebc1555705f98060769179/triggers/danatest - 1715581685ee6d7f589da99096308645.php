<?php
@@dana_texto_mail="Cuerpo";
@@dana_asunto_mail="Autorización de Débito";
$data = array(
    "TipoId"=>"",
    "Identificacion"=>@@dana_asunto_mail,
    "Nombres"=>"",
    "Apellidos"=>"",
    "Celular"=>"0997942334",
    "Email"=>"faustol@gmail.com",
    "NombreEjecutivo"=>"",
    "EmailEjecutivo"=>"",
    "CelularEjecutivo"=>"",
    "CanalEjecutivo"=>"Especialista",
    "AsuntoMail"=>"",
    "TextoMail"=>"",
    "LinkSolicitud"=>"",
    "LinkAutorizacion"=>"",
    "LinkPep"=>"",
    "LinkCovid"=>"",
    "IdProceso"=>@@APPLICATION

);
$conversation_id=@@conversation_debito_id;
$url = @@conversation_debito_url1.$conversation_id.@@conversation_debito_url2;

@@tmp_url = $url;
$usr=$usuario.":".$clave;
$usr=@@conversation_debito_key;
$data= json_encode($data);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => $url,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Basic ". $usr
    ),
    CURLOPT_POSTFIELDS	=>	$data
));

try{
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    curl_close($curl);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'danatest',
        $url,
        'POST',
        "Authorization: Basic ",
        $data,
        $response,
        $err
    );


    $datos['data'] = json_decode($response,true);
    @@resultado_dana=$datos['data']['wsResult']['resultDescription'];
    if(@@resultado_dana!="OK"){
        $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='5982362815ec6d7c2831b84011722634' and STEP_POSITION = 1");
        @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);

        $g = new G();
        $g->SendMessageText("Error al enviar al cliente", "WARNING");
    }
}
catch(SoapFault $result){
    $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='5982362815ec6d7c2831b84011722634' and STEP_POSITION = 1");
    @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);

    $g = new G();
    $g->SendMessageText("Error al enviar al cliente", "WARNING");
}
