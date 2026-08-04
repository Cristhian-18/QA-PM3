<?php
@@tmp_persistencia = '';
@@tmp_persistencia_response = '';
@@tri_persistencia_respuesta = '';
@@tri_persistencia_respuesta_label = '';



$pro_uid = @@PROCESS;
$sql = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'PERSISTENCIA' AND ESTADO = 1";
$rs  = executeQuery($sql);
$url = $rs['1']['VALOR'];
$apiKey = $rs['1']['CAMPO2']; 
$origenCode = $rs['1']['INTEGRACION']; 

@@TMP_URL = $url;

/* Recupera destinatarios de correo */
$desPARA = '';
$desCC   = '';
$desBCC  = '';
$sql_correo = "SELECT * FROM ADMIN_CATALOGOS WHERE PRO_UID = 'GENERICO' AND INTEGRACION = '5393441295ebc1555705f98060769179' AND DESCRIPCION = 'Enviar persistencia CU'";
$rs_correo  = executeQuery($sql_correo);
$desPARA = $rs_correo[1]['VALOR'];
$desCC   = $rs_correo[1]['CAMPO2'];
$desBCC  = $rs_correo[1]['CAMPO1'];

$user    = 'sys_bpm_user';
$user_ip = '10.10.22.62';


// Identificación
$frm_numero_identificacion = @@frm_numero_identificacion;
$frm_tipo_identificacion   = @@frm_cliente_tipo_identificacion;
if ($frm_tipo_identificacion == '' || $frm_tipo_identificacion == null) {
    $frm_tipo_identificacion = preg_match('/[a-zA-Z]/', $frm_numero_identificacion) ? 'P' : 'C';
    $mdm_tipo_identificacion = ($frm_tipo_identificacion == 'P') ? '9c64159d-5bc0-4f66-adfe-420590ceac0f' : 'f092e4ef-7a6d-4ece-8190-0a9b95039b3d';
}

// Datos personales
$frm_apellido_paterno  = @@frm_apellido_paterno;
$frm_apellido_materno  = @@frm_apellido_materno;
$frm_primer_nombre     = @@frm_primer_nombre;
$frm_segundo_nombre    = @@frm_segundo_nombre;
$frm_pais_nacimiento   = @@frm_pais_nacimiento;
$frm_ciudad_nacimiento = @@frm_ciudad_nacimiento;
$frm_fecha_nacimiento  = @@frm_fecha_nacimiento;
$frm_sexo              = (@@frm_sexo == "M")?'d8b72567-48db-4642-b03a-fbaa6cb27d2c':'aa2e98e5-ad0b-4802-b86e-cbd04c93de8d';
$frm_estado_civil      = @@frm_estado_civil;
$frm_numero_hijos      = @@frm_numero_hijos;

$sql_mdm_pais = "SELECT CAMPO1 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'PAISES' AND CODIGO = '$frm_pais_nacimiento' AND ESTADO = 1";
$rs_mdm_pais  = executeQuery($sql_mdm_pais);
$mdm_pais = $rs_mdm_pais[1]['CAMPO1'];

$sql_mdm_ciudad = "SELECT CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'PROVINCIAS' AND VALOR = '$frm_ciudad_nacimiento' AND ESTADO = 1";
$rs_mdm_ciudad  = executeQuery($sql_mdm_ciudad);
$mdm_ciudad = $rs_mdm_ciudad[1]['CAMPO2'];

$sql_mdm_civil = "SELECT CAMPO1 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'ESTADO_CIVIL' AND CODIGO = '$frm_estado_civil' AND ESTADO = 1";
$rs_mdm_civil  = executeQuery($sql_mdm_civil);
$mdm_civil = $rs_mdm_civil[1]['CAMPO1'];

// PEP
$pep                          = @@frm_trabajo_expuesta_politicamente;
$frm_expuesta_PEP_codigo      = @@frm_expuesta_codigo;
$frm_expuesta_PEP_institucion = @@frm_expuesta_insttucion;
$frm_expuesta_fecha           = @@frm_expuesta_fecha;
$tiene_familiar_pep           = @@frm_trabajo_expuesta_politicamente_familiar;
$frm_expuesta_parentesco      = @@frm_expuesta_parentesco;
$frm_expuesta_especifique_nombre = @@frm_expuesta_especifique_nombre;
$frm_expuesta_especifique_cargo = @@frm_expuesta_especifique_cargo;

// Financiera
$frm_financiera_actividad_principal = @@frm_financiera_actividad_principal;
$frm_ingresos_familiares            = @@frm_ingresos_familiares;
$frm_financiera_otros_ingresos      = @@frm_financiera_otros_ingresos;
$frm_origen_otros_ingresos_label    = ($frm_financiera_otros_ingresos == '' || $frm_financiera_otros_ingresos == '0.00' || @@frm_origen_otros_ingresos_label == 'N\/A'  || @@frm_origen_otros_ingresos_label == 'N/A')?"8b43f81e-2e8e-437f-9b29-de0de2f8c725":@@frm_origen_otros_ingresos_label;
$frm_financiera_total_egresos       = @@frm_financiera_total_egresos;
$frm_financiera_total_activos       = @@frm_financiera_total_activos;
$frm_financiera_total_pasivos       = @@frm_financiera_total_pasivos;

// Ocupación
$frm_ocupacion_tipo_empleo    = @@frm_ocupacion_tipo_empleo;
$sql_tipo_oc = "SELECT CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'OCUPACIONES_MG' AND CODIGO = '$frm_ocupacion_tipo_empleo'";
$rs_tipo_oc  = executeQuery($sql_tipo_oc, $cnx);
$mdm_tipo_empleo = $rs_tipo_oc['1']['CAMPO2'];

$frm_ocupacion_nombre_negocio = (@@frm_ocupacion_nombre_negocio == '' ? @@frm_ocupacion_nombre_empresa : @@frm_ocupacion_nombre_negocio);
$frm_ocupacion_mayor_ingresos = @@frm_ocupacion_mayor_ingresos;
$frm_ocupacion_cargo          = @@frm_ocupacion_cargo;  
$frm_ocupacion_nombre_empresa = @@frm_ocupacion_nombre_empresa;

$tri_ocupa_mag = @@tri_profesion_magnum;
$sql_oc = "SELECT CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'OCUPACIONES' AND INTEGRACION = '$tri_ocupa_mag'";
$rs_oc  = executeQuery($sql_oc, $cnx);
$mdm_ocupacion = $rs_oc['1']['CAMPO2'];

// Cónyuge
$frm_conyuge_tipo_identificacion   = @@frm_conyuge_tipo_identificacion;
$mdm_tipo_identificacion = ($frm_conyuge_tipo_identificacion == 'P') ? '9c64159d-5bc0-4f66-adfe-420590ceac0f' : 'f092e4ef-7a6d-4ece-8190-0a9b95039b3d';
$frm_conyuge_numero_identificacion = @@frm_conyuge_numero_identificacion;
$frm_conyuge_apellido_paterno      = @@frm_conyuge_apellido_paterno;
$frm_conyuge_apellido_materno      = @@frm_conyuge_apellido_materno;
$frm_conyuge_primer_nombre         = @@frm_conyuge_primer_nombre;
$frm_conyuge_segundo_nombre        = @@frm_conyuge_segundo_nombre;
$frm_conyuge_fecha_nacimiento      = (@@frm_conyugue_fecha_nacimiento == '' ? '1900-01-01' : @@frm_conyugue_fecha_nacimiento);

// Dirección domicilio
$frm_pais              = @@frm_pais;
$sql_pais_dir = "SELECT CAMPO1 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'PAISES' AND CODIGO = '$frm_pais'";
$rs_pais_dir  = executeQuery($sql_pais_dir, $cnx);
$mdm_pais_dir = $rs_pais_dir['1']['CAMPO1'];

$frm_provincia         = @@frm_provincia;
$sql_prov_dir = "SELECT CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'PROVINCIAS' AND CODIGO = '$frm_provincia'";
$rs_prov_dir  = executeQuery($sql_prov_dir, $cnx);
$mdm_prov_dir = $rs_prov_dir['1']['CAMPO2'];

$frm_canton            = @@frm_canton;
$sql_canton_dir = "SELECT CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'CANTONES' AND CODIGO = '$frm_canton'";
$rs_canton_dir  = executeQuery($sql_canton_dir, $cnx);
$mdm_canton_dir = $rs_canton_dir['1']['CAMPO2'];

$frm_barrio            = @@frm_barrio;
$frm_calle_principal   = @@frm_calle_principal;
$frm_calle_transversal = @@frm_calle_transversal;
$frm_numero            = substr(@@frm_numero, 0, 8);
$frm_conjunto_edificio = @@frm_conjunto_edificio;

// Contacto personal
$frm_celular                     = (@@frm_celular == '' ? 'ND' : @@frm_celular);
$mdm_tipo_celular                = '558a3719-6eed-473a-a2f5-677522bbbdf6';
$frm_correo_electronico_personal = @@frm_correo_electronico_personal;

// Dirección y contacto laboral
$frm_trabajo_calle_principal   = (@@frm_trabajo_calle_principal ? @@frm_trabajo_calle_principal : @@frm_trabajo_direccion);
$frm_trabajo_calle_transversal = @@frm_trabajo_calle_transversal;
$frm_trabajo_edificio          = @@frm_trabajo_edificio;
$frm_trabajo_numero            = substr(@@frm_trabajo_numero, 0, 8);
$frm_trabajo_provincia         = @@frm_trabajo_provincia;
$frm_trabajo_canton            = @@frm_trabajo_canton;
$frm_trabajo_canton_label      = @@frm_trabajo_canton_label;
$frm_trabajo_sector_barrio     = @@frm_trabajo_sector_barrio;
$frm_trabajo_convencional      = (@@frm_trabajo_convencional == '' ? 'ND' : @@frm_trabajo_convencional);
$frm_trabajo_celular           = (@@frm_trabajo_celular == '' ? 'ND' : @@frm_trabajo_celular);
$frm_trabajo_correo_trabajo    = @@frm_trabajo_correo_trabajo;

$preferido = @@frm_trabajo_envio_correspondencia;
$mdm_preferido = ($preferido == 1) ? $frm_correo_electronico_personal : $frm_trabajo_correo_trabajo;
$mdm_no_preferido = ($preferido != 1) ? $frm_correo_electronico_personal : $frm_trabajo_correo_trabajo;
$mdm_dir_preferido = ($preferido == 1) ? "0b274248-a95f-4dfb-b197-508f5367c815x" : "ba40c670-6a94-4163-b3cb-8e5539ae7f7e";

$posee_otros_ingresos = ($frm_financiera_otros_ingresos != '' && $frm_financiera_otros_ingresos != '0' && $frm_financiera_otros_ingresos != '0.00');

$tieneDomicilio = !empty(trim(@@frm_calle_principal));
$tieneTrabajo   = !empty(trim(@@frm_trabajo_direccion));

$direcciones = [];

if ($tieneDomicilio) {
    $domicilio = [
        "pais"                       => $mdm_pais_dir,
        "provincia"                  => $mdm_prov_dir,
        "canton"                     => $mdm_canton_dir,
        "barrio_sector_ciudadela"    => $frm_barrio,
        "calle_principal"            => $frm_calle_principal,
        "calle_secundaria"           => $frm_calle_transversal,
        "numero"                     => $frm_numero,
        "edificio_condominio_manzana"=> $frm_conjunto_edificio
    ];
}

if ($tieneTrabajo) {
    $trabajo = [
        "pais"                       => $mdm_pais_dir,
        "provincia"                  => $mdm_prov_dir,
        "canton"                     => $mdm_canton_dir,
        "barrio_sector_ciudadela"    => $frm_trabajo_sector_barrio,
        "calle_principal"            => $frm_trabajo_calle_principal,
        "calle_secundaria"           => $frm_trabajo_calle_transversal,
        "numero"                     => $frm_trabajo_numero,
        "edificio_condominio_manzana"=> $frm_trabajo_edificio
    ];
}

if ($preferido == 1) {
    // Domicilio preferido
    if ($tieneDomicilio) {
        $preferida = $domicilio;
    } elseif ($tieneTrabajo) {
        $preferida = $trabajo;
    }
} else {
    // Trabajo preferido
    if ($tieneTrabajo) {
        $preferida = $trabajo;
    } elseif ($tieneDomicilio) {
        $preferida = $domicilio;
    }
}

// ========================================
// Agregar dirección preferida
// ========================================
if (isset($preferida)) {
    $direcciones[] = array_merge(
        ["tipo_direccion" => "0b274248-a95f-4dfb-b197-508f5367c815"],
        $preferida
    );
}

// ========================================
// Agregar domicilio
// ========================================
if ($tieneDomicilio) {
    $direcciones[] = array_merge(
        ["tipo_direccion" => "7f39aa4a-0c48-431b-9476-b28e6a8dbe2e"],
        $domicilio
    );
}

// ========================================
// Agregar trabajo
// ========================================
if ($tieneTrabajo) {
    $direcciones[] = array_merge(
        ["tipo_direccion" => "ba40c670-6a94-4163-b3cb-8e5539ae7f7e"],
        $trabajo
    );
}

// Armar JSON nueva estructura
$var_json = [
    "codigoFormulario" => "form_bpm_cliente_unico_natural",
    "data" => [
        "tipo_identificacion"       => $mdm_tipo_identificacion,
        "numero_documento"          => $frm_numero_identificacion,
        "apellido_paterno"          => $frm_apellido_paterno,
        "apellido_materno"          => $frm_apellido_materno,
        "primer_nombre"             => $frm_primer_nombre,
        "segundo_nombre"            => $frm_segundo_nombre,
        "pais_nacimiento"           => $mdm_pais,
        "ciudad_nacimiento"         => $mdm_ciudad,
        "nacionalidad"              => [$mdm_pais],
        "fecha_nacimiento"          => $frm_fecha_nacimiento,
        "genero"                    => $frm_sexo,
        "estado_civil"              => $mdm_civil,
        "ocupacion"                 => $mdm_ocupacion,
        "canal"                     => "1f3d5b79-8c2a-4f6e-b1d3-9a7c5e2f8b44",
        "deportes"                  => '5c8a7e12-3d4f-4b91-a2c7-8f1e6d9b3a45',
        "numero_hijos"              => intval($frm_numero_hijos),
        "tipo_empleo"               => $mdm_tipo_empleo,
        "es_pep"                    => ($pep == 'S'),
        "cargo_desempena_pep"       => "0d0fab1c-5beb-4543-b2ac-12ae329ee35a",
        "CargoPep"                  => isset($frm_expuesta_especifique)?$frm_expuesta_especifique:'',
        "institucion_pep"           => $frm_expuesta_PEP_institucion,
        "fecha_inicio_cargo_pep"    => $frm_expuesta_fecha,
        "tiene_familiar_pep"        => ($tiene_familiar_pep == 'S'),
        //"parentesco_pep"            => $mdm_parentesco_pep,
        "nombre_familiar_pep"       => $frm_expuesta_especifique_nombre,
        "cargo_familiar_pep"        => "0d0fab1c-5beb-4543-b2ac-12ae329ee35a",
        "CargoFamiliarPep"          => $frm_expuesta_especifique_cargo,
        "ingresos_mensuales_usd"    => (isset($frm_financiera_actividad_principal) && $frm_financiera_actividad_principal !== '' && $frm_financiera_actividad_principal !== 'N/A') ? (float)$frm_financiera_actividad_principal : 0,
        "ingresos_familiares_usd"   => (isset($frm_ingresos_familiares) && $frm_ingresos_familiares !== '' && $frm_financiera_actividad_principal !== 'N/A') ? (float)$frm_financiera_actividad_principal : 0,
        "egresos_mensuales_usd"     => (isset($frm_financiera_total_egresos) && $frm_financiera_total_egresos !== '' && $frm_financiera_total_egresos !== 'N/A') ? (float)$frm_financiera_total_egresos : 0,
        "posee_otros_ingresos"      => $posee_otros_ingresos,
        "fuente_otros_ingresos"     => $frm_origen_otros_ingresos_label,
        "valor_otros_ingresos_usd"  => (isset($frm_financiera_otros_ingresos) && $frm_financiera_otros_ingresos !== '' && $frm_financiera_otros_ingresos !== 'N/A') ? (float)$frm_financiera_otros_ingresos : 0,
        "total_activos_usd"         => (isset($frm_financiera_total_activos) && $frm_financiera_total_activos !== '' && $frm_financiera_total_activos !== 'N/A') ? (float)$frm_financiera_total_activos : 0,
        "total_pasivos_usd"         => (isset($frm_financiera_total_pasivos) && $frm_financiera_total_pasivos !== '' && $frm_financiera_total_pasivos !== 'N/A') ? (float)$frm_financiera_total_pasivos : 0,        
        "direcciones"               => $direcciones,
        "telefonos" => [
            [
                "tipo_telefono" => "68cb6e4d-4224-4e46-a51f-0196153d0412",
                "telefono"      => $frm_celular
            ],
            [
                "tipo_telefono" => "5a1a7d6c-bfc7-43c4-a4cd-f6b5e217f13b",
                "telefono"      => $frm_trabajo_celular
            ]
        ],
        "correos_electronicos" => [
            [
                "tipo_correo_electronico" => "1e7d1526-1116-4b43-9ed9-3b101df17270",
                "correo_electronico"      => $mdm_preferido
            ],
            [
                "tipo_correo_electronico" => "9cfc782e-37a4-492d-8ef8-78e6a06ea730",
                "correo_electronico"      => $mdm_preferido
            ],
            [
                "tipo_correo_electronico" => "fa9fc52e-00b3-4197-b2fd-8770fa6b33cc",
                "correo_electronico"      => $mdm_no_preferido
            ]
        ],
        "empleo_dependiente" => in_array($frm_ocupacion_tipo_empleo, ['DEPENDIENTE', 'DEPENDIENTE_1']) ? [
            [
                "cargo"                  => $frm_ocupacion_cargo,
                "razon_social_empleador" => $frm_ocupacion_nombre_empresa,
                "actividad_economica"    => "b10b00f6-268b-4212-a208-744b6feda253"
            ]
        ] : [],
        "empleo_independiente" => ($frm_ocupacion_tipo_empleo == 'INDEPENDIENTE') ? [
            [
                "cargo"               => $frm_ocupacion_cargo_label,
                "razon_social"        => $frm_ocupacion_nombre_negocio,
                "actividad_economica" => "b10b00f6-268b-4212-a208-744b6feda253"
            ]
        ] : [],
        "user_bpm"        => $user,
        "caso_bpm"        => @@APP_NUMBER,
        "ip_modificacion" => $user_ip
    ]
];

if ($frm_estado_civil != 1){
    $var_json["data"]["conyuge"] = [
        "tipo_identificacion" => $mdm_tipo_identificacion,
        "identificacion"      => $frm_conyuge_numero_identificacion,
        "apellido_paterno"    => $frm_conyuge_apellido_paterno,
        "apellido_materno"    => $frm_conyuge_apellido_materno,
        "primer_nombre"       => $frm_conyuge_primer_nombre,
        "segundo_nombre"      => $frm_conyuge_segundo_nombre,
        "fecha_nacimiento"    => $frm_conyuge_fecha_nacimiento
    ];
}

$var_json = json_encode($var_json);
@@tmp_json_ClienteUnico = $var_json;


$headers = [
    'Content-Type: application/json',
    'apiKey: ' . trim($apiKey),
    'x-origin-code: ' . trim($origenCode)
];

// Envío al servicio web
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => '',
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS     => $var_json,
    CURLOPT_HTTPHEADER     => $headers,
]);
$response = curl_exec($curl);

$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$err = curl_error($curl);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Enviar persistencia CU', $url, 'POST', print_r($headers), $var_json, $response , $err);

if (empty($response)) {
    $html_decision_notificacion = 'No existen valores de respuesta';
    @@html_decision_notificacion = $html_decision_notificacion;
    @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, '', $desPARA, $desCC, $desBCC, 'Problemas en la persistencia CU Caso BPM: ' . @#APP_NUMBER, 'Notificacion_manual.html', []);
    echo '<h3><br>Problemas en la generacion de la persistencia CU<br>Comuniquese con el administrador del sistema</h3>';
    die();
}

$respuesta      = json_decode($response, true);
$sincronizacion = $respuesta['sincronizacionRespuestas'][0] ?? [];
$respuestaBody  = $sincronizacion['respuestaBody'] ?? [];

@@tmp_persistencia_response        = $response;
@@tri_persistencia_respuesta       = $respuesta['success'] ? 'true' : 'false';
@@tri_persistencia_respuesta_label = $sincronizacion['codigoRespuesta'] ?? '';

// Se agrega validación de exitoso y error a nivel de sincronización
$exitosoSincronizacion = $sincronizacion['exitoso'] ?? false;
$errorBody             = $respuestaBody['error'] ?? false;
$txterrorBody          = $respuestaBody['txterror'] ?? null;

if ($respuesta['success'] == true && $exitosoSincronizacion == true && $errorBody == false) {
    @@tri_id_persona_CU = $respuestaBody['idPersona'] ?? 0;

    if (@@tri_id_persona_CU == 0 || empty(@@tri_id_persona_CU)) {
        @@tri_CodAseg_SISE = 0;
        $html_decision_notificacion = $respuesta['postProcessResult'] ?? 'ID_PERSONA retornado es 0';
        @@html_decision_notificacion = $html_decision_notificacion;
        @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, '', $desPARA, $desCC, $desBCC, 'Problemas en la persistencia CU -ID_PERSONA 0- Caso BPM: ' . @#APP_NUMBER, 'Notificacion_manual.html', []);
    } else {
        @@tri_CodAseg_SISE               = $respuestaBody['codAseg'] ?? 0;
        @@tri_persist_secpersona_natural = $respuesta['idRegistroMaestro'] ?? '';
        @@tri_persist_secpersona         = $respuesta['uuidRegistroFormulario'] ?? '';
        @@tri_persist_version            = (@@tri_persist_version == '' ? 1 : @@tri_persist_version + 1);
        @@frm_accion_cu                  = 'CONTINUAR';
    }
} else {
    @@tri_id_persona_CU              = '';
    @@tri_CodAseg_SISE               = '';
    @@tri_persist_secpersona_natural = '';
    @@tri_persist_secpersona         = '';
    @@tri_persist_version            = '';
    @@frm_accion_cu                  = 'REFERIR';

    // Mensaje de error: priorizar txterror del body, luego postProcessResult
    $html_decision_notificacion = $txterrorBody 
        ?? $respuesta['postProcessResult'] 
        ?? 'Error en la respuesta del servicio';
    @@html_decision_notificacion = $html_decision_notificacion;
    @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, '', $desPARA, $desCC, $desBCC, 'Problemas en la persistencia CU Caso BPM: ' . @#APP_NUMBER, 'Notificacion_manual.html', []);
}
