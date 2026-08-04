<?php
//created by Henry
//20-08-2020
//Obtener responsable de aprobacion

$cnx = '4647520625f3ca6ed2d2621030136501';
@@tri_next_users_pda = '';

$sql = "SELECT CODIGO, DESCRIPCION, VALOR FROM ADMIN_CATALOGOS
WHERE 
COD_CATALOGO = 'APROBACION_PDA'
AND ESTADO = 1 order by CODIGO";

$rs = executeQuery($sql, $cnx);

$monto = (@@frm_monto_prestamo == '' ? (@@frm_monto*1) : (@@frm_monto_prestamo*1));

//Jefe de operaciones
if ($monto >= ($rs['1']['DESCRIPCION']*1) && $monto < ($rs['1']['VALOR']*1)){
	//grps 9680578435f52f4b5f02274055833214 PR_JEFE_OPER_SEG_INDV
	//grps 2995709175f52f4d22cf848062649993 PR_JEFE_REG_OPERACIONES
	/*$sql = "SELECT USR_UID FROM GROUP_USER WHERE GRP_UID IN ('9680578435f52f4b5f02274055833214','2995709175f52f4d22cf848062649993') GROUP BY USR_UID ORDER BY RAND()";
	$rs = executeQuery($sql);
	@@tri_next_users_pda = $rs['1']['USR_UID'];*/
	$task = '8163617725f3aa929732d82091255154';
	@@tri_next_users_pda = UserCiclicoTarea_PR($task);
	@@tri_next_users_pda_label = 'Jefe de operaciones';
}
//Directora de operaciones
if (@@tri_next_users_pda == '' && ($monto >= ($rs['2']['DESCRIPCION']*1) && $monto < ($rs['2']['VALOR']*1))){
	//grps 5204465565f52f4fc1ca2a2009450611 PR_DIRECT_OPER_REGIONAL
	$sql = "SELECT USR_UID FROM GROUP_USER WHERE GRP_UID = '5204465565f52f4fc1ca2a2009450611' ORDER BY RAND()";
	$rs = executeQuery($sql);
	@@tri_next_users_pda = $rs['1']['USR_UID'];
	@@tri_next_users_pda_label = 'Director de operaciones Regional';
}

//Jefa de beneficios
if (@@tri_next_users_pda == '' && ($monto >= ($rs['3']['DESCRIPCION']*1) && $monto < ($rs['3']['VALOR']*1))){
	//grps 3344876785f52f512847989040963796 PR_JEFE_BIENE_PRESTACION
	$sql = "SELECT USR_UID FROM GROUP_USER WHERE GRP_UID = '3344876785f52f512847989040963796' ORDER BY RAND()";
	$rs = executeQuery($sql);
	@@tri_next_users_pda = $rs['1']['USR_UID'];
	@@tri_next_users_pda_label = 'Jefe de bienes de prestacion';
}
//Gerencia tecnica
if (@@tri_next_users_pda == '' && ($monto >= $rs['4']['DESCRIPCION'] && $monto < $rs['4']['VALOR'])){
	//grps 9764280895f52f597987c32012896425 PR_GERENCIA_TECNICA
	$sql = "SELECT USR_UID FROM GROUP_USER WHERE GRP_UID = '9764280895f52f597987c32012896425' ORDER BY RAND()";
	$rs = executeQuery($sql);
	@@tri_next_users_pda = $rs['1']['USR_UID'];
	@@tri_next_users_pda_label = 'Gerencia Tecnica';
}
//Gerencia General
if (@@tri_next_users_pda == '' && ($monto >= $rs['5']['DESCRIPCION']*1)){
	//grps 9309910305f52f5b085aa36015270452 PR_GERENCIA_GENERAL
	$sql = "SELECT USR_UID FROM GROUP_USER WHERE GRP_UID = '9309910305f52f5b085aa36015270452' ORDER BY RAND()";
	$rs = executeQuery($sql);
	@@tri_next_users_pda = $rs['1']['USR_UID'];
	@@tri_next_users_pda_label = 'Gerencia General';
}