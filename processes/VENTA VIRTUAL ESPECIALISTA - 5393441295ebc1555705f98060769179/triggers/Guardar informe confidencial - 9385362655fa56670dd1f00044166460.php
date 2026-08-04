<?php
$cnx = "1479570925ec29f1d8d1d57019959618";

$app_uid =  @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status =  '';

$frm_infconf_a=@@frm_infconf_a;
$frm_infconf_a_parentesco=@@frm_infconf_a_parentesco;
$frm_infconf_a_contacto=@@frm_infconf_a_contacto;
$frm_infconf_a_detalle=@@frm_infconf_a_detalle;
$frm_infconf_b=@@frm_infconf_b;
$frm_infconf_b_detalle=@@frm_infconf_b_detalle;
$frm_infconf_c=@@frm_infconf_c;
$frm_infconf_c_detalle=@@frm_infconf_c_detalle;
$frm_infconf_d=@@frm_infconf_d;
$frm_infconf_d_detalle=@@frm_infconf_d_detalle;
$frm_infconf_e=@@frm_infconf_e;
$frm_infconf_f=@@frm_infconf_f;
$frm_infconf_f_detalle=@@frm_infconf_f_detalle;
$frm_infconf_g=@@frm_infconf_g;
$frm_infconf_g_detalle=@@frm_infconf_g_detalle;
$frm_infconf_observaciones=@@frm_infconf_observaciones;
$frm_infconf_morfologia=@@frm_infconf_morfologia;

// @@alguna_condicion = 'insertar';//Solo para pruebas despues borrar
if(@@alguna_condicion == 'insertar'){

$sql = "INSERT INTO pe_informacion_confidencial
            (APP_UID,
             APP_NUMBER,
             APP_STATUS,
             FRM_INFCONF_A,
             FRM_INFCONF_A_PARENTESCO,
             FRM_INFCONF_A_CONTACTO,
             FRM_INFCONF_A_DETALLE,
             FRM_INFCONF_B,
             FRM_INFCONF_B_DETALLE,
             FRM_INFCONF_C,
             FRM_INFCONF_C_DETALLE,
             FRM_INFCONF_D,
             FRM_INFCONF_D_DETALLE,
             FRM_INFCONF_E,
             FRM_INFCONF_F,
             FRM_INFCONF_F_DETALLE,
             FRM_INFCONF_G,
             FRM_INFCONF_G_DETALLE,
             FRM_INFCONF_OBSERVACIONES,
             FRM_INFCONF_MORFOLOGIA)
VALUES (
		'$app_uid',
        '$app_number',
        '$app_status',
        '$frm_infconf_a',
        '$frm_infconf_a_parentesco',
        '$frm_infconf_a_contacto',
        '$frm_infconf_a_detalle',
        '$frm_infconf_b',
        '$frm_infconf_b_detalle',
        '$frm_infconf_c',
        '$frm_infconf_c_detalle',
        '$frm_infconf_d',
        '$frm_infconf_d_detalle',
        '$frm_infconf_e',
        '$frm_infconf_f',
        '$frm_infconf_f_detalle',
        '$frm_infconf_g',
        '$frm_infconf_g_detalle',
        '$frm_infconf_observaciones',
        '$frm_infconf_morfologia'
		)";

}else{		

$sql = "UPDATE pe_informacion_confidencial
SET 
APP_STATUS	=	'$app_status',
FRM_INFCONF_A	=	'$frm_infconf_a',
FRM_INFCONF_A_PARENTESCO	=	'$frm_infconf_a_parentesco',
FRM_INFCONF_A_CONTACTO	=	'$frm_infconf_a_contacto',
FRM_INFCONF_A_DETALLE	=	'$frm_infconf_a_detalle',
FRM_INFCONF_B	=	'$frm_infconf_b',
FRM_INFCONF_B_DETALLE	=	'$frm_infconf_b_detalle',
FRM_INFCONF_C	=	'$frm_infconf_c',
FRM_INFCONF_C_DETALLE	=	'$frm_infconf_c_detalle',
FRM_INFCONF_D	=	'$frm_infconf_d',
FRM_INFCONF_D_DETALLE	=	'$frm_infconf_d_detalle',
FRM_INFCONF_E	=	'$frm_infconf_e',
FRM_INFCONF_F	=	'$frm_infconf_f',
FRM_INFCONF_F_DETALLE	=	'$frm_infconf_f_detalle',
FRM_INFCONF_G	=	'$frm_infconf_g',
FRM_INFCONF_G_DETALLE	=	'$frm_infconf_g_detalle',
FRM_INFCONF_OBSERVACIONES	=	'$frm_infconf_observaciones',
FRM_INFCONF_MORFOLOGIA	=	'$frm_infconf_morfologia'
WHERE APP_UID = '$app_uid'
    AND APP_NUMBER = '$app_number'";
}

$rs_d = executeQuery($sql,$cnx);	

// @@sql_prueba = $sql;	//Solo para pruebas despues borrar







