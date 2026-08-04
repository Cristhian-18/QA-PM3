<?php
try {
    $_SESSION['PROCESS'] = '3685317655e829ed34bce43075006773';
    $cnxSQL = '7477305145e37562849cda7003565620';
    $APP_NUMBER = @@APP_NUMBER;

    $sql = "SELECT DEL_INDEX, DELEGATION_ID, APP_NUMBER, DEL_PREVIOUS, DEL_LAST_INDEX, DEL_THREAD_STATUS, DEL_DELEGATE_DATE, DEL_INIT_DATE, DEL_FINISH_DATE
FROM APP_DELEGATION WHERE APP_NUMBER = '$APP_NUMBER' AND DEL_THREAD_STATUS = 'OPEN'";
    $rs = executeQuery($sql);

    /* $rsString = print_r($rs, true);
$logSql = "INSERT INTO rp_equivida.ADMIN_CATALOGOS_copyHB1912021
           (PRO_UID, TAS_UID, COD_CATALOGO, CODIGO, DESCRIPCION, VALOR, INTEGRACION, ESTADO, CAMPO1, CAMPO2, FECHA_INSERCION)
           VALUES('GENERICO', NULL, 'Log-Trigger Duplicidad I', 'T-DUP', CURRENT_TIMESTAMP, '', '', 1, '', 'Consulta inicial ejecutada: " . addslashes($rsString) . "', CURRENT_TIMESTAMP)";
$rsCat = executeQuery($logSql, $cnxSQL); */

    if ($rs && count($rs) > 1) {

        /* $logSql = "INSERT INTO rp_equivida.ADMIN_CATALOGOS_copyHB1912021
               (PRO_UID, TAS_UID, COD_CATALOGO, CODIGO, DESCRIPCION, VALOR, INTEGRACION, ESTADO, CAMPO1, CAMPO2, FECHA_INSERCION)
               VALUES('GENERICO', NULL, 'Log-Trigger Duplicidad MF', 'T-DUP', CURRENT_TIMESTAMP, '', '', 1, 'MULTIPLES_FILAS', 'Se encontraron " . count($rs) . " filas con estado OPEN', CURRENT_TIMESTAMP)";
    $rsCat = executeQuery($logSql, $cnxSQL); */

        $minLastIndex = PHP_INT_MAX;
        $rowToUpdate = null;

        foreach ($rs as $row) {
            if ($row['DEL_LAST_INDEX'] < $minLastIndex) {
                $minLastIndex = $row['DEL_LAST_INDEX'];
                $rowToUpdate = $row;
            }
        }

        if ($rowToUpdate) {

            $logData = json_encode($rowToUpdate);
            /* $logSql = "INSERT INTO rp_equivida.ADMIN_CATALOGOS_copyHB1912021
                   (PRO_UID, TAS_UID, COD_CATALOGO, CODIGO, DESCRIPCION, VALOR, INTEGRACION, ESTADO, CAMPO1, CAMPO2, FECHA_INSERCION)
                   VALUES('GENERICO', NULL, 'Log-Trigger Duplicidad PA', 'T-DUP', CURRENT_TIMESTAMP, '', '', 1, 'PRE_ACTUALIZACION', 'Datos de la fila a actualizar: $logData', CURRENT_TIMESTAMP)";
        $rsCat = executeQuery($logSql, $cnxSQL); */

            $updateSql = "UPDATE APP_DELEGATION
                      SET DEL_THREAD_STATUS = 'CLOSED',
                          DEL_INIT_DATE = DEL_DELEGATE_DATE,
                          DEL_FINISH_DATE = DEL_DELEGATE_DATE
                      WHERE DEL_INDEX = '{$rowToUpdate['DEL_INDEX']}'";

            try {
                executeQuery($updateSql);


                /* $logSql = "INSERT INTO rp_equivida.ADMIN_CATALOGOS_copyHB1912021
                      (PRO_UID, TAS_UID, COD_CATALOGO, CODIGO, DESCRIPCION, VALOR, INTEGRACION, ESTADO, CAMPO1, CAMPO2, FECHA_INSERCION)
                      VALUES('GENERICO', NULL, 'Log-Trigger Duplicidad AE', 'T-DUP', CURRENT_TIMESTAMP, '', '', 1, 'ACTUALIZACION_EXITOSA', 'Actualización completada para DEL_INDEX: {$rowToUpdate['DEL_INDEX']}', CURRENT_TIMESTAMP)";
            executeQuery($logSql, $cnxSQL); */
            } catch (Exception $e) {

                $logSql = "INSERT INTO rp_equivida.ADMIN_CATALOGOS_copyHB1912021
                      (PRO_UID, TAS_UID, COD_CATALOGO, CODIGO, DESCRIPCION, VALOR, INTEGRACION, ESTADO, CAMPO1, CAMPO2, FECHA_INSERCION)
                      VALUES('GENERICO', NULL, 'Log-Trigger Duplicidad EA', 'T-DUP', CURRENT_TIMESTAMP, '', '', 1, 'ERROR_ACTUALIZACION', 'Error al actualizar: " . addslashes($e->getMessage()) . "', CURRENT_TIMESTAMP)";
                $rsCat = executeQuery($logSql, $cnxSQL);
            }
        }
    } else {
        /* $logSql = "INSERT INTO rp_equivida.ADMIN_CATALOGOS_copyHB1912021
               (PRO_UID, TAS_UID, COD_CATALOGO, CODIGO, DESCRIPCION, VALOR, INTEGRACION, ESTADO, CAMPO1, CAMPO2, FECHA_INSERCION)
               VALUES('GENERICO', NULL, 'Log-Trigger Duplicidad No MF', 'T-DUP', CURRENT_TIMESTAMP, '', '', 1, 'NO_MULTIPLES_FILAS', 'No se encontraron múltiples filas para actualizar', CURRENT_TIMESTAMP)";
    $rsCat = executeQuery($logSql, $cnxSQL); */
    }
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
