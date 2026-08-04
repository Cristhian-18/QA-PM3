//CREATED BY HENRY

function limpiar_datos_busqueda(){
  $('#frm_busqueda_tipo').setValue('');
  $('#frm_busqueda_dato').setValue('');
  //$('#frm_busqueda_fechaSiniestro').setValue('');
  $('#frm_busqueda_horaSiniestro').setValue('');
  $('#frm_busqueda_identificacion').setValue('');
  $('#frm_busqueda_apellidos').setValue('');
  $('#frm_busqueda_nombres').setValue('');
}

function consultar_datos_cont(){
	limpiar_datos_busqueda();
  	var frm_tipo_doc_contratante = $("#frm_busqueda_tipoContratante").getValue(); 
  	var frm_contratante_numero_identificacion = $("#frm_busqueda_contratante").getValue(); 
  	var tri_user_sac_uname = 'admin';
  
  	if(frm_tipo_doc_contratante != '' && frm_contratante_numero_identificacion != ''){
   $.ajax({
            url  : '../beesmartec/services/siniestrosVeh/ajax_pantalla.php',
            data : {
              'funcion' : 'consultar_datos_cont',
              'frm_tipo_doc_contratante' : frm_tipo_doc_contratante,
              'frm_contratante_numero_identificacion' : frm_contratante_numero_identificacion,
              'tri_user_sac_uname' : tri_user_sac_uname
            },
            type : 'POST',
            beforeSend : function(){
              $("#51422455265655b4ed7a504019320257").showFormModal();
            },

            success : function(respuesta) {             

              var respuestadata = JSON.parse(respuesta);                           

              if(respuestadata.mensaje == 'false')     
              {           
                alert(respuestadata.mensaje_mostrar);
              }
              else  
              {
				$('#frm_contratante').setValue(respuestadata.nombre_completo_gr);
                $('#frm_asegurado_telefono').setValue(respuestadata.cli_telef_celular);
                $('#frm_asegurado_pais').setValue(respuestadata.cli_cod_pais_origen);
                $('#frm_asegurado_provincia').setValue(respuestadata.cli_dir_cod_prov);
                $('#frm_asegurado_ciudad').setValue(respuestadata.cli_dir_cod_ciudad);
                $('#frm_asegurado_mail1').setValue(respuestadata.cli_email);
                $('#frm_siniestro_direccion').setValue(respuestadata.cli_dir_detalle);
                
              }
            },
            error : function(xhr, status) {
              alert(status);
            },
            complete : function(xhr, status) {
             $("#51422455265655b4ed7a504019320257").hideFormModal();          
            }
          });
      }else{
    alert("Por favor ingrese los datos requeridos");
    }
}

$("#frm_busqueda_contratante").setOnchange(consultar_datos_cont);

function encerar_num_doc(){
	$("#frm_busqueda_contratante").setValue('');
}

$("#frm_busqueda_tipoContratante").setOnchange(encerar_num_doc);

function consultar_datos(){
  	$("#grd_registro_siniestro").clear();
    var frm_contratante = $("#frm_contratante").getValue(); 
   	var frm_busqueda_tipo = $("#frm_busqueda_tipo").getValue(); 
  	var frm_busqueda_dato = $("#frm_busqueda_dato").getValue(); 
  	var tri_user_sac_uname = 'admin';
  	var frm_busqueda_fechaSiniestro = $("#frm_busqueda_fechaSiniestro").getValue(); 
  	var frm_busqueda_horaSiniestro = $("#frm_busqueda_horaSiniestro").getValue(); 
  
  	if(frm_contratante  != '' && frm_busqueda_tipo != '' && frm_busqueda_dato != '' && frm_busqueda_fechaSiniestro != '' && frm_busqueda_horaSiniestro != ''){
   $.ajax({
            url  : '../beesmartec/services/siniestrosVeh/ajax_pantalla.php',
            data : {
              'funcion' : 'consultar_datos',
              'frm_busqueda_tipo' : frm_busqueda_tipo,
              'frm_busqueda_dato' : frm_busqueda_dato,
              'frm_busqueda_fechaSiniestro' : frm_busqueda_fechaSiniestro,
              'tri_user_sac_uname' : tri_user_sac_uname
            },
            type : 'POST',
            beforeSend : function(){
             //$("#51422455265655b4ed7a504019320257").showFormModal();
            },

            success : function(respuesta) {             

              var respuestadata = JSON.parse(respuesta);                           

              if(respuestadata.mensaje == 'false')     
              {           
                alert(respuestadata.mensaje_mostrar);
              }
              else  
              {
				$('#frm_busqueda_identificacion').setValue(respuestadata.DtaVehicu.nrO_CEDULA);
                $('#frm_busqueda_nombres').setValue($('#frm_contratante').getValue());
                //DATOS DE LA POLIZA
                $('#frm_poliza_numero').setValue(respuestadata.result_pol.nroPol);
                $('#frm_poliza_producto').setValue(respuestadata.result_pol.ramo);
                $('#frm_poliza_sucursal').setValue(respuestadata.result_pol.sucursal);
                $('#frm_txt_condiciones').setValue(respuestadata.result_condi.descripcion);
                //estos datos aun estan van quemados
                $("#frm_poliza_FechaInicioA").setValue("10-11-2022");
                $("#frm_poliza_FechaFinA").setValue("10-11-2023");
                $("#frm_poliza_FechaInicio").setValue("10-11-2022");
                $("#frm_poliza_FechaFin").setValue("10-11-2023");
                //datos de las coberturas
                 var i=1;
                  $.each(respuestadata.result_cober, function(i, item) {
                    //if(i > 1)
                		$("#grd_registro_siniestro").addRow()
                    
                    $("#grd_registro_siniestro").setValue(item.descripcion, i, 1);//causa
                    $("#grd_registro_siniestro").setValue(item.limiteMaximo, i, 2);//causa
                    $("#grd_registro_siniestro").setValue(item.limiteMaximo, i, 4);//causa
                    $("#grd_registro_siniestro").setValue(item.limiteMaximo, i, 4);//causa
                    $("#grd_registro_siniestro").setValue(item.codigo, i, 5);//causa
                    i++;
                  });                
                
                //DATOS DEL VEHICULO
                $('#frm_vehiculo_placa').setValue(respuestadata.DtaVehicu.placa);
                $('#frm_vehiculo_precioPromedio').setValue(respuestadata.DtaVehicu.preciopromedio);
                var j = 1;
                $("#grd_vehiculos").setValue(respuestadata.DtaVehicu.marca, j, 1);
                $("#grd_vehiculos").setValue(respuestadata.DtaVehicu.modelo, j, 2);
                $("#grd_vehiculos").setValue(respuestadata.DtaVehicu.anio, j, 3);
                $("#grd_vehiculos").setValue(respuestadata.DtaVehicu.tipo, j, 4);
                $("#grd_vehiculos").setValue(respuestadata.DtaVehicu.placa, j, 5);
                $("#grd_vehiculos").setValue(respuestadata.DtaVehicu.motor, j, 6);
                $("#grd_vehiculos").setValue(respuestadata.DtaVehicu.chasis, j, 7);
                $("#grd_vehiculos").setValue((respuestadata.DtaVehicu.color == null ? '':respuestadata.DtaVehicu.color), j, 8);
                $("#grd_vehiculos").setValue(respuestadata.DtaVehicu.tipo_vh_x_ant, j, 9);
              }
            },
            error : function(xhr, status) {
              alert(status);
            },
            complete : function(xhr, status) {
            $("#51422455265655b4ed7a504019320257").hideFormModal();          
            }
          });
      }else{
    alert("Por favor ingrese los datos requeridos");
    }
}


$("#btn_consultar").find("button").on("click" , function() {
    consultar_datos();
} );

function showStartup() {
  window.dynaform.flashMessage( {
     emphasisMessage: "ERROR: ",
     message: $("#tri_msg_error").getValue(),
     duration:  5000,
     type: 'danger',
     appendTo: $('#tlt_principal'),
     absoluteTop : false
   } )
}

$("document").ready( function() {
  if($("#tri_msg_error").getValue() != ''){
  	setTimeout(showStartup, 50);
	}
});


