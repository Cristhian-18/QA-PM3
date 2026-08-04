<?php
$sql = "SELECT * FROM APP_MESSAGE 
WHERE APP_MSG_DATE > '2025-11-01 00:00:00'
AND APP_MSG_STATUS IN ('failed') limit 5";

$rs = executeQuery($sql);
$from = "bpmgenerales@equisuiza.com";


foreach($rs as $row){
	$to   = cleanEmailList($row['APP_MSG_TO']);
    $cc_  = cleanEmailList($row['APP_MSG_CC']);
    $bcc_ = cleanEmailList($row['APP_MSG_BCC']);
	
	$subject = $row['APP_MSG_SUBJECT'];
	$template = $row['APP_MSG_BODY'];
	
	$estado = PMFSendMessage($row['APP_UID'],$from,$to, $cc_, $bcc_, $subject, $template, array());
	
	echo "Correo enviado para {$row['APP_UID']} -> Estado: $estado <br>";
    
    sleep(5);
}


function cleanEmailList($raw) {
    if (empty($raw)) return [];

    // Elimina caracteres innecesarios (comas y espacios al inicio o final)
    $raw = trim($raw, ", \t\n\r\0\x0B");

    // Divide por coma y limpia cada dirección
    $emails = array_map('trim', explode(',', $raw));

    // Filtra vacíos y valida formato de email
    $emails = array_filter($emails, function ($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    });

    // Elimina duplicados y devuelve como array limpio
    return array_values(array_unique($emails));
}