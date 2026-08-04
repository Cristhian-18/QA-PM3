<?php
//Obtener Datos Directores
//26-09-2023
//Henry

$pro_uid = @@PROCESS;
$username = @@USR_USERNAME;

$sql = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'DELEGACION_DIRECTORES' AND ESTADO = 1 AND CODIGO = '$username'";
$rs = executeQuery($sql);

$tri_director_comercial = $rs['1']['CAMPO1'];
@@$tri_director_comercial = $tri_director_comercial;
$sql_u = "SELECT USR_UID, USR_FIRSTNAME, USR_LASTNAME FROM USERS WHERE USR_USERNAME = '$tri_director_comercial'";
$rs_u = executeQuery($sql_u);
@@tri_data_director_comercial = $rs_u['1'];

$tri_director_especialista = $rs['1']['CAMPO2'];
@@tri_director_especialista = $tri_director_especialista;
$sql_u = "SELECT USR_UID, USR_FIRSTNAME, USR_LASTNAME FROM USERS WHERE USR_USERNAME = '$tri_director_especialista'";
$rs_u = executeQuery($sql_u);
@@tri_data_director_especialista = $rs_u['1'];

@@frm_datosSolicitud_directorComercial = @@tri_data_director_comercial['USR_FIRSTNAME']. ' ' .@@tri_data_director_comercial['USR_LASTNAME'];
@@frm_datosSolicitud_directorEspecialista = @@tri_data_director_especialista['USR_FIRSTNAME']. ' ' .@@tri_data_director_especialista['USR_LASTNAME'];

//ejecutivo comercial 
$data_user = PMFInformationUser(@@USER_LOGGED);
@@frm_datosSolicitud_solicitante = $data_user['firstname']. ' ' .$data_user['lastname'];

/* solicitado por frm_datosSolicitud_solicitante
frm_datosSolicitud_directorComercial
frm_datosSolicitud_directorEspecialista*/

