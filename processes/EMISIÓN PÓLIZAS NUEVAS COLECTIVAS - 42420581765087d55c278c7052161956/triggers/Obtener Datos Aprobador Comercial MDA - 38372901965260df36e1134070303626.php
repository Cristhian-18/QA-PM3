<?php
//Obtener Datos Aprobador Comercial MDA
//26-09-2023
//Henry

$pro_uid = @@PROCESS;
$data_user = PMFInformationUser(@@tri_user_inicial);
$username = $data_user['username'];
@@tri_bandera_mda_comercial = 'false';
@@tri_bandera_mda_tecnico = 'false';
@@tri_bandera_evaluacion = 'false';
//DATOS DE LOS DIRECTORES
$sql = "SELECT CAMPO1, CAMPO2, VALOR, INTEGRACION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'DELEGACION_DIRECTORES' AND ESTADO = 1 AND CODIGO = '$username'";
$rs = executeQuery($sql);

$tri_director_comercial = UidUsuario($rs['1']['CAMPO1']);
$tri_director_especialista = UidUsuario($rs['1']['CAMPO2']);
$tri_director_unidad = UidUsuario($rs['1']['INTEGRACION']);
$tri_gerencia_senior = UidUsuario($rs['1']['VALOR']);

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
				@@frm_accion = 'FINALIZAR';
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
				@@frm_accion = 'FINALIZAR';
			}
		}
	}
}

@@tri_user_mda_comercial = @@USER_LOGGED;