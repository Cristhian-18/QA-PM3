<?php
/*
ESTE TRIGGER SE EJECUTA DESPUES DEL ROMBO....
ACCIONES: ENVIA MENSAJE AL CLIENTE Y SE PAUSA EN LA MISMA TAREA "cliente adjuntar documentos"
*/
try {

	//Declaro varibles para pausar caso
	$mifecha = date('Y-m-d H:i:s');
	$fecha_despausa = strtotime('+5 days', strtotime($mifecha));
	$fecha_despausa = date("Y-m-d H:i:s", $fecha_despausa);
	//@@tmp_fecha_Despausa = $fecha_despausa;
	$sql = "SELECT DEL_INDEX ,USR_UID
		FROM APP_DELEGATION ad
		WHERE APP_UID = '$caseId'
			AND DEL_LAST_INDEX = 1";
	$res = executeQuery($sql);
	$index = $res[1]['DEL_INDEX'];
	$userPausa = $res[1]['USR_UID'];
	$appUid = $res[1]['APP_UID'];


	@@siniestro_pausa_caso = PMFPauseCase(@@APPLICATION, $index, $userPausa, $fecha_despausa);
} catch (Exception $e) {

	$errorMessage =  $e->getMessage();
}
