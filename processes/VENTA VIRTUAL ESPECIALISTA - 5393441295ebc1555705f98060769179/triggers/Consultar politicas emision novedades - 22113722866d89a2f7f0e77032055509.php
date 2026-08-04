<?php
//<?php
//Consultar Politicas de suscripcion

$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$process = @@PROCESS;

/*	QUITAR ESTE CODIGO CUANDO YA ESTEN TODOS LOS CASOS DESDE T7*/
/*$frm_aps_codigo_tipoAgente = @@frm_aps_codigo_tipoAgente;
//extrae el tipo agente label
$sql_tipoagen = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'ttipo_agente' and CODIGO = '$frm_aps_codigo_tipoAgente'";
$rs_tipoagen = executeQuery($sql_tipoagen, $cnx_rp);
@@frm_aps_codigo_tipoAgente_label = $rs_tipoagen[1]['DESCRIPCION'];*/
/*HASTA AQUI*/

$sql = "SELECT * FROM ADMIN_CATALOGOS 
WHERE COD_CATALOGO = 'POLITICAS_EMSION' 
AND ESTADO = 1";

$rs  = executeQuery($sql, $cnx_rp);

$arr_politicas = array();

$aux = 1;
$bandera = true;

foreach($rs as $data){
	$cod = $data['CODIGO'];
	switch($cod){
		case "CODIGOS":
			$tri_CodAseg_SISE = @@tri_CodAseg_SISE;
			if($tri_CodAseg_SISE == '' ){
				$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['frm_polemi_resultado'] = $data['VALOR'];
				$arr_politicas[$aux]['frm_polemi_obs'] = $data['CAMPO2'];
				$bandera = false;
			} else {
				$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['frm_polemi_resultado'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['frm_polemi_obs'] = 'APROBADO';
			}
		break;
		case "SUSCRIPCION":
			if(@@frm_accion_suscripcion != 'APROBAR'){
				$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['frm_polemi_resultado'] = $data['VALOR'];
				$arr_politicas[$aux]['frm_polemi_obs'] = $data['CAMPO2'];
				$bandera = false;
			}else{
				$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['frm_polemi_resultado'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['frm_polemi_obs'] = 'APROBADO';
			}
		break;
		case "EMISION":
			if(@@frm_accion_emisiona == 'ERROR'){
				$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['frm_polemi_resultado'] = 'NO';				
				$arr_politicas[$aux]['frm_polemi_obs'] = @@tri_emision_respuesta_label;
				$bandera = false;
			}else{
				$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['frm_polemi_resultado'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['frm_polemi_obs'] = 'APROBADO';
			}
		break;
		case "TARIFA":
			if(@@frm_accion_emision == 'CONTINUAR'){	
				if (@@tri_decision_magnum_result == 'REFER'){
					$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
					$arr_politicas[$aux]['frm_polemi_resultado'] = $data['VALOR'];
					$arr_politicas[$aux]['frm_polemi_obs'] = $data['CAMPO2'];
				}else{
					$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
					$arr_politicas[$aux]['frm_polemi_resultado'] = $data['INTEGRACION'];
					$arr_politicas[$aux]['frm_polemi_obs'] = 'APROBADO';
				}
			}else{
				if (@@tri_decision_magnum_result == 'REFER'){
					$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
					$arr_politicas[$aux]['frm_polemi_resultado'] = $data['VALOR'];
					$arr_politicas[$aux]['frm_polemi_obs'] = $data['CAMPO2'];
				}else{
					$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
					$arr_politicas[$aux]['frm_polemi_resultado'] = $data['VALOR'];
					$arr_politicas[$aux]['frm_polemi_obs'] = @@frm_accion_emision;
				}
				$bandera = false;
			}
		break;
		case "ASEGURADO":
			$tri_CodAseg_SISE = @@tri_CodAseg_SISE;
			if($tri_CodAseg_SISE == '' ){
				$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['frm_polemi_resultado'] = $data['VALOR'];
				$arr_politicas[$aux]['frm_polemi_obs'] = $data['CAMPO2'];
				$bandera = false;
			} else {
				$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['frm_polemi_resultado'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['frm_polemi_obs'] = 'APROBADO';
			}
		break;
		default:
			//codigo
			$arr_politicas[$aux]['frm_polemi_descripcion'] = $data['DESCRIPCION'];
			$arr_politicas[$aux]['frm_polemi_resultado'] = $data['INTEGRACION'];
			$arr_politicas[$aux]['frm_polemi_obs'] = 'APROBADO';
		break;
	
	}
	$aux = $aux+1;	
}
@=grd_politicas_emision = $arr_politicas;


