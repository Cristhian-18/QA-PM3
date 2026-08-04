<?php
//<?phpObtener Ruta Suscripcion
//created by Henry
//5-3-2024
 
$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$process = @@PROCESS;
$pro_uid = @@PROCESS;
$tri_decision_magnum_result = @@tri_decision_magnum_result;
$sql = "SELECT * FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'POLITICAS_SUSCRIPCION'
AND ESTADO = 1";
    $rs  = executeQuery($sql, $cnx_rp);

$arr_politicas = array();

$aux = 1;
$bandera = true;
@@banderaContratanteEsAsegurado = 'NO';
@@banderaPasoControlSuscripcion = 'NO';
foreach($rs as $data){
	$cod = $data['CODIGO'];
	switch($cod){
		case "REFUGIADO":
			$tipo_visa = @@frm_tipo_visa;
			if($tipo_visa == 10 || $tipo_visa == '10' ){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
				$bandera = false;
			} else {
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}
		break;
		case "AUTOCERTIFICACION_FISCAL":
			if(@@frm_plan_pago_impuestos == 'NO'){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
				$bandera = false;
			}else{
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}
		break;
			/*duplicados*/
		case "DUPLICADOS":
			$identifica = @@frm_numero_identificacion;
			$app_number = @@APP_NUMBER;
			$sql = "SELECT COUNT(APP_NUMBER) AS grd_num_caso FROM PMT_VV_MAGNUM WHERE FRM_NUMERO_IDENTIFICACION = '$identifica'
			AND APP_NUMBER <> $app_number AND HTML_DECISION_MAGNUM <> '' AND TRI_DECISION_MAGNUM_RESULT <> '$tri_decision_magnum_result'";
			$sql_2= "SELECT * FROM PMT_VV_MAGNUM WHERE FRM_NUMERO_IDENTIFICACION = '$identifica' AND APP_NUMBER <> $app_number
			AND HTML_DECISION_MAGNUM <> '' AND TRI_DECISION_MAGNUM_RESULT <> '$tri_decision_magnum_result'";
			$rs_2 = executeQuery($sql_2);

			$rs = executeQuery($sql);
			$rs_2 = executeQuery($sql);

			$duplicados = 0;
			foreach($case as $rs_2){
				if($case['TRI_DECISION_MAGNUM_RESULT'] != 'ACCEPT' && $case['TRI_DECISION_MAGNUM_RESULT'] != 'ACCEPT_V'){
					$duplicados = $duplicados + 1;
				}
			}
			if($duplicados == 0){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}else{
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
				$bandera = false;
			}
		break;
		case "RECHAZO":
			$identifica = @@frm_numero_identificacion;
			$sql = "SELECT COUNT(CEDULA) AS grd_rechazo, OBSERVACION FROM VV_CONTROL_SUSCRIPCION WHERE CEDULA = '$identifica' AND ESTADO = 1";
			$rs = executeQuery($sql, $cnx_rp);

			$rehazo = $rs['1']['grd_rechazo'];
			if($rehazo > 0){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $rs['1']['OBSERVACION'];
				$bandera = false;
			}else{
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}
		break;

		/*VERSION*/
		case "VER_COTIZACION":
			$cotiza = @@frm_num_cotizacion;
			$version = $data['CAMPO1'];

			if($cotiza != $version){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'] . ' Version esperada : '	. $version . ' / Version del documento : ' . $cotiza;
				$bandera = false;
			}else{
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}
		break;
		case "FECHA_VIGENTE":
			//echo 'FECHA_VIGENTE';
			//$fecha_cotizacion = @@tri_fecha_Cotizadorvalida;
			// Numeric representation of the date
			$excel_date = @@tri_fecha_Cotizadorvalida;

			// Convert Excel date to Unix timestamp
			$unix_timestamp = ($excel_date - 25569) * 86400;
			//echo gmdate("d-m-Y H:i:s", $unix_timestamp);

			// Create a DateTime object from the Unix timestamp
			//$date_time = new DateTime($unix_timestamp);
			$date_time = gmdate("Y-m-d", $unix_timestamp);
			/*echo $date_time;
			die();*/

			// Format the date as desired
			//$formatted_date = $date_time->format('Y-m-d');
			//echo $formatted_date; // Output: 2024-01-01

			//get fecha_cotizacion
			$fecha_magnum = @@tri_fecha_magnum;

			//$fecha_magnum = '2024-05-26';
			//Si la fecha de validez es posterior a la fecha de la respuesta: deja pasar.
			//Si la fecha de validez es anterior a la fecha de la respuesta: lo refiere a revisión manual, pues es una cotización no vigente.

			$date_diff = strtotime($fecha_magnum) - strtotime($date_time);

			if($date_diff > 0){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
				$bandera = false;

			}else{
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}

			//echo strtotime($fecha_magnum) . ' - ' . strtotime($formatted_date);
		break;
		case "PARENTESCO":
			$aux_data = 0;
			$grid_beneficiario = array();
			$grid_beneficiario = @=grd_beneficiario;

			$grid_beneficiario_contingente = array();
			$grid_beneficiario_contingente = @=grid_beneficiarios_contingentes;
			if(!empty($grid_beneficiario)){
				foreach($grid_beneficiario as $row){
					$parentesco = intval($row['frm_plan_prentesco']);
					//echo $parentesco . ' - ';
					//$parentesco_manual = ['40','11','20','36','34','60','61','62','63','30','66','67','68','69'];
					$parentesco_manual = [40, 11, 20, 36, 34, 60, 61, 62, 63, 30, 66, 67, 68, 69];
					if(in_array($parentesco, $parentesco_manual)){
						$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
						$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
						$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
						$aux_data = $aux_data + 1;
					}
					/*else{
						$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
						$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
						$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
					}*/
				}
			}
			//die();
			if(!empty($grid_beneficiario_contingente)){
				foreach($grid_beneficiario_contingente as $row){
					$parentesco = intval($row['frm_plan_prentesco_contingente']);
					//$parentesco_manual = ['40','11','20','36','34','60','61','62','63','30','66','67','68','69'];
					$parentesco_manual = [40, 11, 20, 36, 34, 60, 61, 62, 63, 30, 66, 67, 68, 69];

					if(in_array($parentesco, $parentesco_manual)){
						$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
						$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
						$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
						$aux_data = $aux_data + 1;

					}
					/*else{
						$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
						$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
						$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
					}*/
				}
			}

			if($aux_data == 0){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}else{
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
				$bandera = false;
			}
			//die();
		break;
		case "CUMULOS":
			$bandera_cumulos = @@tri_bandera_canceladas;
			if ($bandera_cumulos == 0){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}else{
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
				$bandera = false;
			}
		break;
		case "PEP":
			$bandera_pep = @@frm_trabajo_expuesta_politicamente;
			$bandera_pep_fami = @@frm_trabajo_expuesta_politicamente_familiar;

			if ($bandera_pep == 'S' || $bandera_pep_fami == 'S'){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
				$bandera = false;
			}else{
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
			}
		break;
		case "CONTRATANTE":
			$frm_plan_diferente_asegurado = @@frm_plan_diferente_asegurado;
			if($frm_plan_diferente_asegurado == 'S'){
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['VALOR'];
				$arr_politicas[$aux]['grd_politica_obs'] = $data['CAMPO2'];
				$bandera = false;
			} else {
				$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
				$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
				$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
				@@banderaContratanteEsAsegurado = 'SI';
			}
		break;
		default:
			//codigo
			$arr_politicas[$aux]['grd_politica_preg'] = $data['DESCRIPCION'];
			$arr_politicas[$aux]['grd_politica_resp'] = $data['INTEGRACION'];
			$arr_politicas[$aux]['grd_politica_obs'] = 'APROBADO';
		break;

	}
	$aux = $aux+1;

}



$validacion_inpuesto = @@frm_plan_pago_impuestos;

@@frm_accion_suscripcion = 'FINALIZAR';
@=grd_pol_suscripcion = $arr_politicas;
if($bandera){
	@@frm_accion_suscripcion = 'APROBAR';
	@@banderaPasoControlSuscripcion = 'SI';
}else{
	if($validacion_inpuesto == 'NO'){
		@@frm_accion_suscripcion = 'FINALIZAR';
	}else{
		@@frm_accion_suscripcion = 'REFERIR';
		 $sql = "SELECT CODIGO, DESCRIPCION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'RESP_MAGNUM' AND ESTADO = 1 AND CODIGO = 'REFER'";
		$rs_cat = executeQuery($sql, $cnx_rp);
		foreach($rs_cat as $data_cat){
				$res_a = $data_cat['CAMPO2'];
				$html_decision_magnum = "<h4>$res_a</h4>";
		}
		@@html_decision_magnum = $html_decision_magnum;
	}
}
