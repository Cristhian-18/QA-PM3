<?php
//<?

	$valor_aprobacion = 0;

	if (@@frm_valoresAprobados_totalProformado == '' || @@frm_valoresAprobados_totalProformado == 0 || @@frm_valoresAprobados_totalProformado == null) {
		$valor_aprobacion = @@frm_valoresSiniestro_totalProformado;
	} else {
		$valor_aprobacion = @@frm_valoresAprobados_totalProformado;
	}

	if ($valor_aprobacion == '' || $valor_aprobacion == 0 || $valor_aprobacion == null) {
		$valor_aprobacion = 0;
	}

	if ($valor_aprobacion > 50000) {
		$group = 'DIRECCION_PDA_VH';
		$groupUID = PMFGetGroupUID($group);
		$groupArray = PMFGetGroupUsers($groupUID);
		$usr_uid = $groupArray['0']['USR_UID'];
		$usr_name = $groupArray['0']['USR_USERNAME'];
		@@tri_aprobador_negativa = $usr_uid;
	} else {
		//mail aprobador 
		$aprobador_mail = @@frm_emisionNegativa_jefatura;

		$sql_usrid = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$aprobador_mail'";
		$usr_id = executeQuery($sql_usrid);
		$usr_uid = $usr_id[1]['USR_UID'];
		$usr_name = $usr_id[1]['USR_USERNAME'];
		@@tri_aprobador_negativa = $usr_uid;
	}
