<?php
//<?
//Obtener Regla Derivacion T1

$process = @@PROCESS;

$estado = @@estado;
if (@@frm_accidente_provincia == 'undefined') {
    $cod_prov = 17;
} else {
    $cod_prov = @@frm_accidente_provincia * 1;
}
//$cod_prov = @@frm_accidente_provincia * 1;

$marca = @@frm_vehiculo_marca;
$tipo_veh = @@frm_vehiculo_tipo;


if ($tipo_veh != "PESADO") {
    $tipo_veh = "LIVIANO";
}

if ($estado == "INDEMNIZACION") {
    @@bandera_indemnizacion == "1";
    $mail_responsa_taller = 'taller.indemnizacion@seguros.com';
    $sql_u = "SELECT USR_UID FROM USERS WHERE USR_POSITION = '$mail_responsa_taller'";
    $rs_u = executeQuery($sql_u);

    if (empty($rs_u)) {
        $sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$mail_responsa_taller'";
        $rs_u = executeQuery($sql_u);
    }

    @@tri_user_taller = $rs_u['1']['USR_UID'];
    @@tri_tipo_taller = $rs_tm['1']['tipo'];
    @@tri_nombre_taller = $rs_tm['1']['nombre_taller'];

    if (@@tri_user_taller == null) {
        echo ($mail_responsa_taller);
        die();
    }
} else {
    if ($cod_prov == '17') {
        if ($tipo_veh == 'LIVIANO') {
            $mail_responsa_taller = 'servicioalcliente@mundomotriz.com.ec';
            //RUC TALLER - Cristhian 17/07/2026
            @@frm_ruc_taller = "1792151473001";
        } else {
            $mail_responsa_taller = 'gerencia_qa@fulltruck.ec';
            //$mail_responsa_taller = 'servicioalcliente@mundomotriz.com.ec';
        }
        $sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$mail_responsa_taller'";
        $rs_u = executeQuery($sql_u);

        if (empty($rs_u)) {
            $sql_u = "SELECT USR_UID FROM USERS WHERE USR_POSITION = '$mail_responsa_taller'";
            $rs_u = executeQuery($sql_u);
        }

        @@tri_user_taller = $rs_u['1']['USR_UID'];
        @@tri_tipo_taller = $rs_tm['1']['tipo'];
        @@tri_nombre_taller = $rs_tm['1']['nombre_taller'];

        if (@@tri_user_taller == null) {
            echo ($mail_responsa_taller);
            die();
        }
    } else {
        $sql_tm = "SELECT * FROM  SINIESTROS_DIRECCIONADOR
        WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
        AND cod_provincia = '$cod_prov'
        AND tipo_vehiculo = '$tipo_veh'
        AND marcas LIKE '%$marca%'
        ORDER BY prioridad, capacidad";

        $rs_tm = executeQuery($sql_tm);

        if (empty($rs_tm)) {
            $sql_tm = "SELECT * FROM  SINIESTROS_DIRECCIONADOR
            WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
            AND cod_provincia = '$cod_prov'
            AND tipo_vehiculo = '$tipo_veh'
            ORDER BY prioridad, capacidad";

            $rs_tm = executeQuery($sql_tm);
        }


        if (empty($rs_tm)) {
            $sql_tm = "SELECT * FROM  SINIESTROS_DIRECCIONADOR
            WHERE tipo = 'TALLER AUTORIZADO MULTIMARCA'
            AND cod_provincia = '$cod_prov'
            ORDER BY prioridad, capacidad";
            $rs_tm = executeQuery($sql_tm);
        }
        if (empty($rs_tm)) {
            $sql_tm = "SELECT * FROM  SINIESTROS_DIRECCIONADOR
            WHERE NOMBRE_TALLER = 'TALLER INDEMNIZACION'";
            $rs_tm = executeQuery($sql_tm);
        }

        $mail_responsa_taller = $rs_tm['1']['email_taller'];

        @@json_taller = $sql_tm;

        @@datos_taller = $rs_tm['1'];

        //RUC TALLER - Cristhian 17/07/2026
        @@frm_ruc_taller = $rs_tm['1']['ruc_taller'];

        //$mail_responsa_taller = $rs_tm['1']['email_taller'];
        //$mail_responsa_taller = 'elara@mundomotriz.com.ec';
        $sql_u = "SELECT USR_UID FROM USERS WHERE USR_EMAIL = '$mail_responsa_taller'";
        $rs_u = executeQuery($sql_u);
        if (empty($rs_u)) {
            $sql_u = "SELECT USR_UID FROM USERS WHERE USR_POSITION = '$mail_responsa_taller'";
            $rs_u = executeQuery($sql_u);
        }


        @@tri_user_taller = $rs_u['1']['USR_UID'];
        @@tri_tipo_taller = $rs_tm['1']['tipo'];
        @@tri_nombre_taller = $rs_tm['1']['nombre_taller'];

        if (@@tri_user_taller == null) {
            echo ($mail_responsa_taller);
            die();
        }
    }
}
