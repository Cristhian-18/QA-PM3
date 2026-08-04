<?php
/*
TRRIGER SE EJECUTA AUTOMATICAMENTE DESPUES DE QUE CUALQUIER CASO SE REANUDE
*/
try {

	//@@contador_alternativa_mail = 4;
	$caseId = @@APPLICATION;
	//$contador = @@contador_alternativa_mail;

	$sql = "SELECT * FROM APP_DELEGATION ad WHERE APP_UID = '$caseId' AND DEL_LAST_INDEX = 1";
	$rs = executeQuery($sql);
	$task = $rs[1]['TAS_UID'];
	$index1 = $rs[1]['DEL_INDEX'];
	$appUid = $rs[1]['APP_UID'];
	$usuario = $rs[1]['USR_UID'];

	//Declaro varibles para pausar caso
	$mifecha = date('Y-m-d H:i:s');
	$fecha_despausa = strtotime('+5 minutes', strtotime($mifecha));
	$fecha_despausa = date("Y-m-d H:i:s", $fecha_despausa);

	//@@tmp_damian = $fecha_despausa;
	//Si la task es igual a "cliente adjuntar documentos" ejecuta
	if ($task == '746727803624e063116b8f7094625923') {
		$ajx_adjunta = @@ajx_adjunta;

		if ($ajx_adjunta != 'SI') {
			@@derivate_Case = PMFDerivateCase($appUid, $index1, true, $usuario);
		}
	}
} catch (Exception $e) {

	$errorMessage =  $e->getMessage();
}
