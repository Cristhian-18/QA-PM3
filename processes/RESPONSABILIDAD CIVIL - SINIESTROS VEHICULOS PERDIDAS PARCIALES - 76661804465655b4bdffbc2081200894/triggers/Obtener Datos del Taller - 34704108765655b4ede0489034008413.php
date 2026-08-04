<?php
//Obtener Datos del Taller

$cnx_rp = '934957180650c74e8ed0e10096114321';

if(@@TASK == '21947251964a193141bc7e8005186014'){
    $usruid = @@USER_LOGGED;
}else{
    $usruid = @@tri_user_taller;
}

$aUser = PMFInformationUser($usruid);

$tri_taller_mail = $aUser['mail'];

$sql = "SELECT
id_sise,
nombre_taller,
representante,
nombre_contacto,
telefono_contacto,
email_taller,
cod_provincia,
provincia,
cod_canton,
canton,
direccion,
sector,
tipo,
cod_marca,
marcas,
prioridad,
capacidad,
estado,
ruc_taller
FROM
SINIESTROS_DIRECCIONADOR
WHERE email_taller = '$tri_taller_mail'
";

$rs = executeQuery($sql);

if(empty($rs)){
    $tri_taller_mail = $aUser['position'];
    $sql = "SELECT
    id_sise,
    nombre_taller,
    representante,
    nombre_contacto,
    telefono_contacto,
    email_taller,
    cod_provincia,
    provincia,
    cod_canton,
    canton,
    direccion,
    sector,
    tipo,
    cod_marca,
    marcas,
    prioridad,
    capacidad,
    estado,
    ruc_taller
    FROM
    SINIESTROS_DIRECCIONADOR
    WHERE email_taller = '$tri_taller_mail'
    ";

    $rs = executeQuery($sql);
}

if(empty($rs)){
    return;
}


@@frm_taller = $rs['1']['nombre_taller'];
@@frm_taller_nombreContacto = $rs['1']['nombre_contacto'];
@@frm_taller_telefonoContacto = $rs['1']['telefono_contacto'];
@@frm_taller_email = $rs['1']['email_taller'];
@@frm_taller_provincia = $rs['1']['provincia'];
@@frm_taller_ciudad = $rs['1']['canton'];
@@frm_taller_direccion = $rs['1']['direccion'];
@@frm_taller_sector = $rs['1']['sector'];
@@frm_taller_tipo = $rs['1']['tipo'];

//RUC TALLER - Cristhian 17/07/2026
@@frm_ruc_taller = $rs['1']['ruc_taller'];