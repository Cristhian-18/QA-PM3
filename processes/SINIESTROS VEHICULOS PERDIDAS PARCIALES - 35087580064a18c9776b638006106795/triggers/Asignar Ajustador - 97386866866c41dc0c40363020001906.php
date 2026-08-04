<?php
//Asignar Ajustador

$pro_uid = @@PROCESS;
$group = 'VH_SINIESTROS_AJUSTADORES_INTERNOS';

$groupUID = PMFGetGroupUID($group);
$groupArray = PMFGetGroupUsers($groupUID);

//print_r($groupArray);

$group_analistas = 'SINIESTROS_ANALISTAS_VH';
$groupUID_analistas = PMFGetGroupUID($group_analistas);
$groupArray_analistas = PMFGetGroupUsers($groupUID_analistas);



//get user name
$current_user = @@USER_LOGGED;
//select a random  and assign it to the variable
foreach ($groupArray as $user) {
    if ($user['USR_UID'] == $current_user) {
        $usr_uid = $user['USR_UID'];
        echo 'Same user';
        @@tri_user_auditor = $usr_uid;
        return;
    }
}

$tipo_veh = @@frm_vehiculo_tipo;

if ($tipo_veh != "PESADO") {
    $tipo_veh = "LIVIANO";
}
echo 'ajustador';
$provincia_accidente = @@frm_accidente_provincia;
echo $provincia_accidente;
if ($provincia_accidente == '' || $provincia_accidente == 'undefined') {
    $provincia_accidente = 0;
}
//to int
$provincia_accidente = $provincia_accidente * 1;

$sql = "SELECT CODIGO FROM ADMIN_CATALOGOS WHERE
     PRO_UID = '$pro_uid'
     AND COD_CATALOGO = 'AJUSTADORES_PROVINCIA'
     AND DESCRIPCION = '$tipo_veh'
     AND VALOR = '$provincia_accidente'
     AND ESTADO = 1
     ORDER BY RAND() LIMIT 1";
echo $sql;
$rs = executeQuery($sql);
print_r($rs);
if (empty($rs)) {
    echo 'No hay ajustador';

    $sql = "SELECT CODIGO FROM ADMIN_CATALOGOS WHERE
     PRO_UID = '$pro_uid'
     AND COD_CATALOGO = 'AJUSTADORES_PROVINCIA'
     AND DESCRIPCION = '$tipo_veh'
     AND VALOR = ''
     AND ESTADO = 1
     ORDER BY RAND() LIMIT 1";
    echo $sql;
    $rs = executeQuery($sql);
}

$userName = $rs['1']['CODIGO'];

$sql_user = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$userName'";
$rs_user = executeQuery($sql_user);

@@tri_user_auditor = $rs_user['1']['USR_UID'];

if ($rs_user['1']['USR_UID'] == '') {
    echo 'No hay ajustador asignado con los siguientes criterios:';
    echo 'Tipo de vehiculo: ' . $tipo_veh;
    echo 'Provincia: ' . $provincia_accidente;
    echo 'Ajustador: ' . $userName;
    echo 'No se puede continuar';
   die();

}


if(@@@@tri_user_auditor == ''){

}
