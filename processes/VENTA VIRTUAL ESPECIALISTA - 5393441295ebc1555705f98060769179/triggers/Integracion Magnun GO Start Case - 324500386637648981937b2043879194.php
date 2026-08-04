<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
@@tri_case_id_magnum = '';
@@tri_fecha_magnum = date('Y-m-d');
$tri_bandera_sdb = 'true';

$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_STARCASE_MAGNUM'";
$rs_auth =  executeQuery($sql_cata_auth, $cnx);

$url_auth = $rs_auth['1']['DESCRIPCION'];

$dns_auth = $url_auth;

$language = "es_MX";
$rulebaseName = "Equisuiza";
$bootstrapType = "HOST_APP";
//seccion 1
$mandatoryValidationsSettings = array();
$validateOnNextForm = "true";
$validateOnPreviousForm = "true";
$validateOnSubmit = "true";
$mandatoryValidationsSettings = array("validateOnNextForm" => $validateOnNextForm, "validateOnPreviousForm" => $validateOnPreviousForm, "validateOnSubmit" => $validateOnSubmit);

//bootstrapData
$ApplicationID = @@APP_NUMBER;
$SalesChannel = @@tri_es_broker == 'NO' ? 'Direct Sales Force' : 'Broker';
$Agency = @@frm_Sucursal_label;
$ClientPresent = "Yes";
//$LifeID = @@frm_numero_identificacion . ' ' . @#frm_primer_nombre . ' ' . @#frm_apellido_paterno;
$LifeID = 'ID : '.@@APP_NUMBER;
$Gender = @@frm_sexo == 'M' ? "MALE" : "FEMALE";
$DateOfBirth = @@frm_fecha_nacimiento;
//consulto integracio de estado civil
$sql = "SELECT INTEGRACION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'ESTADO_CIVIL' AND CODIGO = '".@@frm_estado_civil."'";
$rs = executeQuery($sql, $cnx);
$MaritalState = empty($rs['1']['INTEGRACION']) ? 'Single' : $rs['1']['INTEGRACION'];
$SmokingStatus = @@frm_declaracion_h_combo == 'S' ? "SMOKER" : "NON_SMOKER";
$amount_send = str_replace(',','', @#frm_financiera_actividad_principal);
$Financial_AnnualIncome = $amount_send * 12;
$ExistingADBCoverThisCompany = (@@frm_cumulo_vida_muerte == '' ? '0' : @@frm_cumulo_vida_muerte);
$ExistingLIFECoverThisCompany = (@@frm_cumulo_vida == '' ? '0' : @@frm_cumulo_vida);
$product_LifeRole = "Main Life";
$product_type = @@frm_ramo == '58' ? 'Term life' : 'Universal life';
$product_displayName = @@frm_ramo == '58' ? 'Proteger Plus' : 'Vida Universal';
//consulto integracion de motivo del seguro
$sql = "SELECT INTEGRACION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'tmotivo_seguro' AND CODIGO = '".@@frm_motivo_seguro."'";
$rs = executeQuery($sql, $cnx);
$product_CoverPurpose = empty($rs['1']['INTEGRACION']) ? 'Personal / family protection' : $rs['1']['INTEGRACION'];
//debe ser el recorrido del grid de coberutras
$product_benefit_termBasis = @@frm_ramo == '58' ? 'YEARS' : "WHOLE_LIFE";
$aux_cober = 0; 

$product_ID = @@frm_producto;

$bootstrapData = array("attributes" => array (

      // Every array will be converted
      // to an object
      array(
          "attribute" => "case.ApplicationID", "questionDefinitionUuid" => "8eee4ccc-548e-4304-8847-4d781534e88b", "valueAsString" => $ApplicationID
      ),
	  array(
          "attribute" => "case.SalesChannel", "questionDefinitionUuid" => "48c081b0-9c04-4391-8830-23cdffc1e6eb", "valueAsString" => $SalesChannel
      ),
      array(
          "attribute" => "case.Agency", "questionDefinitionUuid" => "80bb3555-be9c-442e-a6da-2ad5a20bcfb5", "valueAsString" => $Agency
      ),
	  array(
          "attribute" => "case.ClientPresent", "questionDefinitionUuid" => "1aa185bd-269a-40a1-be24-862ac4f5f626", "valueAsString" => $ClientPresent
      ),
	  //agreagamos el nuevo atributo Provincia al bootstrap
	  array(
		"attribute" => "case.Province",	"questionDefinitionUuid" => "d76d5d05-c573-4649-b97d-679370ab8e9a",	"valueAsString" => @@frm_provincia
	  ),
	  //agreagamos el nuevo atributo Canton al bootstrap
	  array(
		"attribute" => "case.Municipality",	"questionDefinitionUuid" => "fd93126f-6800-4fdb-9fa6-458a714f79c4",	"valueAsString" => @@frm_canton
	  ),
	  //agreagamos el nuevo atributo Ocupacion al bootstrap
	  array(
		"attribute" => "case.life[0].LineOfBusiness",	"questionDefinitionUuid" => "60a70786-f400-4d7d-b9bb-6cb49729e437",	"valueAsString" => @@frm_ocupacion_tipo_empleo
	  ),	  
	  array(
          "attribute" => "case.life[0].LifeID", "questionDefinitionUuid" => "400f86c3-bf38-4bfb-bf1e-cf0708931f5e", "valueAsString" => $LifeID
      ),
	  array(
         "attribute" => "case.life[0].Gender", "questionDefinitionUuid" => "acb46ed7-8463-4ff9-bf1b-7e03cae056ec", "valueAsString" => $Gender
      ),
	  array(
         "attribute" => "case.life[0].DateOfBirth", "questionDefinitionUuid" => "05ad5b82-5674-4691-a411-2ef05854f040", "valueAsString" => $DateOfBirth
      ),
	  array(
         "attribute" => "case.life[0].MaritalState", "questionDefinitionUuid" => "93f1dddc-92a1-47a2-a25c-46b4c17810f5", "valueAsString" => $MaritalState
      ),
	  array(
         "attribute" => "case.life[0].SmokingStatus", "questionDefinitionUuid" => "e16fd13c-365a-4cd6-9b2a-f990fb1d5d5b", "valueAsString" => $SmokingStatus
      ),
	  array(
         "attribute" => "case.life[0].Financial.AnnualIncome", "questionDefinitionUuid" => "c47fd80d-93ae-45ad-8b3e-893e35c0ed01", "valueAsString" => $Financial_AnnualIncome
      ),
	array(
         "attribute" => "case.life[0].Financial.ExistingADBCoverThisCompany", "questionDefinitionUuid" => "a3f5d23c-21e7-487a-bf98-1692172979e3", "valueAsString" => $ExistingADBCoverThisCompany
      ),
	array(
         "attribute" => "case.life[0].Financial.ExistingLIFECoverThisCompany", "questionDefinitionUuid" => "8360a01a-0a14-4198-ab28-a424bcde6c64", "valueAsString" => $ExistingLIFECoverThisCompany
      ),
	  array(
         "attribute" => "case.life[0].product[0].LifeRole", "questionDefinitionUuid" => "c922f417-7af9-4bb6-a3e6-95ddebc3f73b", "valueAsString" => $product_LifeRole
      ),
	  array(
         //"attribute" => "case.life[0].product[0].type", "questionDefinitionUuid" => "6fccba08-af2a-48d2-adec-0ba9a116f1ed", "valueAsString" => $product_type
		 "attribute" => "case.life[0].product[0].type", "questionDefinitionUuid" => "bd6d32bf-e42c-42a6-88af-7756834c8fb9", "valueAsString" => $product_type
      ),
	  array(
         //"attribute" => "case.life[0].product[0].displayName", "questionDefinitionUuid" => "c9452337-8c47-4b46-9389-3e7ae5b1829d", "valueAsString" => $product_displayName
		 "attribute" => "case.life[0].product[0].displayName", "questionDefinitionUuid" => "ed177374-7df7-4468-b778-942469c7b8d0", "valueAsString" => $product_displayName
      ),
	  array(
         "attribute" => "case.life[0].product[0].CoverPurpose", "questionDefinitionUuid" => "5cf219ae-b2ad-4a07-9314-74e35d7da55c", "valueAsString" => $product_CoverPurpose
	  ),
	  /*array(
         "attribute" => "case.life[0].product[0].benefit[0].type", "questionDefinitionUuid" => "068fa14a-2d53-4fbc-8a5c-99a928bd3724", "valueAsString" => $product_benefit_type
      ),
	  array(
        "attribute" => "case.life[0].product[0].benefit[0].amount", "questionDefinitionUuid" => "197fb849-f5ed-4e76-b1a1-0127613c4454", "valueAsString" => $product_benefit_amount
      ),
	  array(
        "attribute" => "case.life[0].product[0].benefit[0].termBasis", "questionDefinitionUuid" => "c91c5e11-e45b-4d35-8c38-ec8b974f2615", "valueAsString" => $product_benefit_termBasis
      ),*/
	  array(
         "attribute" => "case.life[0].product[0].ID", "valueAsString" => $product_ID
		 )
  ));
  @@tri_monto_total_coberturas = 0;


  foreach(@=grd_coberturas as $datagrid){
	$val_aseg = intval($datagrid['valor_asegurado']);
	//valido si tiene valor en la cobertura
	if($val_aseg > 0){
		$namecober = $datagrid['cobertura_label'];
		//VIDA
		if($namecober == 'VIDA' || $namecober == 'VIDA + EXENCION DED. MENSUAL INCAP. TOTAL Y PERM.'){
			$product_benefit_type = "LIFE";
			$product_benefit_amount = $val_aseg;
			$product_benefit_life = $val_aseg;
			$array_cober_life_p = array(
						 "attribute" => "case.life[0].product[0].benefit[$aux_cober].type", "questionDefinitionUuid" => "068fa14a-2d53-4fbc-8a5c-99a928bd3724", "valueAsString" => $product_benefit_type
					  );
			array_push($bootstrapData['attributes'], $array_cober_life_p);
			$array_cober_life_a = array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].amount", "questionDefinitionUuid" => "197fb849-f5ed-4e76-b1a1-0127613c4454", "valueAsString" => $product_benefit_amount
					  );
			array_push($bootstrapData['attributes'], $array_cober_life_a);
			$array_cober_life_b =  array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].termBasis", "questionDefinitionUuid" => "c91c5e11-e45b-4d35-8c38-ec8b974f2615", "valueAsString" => $product_benefit_termBasis
						);
			array_push($bootstrapData['attributes'], $array_cober_life_b);
			$aux_cober_vda = $aux_cober;
			$aux_cober++;

			@#tri_monto_total_coberturas = $product_benefit_amount;
		}

		//$bootstrapData = array_merge($bootstrapData['attributes'], $array_cober_life);
		//CAPITAL COMPLEMENTARIO
		if($namecober == 'CAPITAL COMPLEMENTARIO'){
			$product_benefit_amount = $product_benefit_life + $val_aseg;
			$bootstrapData['attributes']['18']['valueAsString'] = $product_benefit_amount;
			@#tri_monto_total_coberturas = $product_benefit_amount;
		}

		//INCAPACIDAD TOTAL Y PERMANENTE - ENFERMEDAD - INCAPACIDAD TOTAL Y PERMANENTE - ENFERMEDAD
		if($namecober == 'BENEFICIO ADICIONAL INCAP. TOTAL Y PERMANENTE' || $namecober == 'INCAPACIDAD TOTAL Y PERMANENTE - ENFERMEDAD'){
			$product_benefit_type = "TPD";
			$product_benefit_amount = $val_aseg;
			$array_cober_tpd_t = array(
						 "attribute" => "case.life[0].product[0].benefit[$aux_cober].type", "questionDefinitionUuid" => "068fa14a-2d53-4fbc-8a5c-99a928bd3724", "valueAsString" => $product_benefit_type
					  );
			array_push($bootstrapData['attributes'], $array_cober_tpd_t);
			$array_cober_tpd_a = array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].amount", "questionDefinitionUuid" => "197fb849-f5ed-4e76-b1a1-0127613c4454", "valueAsString" => $product_benefit_amount
					  );
			array_push($bootstrapData['attributes'], $array_cober_tpd_a);
			$array_cober_tpd_b =  array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].termBasis", "questionDefinitionUuid" => "c91c5e11-e45b-4d35-8c38-ec8b974f2615", "valueAsString" => $product_benefit_termBasis
			);
			array_push($bootstrapData['attributes'], $array_cober_tpd_b);
			$aux_cober++;
		}
		//BENEFICIO ADICIONAL POR ENFERMEDADES GRAVES - ANTICIPO EN CASO DE ENFERMEDAD GRAVES
		if($namecober == 'BENEFICIO ADICIONAL POR ENFERMEDADES GRAVES' || $namecober == 'ANTICIPO EN CASO DE ENFERMEDAD GRAVES'){
			$product_benefit_type = "CI";
			$product_benefit_amount = $val_aseg;
			$array_cober_tpd_t = array(
						 "attribute" => "case.life[0].product[0].benefit[$aux_cober].type", "questionDefinitionUuid" => "068fa14a-2d53-4fbc-8a5c-99a928bd3724", "valueAsString" => $product_benefit_type
					  );
			array_push($bootstrapData['attributes'], $array_cober_tpd_t);
			$array_cober_tpd_a = array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].amount", "questionDefinitionUuid" => "197fb849-f5ed-4e76-b1a1-0127613c4454", "valueAsString" => $product_benefit_amount
					  );
			array_push($bootstrapData['attributes'], $array_cober_tpd_a);
			$array_cober_tpd_b =  array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].termBasis", "questionDefinitionUuid" => "c91c5e11-e45b-4d35-8c38-ec8b974f2615", "valueAsString" => $product_benefit_termBasis
			);
			array_push($bootstrapData['attributes'], $array_cober_tpd_b);
			$aux_cober++;
		}
		//MUERTE Y DESMEMBRACION ACCIDENTAL - INCAPACIDAD TOTAL Y PERMANENTE - ACCIDENTE
		if($namecober == 'MUERTE Y DESMEMBRACION ACCIDENTAL'){
			$product_benefit_type = "ADB";
			$product_benefit_amount = $val_aseg;
			$array_cober_tpd_t = array(
						 "attribute" => "case.life[0].product[0].benefit[$aux_cober].type", "questionDefinitionUuid" => "068fa14a-2d53-4fbc-8a5c-99a928bd3724", "valueAsString" => $product_benefit_type
					  );
			array_push($bootstrapData['attributes'], $array_cober_tpd_t);
			$array_cober_tpd_a = array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].amount", "questionDefinitionUuid" => "197fb849-f5ed-4e76-b1a1-0127613c4454", "valueAsString" => $product_benefit_amount
					  );
			array_push($bootstrapData['attributes'], $array_cober_tpd_a);
			$array_cober_tpd_b =  array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].termBasis", "questionDefinitionUuid" => "c91c5e11-e45b-4d35-8c38-ec8b974f2615", "valueAsString" => $product_benefit_termBasis
			);
			array_push($bootstrapData['attributes'], $array_cober_tpd_b);
			$aux_cober++;
			$tri_bandera_sdb = 'false';
		}

		//INCAPACIDAD TOTAL Y PERMANENTE - ACCIDENTE
		if($namecober == 'INCAPACIDAD TOTAL Y PERMANENTE - ACCIDENTE' && $tri_bandera_sdb == 'true'){
			$product_benefit_type = "ADB";
			$product_benefit_amount = $val_aseg;
			$array_cober_tpd_t = array(
						 "attribute" => "case.life[0].product[0].benefit[$aux_cober].type", "questionDefinitionUuid" => "068fa14a-2d53-4fbc-8a5c-99a928bd3724", "valueAsString" => $product_benefit_type
					  );
			array_push($bootstrapData['attributes'], $array_cober_tpd_t);
			$array_cober_tpd_a = array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].amount", "questionDefinitionUuid" => "197fb849-f5ed-4e76-b1a1-0127613c4454", "valueAsString" => $product_benefit_amount
					  );
			array_push($bootstrapData['attributes'], $array_cober_tpd_a);
			$array_cober_tpd_b =  array(
						"attribute" => "case.life[0].product[0].benefit[$aux_cober].termBasis", "questionDefinitionUuid" => "c91c5e11-e45b-4d35-8c38-ec8b974f2615", "valueAsString" => $product_benefit_termBasis
			);
			array_push($bootstrapData['attributes'], $array_cober_tpd_b);
			$aux_cober++;
		}
	}
}

$aVars = array(
					   "language" => $language,
					   "rulebaseName" => $rulebaseName,
					   "bootstrapType" => $bootstrapType,
					   "mandatoryValidationsSettings" => $mandatoryValidationsSettings,
					   "bootstrapData" => $bootstrapData
					);
				$json = json_encode($aVars);

@@json_magnum_bootstrap = $json;

$token = @@token;
$ch_auth = curl_init();
curl_setopt($ch_auth, CURLOPT_URL, $dns_auth);
curl_setopt($ch_auth, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch_auth, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch_auth, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_auth, CURLOPT_FAILONERROR, true);
curl_setopt($ch_auth, CURLOPT_HTTPHEADER,
			array(
							"Accept: application/json",
							"Content-Type: application/json",
							"Accept-Language: application/json",
							"Authorization: Bearer ". $token
						)
		   );
$res = curl_exec($ch_auth);
if(curl_errno($ch_auth)){
	$msg_m_auth = curl_error($ch_auth);
	$result['mensaje_mostrar'] = 'Excepción capturada: Error al generar token, comuniquese con el  administrador.- '.utf8_encode($msg_m_auth);
}
curl_close($ch_auth);
$rs_m = json_decode($res);

@@tri_case_id_magnum = $rs_m->caseUuid;

  PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'IMGSC-VVE-289',
      $dns_auth,
      'POST',
      "Authorization: Bearer ". $token,
      json_encode($json),
      json_encode($rs_m),
      json_encode($msg_m_auth));
