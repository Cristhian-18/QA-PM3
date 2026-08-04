<?php
$app_uid             = @@APPLICATION;
$task_uid            = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX + 1;
$cod_negativa        = 0;
@@frm_accion_aux     = @@frm_accion;

$sql          = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs           = executeQuery($sql);
$rs_actual    = $rs['1'];
$rs_siguiente = $rs['2'];

$ticket         = @@APP_NUMBER;
$usr_uid_actual = @@USER_LOGGED;

$fecha_inicio      = ($rs_actual['DEL_INIT_DATE'] != '') ? $rs_actual['DEL_INIT_DATE'] : '';
$fecha_fin         = date('Y-m-d H:i:s');
$fecha_vencimiento = ($rs_actual['DEL_TASK_DUE_DATE'] != '') ? $rs_actual['DEL_TASK_DUE_DATE'] : '';
$fecha_derivacion  = ($rs_actual['DEL_DELEGATE_DATE'] != '') ? $rs_actual['DEL_DELEGATE_DATE'] : '';

$usr_uid_receptor = $rs_siguiente['USR_UID'];
$tas_uid_actual   = $rs_siguiente['TAS_UID'];
$tarea_actual     = PMFGetTaskName($rs_siguiente['TAS_UID'], 'es');

@@tmp_entra = @@TASK;
//validacion por tarea
switch (@@TASK) {
    //tarea 1
    case '38904972565655b4c198e78054771644':
        $comentario   = 'Caso de RC Creado';
        $accion       = 'INGRESAR';
        $accion_label = 'Caso de Responsabilidad Civil Creado';
        break;
    //tarea 2 taller
    case '15211273265655b4cd97301035030415':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //TAREA 3
    case '22956853965655b4c6740a9088624477':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //Tarea 4
    case '25229672265655b4c093eb8086245900':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //Tarea 2.1 Analista
    case '34330388265655b4c89f459072594150':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //Tarea 2.1 reasig taller
    case '36558695365655b4c55e680055385982':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //Tarea 2.1 Realizar Gestión Cliente
    case '36655463565655b4ccb89e5046409039':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T2: Validar Información Siniestro - Comercial
    case '36980869965655b4c0f08e2009907393':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T3: Revisar Información Cartera del siniestro
    case '38904972565655b4c198e78054771644':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T3: Validar Información Siniestro - Analistas
    case '40083923465655b4ca13183037707738':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T3: Validar Información Siniestro - Analistas
    case '42291546065655b4cdf56a3065260878':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T5: Adjuntar Información del Siniestro
    case '43389830465655b4cf0bc10019163220':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T5: Registro de datos de los repuestos
    case '44191531765655b4c1f2274020255900':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T6: Recepción de repuestos
    case '50589541965655b4c2499b4031474219':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T6.1: Recepción de repuestos
    case '52511424465655b4c7efab8074151781':
        $comentario                = @@frm_comentario;
        $accion                    = @@frm_accion;
        $accion_label              = @@frm_accion_label;
        @@tri_mundo_partes_auditor = 'true';
        break;
    //Tarea ADJUNTAR DOCUMTO
    //T5: Aprobar Siniestro
    case '56755714965655b4c3a5577084383590':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //Tarea 6 pda
    case '57972646965655b4c848b46093756140':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T6: Revisar Información de la negativa
    case '58270552265655b4c8f7083025523155':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T7: Aprobar Carta de negativa
    case '61837752065655b4ceb35b6018527416':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //Tarea 7
    case '69077221665655b4d08df98069467175':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T5: Aprobar ajustador Externo
    case '72997535365655b4c9ad129058796434':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T5: Verificar daños del siniestro
    case '75546757665655b4c3f6903047204686':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T5: Aprobar daños del siniestro
    case '76721929965655b4c5c5779032982726':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T6: Verificar daños del siniestro Externo
    case '84345412765655b4c44d366036724895':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //T6.1: Adjuntar Información del Siniestro
    case '85716571365655b4ce53434023788704':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //Tarea 5 negativas
    case '87534098165655b4d02cc82035987145':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    //Tarea 5.1 negativas
    case '87945151265655b4c955010014276507':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    case '91462943765655b4c2f2756085808155':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    case '97595818565655b4c78e628054402425':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
	//T7: Generación de Preliquidación - Cristhian
    case '1941622066a4bcee572f604098768635':
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = "Enviar Pre-liquidación";
        break;
	//T7.1: Notificación del Portal - Cristhian
    case '8406961446a4bcf0d531d54023710123':
        $comentario   = 'Datos recibidos y almacenados correctamente';
        $accion       = 'CONTINUAR';
        $accion_label = 'Notificación del Portal';
        break;

    case '59452589065655b4c29e5d9086516621':
        if (@@frm_comentario_aux != null) {
            @@frm_comentario = @@frm_comentario_aux;
        } else {
            @@frm_comentario = @@frm_comentario_label;
        }
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
    default:
        $comentario   = @@frm_comentario;
        $accion       = @@frm_accion;
        $accion_label = @@frm_accion_label;
        break;
}

@@tri_estado_evento = 1;
$cod_estado         = @@tri_estado_evento;

$sql = "INSERT INTO SINIESTRO_VH_BITACORA (
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
$rs_i         = executeQuery($sql);
