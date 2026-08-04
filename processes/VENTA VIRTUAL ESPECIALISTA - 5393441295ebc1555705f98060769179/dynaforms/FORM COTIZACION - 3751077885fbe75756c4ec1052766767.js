$(function(){
  $("#grd_coberturas").hideColumn(6);
  var ramo =  $("#frm_ramo").getValue();  
  var freq = $("#frm_frecuencia_cotizacion").getText();  
  var freq1 = freq.toLowerCase();

   $("#lbl_provision").hide();
  // esconder para todos

  $("#frm_prima_conimpuestos").hide();
  $("#frm_valor_asegurado").hide();
  $("#frm_prima_exequial").hide();
  $("#frm_prima_dental").hide();
  $("#frm_prima_dscto").hide();
  $("#frm_prima_derechos").hide();

  if (ramo == '58')
  {
    $("#frm_prima_subtt").setLabel("Prima Neta "+freq1);
    $("#frm_prima_total").setLabel("Prima total "+freq1);    
    $("#frm_aporte_adicional").setLabel("Aporte adicional "+freq1);    

    $("#frm_prima_conimpuestos").setLabel("Prima con impuestos "+freq1);      
    $("#frm_prima_minima").hide();
    $("#frm_provisional_saldo_inicial").hide();

    var aporte = $("#frm_aporte_adicional").getControl().val();
    if (aporte == 'Variable')
    {
      alert ("es variable");
      $("#frm_prima_primer_pago").getControl().attr('disabled', false);
      $("#lbl_provision").show();
      //$("#frm_aporte_adicional").getControl().attr('disabled', false);
      //$("#frm_aporte_adicional").setValue(0);
    }

    calcular();

  }
  if (ramo == '59')
  {
    $("#frm_prima_subtt").setLabel("Prima planeada "+freq1);
    $("#frm_prima_total").setLabel("Prima total "+freq1);
    $("#frm_prima_minima").setLabel("Prima minima "+freq1);
    $("#frm_prima_primer_pago").disableValidation();

    $("#frm_prima_primer_pago").hide();

    $("#frm_prima_iva").hide();
   // $("#frm_aporte_adicional").hide();
    $("#frm_prima_recargo").hide();

    var total = $("#frm_prima_total").getControl().val();

    if (total == 'Variable')
    {
      $("#frm_prima_total").getControl().attr('disabled', false);
      $("#frm_prima_total").enableValidation();
      $("#lbl_provision").show();
    }
  }  

});

//frm_frecuencia_pago

$("#btn_grabar").on("click" , function() {
  $("#3751077885fbe75756c4ec1052766767").saveForm();
});

$("#frm_prima_total").on("focusout" , function() {
  var total = $("#frm_prima_total").getControl().val()*1;
  var planeada = $("#frm_prima_subtt").getControl().val()*1;
  var minima = $("#frm_prima_minima").getControl().val()*1;
  var inicial = $("#frm_provisional_saldo_inicial").getControl().val()*1;
  var suma1 = minima + inicial;
  if (total < minima )
  {
    alert ("Prima total no puede ser menor a "+minima );
    $("#frm_prima_total").setValue('Variable');
  }
});

$("#frm_prima_primer_pago").on("focusout" , function() {
  var ramo = $("#frm_ramo").getControl().val();

  var total = $("#frm_prima_primer_pago").getControl().val()*1;
  var subt1 = $("#frm_provisional_saldo_inicial").getControl().val()*1;
  var subt2 = $("#frm_prima_total").getControl().val()*1;
  var suma1 = subt1 + subt2;
  if (total < suma1)
  {
    alert ("Prima primer pago no puede ser menor a la prima total + Cuenta individual inicial");
    $("#frm_prima_primer_pago").setValue('');
  }
})

$("#3751077885fbe75756c4ec1052766767").setOnSubmit(function(){
  $("#3751077885fbe75756c4ec1052766767").saveForm();  
  if (validarInfoCotizacion()) {
    calcular();
    return validar_beneficio();
  }
  return false;
});

function validar_beneficio(){
  var numRows = $("#grd_coberturas").getNumberRows();
  for (var i=1; i <= numRows; i++) {
    var beneficio = $("#grd_coberturas").getValue(i, 2);
    for (var j=i+1; j <= numRows; j++) {
      var dato= 	$("#grd_coberturas").getValue(j, 2);
      if (dato ==beneficio ){
        alert ('Error beneficio duplicado ver beneficio '+i +' y '+j );
        return false;
        break;
      }
    }
  }
  var seguro = $("#frm_valor_asegurado").getValue();
  if (seguro <= 0 ){
    alert ("Verifique valor asegurado");
    return false;
  }
  return true;
}

function validarInfoCotizacion() {
  // Validacion del valor asegurado
  var asegurado = $("#frm_valor_asegurado").getValue();
  if (asegurado < 1000) {
    alert("Compruebe su archivo de cotizacion CSV, el valor asegurado es menor a 1000.");
    return false;
  }

  // Validacion del producto
  var errorProducto = $("#tri_error_producto").getValue();
  if (errorProducto == 'SI') {
    alert("El producto seleccionado en la seccion ARCHIVOS DE LA COTIZACION no coincide con el producto registrado en el archivo de la cotizacion CSV. Regrese y seleccione el correcto.");
    return false;
  }

  // Validacion de la frecuencia de pago
  var errorFrecuencia = $("#tri_error_validacion").getValue();
  if (errorFrecuencia == 'SI') {
    alert("La frecuencia de pago enviada en la cotizacion no es la correcta. Regrese y seleccione el archivo correcto.");
    return false;
  }

  return true; // Si todo esta correcto, permitir el envio del formulario
}