<?php
//CREATED BY HENRY
//@@frm_codAgente = 101;

if (@@frm_origen_core_insurance == 'INSURANCE') {
    echo '1';
    $group = 'COORDINADOR_INSURANCE_GN';
    $groupUID = PMFGetGroupUID($group);
    $groupArray = PMFGetGroupUsers($groupUID);
    //get a random user from the group
    $rand = array_rand($groupArray);

    $usr_uid = $groupArray[$rand]['USR_UID'];
    $usr_name = $groupArray[$rand]['USR_USERNAME'];
    @@tri_coordinador_sise_insurante = $usr_uid;
    @@tri_grupo_analistas = 'SINIESTROS_ANALISTAS_GN_INSURANCE';
} else {
    $group = 'COORDINADOR_SINIESTROS_GN';
    $groupUID = PMFGetGroupUID($group);
    $groupArray = PMFGetGroupUsers($groupUID);
    //get a random user from the group
    $rand = array_rand($groupArray);
    $usr_uid = $groupArray[$rand]['USR_UID'];
    $usr_name = $groupArray[$rand]['USR_USERNAME'];
    @@tri_coordinador_sise_insurante = $usr_uid;
    @@tri_grupo_analistas = 'SINIESTROS_ANALISTAS_GN';
}


if (@@tri_usr_analista != '') {
    return;
}
//@@frm_codAgente = 962;
$codigo = @@frm_codAgente;
//@@frm_ds_CodsucursalEmision = 1;
$sucursal = @@frm_ds_CodsucursalEmision;
$process = @@PROCESS;

$monto_reclamado = @@valor_solicitado;
//$monto_reclamado = 49998;

if ($monto_reclamado == '') {
    $cobertura = @@grd_cobertura;
    @@valor_solicitado = $cobertura[1]['grd_c_lim_monto_reportado'];
    $monto_reclamado = @@valor_solicitado;
}

//monto_reclamado between campo1 and campo2
$sql_valor = "SELECT CODIGO FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'MONTOS_EJECUTIVOS'
AND CAST($monto_reclamado AS SIGNED)
BETWEEN  CAST(VALOR AS SIGNED)
AND CAST(INTEGRACION AS SIGNED)
AND ESTADO = 1
";

$rs_valor = executeQuery($sql_valor);
$cargo_valor = $rs_valor['1']['CODIGO'];


$sql_analista =
    "SELECT VALOR, CAMPO2 FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$process'
AND COD_CATALOGO = 'EJECUTIVO_X_BROKER'
AND  CODIGO = '$codigo'
AND VALOR = '$sucursal' AND ESTADO = 1
AND CAMPO1 = '$cargo_valor'
ORDER BY RAND()
";
echo $sql_analista;
$rs_a = executeQuery($sql_analista);
$analista = $rs_a['1']['CAMPO2'];

echo $sql_analista;
print_r($rs_a);
echo $analista;

$sql_u = "SELECT USR_UID, USR_STATUS, USR_REPLACED_BY FROM USERS WHERE USR_USERNAME = '$analista'";

$rs_u = executeQuery($sql_u);
echo "<br>$sql_u<br>";
print_r($rs_u);
//CHECK IF ANALISTA IS ACTIVE
if ($rs_u['1']['USR_STATUS'] != 'ACTIVE') {
    $analista = $rs_u['1']['USR_REPLACED_BY'];
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_UID = '$analista'";
    $rs_u = executeQuery($sql_u);
}
echo $rs_u['1']['USR_UID'];
$analista_id = $rs_u['1']['USR_UID'];
@@tri_usr_analista = $analista_id;
if ($analista_id == '' || $analista_id == null || $analista_id == 'null') {
    echo '<br>El agente no tiene analista asignado <br>';
    echo "Analista: $analista_id <br>";
    echo "Sql analista: $sql_analista <br>";
    /* echo 'El agente no tiene analista asignado <br>';
    echo 'Codigo agente: ' . $codigo;
    echo '<br>Codigo sucursal: ' . $sucursal;
    echo '<br>Monto reclamado: ' . $monto_reclamado;
    die();*/
    $sql_analista =
        "SELECT VALOR, CAMPO2 FROM ADMIN_CATALOGOS
    WHERE PRO_UID = '$process'
    AND COD_CATALOGO = 'EJECUTIVO_X_BROKER'
    AND ESTADO = 1
    ORDER BY RAND()
    ";

    $rs_a = executeQuery($sql_analista);

    $analista = $rs_a['1']['CAMPO2'];

    $sql_u = "SELECT USR_UID, USR_STATUS FROM USERS WHERE USR_USERNAME = '$analista'";

    echo "<br>$analista <br>";
    $rs_u = executeQuery($sql_u);
    echo "<br>$sql_u<br>";
    print_r($rs_u);
    //CHECK IF ANALISTA IS ACTIVE
    if ($rs_u['1']['USR_STATUS'] != 'ACTIVE') {
        $analista = $rs_u['1']['USR_REPLACED_BY'];
        $sql_u = "SELECT USR_UID FROM USERS WHERE USR_UID = '$analista'";
        $rs_u = executeQuery($sql_u);
    }
    @@tri_usr_analista = $rs_u['1']['USR_UID'];
}

if (@@tri_usr_analista == '') {
    $mail_ej_portal = @@frm_ii_EmailejecutivoIndemnizaciones;
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$mail_ej_portal'";
    $rs_u = executeQuery($sql_u);
    @@tri_usr_analista = $rs_u['1']['USR_UID'];
}
@@sql_analista = $sql_analista;
//get nombre analista
$analista_id = @@tri_usr_analista;
$sql_n = "SELECT USR_FIRSTNAME, USR_LASTNAME, USR_EMAIL FROM USERS WHERE USR_UID = '$analista_id'";

$rs_n = executeQuery($sql_n);
$nombre_analista = $rs_n['1']['USR_FIRSTNAME'];
$apellido_analista = $rs_n['1']['USR_LASTNAME'];
@@mail_analista =  $rs_n['1']['USR_EMAIL'];
$nombre_analista = $nombre_analista . ' ' . $apellido_analista;
$nombre_analista = strtoupper($nombre_analista);
@@tri_nombre_analista = $nombre_analista;
echo '<br>' . @@tri_usr_analista . ' - ' . $nombre_analista . ' - ' . @@mail_analista;
