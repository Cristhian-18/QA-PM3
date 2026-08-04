<?php
//Obtener Datos Aprobadores MDA
//26-09-2023
//Henry

@@frm_accion_t = null;
@@frm_accion_c = null;


$pro_uid = @@PROCESS;
$data_user = PMFInformationUser(@@tri_user_inicial);
$username = $data_user['username'];
@@tri_bandera_mda_comercial = 'false';
@@tri_bandera_mda_tecnico = 'false';
@@tri_bandera_evaluacion = 'false';
@@tri_bandera_mda = '';
//DATOS DE LOS DIRECTORES
$sql = "SELECT CAMPO1, CAMPO2, VALOR, INTEGRACION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'DELEGACION_DIRECTORES' AND ESTADO = 1 AND CODIGO = '$username'";
$rs = executeQuery($sql);

$tri_director_comercial = UidUsuario($rs['1']['CAMPO1']);
$tri_director_especialista = UidUsuario($rs['1']['CAMPO2']);
$tri_director_unidad = UidUsuario($rs['1']['INTEGRACION']);
$tri_gerencia_senior = UidUsuario($rs['1']['VALOR']);

//DATOS DE LOS SUSCRIPTORES
$username = @@USR_USERNAME;
$sql = "SELECT DESCRIPCION, VALOR, INTEGRACION, CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'DELEGACION_SUCRIPTORES' AND ESTADO = 1 AND CODIGO = '$username'";
$rs = executeQuery($sql);

$tri_suscriptor_junior = UidUsuario($rs['1']['DESCRIPCION']);
$tri_suscriptor_senior = UidUsuario($rs['1']['VALOR']);
$tri_coordinador_suscriptor = UidUsuario($rs['1']['INTEGRACION']);
$tri_jefe_suscriptor = UidUsuario($rs['1']['CAMPO1']);
$tri_gerente_tecnico = UidUsuario($rs['1']['CAMPO2']);

//validacion por linea de negocio
$frm_utilidad = @@frm_datosCotizacion_utilidad;
$frm_monto = @@frm_datosCotizacion_primaNeta;
if(@@frm_datosSolicitud_linea == 'masivo'){
	$sql = "SELECT VALOR, INTEGRACION, CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'MDA_MASIVO' AND ESTADO = 1";
	$rs = executeQuery($sql);
	foreach($rs as $data){
		$utilidad = str_replace("utilidad",$frm_utilidad,$data['CAMPO1']);
		$monto = str_replace("monto",$frm_monto,$data['CAMPO2']);		
		ob_start();
		eval( ' echo('.$utilidad.' ? "true":"false");' );
		$scrp_utili = ob_get_contents();
		ob_end_clean();
		ob_start();
		eval( ' echo ('.$monto.' ? "true":"false");' );
		$scrp_monto = ob_get_contents();
		ob_end_clean();
		if($scrp_utili == 'true' && $scrp_monto == 'true') {
			$arr_resul[$data['INTEGRACION']] = $data['VALOR'];
		}
	}
	foreach($arr_resul as $keydata => $data){
		if($keydata == 'COMERCIAL'){
			if($data == 'EJECUTIVO' || $data == 'COMITE'){
				 @@tri_user_mda_comercial = @@tri_user_inicial;
				if($data == 'COMITE')
					@@tri_bandera_mda = 'true';
			}
			if($data == 'DIRECTOR_COMERCIAL'){
				@@tri_user_mda_comercial = $tri_director_comercial;
			}
			if($data == 'DIRECTOR_ESPECIALISTA'){
				@@tri_user_mda_comercial = $tri_director_especialista;
			}
			if($data == 'GERENCIA_SENIOR'){
				@@tri_user_mda_comercial = $tri_gerencia_senior;
			}
			if($data == 'FIN'){
				@@frm_accion = 'REGRESAR';
				@@tri_bandera_evaluacion = 'true';
			}
		}else{
			if($data == 'SUSCRIPTOR_JUNIOR' || $data == 'COMITE'){
				 @@tri_user_mda_tecnico = $tri_suscriptor_junior;
				if($data == 'COMITE')
					@@tri_bandera_mda = 'true';
			}
			if($data == 'SUSCRIPTOR_SENIOR'){
				@@tri_user_mda_tecnico = $tri_suscriptor_senior;
			}
			if($data == 'COORDINADOR_SUSCRIPCION'){
				@@tri_user_mda_tecnico = $tri_coordinador_suscriptor;
			}
			if($data == 'JEFE_SUSCRIPCION'){
				@@tri_user_mda_tecnico = $tri_jefe_suscriptor;
			}
			if($data == 'GERENCIA_TECNICO'){
				@@tri_user_mda_tecnico = $tri_gerente_tecnico;
			}
			if($data == 'FIN'){
				@@frm_accion = 'REGRESAR';
				@@tri_bandera_evaluacion = 'true';
			}
		}

	}
	
}else{
	$sql = "SELECT VALOR, INTEGRACION, CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'MDA_CORPORATIVO' AND ESTADO = 1";
	$rs = executeQuery($sql);
	foreach($rs as $data){
		$utilidad = str_replace("utilidad",$frm_utilidad,$data['CAMPO1']);
		$monto = str_replace("monto",$frm_monto,$data['CAMPO2']);		
		ob_start();
		eval( ' echo('.$utilidad.' ? "true":"false");' );
		$scrp_utili = ob_get_contents();
		ob_end_clean();
		ob_start();
		eval( ' echo ('.$monto.' ? "true":"false");' );
		$scrp_monto = ob_get_contents();
		ob_end_clean();
		if($scrp_utili == 'true' && $scrp_monto == 'true') {
			$arr_resul[$data['INTEGRACION']] = $data['VALOR'];
		}
	}
	foreach($arr_resul as $keydata => $data){
		if($keydata == 'COMERCIAL'){
			if($data == 'EJECUTIVO' || $data == 'COMITE'){
				 @@tri_user_mda_comercial = @@tri_user_inicial;
				if($data == 'COMITE')
					@@tri_bandera_mda = 'true';
			}
			if($data == 'DIRECTOR_COMERCIAL'){
				@@tri_user_mda_comercial = $tri_director_comercial;
			}
			if($data == 'DIRECTOR_UNIDAD'){
				@@tri_user_mda_comercial = $tri_director_unidad;
			}
			if($data == 'DIRECTOR_ESPECIALISTA'){
				@@tri_user_mda_comercial = $tri_director_especialista;
			}
			if($data == 'GERENCIA_SENIOR'){
				@@tri_user_mda_comercial = $tri_gerencia_senior;
			}
			if($data == 'FIN'){
				@@frm_accion = 'REGRESAR';
				@@tri_bandera_evaluacion = 'true';
			}
		}else{
			if($data == 'SUSCRIPTOR_JUNIOR' || $data == 'COMITE'){
				 @@tri_user_mda_tecnico = $tri_suscriptor_junior;
				if($data == 'COMITE')
					@@tri_bandera_mda = 'true';
			}
			if($data == 'SUSCRIPTOR_SENIOR'){
				@@tri_user_mda_tecnico = $tri_suscriptor_senior;
			}
			if($data == 'COORDINADOR_SUSCRIPCION'){
				@@tri_user_mda_tecnico = $tri_coordinador_suscriptor;
			}
			if($data == 'JEFE_SUSCRIPCION'){
				@@tri_user_mda_tecnico = $tri_jefe_suscriptor;
			}
			if($data == 'GERENCIA_TECNICO'){
				@@tri_user_mda_tecnico = $tri_gerente_tecnico;
			}
			if($data == 'FIN'){
				@@frm_accion = 'REGRESAR';
				@@tri_bandera_evaluacion = 'true';
			}
		}
	}
}