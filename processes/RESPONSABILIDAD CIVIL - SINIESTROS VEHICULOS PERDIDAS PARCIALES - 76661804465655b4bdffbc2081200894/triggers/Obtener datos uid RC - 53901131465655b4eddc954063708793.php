<?php
//Jean

$newCaseId = @@app_uid_rc;
$c         = new Cases();
$aCase     = $c->loadCase($newCaseId);

echo "Caso: " . $newCaseId . "<br>";


/*********Variables desde Perdidda Parcial de Vehículos SISE*********/

@@frm_numero_reclamo_sise  = $aCase['APP_DATA']['frm_numero_reclamo_sise'];
@@frm_numero_reporte_sise  = $aCase['APP_DATA']['frm_numero_reporte_sise'];
@@tri_bandera_error_sise   = $aCase['APP_DATA']['tri_bandera_error_sise'];
@@tri_msg_error_sise       = $aCase['APP_DATA']['tri_msg_error_sise'];

/*************************************************************************/



@@frm_provincia_reparacion      = $aCase['APP_DATA']['frm_provincia_reparacion'];
@@frm_origen_core_insurance     = $aCase['APP_DATA']['frm_origen_core_insurance'];
@@frm_reclamante_core_insurance = $aCase['APP_DATA']['frm_reclamante_core_insurance'];

//Solicitante
@@proccess_padre       = $aCase['APP_DATA']['proccess_padre'];
@@historialAnterior    = $aCase['APP_DATA']['grd_historial_caso'];
@@documentosAnteriores = $aCase['APP_DATA']['gridDocumentos'];
/*@@arr_Dtaparen = $aCase['APP_DATA']['arr_Dtaparen'];
@@arr_Dtamarcas = $aCase['APP_DATA']['arr_Dtamarcas'];*/
@@tri_id_stro = $aCase['APP_DATA']['tri_id_stro'];

@@frm_busqueda_datosBroker_Id = $aCase['APP_DATA']['frm_busqueda_datosBroker_Id'];
@@frm_codTipoAgente           = $aCase['APP_DATA']['frm_codTipoAgente'];

@@frm_id_pv                        = $aCase['APP_DATA']['frm_id_pv'];
@@frm_siniestro_seConsidera        = $aCase['APP_DATA']['frm_siniestro_seConsidera'];
@@frm_informacion_ramo             = $aCase['APP_DATA']['frm_poliza_ramo'];
@@frm_informacion_valorAsegurado   = $aCase['APP_DATA']['frm_vehiculo_valor_asegurado'];
@@frm_informacion_nombresCompletos = $aCase['APP_DATA']['frm_asegurado_nombres'];
@@frm_informacion_codigoAsegurado  = $aCase['APP_DATA']['frm_cod_aseg'];
@@frm_informacion_provincia        = $aCase['APP_DATA']['frm_accidente_provincia'];
@@frm_informacion_ciudad           = $aCase['APP_DATA']['frm_accidente_ciudad'];
@@frm_informacion_descripcion      = $aCase['APP_DATA']['frm_siniestro_detalle'];
@@frm_informacion_linea            = $aCase['APP_DATA']['frm_poliza_LineaNegocio'];
@@frm_informacion_ciudadPoliza     = $aCase['APP_DATA']['frm_poliza_sucursal'];

@@tri_nro_stro = $aCase['APP_DATA']['tri_nro_stro'];
@@tri_nro_stro = $aCase['APP_DATA']['app_number_padre'];
/*
@@frm_conductor_identificacion = $aCase['APP_DATA']['frm_conductor_identificacion'];
@@frm_conductor_nombres = $aCase['APP_DATA']['frm_conductor_nombres'];
@@frm_conductor_telefono = $aCase['APP_DATA']['frm_conductor_telefono'];
@@frm_conductor_relacion = $aCase['APP_DATA']['frm_conductor_relacion'];
@@frm_conductor_relacion_otro = $aCase['APP_DATA']['frm_conductor_relacion_otro'];
*/
@@frm_nroEndoso              = $aCase['APP_DATA']['frm_nroEndoso'];
@@chk_validacion_declaracion = $aCase['APP_DATA']['chk_validacion_declaracion'];
@@chk_vehiculo_derecho       = $aCase['APP_DATA']['chk_vehiculo_derecho'];
@@chk_vehiculo_frontal       = $aCase['APP_DATA']['chk_vehiculo_frontal'];
@@chk_vehiculo_izquierdo     = $aCase['APP_DATA']['chk_vehiculo_izquierdo'];
@@chk_vehiculo_posterior     = $aCase['APP_DATA']['chk_vehiculo_posterior'];
@@dropdownVar001             = $aCase['APP_DATA']['dropdownVar001'];
@@expresion_regular_1        = $aCase['APP_DATA']['expresion_regular_1'];
@@expresion_regular_2        = $aCase['APP_DATA']['expresion_regular_2'];
@@expresion_regular_3        = $aCase['APP_DATA']['expresion_regular_3'];
@@expresion_regular_4        = $aCase['APP_DATA']['expresion_regular_4'];
@@file_ajusteCotizacion      = $aCase['APP_DATA']['file_ajusteCotizacion'];
@@fle_cedula                 = $aCase['APP_DATA']['fle_cedula'];
@@fle_denuncia               = $aCase['APP_DATA']['fle_denuncia'];
@@fle_licencia               = $aCase['APP_DATA']['fle_licencia'];
@@fle_matricula              = $aCase['APP_DATA']['fle_matricula'];
@@fle_partePolicial          = $aCase['APP_DATA']['fle_partePolicial'];
@@frm_accesorios             = $aCase['APP_DATA']['frm_accesorios'];
@@frm_accidente_ciudad       = $aCase['APP_DATA']['frm_accidente_ciudad'];
@@frm_accidente_pais         = $aCase['APP_DATA']['frm_accidente_pais'];
@@frm_accidente_provincia    = $aCase['APP_DATA']['frm_accidente_provincia'];
@@frm_accion                 = $aCase['APP_DATA']['frm_accion'];
//@@frm_alcance_adicional = $aCase['APP_DATA']['frm_alcance_adicional'];
@@frm_alcance_motivo                          = $aCase['APP_DATA']['frm_alcance_motivo'];
@@frm_alcance_si                              = $aCase['APP_DATA']['frm_alcance_si'];
@@frm_alcance_tipo                            = $aCase['APP_DATA']['frm_alcance_tipo'];
@@frm_alcance_valor                           = $aCase['APP_DATA']['frm_alcance_valor'];
@@frm_alcanceAdicional_total                  = $aCase['APP_DATA']['frm_alcanceAdicional_total'];
@@frm_alcanceAdicional_valorMano              = $aCase['APP_DATA']['frm_alcanceAdicional_valorMano'];
@@frm_alcanceAdicional_valorManoAprobado      = $aCase['APP_DATA']['frm_alcanceAdicional_valorManoAprobado'];
@@frm_alcanceAdicional_valorRepuestos         = $aCase['APP_DATA']['frm_alcanceAdicional_valorRepuestos'];
@@frm_alcanceAdicional_valorRepuestosAprobado = $aCase['APP_DATA']['frm_alcanceAdicional_valorRepuestosAprobado'];
@@frm_alcanceAdicional_valorTotalAprobado     = $aCase['APP_DATA']['frm_alcanceAdicional_valorTotalAprobado'];
@@frm_analisisCobertura_analisisTecnico       = $aCase['APP_DATA']['frm_analisisCobertura_analisisTecnico'];
@@frm_analisisCobertura_superaDeducible       = $aCase['APP_DATA']['frm_analisisCobertura_superaDeducible'];
@@frm_analisisCoberturas_fecha                = $aCase['APP_DATA']['frm_analisisCoberturas_fecha'];
@@frm_analisisCoberturas_relacionTotal        = $aCase['APP_DATA']['frm_analisisCoberturas_relacionTotal'];
@@frm_analisisCoberturas_valorTotalReclamo    = $aCase['APP_DATA']['frm_analisisCoberturas_valorTotalReclamo'];
@@frm_asegurado_apellidos                     = $aCase['APP_DATA']['frm_asegurado_apellidos'];
@@frm_asegurado_celular                       = $aCase['APP_DATA']['frm_asegurado_celular'];
@@frm_asegurado_ciudad                        = $aCase['APP_DATA']['frm_asegurado_ciudad'];
@@frm_asegurado_identificacion                = $aCase['APP_DATA']['frm_asegurado_identificacion'];
@@frm_asegurado_mail1                         = $aCase['APP_DATA']['frm_asegurado_mail1'];
@@frm_asegurado_mail2                         = $aCase['APP_DATA']['frm_asegurado_mail2'];
@@frm_asegurado_nombres                       = $aCase['APP_DATA']['frm_asegurado_nombres'];
@@frm_asegurado_pais                          = $aCase['APP_DATA']['frm_asegurado_pais'];
@@frm_asegurado_provincia                     = $aCase['APP_DATA']['frm_asegurado_provincia'];
@@frm_asegurado_relacion                      = $aCase['APP_DATA']['frm_asegurado_relacion'];
@@frm_asegurado_relacion_otro                 = $aCase['APP_DATA']['frm_asegurado_relacion_otro'];
@@frm_asegurado_telefono                      = $aCase['APP_DATA']['frm_asegurado_telefono'];
@@frm_asegurado_tipo                          = $aCase['APP_DATA']['frm_asegurado_tipo'];
@@frm_broker_celular                          = $aCase['APP_DATA']['frm_broker_celular'];
@@frm_broker_mail1                            = $aCase['APP_DATA']['frm_broker_mail1'];
@@frm_broker_mail2                            = $aCase['APP_DATA']['frm_broker_mail2'];
@@frm_busqueda_apellidos                      = $aCase['APP_DATA']['frm_busqueda_apellidos'];
@@frm_busqueda_celular_1                      = $aCase['APP_DATA']['frm_busqueda_celular_1'];
@@frm_busqueda_celular_2                      = $aCase['APP_DATA']['frm_busqueda_celular_2'];
@@frm_busqueda_contratante                    = $aCase['APP_DATA']['frm_busqueda_contratante'];
@@frm_busqueda_dato                           = $aCase['APP_DATA']['frm_busqueda_dato'];
@@frm_busqueda_datosBroker                    = $aCase['APP_DATA']['frm_busqueda_datosBroker'];
@@frm_busqueda_ejecutivoAsignado              = $aCase['APP_DATA']['frm_busqueda_ejecutivoAsignado'];
@@frm_busqueda_fechaSiniestro                 = $aCase['APP_DATA']['frm_busqueda_fechaSiniestro'];
@@frm_busqueda_horaSiniestro                  = $aCase['APP_DATA']['frm_busqueda_horaSiniestro'];
@@frm_busqueda_identificacion                 = $aCase['APP_DATA']['frm_busqueda_identificacion'];
@@frm_busqueda_mail_1                         = $aCase['APP_DATA']['frm_busqueda_mail_1'];
@@frm_busqueda_mail_2                         = $aCase['APP_DATA']['frm_busqueda_mail_2'];
@@frm_busqueda_nombres                        = $aCase['APP_DATA']['frm_busqueda_nombres'];
@@frm_busqueda_tipo                           = $aCase['APP_DATA']['frm_busqueda_tipo'];
@@frm_busqueda_tipoContratante                = $aCase['APP_DATA']['frm_busqueda_tipoContratante'];
@@frm_carta_noDeducible                       = $aCase['APP_DATA']['frm_carta_noDeducible'];
@@frm_cartaDeducible                          = $aCase['APP_DATA']['frm_cartaDeducible'];
@@frm_cartaNegativa                           = $aCase['APP_DATA']['frm_cartaNegativa'];
@@frm_cartaNegativaLega                       = $aCase['APP_DATA']['frm_cartaNegativaLega'];
@@frm_codAseg                                 = $aCase['APP_DATA']['frm_codAseg'];
@@frm_codItem                                 = $aCase['APP_DATA']['frm_codItem'];
@@frm_codRamo                                 = $aCase['APP_DATA']['frm_codRamo'];
@@frm_comentario                              = $aCase['APP_DATA']['frm_comentario'];
@@frm_comentario_aux                          = $aCase['APP_DATA']['frm_comentario_aux'];
@@frm_comentarioAnalista                      = $aCase['APP_DATA']['frm_comentarioAnalista'];
@@frm_comentarioAnalista_ajustadorInterno     = $aCase['APP_DATA']['frm_comentarioAnalista_ajustadorInterno'];
@@frm_componente_accesorios                   = $aCase['APP_DATA']['frm_componente_accesorios'];
@@frm_componente_inundado                     = $aCase['APP_DATA']['frm_componente_inundado'];
@@frm_contratante                             = $aCase['APP_DATA']['frm_contratante'];
@@frm_correo_cliente                          = $aCase['APP_DATA']['frm_correo_cliente'];
@@frm_correo_deducibleAprobado                = $aCase['APP_DATA']['frm_correo_deducibleAprobado'];
@@frm_danios_detalle                          = @@danos;
@@frm_deducible_bancos                        = $aCase['APP_DATA']['frm_deducible_bancos'];
@@frm_deducible_deducible                     = $aCase['APP_DATA']['frm_deducible_deducible'];
@@frm_deducible_iva                           = $aCase['APP_DATA']['frm_deducible_iva'];
@@frm_deducible_ivaPorcentaje                 = $aCase['APP_DATA']['frm_deducible_ivaPorcentaje'];
@@frm_deducible_PorcentajeAsegurado           = $aCase['APP_DATA']['frm_deducible_PorcentajeAsegurado'];
@@frm_deducible_porcentajeBancos              = $aCase['APP_DATA']['frm_deducible_porcentajeBancos'];
@@frm_deducible_prima                         = $aCase['APP_DATA']['frm_deducible_prima'];
//@@frm_deducible_ProcentajeSiniestro = $aCase['APP_DATA']['frm_deducible_ProcentajeSiniestro'];
@@frm_deducible_rasa                  = $aCase['APP_DATA']['frm_deducible_rasa'];
@@frm_deducible_sscampesino           = $aCase['APP_DATA']['frm_deducible_sscampesino'];
@@frm_deducible_sscampesinoPorcentaje = $aCase['APP_DATA']['frm_deducible_sscampesinoPorcentaje'];
@@frm_deducible_tasa                  = $aCase['APP_DATA']['frm_deducible_tasa'];
@@frm_deducible_totalCliente          = $aCase['APP_DATA']['frm_deducible_totalCliente'];
@@frm_deducible_ValorAsegurado        = $aCase['APP_DATA']['frm_deducible_ValorAsegurado'];
//@@frm_deducible_ValorMinimo = $aCase['APP_DATA']['frm_deducible_ValorMinimo'];
@@frm_documento_perito = $aCase['APP_DATA']['frm_documento_perito'];
@@frm_documentos_check = $aCase['APP_DATA']['frm_documentos_check'];
//@@frm_documentos_cotizacion = $aCase['APP_DATA']['frm_documentos_cotizacion'];
//@@frm_documentos_cotizacionMundo = $aCase['APP_DATA']['frm_documentos_cotizacionMundo'];
//@@frm_documentos_evidencia = $aCase['APP_DATA']['frm_documentos_evidencia'];
//@@frm_documentos_evidenciaMundo = $aCase['APP_DATA']['frm_documentos_evidenciaMundo'];
@@frm_documentos_otros                     = $aCase['APP_DATA']['frm_documentos_otros'];
@@frm_ejcomercial_reasignar                = $aCase['APP_DATA']['frm_ejcomercial_reasignar'];
@@frm_emisionNegativa_causales             = $aCase['APP_DATA']['frm_emisionNegativa_causales'];
@@frm_emisionNegativa_causalNegativa       = $aCase['APP_DATA']['frm_emisionNegativa_causalNegativa'];
@@frm_emisionNegativa_certificadoPoliza    = $aCase['APP_DATA']['frm_emisionNegativa_certificadoPoliza'];
@@frm_emisionNegativa_ciudad               = $aCase['APP_DATA']['frm_emisionNegativa_ciudad'];
@@frm_emisionNegativa_clausulaNombrada     = $aCase['APP_DATA']['frm_emisionNegativa_clausulaNombrada'];
@@frm_emisionNegativa_cobertura            = $aCase['APP_DATA']['frm_emisionNegativa_cobertura'];
@@frm_emisionNegativa_condicionesGenerales = $aCase['APP_DATA']['frm_emisionNegativa_condicionesGenerales'];
@@frm_emisionNegativa_diasRestantes        = $aCase['APP_DATA']['frm_emisionNegativa_diasRestantes'];
@@frm_emisionNegativa_extemporanea         = $aCase['APP_DATA']['frm_emisionNegativa_extemporanea'];
@@frm_emisionNegativa_fechaAnalisis        = $aCase['APP_DATA']['frm_emisionNegativa_fechaAnalisis'];
@@frm_emisionNegativa_fechaUltimoDoc       = $aCase['APP_DATA']['frm_emisionNegativa_fechaUltimoDoc'];
@@frm_emisionNegativa_fechaUltimoPoliza    = $aCase['APP_DATA']['frm_emisionNegativa_fechaUltimoPoliza'];
@@frm_emisionNegativa_jefatura             = $aCase['APP_DATA']['frm_emisionNegativa_jefatura'];
@@frm_emisionNegativa_nombreUltimoDoc      = $aCase['APP_DATA']['frm_emisionNegativa_nombreUltimoDoc'];
@@frm_emisionNegativa_nombreUltimoDoc2     = $aCase['APP_DATA']['frm_emisionNegativa_nombreUltimoDoc2'];
@@frm_emisionNegativa_textoPoliza          = $aCase['APP_DATA']['frm_emisionNegativa_textoPoliza'];
@@frm_friss_codigo                         = $aCase['APP_DATA']['frm_friss_codigo'];
@@frm_friss_descripcion                    = $aCase['APP_DATA']['frm_friss_descripcion'];
@@frm_friss_fecha                          = $aCase['APP_DATA']['frm_friss_fecha'];
@@frm_friss_grid                           = $aCase['APP_DATA']['frm_friss_grid'];
@@frm_friss_importe                        = $aCase['APP_DATA']['frm_friss_importe'];
@@frm_friss_reporte                        = $aCase['APP_DATA']['frm_friss_reporte'];
@@frm_friss_score                          = $aCase['APP_DATA']['frm_friss_score'];
@@frm_friss_total                          = $aCase['APP_DATA']['frm_friss_total'];
@@frm_gestionTaller_fecha                  = $aCase['APP_DATA']['frm_gestionTaller_fecha'];
@@frm_gestionTaller_ubicacion              = $aCase['APP_DATA']['frm_gestionTaller_ubicacion'];
@@frm_gestionTaller_vehiculoTaller         = $aCase['APP_DATA']['frm_gestionTaller_vehiculoTaller'];
@@frm_gestionTaller_vehiculoTransito       = $aCase['APP_DATA']['frm_gestionTaller_vehiculoTransito'];
@@frm_grupoEndoso                          = $aCase['APP_DATA']['frm_grupoEndoso'];
@@frm_poliza_contratante                   = $aCase['APP_DATA']['frm_poliza_contratante'];
@@frm_poliza_FechaFin                      = $aCase['APP_DATA']['frm_poliza_FechaFin'];
@@frm_poliza_FechaFinA                     = $aCase['APP_DATA']['frm_poliza_FechaFinA'];
@@frm_poliza_FechaInicio                   = $aCase['APP_DATA']['frm_poliza_FechaInicio'];
@@frm_poliza_FechaInicioA                  = $aCase['APP_DATA']['frm_poliza_FechaInicioA'];
@@frm_poliza_LineaNegocio                  = $aCase['APP_DATA']['frm_poliza_LineaNegocio'];
@@frm_poliza_numero                        = $aCase['APP_DATA']['frm_poliza_numero'];
@@frm_poliza_producto                      = $aCase['APP_DATA']['frm_poliza_producto'];
@@frm_poliza_ramo                          = $aCase['APP_DATA']['frm_poliza_ramo'];
@@frm_poliza_sucursal                      = $aCase['APP_DATA']['frm_poliza_sucursal'];
@@frm_primaNeta                            = $aCase['APP_DATA']['frm_primaNeta'];
@@frm_primaTotal                           = $aCase['APP_DATA']['frm_primaTotal'];
@@frm_rastreoSatelital                     = $aCase['APP_DATA']['frm_rastreoSatelital'];
@@frm_requiere_AsesoriaLegal               = $aCase['APP_DATA']['frm_requiere_AsesoriaLegal'];
@@frm_requiere_PartePolicial               = $aCase['APP_DATA']['frm_requiere_PartePolicial'];
@@frm_rp_componente_e                      = $aCase['APP_DATA']['frm_rp_componente_e'];
@@frm_siniestro_afectado                   = $aCase['APP_DATA']['frm_siniestro_afectado'];
@@frm_siniestro_detalle                    = $aCase['APP_DATA']['frm_siniestro_detalle'];
@@frm_siniestro_direccion                  = $aCase['APP_DATA']['frm_siniestro_direccion'];
@@frm_siniestro_informacionResponsable     = $aCase['APP_DATA']['frm_siniestro_informacionResponsable'];
@@frm_siniestro_nombreResponsable          = $aCase['APP_DATA']['frm_siniestro_nombreResponsable'];
@@frm_siniestro_OtrosVehiculos             = $aCase['APP_DATA']['frm_siniestro_OtrosVehiculos'];
@@frm_siniestro_Personas                   = $aCase['APP_DATA']['frm_siniestro_Personas'];
@@frm_siniestro_placaResponsable           = $aCase['APP_DATA']['frm_siniestro_placaResponsable'];
@@frm_siniestro_Propiedad                  = $aCase['APP_DATA']['frm_siniestro_Propiedad'];
@@frm_solicitarPeritaje_causa              = $aCase['APP_DATA']['frm_solicitarPeritaje_causa'];
@@frm_solicitarPeritaje_correo             = $aCase['APP_DATA']['frm_solicitarPeritaje_correo'];
@@frm_solicitarPeritaje_estado             = $aCase['APP_DATA']['frm_solicitarPeritaje_estado'];
@@frm_solicitarPeritaje_fechaEntrega       = $aCase['APP_DATA']['frm_solicitarPeritaje_fechaEntrega'];
@@frm_solicitarPeritaje_nombre             = $aCase['APP_DATA']['frm_solicitarPeritaje_nombre'];
@@frm_sumaAseguradaCasco                   = $aCase['APP_DATA']['frm_sumaAseguradaCasco'];
@@frm_sumaAseguradaTotal                   = $aCase['APP_DATA']['frm_sumaAseguradaTotal'];
@@frm_taller                               = $aCase['APP_DATA']['frm_taller'];
@@frm_taller_capacidad                     = $aCase['APP_DATA']['frm_taller_capacidad'];
@@frm_taller_ciudad                        = $aCase['APP_DATA']['frm_taller_ciudad'];
@@frm_taller_codigo                        = $aCase['APP_DATA']['frm_taller_codigo'];
@@frm_taller_direccion                     = $aCase['APP_DATA']['frm_taller_direccion'];
@@frm_taller_email                         = $aCase['APP_DATA']['frm_taller_email'];
@@frm_taller_ExisteVehiculo                = $aCase['APP_DATA']['frm_taller_ExisteVehiculo'];
@@frm_taller_fechaIngreso                  = $aCase['APP_DATA']['frm_taller_fechaIngreso'];
@@frm_taller_horario                       = $aCase['APP_DATA']['frm_taller_horario'];
@@frm_taller_nombreContacto                = $aCase['APP_DATA']['frm_taller_nombreContacto'];
@@frm_taller_prioridad                     = $aCase['APP_DATA']['frm_taller_prioridad'];
@@frm_taller_provincia                     = $aCase['APP_DATA']['frm_taller_provincia'];
@@frm_taller_representante                 = $aCase['APP_DATA']['frm_taller_representante'];
@@frm_taller_saldo                         = $aCase['APP_DATA']['frm_taller_saldo'];
@@frm_taller_sector                        = $aCase['APP_DATA']['frm_taller_sector'];
@@frm_taller_serviciosAdicionales          = $aCase['APP_DATA']['frm_taller_serviciosAdicionales'];
@@frm_taller_telefonoContacto              = $aCase['APP_DATA']['frm_taller_telefonoContacto'];
@@frm_taller_tipo                          = $aCase['APP_DATA']['frm_taller_tipo'];
@@frm_taller_transitoVehiculo              = $aCase['APP_DATA']['frm_taller_transitoVehiculo'];
@@frm_taller_vehiculosIngresados           = $aCase['APP_DATA']['frm_taller_vehiculosIngresados'];
@@frm_tasa                                 = $aCase['APP_DATA']['frm_tasa'];
@@frm_tipoEndoso                           = $aCase['APP_DATA']['frm_tipoEndoso'];
@@frm_tipoSubNegocio                       = $aCase['APP_DATA']['frm_tipoSubNegocio'];
@@frm_txt_condiciones                      = $aCase['APP_DATA']['frm_txt_condiciones'];
/*@@frm_valoresAprobados_diasEstimadosReparacion = $aCase['APP_DATA']['frm_valoresAprobados_diasEstimadosReparacion'];
@@frm_valoresAprobados_manoObraProformada = $aCase['APP_DATA']['frm_valoresAprobados_manoObraProformada'];
@@frm_valoresAprobados_procentajeDescuentoProformado = $aCase['APP_DATA']['frm_valoresAprobados_procentajeDescuentoProformado'];
@@frm_valoresAprobados_totalProformado = $aCase['APP_DATA']['frm_valoresAprobados_totalProformado'];
@@frm_valoresAprobados_valoresRepuestos1 = $aCase['APP_DATA']['frm_valoresAprobados_valoresRepuestos1'];
@@frm_valoresAprobados_valorRepuestosProformado = $aCase['APP_DATA']['frm_valoresAprobados_valorRepuestosProformado'];*/
//@@frm_valoresSiniestro_diasEstimadosReparacion = $aCase['APP_DATA']['frm_valoresSiniestro_diasEstimadosReparacion'];
//@@frm_valoresSiniestro_manoObraProformada = $aCase['APP_DATA']['frm_valoresSiniestro_manoObraProformada'];
/*@@frm_valoresSiniestro_procentajeDescuentoProformado = $aCase['APP_DATA']['frm_valoresSiniestro_procentajeDescuentoProformado'];
@@frm_valoresSiniestro_totalProformado = $aCase['APP_DATA']['frm_valoresSiniestro_totalProformado'];
@@frm_valoresSiniestro_valoresRepuestos1 = $aCase['APP_DATA']['frm_valoresSiniestro_valoresRepuestos1'];
@@frm_valoresSiniestro_valoresRepuestos2 = $aCase['APP_DATA']['frm_valoresSiniestro_valoresRepuestos2'];
@@frm_valoresSiniestro_valorRepuestosProformado = $aCase['APP_DATA']['frm_valoresSiniestro_valorRepuestosProformado'];*/
@@frm_vehiculo_anio = @@anio;
//@@frm_vehiculo_chasis = $aCase['APP_DATA']['frm_vehiculo_chasis'];
//@@frm_vehiculo_color = $aCase['APP_DATA']['frm_vehiculo_color'];
@@frm_vehiculo_marca  = @@marca;
@@frm_vehiculo_modelo = @@modelo;
//@@frm_vehiculo_motor = $aCase['APP_DATA']['frm_vehiculo_motor'];
@@frm_vehiculo_placa = @@placa;
//@@frm_vehiculo_precioPromedio = $aCase['APP_DATA']['frm_vehiculo_precioPromedio'];
//@@frm_vehiculo_tipo = $aCase['APP_DATA']['frm_vehiculo_tipo'];
//@@frm_vehiculo_valor_asegurado = $aCase['APP_DATA']['frm_vehiculo_valor_asegurado'];
@@grd_accesorios               = $aCase['APP_DATA']['grd_accesorios'];
@@grd_alcance_proforma         = $aCase['APP_DATA']['grd_alcance_proforma'];
@@grd_CotizacionMundoPartes    = $aCase['APP_DATA']['grd_CotizacionMundoPartes'];
@@grd_CotizacionMundoPartesAud = $aCase['APP_DATA']['grd_CotizacionMundoPartesAud'];
@@grd_historial_caso           = $aCase['APP_DATA']['grd_historial_caso'];
@@grd_historial_siniestros     = $aCase['APP_DATA']['grd_historial_siniestros'];
@@grd_personas_afectados       = $aCase['APP_DATA']['grd_personas_afectados'];
@@grd_propiedad_afectados      = $aCase['APP_DATA']['grd_propiedad_afectados'];
@@grd_registro_siniestro       = $aCase['APP_DATA']['grd_registro_siniestro'];
//@@grd_valores_siniestros = $aCase['APP_DATA']['grd_valores_siniestros'];
@@grd_vehiculos           = $aCase['APP_DATA']['grd_vehiculos'];
@@grd_vehiculos_afectados = $aCase['APP_DATA']['grd_vehiculos_afectados'];
@@grid_id_causa           = $aCase['APP_DATA']['grid_id_causa'];

//@@tri_bandera_alcance = $aCase['APP_DATA']['tri_bandera_alcance'];
@@tri_bandera_compra_completada = $aCase['APP_DATA']['tri_bandera_compra_completada'];
@@tri_bandera_mundoMotriz       = $aCase['APP_DATA']['tri_bandera_mundoMotriz'];
@@tri_bandera_parcial           = $aCase['APP_DATA']['tri_bandera_parcial'];
@@tri_cartera                   = $aCase['APP_DATA']['tri_cartera'];
@@tri_condiciones_poliza        = $aCase['APP_DATA']['tri_condiciones_poliza'];
@@tri_imp_monto_estimado        = $aCase['APP_DATA']['tri_imp_monto_estimado'];

@@tri_imp_monto_pagado = $aCase['APP_DATA']['tri_imp_monto_pagado'];
@@tri_msg_error        = $aCase['APP_DATA']['tri_msg_error'];
@@tri_usr_analista     = $aCase['APP_DATA']['tri_usr_analista'];

$app_uid = @@APPLICATION;

if ($app_uid == '246983261661f71b9b10b06076376603') {
    //return;

    /*
    $sql_user = 'SELECT USR_UID FROM USERS WHERE USR_USERNAME = "MABAD"';
    $rs_user = executeQuery($sql_user);
    $usr_uid = $rs_user[1]['USR_UID'];

    $taskUID  = '38904972565655b4c198e78054771644';
    $newCaseUID = PMFNewCase(
        '76661804465655b4bdffbc2081200894',
        @@USER_LOGGED,
        $taskUID,
        array(
            'app_uid_rc' => '158638026673b46363c6697036260988',
            'app_number_padre' => '7327 - 2024 - RC1',
            'marca' => '367',
            'modelo' => 'CAMIONETA',
            'placa' => 'PBQ2998',
            'propietario' => 'CHIRIBOGA GONZALEZ FELIPE JOSÉ',
            'danos' => 'GOLPE EN LA PARTE DELANTERA',
            'anio' => '2020',
            'estado' => 'TALLER'
        ),
        "TO_DO"
    );
    echo "Nuevo caso creado: $newCaseUID";
    echo "salio";*/

    /*echo "Renovar reservas";
    $sql = "SELECT APP_UID, APP_NUMBER FROM APPLICATION WHERE PRO_UID = '35087580064a18c9776b638006106795' AND
    APP_INIT_DATE > '2024-09-01' LIMIT 1";
    $rs = executeQuery($sql);
    foreach ($rs as $key => $value) {
        echo "Caso: " . $value['APP_NUMBER'] . " - " . $value['APP_UID'] . "<br>";
        $c2 = new Cases();
        $pro_uid = '35087580064a18c9776b638006106795';
        $app_id = $value['APP_UID'];
        $case = $c2->loadCase($app_id);
        $idpv = $case['APP_DATA']['frm_id_pv'];
        $placa = $case['APP_DATA']['frm_vehiculo_placa'];

        $array_datos = array('idpv' => $idpv, "placa" => $placa);
        $json = json_encode($array_datos);

        $sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
        $rs_auth =  executeQuery($sql_cata_auth);
        $token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

        //INFO DE POLIZA POR PLACA E ID_PV
        $sql_cata_poli = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_poliza_Placa_IdPv'";
        $rs_poli =  executeQuery($sql_cata_poli);

        $url_poli = isset($rs_poli['1']['DESCRIPCION']) ? $rs_poli['1']['DESCRIPCION'] : '';
        $url_poli_param = $url_poli;
        try {
            echo $url_poli_param;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_poli_param);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    "Accept: application/json",
                    "Content-Type: application/json",
                    "Accept-Language: application/json",
                    "APIKEY: " . $token
                )
            );

            $res = curl_exec($ch);
            //echo $res;
            if (curl_errno($ch)) {
                $msg_m = curl_error($ch);
            }
            curl_close($ch);

            $result = json_decode($res);

            $datos_result = $result->data;

            $id_stro_insp = $case['APP_DATA']['tri_nro_stro'];

            foreach ($datos_result as $key => $data) {

                if ($key == 'siniestros') {
                    foreach ($data as $datasin) {
                        $idStroInsp = $datasin->idStroInsp;
                        $nroReclamoAgente = $datasin->nroReclamoAgente;

                        if ($id_stro_insp == $idStroInsp) {
                            $nro_stro = $datasin->nroStro;
                            $cod_ind_cob = $datasin->codCobertura;
                            if ($nro_stro == 0 || $nro_stro == '' || $nro_stro == null) {
                                echo "<p>NroStro:";
                                echo ($nro_stro);
                                $mensaje_error = "No se ha encontrado el nro stro.";
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        echo "Caso: " . $value['APP_NUMBER'] . " - " . $value['APP_UID']  . " - " . $cod_ind_cob . "<br>";
    }*/

    /*

    $caseId = '928981915660f3c522ad486003340696';
    $index  = '9';
    $userId = '33954659265bdc0fea0c634042342604';
    $c = new Cases();
    $result = $c->ReactivateCurrentDelegation($caseId, $index);

    $aCaseLoaded = $c->loadCase($caseId);
    $aCaseLoaded['APP_STATUS'] = 'TO_DO';
    $c->updateCase($caseId, $aCaseLoaded);
    echo "salio	";
    die();*/
    /*@@PROCCESS = '76661804465655b4bdffbc2081200894';
    @@PROCESS = '76661804465655b4bdffbc2081200894';*/
    /*$c = new Cases();
    //print all methods and its params in the class
    foreach (get_class_methods($c) as $method_name) {
        $method = new ReflectionMethod('Cases', $method_name);
        $params = $method->getParameters();
        echo $method_name . ' (';
        foreach ($params as $param) {
            echo '$' . $param->getName() . ', ';
        }
        echo ')<br>';
    }*/
    /*$aCase = $c->loadCase($app_uid);
    $aVars = array(
        "PROCESS" => '76661804465655b4bdffbc2081200894',
    );
    $aCase['APP_DATA'] = array_merge($aCase['APP_DATA'], $aVars);
    $c->updateCase($app_uid, $aCase);*/
    //@@tri_usr_analista = '9451630656567a38658b475017343789';
    //die();
    //@@frm_accion = 'ACTUALIZAR';
    return;
}
return;
//return;

/*
@@arr_Dtapais = $aCase['APP_DATA']['arr_Dtapais'];
@@arr_Dtaprov = $aCase['APP_DATA']['arr_Dtaprov'];
@@arr_DtaCant = $aCase['APP_DATA']['arr_DtaCant'];*/

//<?php
//Incializar Datos Solicitud

$pro_uid        = 'GENER';
@@tri_msg_error = '';

//catalogos de marcas modelos
//obtengo el token
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN'";
$rs_auth       = executeQuery($sql_cata_auth);

$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

//PAIS
$sql_cata_infoPais = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Pais'";
$rs_infoPais       = executeQuery($sql_cata_infoPais);

$url_infoPais     = isset($rs_infoPais['1']['DESCRIPCION']) ? $rs_infoPais['1']['DESCRIPCION'] : '';
$url_inPais_param = $url_infoPais = isset($rs_infoPais['1']['DESCRIPCION']) ? $rs_infoPais['1']['DESCRIPCION'] : '';
try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inPais_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "Accept: application/json",
            "Content-Type: application/json",
            "Accept-Language: application/json",
            "Authorization: Bearer " . $token,
        ]
    );

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        $msg_m          = curl_error($ch);
        @@tri_msg_error = $msg_m;
    }
    curl_close($ch);

    $result = json_decode($res);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'ODRC-RC-507',
        $url_inPais_param,
        'GET',
        "Authorization: Bearer " . $token,
        '',
        json_encode($result),
        json_encode($msg_m));

    $arr_Dtapais  = [];
    $i            = 1;
    $datos_result = $result->data;

    foreach ($datos_result as $dataPais) {
        $arr_Dtapais[$i] = [$dataPais->codPais, $dataPais->txtDesc];
        $i++;
    }

    @@arr_Dtapais = $arr_Dtapais;
} catch (Exception $e) {
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje']         = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error            = $msg_m;
}

//PROVINCIAS
@@frm_accidente_provincia = @@frm_accidente_provincia ? @@frm_accidente_provincia : '17';
@@frm_accidente_ciudad    = @@frm_accidente_ciudad ? @@frm_accidente_ciudad : '1';
@@frm_accidente_pais      = @@frm_accidente_pais ? @@frm_accidente_pais : '1';
$pais_portal              = @@frm_accidente_pais ? @@frm_accidente_pais : '1';
$sql_cata_infoProv        = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'consultarProvincias'";
$rs_infoProv              = executeQuery($sql_cata_infoProv);

$url_infoProv     = isset($rs_infoProv['1']['DESCRIPCION']) ? $rs_infoProv['1']['DESCRIPCION'] : '';
$url_inProv_param = $url_infoProv . $pais_portal;

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inProv_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "Accept: application/json",
            "Content-Type: application/json",
            "Accept-Language: application/json",
            "Authorization: Bearer " . $token,
        ]
    );

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        $msg_m          = curl_error($ch);
        @@tri_msg_error = $msg_m;
    }
    curl_close($ch);

    $result = json_decode($res);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'ODRC-RC-575',
        $url_inProv_param,
        'GET',
        "Authorization: Bearer " . $token,
        '',
        json_encode($result),
        json_encode($msg_m));

    $arr_Dtaprov  = [];
    $i            = 1;
    $datos_result = $result->data;

    foreach ($datos_result as $dataProv) {
        $arr_Dtaprov[$i] = [$dataProv->codDpto, $dataProv->txtDesc];
        $i++;
    }
    @@arr_Dtaprov = $arr_Dtaprov;
} catch (Exception $e) {
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje']         = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error            = $msg_m;
}
//CANTONES
$prov_portal       = @@frm_accidente_provincia;
$sql_cata_infoCant = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE  CODIGO = 'consultarCantones'";
$rs_infoCant       = executeQuery($sql_cata_infoCant);

$url_infoCant      = isset($rs_infoCant['1']['DESCRIPCION']) ? $rs_infoCant['1']['DESCRIPCION'] : '';
$url_infCant_param = $url_infoCant . $prov_portal;

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_infCant_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "Accept: application/json",
            "Content-Type: application/json",
            "Accept-Language: application/json",
            "Authorization: Bearer " . $token,
        ]
    );

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        $msg_m          = curl_error($ch);
        @@tri_msg_error = $msg_m;
    }
    curl_close($ch);

    $result = json_decode($res);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'ODRC-RC-637',
        $url_infCant_param,
        'GET',
        "Authorization: Bearer " . $token,
        '',
        json_encode($result),
        json_encode($msg_m));

    $arr_DtaCant  = [];
    $i            = 1;
    $datos_result = $result->data;

    foreach ($datos_result as $dataCant) {
        $arr_DtaCant[$i] = [$dataCant->codCanton, $dataCant->txtDesc];
        $i++;
    }
    @@arr_DtaCant = $arr_DtaCant;
} catch (Exception $e) {
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje']         = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error            = $msg_m;
}
$sql_cata_infoMarcas = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE  CODIGO = 'Catalogo_Marcas'";
$rs_infoMarcas       = executeQuery($sql_cata_infoMarcas);

$url_infomarcas     = isset($rs_infoMarcas['1']['DESCRIPCION']) ? $rs_infoMarcas['1']['DESCRIPCION'] : '';
$url_inMarcas_param = $url_infomarcas;
try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inMarcas_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "Accept: application/json",
            "Content-Type: application/json",
            "Accept-Language: application/json",
            "Authorization: Bearer " . $token,
        ]
    );

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        $msg_m          = curl_error($ch);
        @@tri_msg_error = $msg_m;
    }
    curl_close($ch);

    $result = json_decode($res);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'ODRC-RC-697',
        $url_inMarcas_param,
        'GET',
        "Authorization: Bearer " . $token,
        '',
        json_encode($result),
        json_encode($msg_m));

    $arr_Dtamarcas = [];
    $i             = 1;
    $datos_result  = $result->data;

    foreach ($datos_result as $dataMarc) {
        $arr_Dtamarcas[$i] = [$dataMarc->idMarca, $dataMarc->nombreMarca];
        $i++;
    }

    @@arr_Dtamarcas = $arr_Dtamarcas;
} catch (Exception $e) {
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje']         = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error            = $msg_m;
}

//Parenteco
$sql_cata_infoParen = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE  CODIGO = 'Catalogo_Tipo_Parentesco'";
$rs_infoParen       = executeQuery($sql_cata_infoParen);

$url_infoParen     = isset($rs_infoParen['1']['DESCRIPCION']) ? $rs_infoParen['1']['DESCRIPCION'] : '';
$url_inparen_param = $url_infoParen;
try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inparen_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "Accept: application/json",
            "Content-Type: application/json",
            "Accept-Language: application/json",
            "Authorization: Bearer " . $token,
        ]
    );

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        $msg_m          = curl_error($ch);
        @@tri_msg_error = $msg_m;
    }
    curl_close($ch);

    $result = json_decode($res);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'ODRC-RC-759',
        $url_inparen_param,
        'GET',
        "Authorization: Bearer " . $token,
        '',
        json_encode($result),
        json_encode($msg_m));

    $arr_Dtaparen = [];
    $i            = 1;
    $datos_result = $result->data;

    foreach ($datos_result as $dataMarc) {
        $arr_Dtaparen[$i] = [$dataMarc->idParentesco, $dataMarc->txtDesc];
        $i++;
    }

    @@arr_Dtaparen = $arr_Dtaparen;
} catch (Exception $e) {
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje']         = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error            = $msg_m;
}

