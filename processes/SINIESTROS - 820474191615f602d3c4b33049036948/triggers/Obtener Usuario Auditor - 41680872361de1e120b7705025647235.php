<?php

try {
    $grupoSiniestros = '26132490261d657dcdd2195090786463';
    $tareasAuditoria = "'309930261615f607b901f74034966395', '86240770361d652fbb6f186074849549'";

    $sql = "
        SELECT
            U.USR_UID,
            COALESCE((
                SELECT COUNT(*)
                FROM APPLICATION A
                INNER JOIN APP_DELEGATION D ON A.APP_UID = D.APP_UID
                WHERE A.APP_STATUS = 'TO_DO'
                    AND D.DEL_THREAD_STATUS = 'OPEN'
                    AND D.DEL_LAST_INDEX = 1
                    AND D.TAS_UID IN ($tareasAuditoria)
                    AND D.USR_UID = U.USR_UID
            ), 0) AS carga_trabajo
        FROM USERS U
        INNER JOIN GROUP_USER GU ON U.USR_UID = GU.USR_UID
        WHERE GU.GRP_UID = '$grupoSiniestros'
        ORDER BY carga_trabajo ASC
        LIMIT 1
    ";

    $rs = executeQuery($sql);

    if (!empty($rs)) {
        @@tri_user_auditor = $rs[1]['USR_UID'];
    } else {
        @@tri_user_auditor = null;
        echo '<br>Error: No hay miembros en el grupo de siniestros';
    }
} catch (Exception $e) {
    @@tri_user_auditor = null;
    echo '<br>Error: ' . $e->getMessage();
}