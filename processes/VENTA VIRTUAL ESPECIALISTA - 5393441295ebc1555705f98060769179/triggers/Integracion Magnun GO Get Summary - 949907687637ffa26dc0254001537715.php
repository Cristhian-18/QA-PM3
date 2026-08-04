<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$html_summary = '';
$server = @@URL_SERVER_SQL;
$case_id = @@APP_NUMBER;

$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_SUMMARY_MAGNUM'";
$rs_auth =  executeQuery($sql_cata_auth, $cnx);

$url_auth = $rs_auth['1']['DESCRIPCION'];

$tri_case_id_magnum = (@@tri_case_id_magnum != '') ? @@tri_case_id_magnum : '';


$dns_auth = str_replace("caseid", $tri_case_id_magnum, $url_auth);

$token = @@token;

$ch_auth = curl_init();
curl_setopt($ch_auth, CURLOPT_URL, $dns_auth);
curl_setopt($ch_auth, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch_auth, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch_auth, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_auth, CURLOPT_FAILONERROR, true);
curl_setopt(
	$ch_auth,
	CURLOPT_HTTPHEADER,
	array(
		"Accept: application/json",
		"Content-Type: application/json",
		"Accept-Language: application/json",
		"Authorization: Bearer " . $token
	)
);
$res = curl_exec($ch_auth);



$res = str_replace("Magnum Go Equinoccial - Solicitud de Seguro", "Magnum Go EQUISUIZA - Solicitud de Seguro", $res);
$msg_m_auth = '';
if (curl_errno($ch_auth)) {
	$msg_m_auth = curl_error($ch_auth);
	$result['mensaje_mostrar'] = 'Excepción capturada: Error al generar token, comuniquese con el  administrador.- ' . utf8_encode($msg_m_auth);
}
curl_close($ch_auth);
//die();
$rs_m = json_decode($res);

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'IMGGS-VVE-55',
$dns_auth,
'GET',
"Accept: application/json".
" Content-Type: application/json".
" Accept-Language: application/json".
" Authorization: Bearer ". $token,
'',
json_encode($rs_m),
json_encode($msg_m_auth));

$name_mag = $rs_m->forms['0']->lifeDisplayName;

$arr_datos = $rs_m->forms['0']->forms['0']->childElements;

$childElements = json_decode(json_encode($arr_datos['0']->childElements), true);

$arrar_des = json_decode(json_encode($childElements), true);

$html_summary = "<table border='1'><tbody>";
$html_summary .= "<tr><th colspan='2'>$name_mag</th></tr>";

foreach ($arrar_des as $childElement) {
 
	$array_childElements = $childElement['childElements'];
	$nodo_padre = $childElement['title'];


	$html_summary .= "<tr><td colspan='2'><b style='color:#027361'>$nodo_padre</b></td></tr>";
	foreach ($array_childElements  as $datachildElement) {
		$nodo_preg = $datachildElement['title'];
		$nodo_preg_locator = $datachildElement['locator'];
		$nodo_preg_type = $datachildElement['type'];
		$nodo_preg_dataType = $datachildElement['dataType'];
		if ($nodo_preg_type == 'QUESTION') {
			$html_summary .= "<tr>";
			$html_summary .= "<td>$nodo_preg</td>";
			if ($childElement['title'] == 'Constitución') {
				$nodo_resp = $datachildElement['value']['decimalValue'];
				$html_summary .= "<td><i>$nodo_resp</i></td>";
				$html_summary .= "</tr>";
				if ($nodo_preg_locator == 'case.life[0].Build.HeightMeters')
					@@frm_declaracion_estatura = $datachildElement['value']['decimalValue'];
				if ($nodo_preg_locator == 'case.life[0].Build.WeightKilograms')
					@@frm_declaracion_peso = $datachildElement['value']['decimalValue'];
			} else {
				if ($nodo_preg == '<p>¿Cuál es su ocupación?</p>') {
					if (
						isset($datachildElement['value']['referenceDataValues']) &&
						is_array($datachildElement['value']['referenceDataValues']) &&
						count($datachildElement['value']['referenceDataValues']) > 0
					) {
						foreach ($datachildElement['value']['referenceDataValues'] as $dataProf) {
							@@tri_profesion_magnum = $dataProf['code'];
						}
					}
				}
				if ($nodo_preg == '<p>Detalle el país dónde reside</p>') {
					$nodo_resp = $datachildElement['value']['stringValue'];
					$html_summary .= "<td><i>$nodo_resp</i></td>";
					$html_summary .= "</tr>";
					if ($nodo_preg_locator == 'case.life[0].Residence.City')
						@@frm_declaracion_6_1 = $datachildElement['value']['stringValue'];
				} else {
					if (
						isset($datachildElement['value']['referenceDataValues']) &&
						is_array($datachildElement['value']['referenceDataValues']) &&
						count($datachildElement['value']['referenceDataValues']) > 1
					) {
						$html_summary .= "<td><i>";
						foreach ($datachildElement['value']['referenceDataValues'] as $dataRefrenc) {
							$nodo_resp = $dataRefrenc['name'];
							$html_summary .= "<ul>$nodo_resp</ul>";
							if ($nodo_preg_locator == 'case.life[0].Avocations.Type')
								@@frm_declaracion_7 .= $nodo_resp . ',';
						}
						$html_summary .= "</i></td></tr>";
					} else {
						if ($nodo_preg_dataType == 'INTEGER_TEXTBOX' || $nodo_preg_dataType == 'INTEGER_SPINNER') {
							$nodo_resp = $datachildElement['value']['intValue'];
							$html_summary .= "<td><i>$nodo_resp</i></td>";
							$html_summary .= "</tr>";
						} else {
							if ($nodo_preg_dataType == 'DATE_PARTIAL') {
								$nodo_resp = $datachildElement['value']['datePartialValue'];
								$html_summary .= "<td><i>$nodo_resp</i></td>";
								$html_summary .= "</tr>";
							} else {
								if ($nodo_preg_dataType == 'STRING_TEXTBOX_SINGLE') {
									$nodo_resp = $datachildElement['value']['stringValue'];
									if ($nodo_preg_locator == 'case.life[0].PreviousApplicationDecision.InsuranceDetails')
										@@frm_declaracion_12_1 = $nodo_resp;
									$html_summary .= "<td><i>$nodo_resp</i></td>";
									$html_summary .= "</tr>";
								} else {
									//echo $nodo_resp.'<br>';
									$nodo_resp = $datachildElement['value']['referenceDataValues']['0']['name'];
									$html_summary .= "<td><i>$nodo_resp</i></td>";
									$html_summary .= "</tr>";
									//echo $nodo_preg_locator.'<br>';
									if ($nodo_preg_locator == 'case.life[0].Tobacco.TobaccoUse')
										@@frm_declaracion_1 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Alcohol.ConsumptionDaysPerWeek')
										@@frm_declaracion_2 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Alcohol.DailyAlcoholConsumption')
										@@frm_declaracion_2_1 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Alcohol.AlcoholAdvice')
										@@frm_declaracion_3 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].RecreationalDrugs.Use')
										@@frm_declaracion_4 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].RecreationalDrugs.Use_cuales')
										@@frm_declaracion_4_1 = 'tadavia no0 se';
									if ($nodo_preg_locator == 'case.life[0].occupations[0].type')
										@@frm_declaracion_5 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Residence.ResidentEcuador')
										@@frm_declaracion_6 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].FamilyHistories.DiagnosedBeforeAge65')
										@@frm_declaracion_8 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.Impairments1')
										@@frm_declaracion_9_a = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.Impairments2')
										@@frm_declaracion_9_b = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.Impairments3')
										@@frm_declaracion_9_c = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.Impairments4')
										@@frm_declaracion_9_d = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.Impairments5')
										@@frm_declaracion_9_e = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.Impairments6')
										@@frm_declaracion_9_f = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.DisabilityPension')
										@@frm_declaracion_10 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.PercentageOfDisability')
										@@frm_declaracion_10_1 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.Impairments7')
										@@frm_declaracion_10_2 = $datachildElement['value']['referenceDataValues']['0']['intValue'];
									if ($nodo_preg_locator == 'case.life[0].impairments[1].type')
										@@frm_declaracion_10_3 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.CurrentPregnant')
										@@frm_declaracion_11 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.PreganancyComplication')
										@@frm_declaracion_11_1 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].Medical.Ever.PreganancyComplication')
										@@frm_declaracion_11_1 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].PreviousApplicationDecision.Declined')
										@@frm_declaracion_12 = $datachildElement['value']['referenceDataValues']['0']['name'];
									if ($nodo_preg_locator == 'case.life[0].PreviousApplicationDecision.OtherCompany')
										@@frm_declaracion_13 = $datachildElement['value']['referenceDataValues']['0']['name'];
								}
							}
						}
					}
				}
			}
		} else {
			if ($nodo_preg_type == 'SECTION_INLINE' || $nodo_preg_type == 'SECTION_REPEATING') {
				//$html_summary .= "<tr>";
				//$html_summary .= "<td>aaa$nodo_preg</td>";
				$arr_des_inline = $datachildElement['childElements'];
				foreach ($arr_des_inline as $childElement) {
					$array_childElements = $childElement['childElements'];
					$nodo_padre = $childElement['title'];
					if ($nodo_padre != '')
						$html_summary .= "<tr><td colspan='2'><b>$nodo_padre</b></td></tr>";
					foreach ($array_childElements  as $datachildElement) {
						$nodo_preg = $datachildElement['title'];
						$nodo_preg_locator = $datachildElement['locator'];
						$nodo_preg_type = $datachildElement['type'];
						$nodo_preg_datatype = $datachildElement['dataType'];

						if ($nodo_preg_type == 'QUESTION') {
							$html_summary .= "<tr>";
							$html_summary .= "<td>$nodo_preg</td>";
							if (
								isset($datachildElement['value']['referenceDataValues']) &&
								is_array($datachildElement['value']['referenceDataValues']) &&
								count($datachildElement['value']['referenceDataValues']) > 1
							) {
								$html_summary .= "<td><i>";
								foreach ($datachildElement['value']['referenceDataValues'] as $data_ValuesRefer) {
									$nodo_resp = $data_ValuesRefer['name'];
									$html_summary .= "<ul>$nodo_resp</ul>";
								}
								$html_summary .= "</i></td></tr>";
							} else {
								if ($nodo_preg_datatype == 'INTEGER_TEXTBOX' || $nodo_preg_datatype == 'INTEGER_SPINNER') {
									$nodo_resp = $datachildElement['value']['intValue'];
									$html_summary .= "<td><i>$nodo_resp</i></td>";
									$html_summary .= "</tr>";
								} else {
									if ($nodo_padre == 'Opiáceos') {
										$nodo_resp = $datachildElement['value']['referenceDataValues']['0']['name'];
										$html_summary .= "<td><i>$nodo_resp</i></td>";
										$html_summary .= "</tr>";
										foreach ($array_childElements['1']['childElements'] as $datachildinside) {
											$nodo_preg = $datachildinside['title'];
											$nodo_preg_locator = $datachildinside['locator'];
											$nodo_preg_type = $datachildinside['type'];
											$nodo_preg_datatype = $datachildinside['dataType'];
											$html_summary .= "<tr>";
											$html_summary .= "<td>$nodo_preg</td>";
											if (
												isset($datachildinside['value']['referenceDataValues']) &&
												is_array($datachildinside['value']['referenceDataValues'])
												&& count($datachildinside['value']['referenceDataValues']) > 1
											) {
												$html_summary .= "<td><i>";
												foreach ($datachildinside['value']['referenceDataValues'] as $data_ValuesRefer) {
													$nodo_resp = $data_ValuesRefer['name'];
													$html_summary .= "<ul>$nodo_resp</ul>";
												}
												$html_summary .= "</i></td></tr>";
											} else {
												if ($nodo_preg_datatype == 'DATE_PARTIAL') {
													$nodo_resp = $datachildinside['value']['datePartialValue'];
													$html_summary .= "<td><i>$nodo_resp</i></td>";
													$html_summary .= "</tr>";
												} else {
													$nodo_resp = $datachildinside['value']['referenceDataValues']['0']['name'];
													$html_summary .= "<td><i>$nodo_resp</i></td>";
													$html_summary .= "</tr>";
												}
											}
										}
									} else {
										$nodo_resp = $datachildElement['value']['referenceDataValues']['0']['name'];
										$html_summary .= "<td><i>$nodo_resp</i></td>";
										$html_summary .= "</tr>";
										//Max:1
										//echo $nodo_preg_locator.'<br>';
										if ($nodo_preg_locator == 'case.life[0].impairments[1].type')
											@@frm_declaracion_9a_detalle = $datachildElement['value']['referenceDataValues']['0']['name'];
										if ($nodo_preg_locator == 'case.life[0].impairments[0].type')
											@@frm_declaracion_11_2 = $datachildElement['value']['referenceDataValues']['0']['name'];
									}
								}
							}
						} else {
							if ($nodo_preg_type == 'SECTION_INLINE' || $nodo_preg_type == 'SECTION_REPEATING') {
								$arr_des_inline_res = $datachildElement['childElements'];
								foreach ($arr_des_inline_res  as $datachildElement_res) {
									$arrnodo_preg_inside = $datachildElement_res['childElements'];
									foreach ($arrnodo_preg_inside as $datainsideElement) {
										$nodo_preg_in = $datainsideElement['title'];
										$nodo_preg_locator = $datainsideElement['locator'];
										$nodo_preg_type_in = $datainsideElement['type'];
										$nodo_preg_datatype = $datainsideElement['dataType'];
										if ($nodo_preg_type_in == 'QUESTION') {
											$html_summary .= "<tr>";
											$html_summary .= "<td>$nodo_preg_in</td>";
											if (
												isset($datachildElement['value']['referenceDataValues']) &&
												is_array($datachildElement['value']['referenceDataValues']) &&
												count($datainsideElement['value']['referenceDataValues']) > 1
											) {
												$html_summary .= "<td><i>";
												foreach ($datainsideElement['value']['referenceDataValues'] as $data_ValuesRefer) {
													$nodo_resp = $data_ValuesRefer['name'];
													$html_summary .= "<ul>$nodo_resp</ul>";
												}
												$html_summary .= "</i></td></tr>";
											} else {
												if ($nodo_preg_datatype == 'INTEGER_TEXTBOX' || $nodo_preg_datatype == 'INTEGER_SPINNER') {
													$nodo_resp = $datainsideElement['value']['intValue'];
													$html_summary .= "<td><i>$nodo_resp</i></td>";
													$html_summary .= "</tr>";
												} else {
													if ($nodo_preg_datatype == 'DATE_PARTIAL') {
														$nodo_resp = $datainsideElement['value']['datePartialValue'];
														$html_summary .= "<td><i>$nodo_resp</i></td>";
														$html_summary .= "</tr>";
													} else {
														$nodo_resp = $datainsideElement['value']['referenceDataValues']['0']['name'];
														$html_summary .= "<td><i>$nodo_resp</i></td>";
														$html_summary .= "</tr>";
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

$html_summary .= "</tbody></table>";
$res = str_replace("Magnum Go EQUISUIZA - Solicitud de Seguro", "Declaración de Asegurabilidad", $res);
@@tri_summary_magnum = $res;
@@html_summary_magnum = $html_summary;

if (@@frm_motivo_seguro == '11') {
	@@tri_etiqueta_desgravamen = 'DESGRAVAMEN - ';
}


//link para envio de mail al suscriptor
@@dana_link_covid = "$server/syscertificacion/es/3sesa/beesmartec/services/poliza_especialista/magnun_go/magnun3.php?case=" . $case_id;
@@link_desicion_id = "$server/syscertificacion/es/3sesa/beesmartec/services/poliza_especialista/magnun_go/magnun2.php?case=" . $case_id;
@@link_bootstrap_id = "$server/syscertificacion/es/3sesa/beesmartec/services/poliza_especialista/magnun_go/magnun4.php?case=" . $case_id;

