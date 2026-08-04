<?php
//created by Henry
//Obtener Usuario Auditor
//8-1-2022
try {

	$cnx = "11264850561d723f004d5c2072943786";
	$app_uid        = @@APPLICATION;
	$pro_uid        = @@PROCESS;

	//Casos en la tarea de auditor
	$sql = "SELECT D.USR_UID, COUNT(D.USR_UID) AS TOT_CAS FROM APPLICATION A, APP_DELEGATION D
	WHERE A.APP_UID = D.APP_UID AND APP_STATUS = 'TO_DO' AND D.DEL_THREAD_STATUS = 'OPEN'
	AND DEL_LAST_INDEX = 1 AND TAS_UID IN ('309930261615f607b901f74034966395', '86240770361d652fbb6f186074849549') GROUP BY D.USR_UID ORDER BY COUNT(D.USR_UID) ASC";
	$rs = executeQuery($sql);

	if (empty($rs)) {
		$sql_u = "SELECT USR_UID FROM GROUP_USER WHERE GRP_UID = '26132490261d657dcdd2195090786463' ORDER BY RAND() LIMIT 0, 1";
		$rs_u = executeQuery($sql_u);
		@@tri_user_auditor_negativa = $rs_u['1']['USR_UID'];
	} else {
		//listado de usuarios del grupo
		$sql_u = "SELECT USR_UID FROM GROUP_USER WHERE GRP_UID = '26132490261d657dcdd2195090786463'";
		$rs_u = executeQuery($sql_u);
		$bandera = 'false';
		foreach ($rs as $data) {
			$usr_uid = $data['USR_UID'];
			if ($bandera == 'false') {
				foreach ($rs_u as $data_u) {
					$usr_id_u = $data_u['USR_UID'];
					if ($usr_uid == $usr_id_u) {
						@@tri_user_auditor_negativa = $usr_uid;
						$bandera = 'true';
					}
				}
			}
		}
	}
} catch (Exception $e) {

	$errorMessage =  $e->getMessage();
}
