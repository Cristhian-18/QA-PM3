//oculto grillas del subfrom regulizacion gestionar regularizacion
$("#grd_coberturas").hide();
$("#dropdown0000000001").hide();
$("#text0000000001").hide();
$("#tipo_extraprima_2").hide();
$("#dropdown0000000003").hide();
$("#Años extraprima").hide();
$("#text0000000002").hide();

grid_col_especifique();

function grid_col_especifique() {

  if ($("#grid_regularizacion").getNumberRows() !== 0) {
    for (var f = 1; f <= $("#grid_regularizacion").getNumberRows(); f++) {

      var respuesta = $("#grid_regularizacion").getValue(f, 2);

      if (respuesta == 'S') {
        $("#grid_regularizacion").getControl(f, 4).attr("disabled",false);
        //$("#grid_regularizacion").getControl(f, 5).attr("disabled",false);
      } else {
        //$("#grid_regularizacion").getControl(f, 3).attr("disabled", true);
        //$("#grid_regularizacion").getControl(f, 4).attr("disabled",true);
        //$("#grid_regularizacion").getControl(f, 5).attr("disabled",true);

      }

      files_hideShow_2(f, respuesta);

    }
  }

}

function files_hideShow_2(fila, respuesta){

  if (fila == 3){
    if (respuesta == 'S'){
      $("#grd_obligatorios_incorrectos").show();
      $("#grd_especificos_incorrectos").show();
      $("#frm_opcionales").show();
      jQuery("#grd_obligatorios_incorrectos").enableValidation(2);
      jQuery("#grd_especificos_incorrectos").enableValidation(2);
    }else{
      $("#grd_obligatorios_incorrectos").hide();
      $("#grd_especificos_incorrectos").hide();
      $("#frm_opcionales").hide();
      jQuery("#grd_obligatorios_incorrectos").disableValidation(2);
      jQuery("#grd_especificos_incorrectos").disableValidation(2);
    }
  }

}


//On change del select "Regulado"
$("#grid_regularizacion select").on('change', function () {	
  var fila = $(this).val();
  //alert(fila);
});


//On change del multiple archivo
$("#grid_regularizacion .pm-multiplefile-upload value").on('change',function(){
  alert('extensin');
});
