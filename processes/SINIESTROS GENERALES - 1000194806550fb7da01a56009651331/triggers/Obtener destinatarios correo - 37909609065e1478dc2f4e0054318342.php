<?php
//
$process = @@PROCESS;

$sql_emails_suscriptores = "
SELECT DESCRIPCION FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'DESTINATARIOS_CORREOS'
AND PRO_UID = '$process'
AND CODIGO = 'SUSCRIPTORES'
";

$rs_sql_emails_suscriptores = executeQuery($sql_emails_suscriptores);

$array_correos = array();



$operacion = @@frm_ds_tipoOperacion;
$facultado = @@tri_tipo_operacion;

if ($operacion == 'DIRECTA' && $facultado == 1) {
    $operacion = 'Facultado';
}

$sql_emails_operacion = "
SELECT DESCRIPCION FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'DESTINATARIOS_CORREOS'
AND PRO_UID = '$process'
AND CODIGO = '$operacion' AND ESTADO = 1";

$rs_sql_emails_operacion = executeQuery($sql_emails_operacion);

//add the emails to the array
foreach ($rs_sql_emails_operacion as $email) {
    if (!in_array($email['DESCRIPCION'], $array_correos)) {
        $array_correos[] = $email['DESCRIPCION'];
    }
}

$valor_siniestro = @@valor_solicitado ? intval(@@valor_solicitado) : 0;


if ($valor_siniestro > 4999.99) {
    //add the emails to the array
    foreach ($rs_sql_emails_suscriptores as $email) {
        $array_correos[] = $email['DESCRIPCION'];
    };
    
    $array_ciudad = array();
    $array_ciudad = @@grd_ramos;

    $ciudad = $array_ciudad[1]['grd_r_sucursal'] ? $array_ciudad[1]['grd_r_sucursal'] : '';

    $sql_emails_ciudad = "
    SELECT DESCRIPCION FROM ADMIN_CATALOGOS 
    WHERE COD_CATALOGO = 'DESTINATARIOS_CORREOS'
    AND PRO_UID = '$process'
    AND CODIGO = '$ciudad' AND ESTADO = 1
    ";

    $rs_sql_emails_ciudad = executeQuery($sql_emails_ciudad);

    //add the emails to the array 
    //check if already exists
    foreach ($rs_sql_emails_ciudad as $email) {
        if (!in_array($email['DESCRIPCION'], $array_correos)) {
            $array_correos[] = $email['DESCRIPCION'];
        }
    }
}
//make everything a single string separated by comma
@@array_coreos = $array_correos;
$array_correos = implode(',', $array_correos);

if (@@tri_tipo_operacion == '1') {
    $tipo = @@frm_ds_tipoOperacion;

    if ($tipo == 'DIRECTA(FC)') {
        $sql_u = "SELECT USR_EMAIL FROM USERS WHERE USR_USERNAME = 'mcarrera'";
        $rs_u = executeQuery($sql_u);
        $email = $rs_u['1']['USR_EMAIL'];
    } else {
        $sql_u = "SELECT USR_EMAIL FROM USERS WHERE USR_USERNAME = 'ravelasco'";
        $rs_u = executeQuery($sql_u);
        $email = $rs_u['1']['USR_EMAIL'];
    }
    $mail_analista = @@mail_analista;
    $array_correos = $array_correos . ',' . $email . ',' . $mail_analista;
} else {
    $mail_analista = @@mail_analista;
    $array_correos = $array_correos . ',' . $mail_analista;
}

@@tri_destinatarios_correos = $array_correos;
