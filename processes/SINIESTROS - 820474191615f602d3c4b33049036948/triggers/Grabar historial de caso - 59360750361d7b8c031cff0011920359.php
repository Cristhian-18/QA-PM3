<?php
//<?phpcreated by Henry Bautista
//20-08-2020
//Grabar historial de caso
try {

    @@tri_consultar_datos = '';
    //@@tmp_isaac = '';

    @@tmp_sql_com = 'DMAIN';

    $cnx = '11264850561d723f004d5c2072943786';
    $app_uid   = @@APPLICATION;
    $task_uid  = @@TASK;
    $del_index           = @@INDEX;
    $del_index_siguiente = @@INDEX + 1;
    $cod_negativa = 0;
    @@frm_accion_aux  = @@frm_accion;

    $sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
    $rs  = executeQuery($sql);
    $rs_actual    = $rs['1'];
    $rs_siguiente = $rs['2'];

    $ticket              = @@APP_NUMBER;
    $usr_uid_actual      = @@USER_LOGGED;

    $fecha_inicio        = ($rs_actual['DEL_INIT_DATE'] != '') ? $rs_actual['DEL_INIT_DATE'] : '';
    $fecha_fin           = date('Y-m-d H:i:s');
    $fecha_vencimiento   = ($rs_actual['DEL_TASK_DUE_DATE'] != '') ? $rs_actual['DEL_TASK_DUE_DATE'] : '';
    $fecha_derivacion    = ($rs_actual['DEL_DELEGATE_DATE'] != '') ? $rs_actual['DEL_DELEGATE_DATE'] : '';

    $usr_uid_receptor    = $rs_siguiente['USR_UID'];
    $tas_uid_actual    = $rs_siguiente['TAS_UID'];
    $tarea_actual    = PMFGetTaskName($rs_siguiente['TAS_UID'], 'es');

    @@tmp_entra = @@TASK;
    //validacion por tarea
    switch (@@TASK) {
        //tarea 1
        case '799986505615f607b50a4f4033464318':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            if ($accion == 'CONTINUAR') {
                $sql = "UPDATE SINIESTRO_REGISTRADO SET usr_auditor = '$usr_uid_receptor' WHERE app_uid = '$app_uid'";
                $rs = executeQuery($sql, $cnx);
            } else {
                @@tri_bandera_sac = 'true';
                @@tri_bandera_cliente = 'true';
            }
            //estado del flujo catalogo ESTADO_EVENTO
            @@tri_estado_evento = 1;
            $cod_estado = @@tri_estado_evento;
            break;
        //tarea 1 sin reserva
        case '50123164765fa44f68d77b7041621403':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            //estado del flujo catalogo ESTADO_EVENTO
            @@tri_estado_evento = 1;
            $cod_estado = @@tri_estado_evento;
            break;
        //tarea 2
        case '309930261615f607b901f74034966395':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            @@tri_user_auditor      = @@USER_LOGGED;
            @@tri_bandera_sac = 'true';
            //estado del flujo catalogo ESTADO_EVENTO
            @@tri_estado_evento = 2;

            if ($accion == 'NO_PROCEDER') {
                //estado negado no procede
                @@tri_consultar_datos = 'true';
                $estado = 5;
                $cod_negativa = @@frm_razon_negativa;
                $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
                $rs = executeQuery($sql, $cnx);
                //estado del flujo catalogo ESTADO_EVENTO
                @@tri_estado_evento = 9;
            }
            if ($accion == 'NEGAR') {
                //estado negado
                @@tri_consultar_datos = 'true';
                $estado = 4;
                $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
                $rs = executeQuery($sql, $cnx);
                $cod_negativa = @@frm_razon_negativa;
                //estado del flujo catalogo ESTADO_EVENTO
                @@tri_estado_evento = 4;
            }
            if ($accion == 'DOCUMENTAR') {
                @@tri_bandera_analista = 'true';
                //estado del flujo catalogo ESTADO_EVENTO
                @@tri_estado_evento = 11;
            }
            if ($accion == 'MANTENER') {
                @@tri_bandera_analista = 'true';
                @@tri_bandera_upreserva = 'true';
                @@frm_monto_liquidar_aux = @@frm_monto_liquidar;
                //estado del flujo catalogo ESTADO_EVENTO
                @@tri_estado_evento = 2;
            }
            $cod_estado = @@tri_estado_evento;
            break;
        //tarea 1.2
        case '86240770361d652fbb6f186074849549':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            $cod_negativa = (@@frm_razon_negativa == '' ? 0 : @@frm_razon_negativa);
            //estado negado
            $estado = 4;
            $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
            $rs = executeQuery($sql, $cnx);
            @@tri_bandera_Negado_medico = 'true';
            //estado del flujo catalogo ESTADO_EVENTO
            @@tri_estado_evento = 4;
            $cod_estado = @@tri_estado_evento;
            @@tri_bandera_negado = 'NEGADO';
            break;
        //tarea 2.1
        case '77775011261e6e6a3f16759039105464':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            if ($accion == 'APROBAR') {
                @@tri_bandera_monto = 'true';
                @@frm_monto_liquidar = @@frm_monto_aprobado;
            }
            $cod_estado = @@tri_estado_evento;
            break;
        //tarea 2.2 desbloqueo
        case '55791594965f5a2ef34bfd4003637297':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            $cod_estado = @@tri_estado_evento;
            break;
        //TAREA 3
        case '78637654361d6525d2e3a08010058577':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            @@frm_accion_medico     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            @@tri_bandera_analista = 'true';
            $cod_estado = @@tri_estado_evento;
            break;
        //Tarea 4
        case '810510287615f607b9b5ca4074139938':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            //estado del flujo catalogo ESTADO_EVENTO
            @@tri_estado_evento = 5;
            if ($accion == 'NEGAR') {
                //estado negado
                @@tri_consultar_datos = 'true';
                $estado = 4;
                $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
                $rs = executeQuery($sql, $cnx);
                //estado del flujo catalogo ESTADO_EVENTO
                @@tri_estado_evento = 4;
            }
            $cod_estado = @@tri_estado_evento;
            break;
        //Tarea 4.1
        case '359772973624db81b5141e6050784057':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            @@tri_bandera_negativa = 'true';
            //estado del flujo catalogo ESTADO_EVENTO
            @@tri_estado_evento = 4;
            $cod_estado = @@tri_estado_evento;
            break;
        //Tarea 5
        case '82593904961d6539d3a40c1083663438':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            //estado del flujo catalogo ESTADO_EVENTO
            @@tri_estado_evento = 8;
            $cod_estado = @@tri_estado_evento;
            break;
        //Tarea 5.1
        case '586273038621f946de70059012786039':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            $cod_estado = @@tri_estado_evento;
            break;
        //Tarea 5.2
        case '65489101862290a70b3abf4053213172':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            @@tri_bandera_parcial = 'true';
            $cod_estado = @@tri_estado_evento;
            break;
		//Tarea 5.3
		case '29023130167e58726b94ea6041483832':
			$comentario = @@frm_comentario;
			$accion = @@frm_accion;
			$accion_label = @@frm_accion_label;
			//estado
			if(@@frmCmbTipoLiquidacion == 'PARCIAL') {
				$estado = 7;
				$cod_estado = @@tri_estado_evento;
				$sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
				$rs = executeQuery($sql, $cnx);
			}
			break;
        //Tarea 6
        case '54146797061d7b93a9bcdd0041253461':
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            //estado
            $estado = @@cod_estado_evento;
            $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
            $rs = executeQuery($sql, $cnx);
            $cod_estado = @@tri_estado_evento;
            break;
        //Tarea ADJUNTAR DOCUMTO

        case '746727803624e063116b8f7094625923':
            @@tmp_entra = 'entra TAREA';
            //@@tmp_isaac = 'antes de condicional';

            if (@@ajx_adjunta == 'SI') {
                @@tmp_entra = 'entra si ASDDSAS';
                $comentario = @@TASK; // 'Documentos enviados por el cliente';
                $accion     = 'Adjuntos cliente';
                $accion_label     = 'Documento enviado por el cliente';
                //estado
                $estado = 'DOCUMENTO RECIBIDO';
            }

            if (@@ajx_adjunta != 'SI') {
                @@tmp_entra = 'no wntraDSADSDSDASDS';
                $comentario = @@TASK; // 'Documentos no han sido enviados por el cliente';
                $accion     =  'VENCIDO';
                $accion_label     = 'Documentos faltantes';
                //estado
                $estado = 'DOCUMENTO NO RECIBIDO';
            }

            $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
            $rs = executeQuery($sql, $cnx);
            $cod_estado = @@tri_estado_evento;
            break;
        //Tarea 2 Auditoria Insurance
        case '72084067668da4feeb0e3a9021632379':
            echo 'ENTRA TAREA AUDITORIA';
            $comentario = @@frm_comentario;
            $accion     = @@frm_accion;
            $accion_label     = @@frm_accion_label;
            @@tri_estado_evento = 2;
            $cod_estado = 2;
            $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = 2 WHERE app_uid = '$app_uid'";
            $rs = executeQuery($sql, $cnx);
            break;
        //Tarea 3 Analista Insurance
        case '12045909868ef4c0bb41b37067088253':
            echo 'ENTRA TAREA ANALISTA';
            $comentario   = @@frm_comentario;
            $accion       = @@frm_accion;
            $accion_label = @@frm_accion_label;

            if ($accion == 'FINALIZAR_I') {
                if (@@frmTipoGestion == 'NEGATIVA') {
                    $estado = 4;
                    $cod_estado = 4;
                } else if (@@frmTipoGestion == 'LIQUIDACION') {
                    $estado = 5;
                    $cod_estado = 5;
                }

                $sql = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE app_uid = '$app_uid'";
                $rs = executeQuery($sql, $cnx);
            } else {
                $cod_estado = 2;
            }
            @@tri_estado_evento = $cod_estado;
            break;
        default:
            $comentario = '--';
            $accion = 'damisan';
            break;
    }

    $sql = "INSERT INTO SINIESTRO_BITACORA (
        APP_NUMBER,
        APP_UID,
        TASK_UID,
        FECHA_INICIO,
        FECHA_FIN,
        FECHA_DERIVACION,
        FECHA_VENCIMIENTO,
        DEL_INDEX,
        COD_ACCION,
        USR_UID_ACTUAL,
        USR_UID_RECEPTOR,
        COMENTARIO, ACCION, COD_NEGATIVA, COD_ESTADO)
        values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', '$comentario','$accion_label', '$cod_negativa','$cod_estado')";
    @@tmp_sql_com = $sql;
    $rs_i = executeQuery($sql, $cnx);

    //@@frm_comentario = '';
    //@@frm_accion = '';
    //@@frm_accion_label = '';

    //para saber la tarea actual de los casos en proceso
    $sql_t = "UPDATE SINIESTRO_REGISTRADO SET tas_uid = '$tas_uid_actual', tarea = '$tarea_actual' WHERE app_uid = '$app_uid'";
    $rs_t = executeQuery($sql_t, $cnx);

    //esto es para actualizar la fecha de vencimiento
    $fecha_notificacion = @@frm_fecha_notificacion;
    $dias_respuesta = @@frm_dias_respuesta;

    $date_actual = date('Y-m-d');

    $date_respuesta = date("Y-m-d", strtotime($fecha_notificacion . "+ $dias_respuesta days"));

    @@frm_fecha_respuesta = $date_respuesta;

    //actualizamos la tabla para las notificaciones
    $sql = "UPDATE APP_DELEGATION SET DEL_TASK_DUE_DATE = '$date_respuesta' WHERE app_uid = '$app_uid' AND DEL_LAST_INDEX = 1";
    $rs = executeQuery($sql);
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
