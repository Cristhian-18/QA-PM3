<?php
//<?php
// condicion @@tri_seq_persona == 'NO_DEFINIDO'

$tipo = @@frm_cliente_tipo_identificacion;
$cedula = @@frm_cliente_cedula;
$Token = @@Token;
$cedula = '1707984272';

@@tmp_damian = @@tmp_damian +1;

@@tri_seq_persona = 0;
@@tri_secEmpleoDependiente = 0;
@@tri_seq_persona = 0;
@@tri_codTelefono = 0;
@@tri_codtipoTelefono = 0;
@@tri_contacto_preferido_seq = 0;
@@tri_contacto_preferido_tipo = 0;
@@tri_secEmpleoDependiente = 0;
@@tri_secActividad = 0;
@@tri_sec_direccion_electronica = 0;
@@tri_codEmailTrabajo = 0;
@@tri_trabajo_codTelefonoConv = 0;
@@tri_trabajo_codtipoTelefonoConv= 0;
@@tri_trabajo_codTelefonoCel = 0;
@@tri_trabajo_codtipoTelefonoCel= 0;
@@tri_trabajo_codTelefonoConv = 0;
@@tri_trabajo_codtipoTelefonoConv= 0;
@@tri_trabajo_codTelefonoCel = 0;
@@tri_trabajo_codtipoTelefonoCel= 0;
@@tri_domicilio_secDireccion = 0;
@@tri_trabajo_secDireccion = 0;
@@tri_sec_persona_pep = 0;
$usuario = @@USR_USERNAME;
$url = @@datos_url."informacion/$tipo/$cedula/$usuario";

@@tmp_url = $url;
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => $url,
    CURLOPT_CUSTOMREQUEST  => 'GET',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer $Token"
    )
));

try{
    //	$url = @@datos_url."informacion/C/$cedula";
    //	$result = file_get_contents($url);
    //	$datos['data'] = json_decode($result,true);
    //	@@data = $datos['data'];
    //@@data = $result;

    $response = curl_exec($curl);
    $err      = curl_error($curl);
    curl_close($curl);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'Consultar enriquecimiento',
        $url,
        'GET',
        'Authorization: Bearer ',
        'NO APLICA',
        $response,
        $err
    );

    // inicializar secuencial para posterior envio si no existe 0
    @@tri_seq_persona = 0;
    @@tri_secEmpleoDependiente = 0;
    $datos['data'] = json_decode($response,true);
    @@tmp_datacu = $datos['data'];

    if (isset($datos['data']['datosPersonales']['identificacion']) ){
        @@tri_seq_persona = $datos['data']['datosPersonales']['secPersonaNatural'];

        @@frm_tipo_identificacion = @@frm_cliente_tipo_identificacion;
        @@frm_numero_identificacion = @@frm_cliente_cedula;
        @@frm_primer_nombre = @@frm_cliente_nombre;
        @@frm_segundo_nombre = (@@frm_cliente_segundo_nombre != '' ? @@frm_cliente_segundo_nombre : $datos['data']['datosPersonales']['segundoNombre']);
        @@frm_apellido_paterno = @@frm_cliente_apellidoPaterno;
        @@frm_apellido_materno = (@@frm_cliente_apellidoMaterno != '' ? @@frm_cliente_apellidoMaterno : $datos['data']['datosPersonales']['apellidoMaterno']);
        @@frm_fecha_nacimiento = @@frm_cliente_fechaNacimiento;

        //@@frm_numero_identificacion = $datos['data']['datosPersonales']['identificacion'];
        //@@frm_tipo_identificacion = $datos['data']['datosPersonales']['tipoIdentificacion'];
        //@@frm_apellido_paterno = $datos['data']['datosPersonales']['apellidoPaterno'];
        //@@frm_apellido_materno = $datos['data']['datosPersonales']['apellidoMaterno'];
        //@@frm_primer_nombre = $datos['data']['datosPersonales']['primerNombre'];
        //@@frm_segundo_nombre = $datos['data']['datosPersonales']['segundoNombre'];
        @@frm_sexo = $datos['data']['datosPersonales']['sexo'];
        @@frm_sexo1 = $datos['data']['datosPersonales']['sexo'];
        //@@frm_fecha_nacimiento = $datos['data']['datosPersonales']['fechaNacimiento'];
        @@frm_lugar_residencia_habitual = $datos['data']['datosPersonales']['lugarResidencia'];
        @@frm_nacionalidad = $datos['data']['datosPersonales']['paisNacionalidad'];
        @@frm_pais_nacimiento = $datos['data']['datosPersonales']['paisNacimiento'];
        @@frm_ciudad_nacimiento = $datos['data']['datosPersonales']['ciudadNacimiento'];
        //@@frm_estado_civil = $datos['data']['datosPersonales']['estadoCivil'];
        @@frm_estado_civil1 = $datos['data']['datosPersonales']['estadoCivil'];
        @@frm_numero_hijos = $datos['data']['datosPersonales']['numeroHijos'];

        @@tri_domicilio_secDireccion = $datos['data']['direccionDomicilio']['secDireccion'];
        @@frm_provincia = $datos['data']['direccionDomicilio']['provincia'];
        @@frm_canton = $datos['data']['direccionDomicilio']['canton'];
        //@@xxxxxxxxxxxx = $datos['data']['direccionDomicilio']['ciudad'];//No hay en el formulario
        @@frm_calle_principal = $datos['data']['direccionDomicilio']['principal'];
        @@frm_calle_transversal = $datos['data']['direccionDomicilio']['secundaria'];
        @@frm_barrio = $datos['data']['direccionDomicilio']['barrio'];
        $frm_conjunto_edificio = $datos['data']['direccionDomicilio']['edificio'];
        @@frm_conjunto_edificio = $frm_conjunto_edificio;
        @@frm_conjunto_edificio = limpiarCadena($frm_conjunto_edificio);
        @@frm_departamento_casa = $datos['data']['direccionDomicilio']['oficina'];//No hay en el formulario
        @@frm_numero = $datos['data']['direccionDomicilio']['numero'];
        @@frm_envio_correspondencia = $datos['data']['direccionDomicilio']['correspondencia'];

        // telefonos de domicilio
        $domicilio_telefonos = $datos['data']['direccionDomicilio']['telefonos'];
        $conv = '';
        $celu = @@frm_celular;

        foreach($domicilio_telefonos as $row){
            $tipo = $row['codtipoTelefono'];
            $estado = $row['estado'];
            $celular = $row['codArea'].$row['numero'];
            if ($estado == 'A'){
                if ($tipo == '1' && $conv == ''){
                    @@frm_seqConvencional = $row['codTelefono'];
                    @@frm_codigo_provincia = $row['codArea'];
                    @@frm_convencional = $row['numero'];
                    $conv = $row['numero'];
                }
                if ($tipo == '6' && $celu == $celular){
                    @@tri_codTelefono = $row['codTelefono'];
                    //@@frm_celular = $row['numero'];
                    $celu = $row['numero'];
                }

            }
        }

        // email personal
        $domicilio_email = $datos['data']['direccionDomicilio']['direccionElectronica'];
        $emailp = @@frm_correo_electronico_personal;

        foreach($domicilio_email as $row){
            $email = $row['direccion'];
            $estado = $row['estado'];
            if ($email == $emailp && $estado == 'A' ){
                @@tri_sec_direccion_electronica = $row['codDireccion'];
            }
        }


        @@tri_contacto_preferido_seq = $datos['data']['direccionDomicilio']['contactosPreferidos']['secContactoPreferido'];
        @@tri_contacto_preferido_tipo = $datos['data']['direccionDomicilio']['contactosPreferidos']['codTipoContactoPreferido'];
        @@frm_hora_inicial = round($datos['data']['direccionDomicilio']['contactosPreferidos'][0]['horaInicioContacto']);
        @@frm_hora_final = round($datos['data']['direccionDomicilio']['contactosPreferidos'][0]['horaFinContacto']);

        @@frm_conyuge_numero_identificacion = $datos['data']['datosConyuge']['identificacion'];
        @@frm_conyuge_tipo_identificacion = $datos['data']['datosConyuge']['tipoIdentificacion'];
        @@frm_conyuge_apellido_paterno = $datos['data']['datosConyuge']['apellidoPaterno'];
        @@frm_conyuge_apellido_materno = $datos['data']['datosConyuge']['apellidoMaterno'];
        @@frm_conyuge_primer_nombre = $datos['data']['datosConyuge']['primerNombre'];
        @@frm_conyuge_segundo_nombre = $datos['data']['datosConyuge']['segundoNombre'];
        @@frm_conyuge_fecha_nacimiento  = $datos['data']['datosConyuge']['fechaNacimiento'];


        @@frm_ocupacion_profesion = $datos['data']['actividadEconomica']['cod_profesion'];
        //@@frm_ocupacion_tipo
        @@frm_ocupacion_profesion_label = $datos['data']['actividadEconomica']['profesion'];
        //		@@frm_ocupacion_tipo_label = $datos['data']['actividadEconomica']['ocupacion'];
        $frm_ocupacion_tipo1 = $datos['data']['actividadEconomica']['cod_ocupacion'];
        @@frm_ocupacion_tipo = $frm_ocupacion_tipo1;
        @@frm_ocupacion_tiene_otra_actividad = ($frm_ocupacion_tipo1 == '0'? 'N' : 'S');
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['empleoIndependiente'];
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['actividadEconomicaEmplIndep'];
        @@frm_trabajo_expuesta_politicamente = (isset($datos['data']['actividadEconomica']['pep']['codCategoriaPpe']) ? 'S':'N');
        @@frm_trabajo_categoria = (isset($datos['data']['actividadEconomica']['pep']['codCategoriaPpe']) ? $datos['data']['actividadEconomica']['pep']['codCategoriaPpe']:'');

        @@tri_sec_persona_pep = $datos['data']['actividadEconomica']['pep']['secPersonaPpe'];

        // tipo de empleo
        @@frm_ocupacion_tipo_empleo = (strlen(@@frm_ocupacion_nombre_empresa) != 0 ? 5 : '');
        $tipo_empleo = 0;
        $tipo_empleo = ($datos['data']['actividadEconomica']['empleoDependiente']['estado'] == 'A'? '5': $tipo_empleo );
        $tipo_empleo = ($datos['data']['actividadEconomica']['empleoIndependiente']['estado'] == 'A'? '6': $tipo_empleo );
        @@frm_ocupacion_tipo_empleo = $tipo_empleo;




        @@tri_secEmpleoDependiente = $datos['data']['actividadEconomica']['empleoDependiente']['secEmpleoDependiente'];
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['empleoDependiente']['secPersonaNatural'];
        @@frm_ocupacion_nombre_empresa = $datos['data']['actividadEconomica']['empleoDependiente']['negocioEmpresa'];
        //@@frm_ocupacion_tipo_empleo = (strlen(@@frm_ocupacion_nombre_empresa) != 0 ? 5 : '');
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['empleoDependiente']['codActividadEconomica'];
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['empleoDependiente']['tiempoEmpresa'];
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['empleoDependiente']['codTiempo'];
        @@frm_ocupacion_cargo = limpiarCadena($datos['data']['actividadEconomica']['empleoDependiente']['cargo']);
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['empleoDependiente']['estado'];

        $secActividadD = $datos['data']['actividadEconomica']['actividadEconomicaEmplDep']['secActividad'];
        $actividadD = $datos['data']['actividadEconomica']['actividadEconomicaEmplDep']['actividad'];
        $secActividadI =  $datos['data']['actividadEconomica']['empleoIndependiente']['secActividad'];
        $actividadI =  $datos['data']['actividadEconomica']['empleoIndependiente']['actividad'];
        @@tri_secActividad = ($secActividadD == '' ? $secActividadI : $secActividadD);
        @@tri_actividad = ($actividadD == '' ? $actividadI : $actividadD);
        @@frm_ocupacion_mayor_ingresos = @@tri_secActividad;
        @@frm_ocupacion_mayor_ingresos_label = @@tri_actividad;
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['actividadEconomicaEmplDep']['actividad'];
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['actividadEconomicaEmplDep']['codigoVisible'];//a que se refiere ??
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['actividadEconomicaEmplDep']['nivel'];//a que se refiere ??
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['actividadEconomicaEmplDep']['ultimoNodo'];//a que se refiere ??

        @@tri_trabajo_secDireccion = $datos['data']['actividadEconomica']['informacionTrabajo']['secDireccion'];
        @@frm_trabajo_provincia = $datos['data']['actividadEconomica']['informacionTrabajo']['provincia'];
        @@frm_trabajo_canton = $datos['data']['actividadEconomica']['informacionTrabajo']['canton'];
        //@@xxxxxxxxxxxx = $datos['data']['actividadEconomica']['informacionTrabajo']['ciudad'];//No hay en el formulario
        @@frm_trabajo_calle_principal = $datos['data']['actividadEconomica']['informacionTrabajo']['principal'];
        @@frm_trabajo_calle_transversal = $datos['data']['actividadEconomica']['informacionTrabajo']['secundaria'];
        @@frm_trabajo_sector_barrio = $datos['data']['actividadEconomica']['informacionTrabajo']['barrio'];
        @@frm_trabajo_edificio = $datos['data']['actividadEconomica']['informacionTrabajo']['edificio'];
        @@frm_trabajo_oficina = $datos['data']['actividadEconomica']['informacionTrabajo']['oficina'];//No hay en el formulario
        @@frm_trabajo_numero = $datos['data']['actividadEconomica']['informacionTrabajo']['numero'];
        @@frm_trabajo_envio_correspondencia = $datos['data']['actividadEconomica']['informacionTrabajo']['correspondencia'];

        // email trabajo
        $trabajo_email =  $datos['data']['actividadEconomica']['informacionTrabajo']['direccionElectronica'];
        $emailt = '';
        foreach($trabajo_email as $row){
            $estado = $row['estado'];
            if ($estado == 'A' && $emailt == '' ){
                @@tri_codEmailTrabajo = $row['codDireccion'];
                @@frm_trabajo_correo_trabajo = $row['direccion'];
                $emailt = $row['direccion'];
            }
        }


        // telefonos de trabajo
        $trabajo_telefonos = $datos['data']['actividadEconomica']['informacionTrabajo']['telefonos'];
        @@tmp_tel_trabajo = $trabajo_telefonos;

        $conv = '';
        $celu = '';

        foreach($trabajo_telefonos as $row){
            $tipo = $row['codtipoTelefono'];
            $estado = $row['estado'];
            $celular = $row['codArea'].$row['numero'];
            @@tmp_damian_tt = 'entra '. $tipo;
            if ($estado == 'A'){
                if ($tipo == '2' && $conv == ''){
                    @@tri_trabajo_codTelefonoConv = $row['codTelefono'];
                    @@frm_trabajo_codigo_provincia = $row['codArea'];
                    @@frm_trabajo_convencional = $row['numero'];
                    $conv = $row['numero'];
                }
                if ($tipo == '4' && $celu == ''){
                    @@tri_trabajo_codTelefonoCel = $row['codTelefono'];
                    @@frm_trabajo_celular = $celular;
                    $celu  = $celular;
                }

            }
        }




        @@frm_trabajo_hora_inicial = $datos['data']['actividadEconomica']['informacionTrabajo']['contactosPreferidos'][0]['horaInicioContacto'];
        @@frm_trabajo_hora_final = $datos['data']['actividadEconomica']['informacionTrabajo']['contactosPreferidos'][0]['horaFinContacto'];
        @@tri_secContactoPreferido = $datos['data']['actividadEconomica']['informacionTrabajo']['contactosPreferidos'][0]['secContactoPreferido'];
    }
}
catch(SoapFault $result){
    $datos['error'] = 'SI';
    @@sw_mina = 0;
    echo json_encode($datos);
}
@@sw_mina += 1;
@@tmp_trabakp = @@frm_trabajo_correo_trabajo;
