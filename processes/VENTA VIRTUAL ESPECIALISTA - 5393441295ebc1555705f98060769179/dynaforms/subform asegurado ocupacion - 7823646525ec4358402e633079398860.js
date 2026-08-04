if(typeof validarExpresionRegular === 'function') {
//  validarExpresionRegular("frm_ocupacion_nombre_empresa", 1);
  validarExpresionRegular("frm_ocupacion_cargo", 1);
 // validarExpresionRegular("frm_ocupacion_nombre_negocio", 1);
  //validarExpresionRegular("frm_ocupacion_mayor_ingresos", 1);

}

tipoEmpleo();
//otrasOcupaciones();
$("#frm_ocupacion_tipo_empleo").change( function () {
  tipoEmpleo();
});

function tipoEmpleo(){

  var aux = $("#frm_ocupacion_tipo_empleo option:selected").val(); 

  
  switch(aux){
    case "DEPENDIENTE":
        $("#frm_ocupacion_nombre_empresa").enableValidation();
        $("#frm_ocupacion_cargo").enableValidation();
      
        $("#frm_ocupacion_nombre_empresa").parent().parent().show();
        $("#frm_ocupacion_cargo").parent().parent().show();	
      
        $("#frm_ocupacion_nombre_negocio").setValue('');       
        $("#frm_ocupacion_nombre_negocio").disableValidation();
        $("#frm_ocupacion_nombre_negocio").parent().parent().hide();
        break;
      case "DEPENDIENTE_1":
        $("#frm_ocupacion_nombre_empresa").enableValidation();
        $("#frm_ocupacion_cargo").enableValidation();
      
        $("#frm_ocupacion_nombre_empresa").parent().parent().show();
        $("#frm_ocupacion_cargo").parent().parent().show();	
      
        $("#frm_ocupacion_nombre_negocio").setValue('');       
        $("#frm_ocupacion_nombre_negocio").disableValidation();
        $("#frm_ocupacion_nombre_negocio").parent().parent().hide();
        break;
    //case "INDEPENDIENTE": 

       // $("#frm_ocupacion_nombre_negocio").enableValidation();
       
        //$("#frm_ocupacion_nombre_negocio").parent().parent().show();
      
        //$("#frm_ocupacion_nombre_empresa").setValue('');
        //$("#frm_ocupacion_cargo").setValue('');
     	// $("#frm_ocupacion_nombre_empresa").disableValidation();
        //$("#frm_ocupacion_cargo").disableValidation();
        //$("#frm_ocupacion_nombre_empresa").parent().parent().hide();
      
      //	break;
    default:
        $("#frm_ocupacion_nombre_empresa").disableValidation();
        $("#frm_ocupacion_cargo").disableValidation();
        $("#frm_ocupacion_nombre_negocio").disableValidation();
      
        $("#frm_ocupacion_nombre_negocio").setValue('');
          $("#frm_ocupacion_nombre_empresa").setValue('');
        $("#frm_ocupacion_cargo").setValue('');
      
        $("#frm_ocupacion_nombre_empresa").parent().parent().hide();
        $("#frm_ocupacion_nombre_negocio").parent().parent().hide();
      break;
  }		
}

/*$("#frm_tiene_otra_actividad").change(function () {
	otrasOcupaciones();
});
*/
/*
function otrasOcupaciones(){
	if ($("#frm_tiene_otra_actividad option:selected").val() == 'S') {
        $("#frm_ocupacion_otras_ocupaciones").parent().parent().show("slow");
        jQuery("#frm_ocupacion_otras_ocupaciones").enableValidation();
        jQuery("#frm_ocupacion_tipo").enableValidation();
      //  jQuery("#frm_ocupacion_mayor_ingresos").enableValidation();
		
    }
    else {
        $("#frm_ocupacion_otras_ocupaciones").parent().parent().hide("slow");
        jQuery("#frm_ocupacion_otras_ocupaciones").disableValidation();
       // jQuery("#frm_ocupacion_mayor_ingresos").disableValidation();
       jQuery("#frm_ocupacion_tipo").disableValidation();
        $("#frm_ocupacion_otras_ocupaciones").setValue('');
        $("#frm_ocupacion_tipo").setValue('');
    //  $("#frm_ocupacion_mayor_ingresos").setValue('');
    
		
    }
}
*/
/*
$("#frm_ocupacion_tipo").on("focusout", function () {

  if (isNaN($(this).getValue()) == false) {
    $(this).parent().find(".textlabel").css("color", "");
    $(this).getControl().css("borderColor", "");
  } else {

    $(this).parent().find(".textlabel").css("color", "#a94442");
    $(this).getControl().css("borderColor", "#e4655f");
    $(this).setValue('');
   // alert("seleccione un valor de la lista");
    return false;
  }

});*/