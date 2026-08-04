<?php
//Asignar Ajustador

$pro_uid = '35087580064a18c9776b638006106795';
$group = 'VH_SINIESTROS_AJUSTADORES_INTERNOS';
$groupUID = PMFGetGroupUID($group);
$groupArray = PMFGetGroupUsers($groupUID);

//print_r($groupArray);

$group_analistas = 'SINIESTROS_ANALISTAS_VH';
$groupUID_analistas = PMFGetGroupUID($group_analistas);
$groupArray_analistas = PMFGetGroupUsers($groupUID_analistas);



//get user name 
$current_user = @@USER_LOGGED;

foreach ($groupArray as $auditor) {
    echo "Checking user: " . $auditor['USR_UID'] . "<br>";
    if ($auditor['USR_UID'] == $current_user) {
        $usr_uid = $auditor['USR_UID'];
        @@tri_user_auditor = $usr_uid;        
        return;
    }
}

$tipo_veh = @@frm_vehiculo_tipo;

if ($tipo_veh != "PESADO") {
    $tipo_veh = "LIVIANO";
}

$provincia_accidente = @@frm_accidente_provincia;
if ($provincia_accidente == '' || $provincia_accidente == 'undefined') {
    $provincia_accidente = 17;
}
$provincia_accidente = $provincia_accidente * 1;

$sql = "SELECT CODIGO FROM ADMIN_CATALOGOS WHERE
     PRO_UID = '$pro_uid' 
     AND COD_CATALOGO = 'AJUSTADORES_PROVINCIA' 
     AND DESCRIPCION = '$tipo_veh'
     AND VALOR = '$provincia_accidente' 
     AND ESTADO = 1
     ORDER BY RAND() LIMIT 1";
$rs = executeQuery($sql);
if (empty($rs)) {

    $sql = "SELECT CODIGO FROM ADMIN_CATALOGOS WHERE
     PRO_UID = '$pro_uid' 
     AND COD_CATALOGO = 'AJUSTADORES_PROVINCIA' 
     AND DESCRIPCION = '$tipo_veh'
	 AND VALOR = ''
     AND ESTADO = 1
     ORDER BY RAND() LIMIT 1";
    $rs = executeQuery($sql);
}

$userName = $rs['1']['CODIGO'];

$sql_user = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$userName'";
$rs_user = executeQuery($sql_user);

@@tri_user_auditor = $rs_user['1']['USR_UID'];
