<?php
//<?

$task = @@TASK;
$operacion = @@frm_ds_tipoOperacion;

switch ($task) {
    //T2: Analizar Revisar Coberturas Siniestro
    case '73612224465558363c37e35011666953':
		if($operacion == "COASEGURO ACEPTADO"){
			@=array_acciones = array(
				array('', '-- Seleccione --'),
				array('REASIGNAR', 'Solicitar Atención a Nuevo Analista'),
				array('INFORMAR', 'Solicitar información a coaseguradora lider'),
				array('NEGAR', 'Revisar la Información de la Negativa'),
				array('FINALIZAR', 'Cerrar caso'),
				array('ESPERAR', 'Esperar Cierre'),
				array('APROBAR', 'Enviar a Aprobación de Siniestro')
			);
		} else {
			@=array_acciones = array(
				array('', '-- Seleccione --'),
				array('REASIGNAR', 'Solicitar Atención a Nuevo Analista'),
				array('DOCUMENTAR', 'Solicitar Documentos al Asegurado/Broker'),
				array('AJUSTADOR', 'Enviar el caso al Ajustador / MDA si aplica'),
				//array('REASEGURO', 'Solicitud Ajustador Reaseguros'),
				//array('NEGAR', 'Revisar la Información de la Negativa'),
				array('DESESTIMIENTO', 'Aprobar carta de desistimiento'),
				array('FINALIZAR', 'Cerrar caso'),
				//array('CIERRE', 'Notificar Salvamentos'),
				//array('ESPERAR', 'Esperar  Cierre'),
				//array('LEGAR', 'Aprobar Negativa'),
				//array('APROBAR', 'Enviar a MDA para Aprobar Siniestro')
                //array('FINALIZAR', 'Cerrar caso'),
			);
		}

        $tipo_operacion = @@tri_tipo_operacion;
        
        if($tipo_operacion=='1'){
           
            @=array_acciones = array(
				array('', '-- Seleccione --'),
                array('CONTINUAR', 'Enviar el caso al Ajustador / MDA si aplica'),	
                array('REASIGNAR', 'Solicitar Atención a Nuevo Analista'),
                array('DOCUMENTAR', 'Solicitar Documentos al Asegurado/Broker'),
                array('FINALIZAR', 'Cerrar caso'),
			);
        }

        break;
    //T3: Aprobar carta deducible
    case '695119116655583dbb8ea09096196722':
        @=array_acciones = array(
            array('', '-- Selecciona --'),
            array('REGRESAR', 'Revisar Coberturas Siniestro'),
            array('FINALIZAR', 'Finalizar Carta Deducible'),
        );
        break;
    //T4: Solicitar ajustador reaseguros
    case '2658432166555847bc41125032580507':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('CONTINUAR', 'Asignar ajustador'),
        );
        break;
		//T3 Información reaseguradora lider
		case '738155266659cc290468b62073029372':
			@=array_acciones = array(
				array('', '-- Seleccione --'),
				array('CONTINUAR', 'Enviar información'),
				array('CONTINUAR', 'Enviar informe preliminar'),
				array('CONTINUAR', 'Enviar informe final'),

			);
			break;

    //T5: Registrar inspección
    case '60452835965558543c85a45021452334':
       /*if (@@tri_bandera_inspeccion == 'true') {
            @=array_acciones = array(
                array('', '-- Seleccione --'),
                array('ESPERAR', 'Registrar nueva inspección'),
                array('DOCUMENTAR', 'Solicitar Documentos al Asegurado/Broker'),
                array('CONTINUAR_IP', 'Enviar al analista para revisión de Informe Preliminar'),
                array('CONTINUAR_IF', 'Enviar al analista para revisión de Informe Final'),
            );
        } else {
            @=array_acciones = array(
                array('', '-- Seleccione --'),
                array('ESPERAR', 'Registrar datos de la inspección')
            );
        }*/
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('ESPERAR', 'Registrar nueva inspección'),
            array('DOCUMENTAR', 'Solicitar Documentos al Asegurado/Broker'),
            array('CONTINUAR_IP', 'Enviar al analista para revisión de Informe Preliminar'),
            array('CONTINUAR_IF', 'Enviar al analista para revisión de Informe Final'),
        );
        break;
    //T5.1: Realizar Gestion Siniestro Asegurado
    case '1423020706555856bc5ca73082558635':
        @=array_acciones = array(
            array('CONTINUAR', 'Enviar Información a la Aseguradora'),
        );
        break;
    //T6: Aprobación informe reaseguros
    case '89697538965558593c71d93006162635':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('REGRESAR', 'Revisar Coberturas Siniestro'),
        );
        break;

    //T4: Revisar Información de la negativa
    case '779528443655585e407cd17072201870':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('REGRESAR', 'Revisar Coberturas Siniestro'),
            array('CONTINUAR', 'Enviar a MDA para Aprobar Siniestro')
        );
        break;
    //T5: Aprobar Negativa
    case '37174648165655d95040468017560408':
        @=array_acciones = array(
            array('', '-- Selecciona --'),
            array('REGRESAR', 'Revisar Coberturas Siniestro'),
        );
            //T5: Aprobar Generacion

        break;
        case '3135985756694ba217fa7a6070980848':
            @=array_acciones = array(
                array('', '-- Selecciona --'),
                array('CONTINUAR', 'Aprobar Generación de Negativa'),
                array('REGRESAR', 'Revisar Coberturas Siniestro'),
            );
            break;
    //T5: Aprobar ajustador Externo
    case '9988199046555865bcb8e44005902575':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('REGRESAR', 'Enviar al Ajustador Informe Preliminar/Final con novedades'),
            array('REGRESAR_IP', 'Enviar al Ajustador para Elaborar el Informe Final'),
            array('REGRESAR_DOC', 'Enviar al Ajustador para Solicitar Documentos'),
            array('CONTINUAR', 'Enviar a aprobación del Siniestro'),
			array('DEDUCIBLE', 'Caso no supera deducible'),
            array('NEGATIVA', 'Revisar causales de negativa'),
            array('CERRAR', 'Cierre administrativo del caso'),
        );
        break;
    //T6: Esperar Informe Externo
    case '389487316655586d3ca8cc4095234799':
        @=array_acciones = array(
            array('', '-- Selecciona --'),
            array('REGRESAR', 'Revisar Coberturas Siniestro'),
        );
        break;
    //T3: Aprobar Cierre Administrativo
    case '21350858965655b15026a94011444687':
        @=array_acciones = array(
            array('', '-- Selecciona --'),
            array('REGRESAR', 'Revisar Coberturas Siniestro'),
        );
        break;
    //T5: Aprobar Siniestro
    case '367107911655586fbdaf2d7040282156':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('REGRESAR', 'Regresar al Analista para Revisar el Siniestro'),
            //array('CONTINUAR', 'Continuar con la Comunicación al Asegurado/Broker y Generación de AT & OP'),
            array('CONTINUAR', 'Aprobar siniestro - Generar AT & OP'),
            //array('CONTINUAR', 'Enviar informe preliminar a reaseguros'),
        );

        $tipo_operacion = @@tri_tipo_operacion;

        if($tipo_operacion=='1'){
           
            @=array_acciones = array(
				 array('', '-- Seleccione --'),
                array('REGRESAR', 'Regresar al Analista para Revisar el Siniestro'),
                array('CONTINUAR', 'Aprobar siniestro - Generar AT & OP'),
                //array('INFORMAR', 'Enviar informe preliminar a reaseguros'),
                //array('CERRAR', 'Cierre administrativo del caso'),
			);
        }

        $tri_tipo_ajustador = @@frm_as_tipoAjustador;
        //== 'SINIESTROS_AJUSTADORES_EXTERNOS'
        if($tri_tipo_ajustador == 'SINIESTROS_AJUSTADORES_EXTERNOS'){
            @=array_acciones = array(
                array('', '-- Seleccione --'),
                array('REGRESAR', 'Regresar al Analista para Revisar el Siniestro'),
                array('CONTINUAR', 'Aprobar siniestro - Generar AT & OP'),
            );
        } else {
            @=array_acciones = array(
                array('', '-- Seleccione --'),
                array('REGRESAR_INTERNO', 'Regresar al Analista para Revisar el Siniestro'),
                array('CONTINUAR', 'Aprobar siniestro - Generar AT & OP'),
            );
        }

        //IF USER_LOGGED == @@TRI_USR_ANALISTA
        if (@@tri_usr_analista == @@USER_LOGGED) {
            //add to array acciones CERRAR
            @=array_acciones[] = array('CERRAR', 'Cierre administrativo del caso');
        }
        break;
    //T4: Esperar Cierre
    case '74628754565655bb4eeac32057363201':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('REGRESAR', 'Revisar Coberturas Siniestro'),
            array('FINALIZAR', 'Finalizar Espera Cierre'),
        );
        break;
    //T3.1: Realizar Gestion Siniestro Asegurado
    case '23398454665558403c9e484080243447':
        @=array_acciones = array(
            array('CONTINUAR', 'Enviar Información a la Aseguradora')
        );
        break;
    //T6. Generar AT & OP
    case '310932373656561cd094902089638289':
        @=array_acciones = array(
            array('REGRESAR', 'Regresar caso al Analista'),
            array('FINALIZAR', 'Finalizar Caso liquidar en SISE y Completar los datos de liquidación en la pantalla')
        );
		/*if(@@tri_pre_liquidacion_confirmada == '1'  || @@frm_ac_tipoOperacion == 'COASEGURO ACEPTADO' ){
			@=array_acciones = array(
				array('', '-- Seleccione --'),
				//array('CONTINUAR', 'Enviar Pre-liquidación al Asegurado/Broker '),
				array('FINALIZAR', 'Finalizar Caso liquidar en SISE y Completar los datos de liquidación en la pantalla')
			);
			
		}else{
			@=array_acciones = array(
				array('', '-- Seleccione --'),
				array('CONTINUAR', 'Enviar Pre-liquidación al Asegurado/Broker '),
				array('REGRESAR', 'Regresar al Analista')
				//array('FINALIZAR', 'Finalizar Caso liquidar en SISE y Completar los datos de liquidación en la pantalla')
			);
		}*/
        break;

    //T2. Revisar documentación
    case '505404229655915398570b2027326575':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('CONTINUAR', 'Generación AT & OP'),
            array('REASEGURO', 'Cruzar Cuentas Generar AT & OP'),
            array('NOTIFICAR', 'Notificar'),
        );
        break;
    //T3. Cruzar cuentas Generar AT y OP
    case '6896732926565540ce8ab07058757238':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('FINALIZAR', 'Finalizar Cruzar cuentas Generar AT y OP'),
        );
        break;
    //T7. Cruzar cuentas Generar AT y OP
    case '8413667076579f0238dd164034023836':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('CONTINUAR', 'Valores y datos bancarios aprobados - Proceder con la Liquidación'),
            array('RECHAZAR', 'No Conforme - Regresar al Analista')
        );
        break;
    case '76135696765861acb123ee9051075483':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('CONTINUAR', 'Proceder con la Liquidación'),
            array('RECHAZAR', 'No Conforme - Regresar al Analista')
        );
        break;
    case '72887747765861bbacc9745012748827':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('CONTINUAR', 'Proceder con la Liquidación'),
            array('RECHAZAR', 'Solicitar fondos')
        );
        break;
    case '31952418665861c0ac7c649095432926':
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('CONTINUAR', 'Verificar fondos'),
        );
        break;
    case '32100622665861c5ace2d56010278465':
		if(@@tri_pre_liquidacion_confirmada == '1'){
			@=array_acciones = array(
				array('', '-- Seleccione --'),
				array('CONTINUAR', 'Enviar Pre-liquidación al Asegurado/Broker '),
				array('SOLICITAR', 'Pedir fondos a reaseguradoras'),
				array('FINALIZAR', 'Finalizar Caso liquidar en SISE y Completar los datos de liquidación en la pantalla')
			);
			
		}else{
			@=array_acciones = array(
				array('', '-- Seleccione --'),
                array('FINALIZAR', 'Finalizar Caso liquidar en SISE y Completar los datos de liquidación en la pantalla')
                //array('CONTINUAR', 'Enviar Pre-liquidación al Asegurado/Broker '),
				//array('FINALIZAR', 'Finalizar Caso liquidar en SISE y Completar los datos de liquidación en la pantalla')
			);
		}
		break;
        case '58790164865987c0b129c68092628820':
            @=array_acciones = array(
                array('', '-- Seleccione --'),
                array('CONTINUAR', 'Proceder con la Liquidación'),
                array('RECHAZAR', 'No Conforme - Regresar al Analista')
            );
            break;  
			case '723413561658509e7591eb3028796394':
				@=array_acciones = array(
					array('', '-- Seleccione --'),
					array('CONTINUAR', 'Enviar carta de negativa a aprobación'),
				);
				break;  
                case '20434072965850eab432110075536875':
				@=array_acciones = array(
					array('', '-- Seleccione --'),
					array('CONTINUAR', 'Aprobar solicitud de negativa'),
                    array('RECHAZAR', 'Rechazar solicitud de negativa'),
				);
				break;  
        case '73813869565a7797a2d9710039533010':
			@=array_acciones = array(
				array('', '-- Seleccione --'),
				array('CONTINUAR', 'Confirmar entrega de negativa'),
			);
			break;  
    default:
        @=array_acciones = array(
            array('', '-- Seleccione --'),
            array('CONTINUAR', 'Continuar (Acción sin continuar)'),
        );
        break;
}

