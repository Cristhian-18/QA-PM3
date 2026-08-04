$("#grid_dental").hideColumn(11);
$("#grid_seguro_exequial").hideColumn(11);
// // alert($("#grid_dental").getNumberRows() + "-" + $("#grid_dental").getValue(1,2) + "-");
// if($("#grid_dental").getNumberRows()==1){
if ($("#grid_dental").getValue(1, 2) == "") {
  // // alert(11111);
  $("#grid_dental").deleteRow();
}
// }

// if($("#grid_seguro_exequial").getNumberRows()==1){
// if($("#grid_seguro_exequial").getValue(1,2)==""){
// $("#grid_seguro_exequial").deleteRow(0);
// }
// }


// alert(jQuery("#grid_beneficiarios_contingentes").getControl(1, 1).val().trim());
// alert(jQuery("#grid_beneficiarios_contingentes").getControl(1, 2).val().trim());
// alert(jQuery("#grid_beneficiarios_contingentes").getValue(1, 3).trim());
// alert(jQuery("#grid_beneficiarios_contingentes").getValue(1, 4).trim());
// alert(jQuery("#grid_beneficiarios_contingentes").getValue(1, 5).trim());
// alert(jQuery("#grid_beneficiarios_contingentes").getValue(1, 6).trim());
// alert(jQuery("#grid_beneficiarios_contingentes").getValue(1, 7).trim());
// alert(jQuery("#grid_beneficiarios_contingentes").getValue(1, 8).trim());
// alert(jQuery("#grid_beneficiarios_contingentes").getControl(1, 9).val().trim() == '' &&
// alert(jQuery("#grid_beneficiarios_contingentes").getValue(1, 10).trim() != '' &&
// alert(jQuery("#grid_beneficiarios_contingentes").getControl(1, 11).val().trim() == ''

if ($("#grid_beneficiarios_contingentes").getValue(1, 1) == '' &&
  ($("#grid_beneficiarios_contingentes").getValue(1, 2) == '' || $("#grid_beneficiarios_contingentes").getValue(1, 2) == 'N/A') &&
  $("#grid_beneficiarios_contingentes").getValue(1, 3) == '' &&
  $("#grid_beneficiarios_contingentes").getValue(1, 4) == '' &&
  $("#grid_beneficiarios_contingentes").getValue(1, 5) == '' &&
  $("#grid_beneficiarios_contingentes").getValue(1, 6) == '' &&
  $("#grid_beneficiarios_contingentes").getValue(1, 7) == '' &&
  $("#grid_beneficiarios_contingentes").getValue(1, 8) == '' &&
  $("#grid_beneficiarios_contingentes").getValue(1, 9) == '' &&
  $("#grid_beneficiarios_contingentes").getValue(1, 10) == '' &&
  $("#grid_beneficiarios_contingentes").getValue(1, 11) == '') {
  $("#grid_beneficiarios_contingentes").deleteRow(0);
}

if ($("#grid_otros_seguros").getNumberRows() == 1) {
  if ($("#grid_otros_seguros").getValue(1, 2) == "") {
    $("#grid_otros_seguros").deleteRow(0);
  }
}

$("#frm_seguro_negado").change(function () {
  seguroNegado();
});
function seguroNegado() {
  if ($("#frm_seguro_negado option:selected").val() == 'S') {
    $("#frm_causa_negacion").show();
    jQuery("#frm_causa_negacion").enableValidation();
  }
  else {
    $("#frm_causa_negacion").hide();
    $("#frm_causa_negacion").setValue('');
    jQuery("#frm_causa_negacion").disableValidation();
  }

}



$("#frm_pago_unico_porcentaje").focusout(function () {
  calcularPorcentajePago();
});
function calcularPorcentajePago() {
  try {
    var percentUnico = $('#frm_pago_unico_porcentaje').getValue().trim();
    if (percentUnico > 0 && percentUnico < 100) {
      var percentCuota = 100 - parseInt(percentUnico);
      $('#frm_pago_cuota_porcentaje').setValue(percentCuota);
    }
    else {
      $('#frm_pago_cuota_porcentaje').setValue('0');
    }
  }
  catch {
    $('#frm_pago_cuota_porcentaje').setValue('0');
  }

}

//if (typeof validarExpresionRegular === 'function') {
//validarExpresionRegular("frm_plan_nombre", 1);
//}

$(function () {
  diferenteAsegurado();
  seguroDental();
  seguroExequial();
  liquidacion_pago();
  nombreHijos();
  seguroNegado();
  calcula_dental();
  relacionPoliza();
});





$("#frm_motivo_seguro").change(function () {
  nombreHijos();
});

$("#frm_plan_diferente_asegurado").change(function () {
  diferenteAsegurado();
});

$("#frm_incluye_dental").change(function () {
  seguroDental();
});

$("#frm_seguro_exequial").change(function () {
  seguroExequial();
});

$("#frm_plan_relacion_poliza").change(function () {
  relacionPoliza();
});

function nombreHijos() {
  // alert($("#frm_incluye_dental option:selected").val());
  if ($("#frm_motivo_seguro option:selected").val() == 'PLANEDUCACION') {
    $("#frm_nombre_hijos").parent().show();
    jQuery("#frm_nombre_hijos").enableValidation();
  }

  else {
    $("#frm_nombre_hijos").parent().hide();
    jQuery("#frm_nombre_hijos").disableValidation();

  }
}

function relacionPoliza() {
  // alert($("#frm_incluye_dental option:selected").val());
  if ($("#frm_plan_relacion_poliza option:selected").val() == '55') {
    $("#frm_plan_relacion_poliza_otro").show();
  }

  else {
    $("#frm_plan_relacion_poliza_otro").hide();

  }
}

function seguroDental() {
  // alert($("#frm_incluye_dental option:selected").val());
  var den = $("#frm_incluye_dental option:selected").val();
  if (den != 'N' && den != '') {
    $("#grid_dental").parent().show("slow");
    //$("#btn_copiar").parent().show("slow");
    $("#frm_tipo_plan_dental").parent().show("slow");
    $("#lbl_dental").parent().show("slow");

    //if($("#grid_dental").getNumberRows()<=0)
    //  $("#grid_dental").addRow();

  }

  else {
    $("#grid_dental").parent().hide("slow");
    $("#btn_copiar").parent().hide("slow");
    $("#frm_tipo_plan_dental").parent().hide("slow");
    $("#lbl_dental").parent().hide("slow");

    var totalRows = $("#grid_dental").getNumberRows();
    for (var i = 1; i <= totalRows; i++) {
      $("#grid_dental").deleteRow(i);
    }

    //jQuery("#grid_dental").disableValidation();

  }
}

function seguroDentalDepen() {
  // alert($("#frm_incluye_dental option:selected").val());
  var den = $("#tri_bandera_dental").getValue();
  if (den == 0) {
    $("#grid_dental").parent().hide("slow");
    //$("#btn_copiar").parent().hide("slow");
    $("#frm_tipo_plan_dental").parent().hide("slow");
    $("#lbl_dental").parent().hide("slow");
  }
  else {
    $("#grid_dental").parent().show("slow");
    //$("#btn_copiar").parent().show("slow");
    $("#frm_tipo_plan_dental").parent().show("slow");
    $("#lbl_dental").parent().show("slow");
    if (den == 1) {
      //aqui solo va 1
      $("#grid_dental").addRow();

    } else {
      //aqui debe ir 2 o mas
      $("#grid_dental").addRow();
    }
  }
}

function seguroExequial() {
  //TODO validar si es seguro exequial Y VER QUE AFECTA LUEGO
  if ($("#frm_seguro_exequial option:selected").val() == 'S') {
    $("#grid_seguro_exequial").parent().show("slow");
    $("#frm_num_exequial").parent().show("slow");
    //$("#frm_num_exequial").parent().hide("slow");
    //$("#btn_copiar").show("slow");
    $("#lbl_exequial").show("slow");
    if ($("#grid_seguro_exequial").getNumberRows() <= 0)
      $("#grid_seguro_exequial").addRow();
  }
  else {
    //FIXME NO ESTA SALIENDO LA GRID BIEN
    // $("#grid_seguro_exequial").parent().hide("slow");
    // $("#frm_num_exequial").parent().hide("slow");

    $("#btn_copiar").hide("slow");
    $("#lbl_exequial").hide("slow");

    var totalRows = $("#grid_seguro_exequial").getNumberRows();


    //for (var i = 1; i <= totalRows; i++) {
    //$("#grid_seguro_exequial").deleteRow(i);
    //}



    //jQuery("#grid_seguro_exequial").disableValidation();

  }
}

function diferenteAsegurado() {

  if ($("#frm_plan_diferente_asegurado option:selected").val() == 'S') {
    $("#frm_plan_relacion_poliza").setValue('');
    //$("#frm_pago_terceros").hide();
    $("#frm_plan_tipo_identificacion").parent().show("slow");
    $("#frm_plan_numero_identificacion").parent().parent().show("slow");
    $("#frm_plan_mail").parent().show("slow");
    $("#frm_plan_relacion_poliza").parent().parent().show("slow");
    $("#frm_plan_relacion_poliza_otro").show();

    jQuery("#frm_plan_tipo_identificacion").enableValidation();
    jQuery("#frm_plan_numero_identificacion").enableValidation();
    jQuery("#frm_plan_numero_identificacion").enableValidation();
    jQuery("#frm_plan_mail").enableValidation();
    jQuery("#frm_plan_relacion_poliza").enableValidation();
  }
  else {
    $("#frm_plan_tipo_identificacion").parent().hide("slow");
    $("#frm_plan_numero_identificacion").parent().parent().hide("slow");
    $("#frm_plan_mail").parent().hide("slow");
    $("#frm_plan_relacion_poliza").parent().parent().hide("slow");
    $("#frm_plan_relacion_poliza_otro").hide();
    jQuery("#frm_plan_tipo_identificacion").disableValidation();
    jQuery("#frm_plan_numero_identificacion").disableValidation();
    jQuery("#frm_plan_mail").disableValidation();
    jQuery("#frm_plan_relacion_poliza").disableValidation();
    jQuery("#frm_plan_nombre").disableValidation();
    $("#frm_plan_tipo_identificacion").setValue('');
    $("#frm_plan_numero_identificacion").setValue('');
    $("#frm_plan_nombre").setValue('');
    $("#frm_plan_mail").setValue('');
    //$("#frm_plan_relacion_poliza").setValue('');
    /*var pago = $("#frm_pago_terceros").getControl().val();
    $("#frm_pago_terceros").show();
    // alert(pago);
    if (pago == 'S'){
      $("#8639320456010cbab579823088697264").show();
    }
    else
    {
      $("#8639320456010cbab579823088697264").hide();
    }*/


  }
}

//Validar Cedula/RUC
$("#frm_plan_numero_identificacion").focusout(function () {
  var numeroIdentificacion = $(this).getValue();
  var tipoIdentificacion = $("#frm_plan_tipo_identificacion").getValue();
  console.log('Numero Identificacion:', numeroIdentificacion);
  console.log('Tipo Identificacion:', tipoIdentificacion);
  var demo = $("#frm_plan_numero_identificacion").getValue();
  if (demo != "1793210565001") {
    var bool_iden = validarIdentificacion(numeroIdentificacion, tipoIdentificacion, true);
    console.log('Resultado Validacion:', bool_iden);
    if (bool_iden == false) {
      $('#frm_plan_numero_identificacion').setValue("");
    }
  }

});



$("#frm_plan_tipo_identificacion").on('change', function () {
  $("#frm_plan_numero_identificacion").setValue('');
});

/*
function validarIdentificacion(identificacion, tipoIdentificacion, aux){
  //console.log(identificacion);

  numero = identificacion;
  var tercerDigito = numero.substring(2, 3);
  var bandera = true;
  if(tipoIdentificacion == 'C'){
    if (numero.length != 10) {
      if(aux){
        alert("La identificacion no tiene diez digitos");
      }
      identificacion.value = '';
      bandera = false;
      return false;
    }
  }else if(tipoIdentificacion == 'R'){
    if (numero.length!=13) {
      if(aux){
        alert("La identificacion no tiene trece digitos");
      }
      identificacion.value = '';
      bandera = false;
      return false;
    }
    if(tercerDigito == 9){
      digitos = numero.split("");
      totdigitos = 10;
      total = 0;
      digito = (digitos[9]*1);
      p1 = digitos[0]*4;
      p2 = digitos[1]*3;
      p3 = digitos[2]*2;
      p4 = digitos[3]*7;
      p5 = digitos[4]*6;
      p6 = digitos[5]*5;
      p7 = digitos[6]*4;
      p8 = digitos[7]*3;
      p9 = digitos[8]*2;
      total = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
      residuo = total % 11
      final = residuo==0 ? 0: 11 - residuo
      //comprobando codigo verificador
      if (final == digito){
        //alert("RUC EMPRESA valido");
        bandera = false;
        return true;
      }else{
        if(aux){
          alert("RUC EMPRESA no valido");
        }
        identificacion.value = '';
        bandera = false;
      }
    }
  }
  if (bandera){
    digitos = numero.split("");
    totdigitos = 10;
    total = 0;
    digito = (digitos[9]*1);
    var i=0;
    for( i=0; i < (totdigitos-1); i++ ){
      mult = 0;
      if ( ( i%2 ) != 0 ) {
        total = total + ( digitos[i] * 1 );
      }else{
        mult = digitos[i] * 2;
        if ( mult > 9 )
          total = total + ( mult - 9 );
        else
          total = total + mult;
      }
    }
    //comprobando codigo verificador
    decena = total / 10;
    decena = Math.floor( decena );
    decena = ( decena + 1 ) * 10;
    final = ( decena - total );
    if ((final == 10 && digito == 0) || (final == digito)){
      //alert("Cedula valida");
      return true;
    }else{
      if(tipoIdentificacion == 'P'){
        return true;
      } else {
        if(aux){
          alert("Identificacion no valida");
        }
        identificacion.value = '';
        return false;
      }
    }
  }
}
*/

$("#frm_opcion_liquidacion_valor").change(function () {
  liquidacion_pago();
});

function liquidacion_pago() {
  if ($("#frm_opcion_liquidacion_valor option:selected").val() == 'PAGOCUOTAS') {
    $("#frm_plazo_cuotas_liquidacion").show("slow");
    jQuery("#frm_plazo_cuotas_liquidacion").enableValidation();

    $("#frm_pago_unico_porcentaje").parent().parent().hide("slow");
    jQuery("#frm_pago_unico_porcentaje").disableValidation();
    $("#frm_pago_unico_porcentaje").setValue(0);
    $("#frm_pago_cuota_porcentaje").parent().parent().hide("slow");
    jQuery("#frm_pago_cuota_porcentaje").disableValidation();
    $("#frm_pago_cuota_porcentaje").setValue(0);
    $("#frm_plazo_cuotas_liquidacion_combinada").parent().parent().hide("slow");
    jQuery("#frm_plazo_cuotas_liquidacion_combinada").disableValidation();
    $("#frm_plazo_cuotas_liquidacion_combinada").setValue('');




  }
  else {
    if ($("#frm_opcion_liquidacion_valor option:selected").val() == 'COMBINADA') {
      $("#frm_plazo_cuotas_liquidacion").hide("slow");
      $("#frm_plazo_cuotas_liquidacion").setValue('');
      jQuery("#frm_plazo_cuotas_liquidacion").disableValidation();
      $("#frm_pago_unico_porcentaje").parent().parent().show("slow");
      jQuery("#frm_pago_unico_porcentaje").enableValidation();
      $("#frm_pago_cuota_porcentaje").parent().parent().show("slow");
      jQuery("#frm_pago_cuota_porcentaje").enableValidation();
      $("#frm_plazo_cuotas_liquidacion_combinada").parent().parent().show("slow");
      jQuery("#frm_plazo_cuotas_liquidacion_combinada").enableValidation();



    }
    else {
      $("#frm_plazo_cuotas_liquidacion").hide("slow");
      jQuery("#frm_plazo_cuotas_liquidacion").disableValidation();
      $("#frm_plazo_cuotas_liquidacion").setValue('');
      $("#frm_pago_unico_porcentaje").parent().parent().hide("slow");
      jQuery("#frm_pago_unico_porcentaje").disableValidation();
      $("#frm_pago_cuota_porcentaje").parent().parent().hide("slow");
      jQuery("#frm_pago_cuota_porcentaje").disableValidation();
      $("#frm_plazo_cuotas_liquidacion_combinada").parent().parent().hide("slow");
      jQuery("#frm_plazo_cuotas_liquidacion_combinada").disableValidation();
      $("#frm_pago_unico_porcentaje").setValue(0);
      $("#frm_pago_cuota_porcentaje").setValue(0);
      $("#frm_plazo_cuotas_liquidacion_combinada").setValue('');
    }

  }
}


/*
$("#frm_plan_pago_impuestos").setOnchange( function(){
  var res = $("#frm_plan_pago_impuestos").getControl().val();
  if (res == 'NO') alert("Llene el formulario AUTO CERTIFICACIN DE RESIDENCIA FISCAL");

});
*/


$("#btn_copiar").find("button").on("click", function () {

  var columnaIdentificacion = [];
  var rowsBeneficiario = $("#grid_dental").getNumberRows();
  var array = [3, 4, 15, 22];//Hij@	//Conyuge

  //Carga todas las cedulas de Beneficiario
  for (i = 1; i <= rowsBeneficiario; i++) {
    columnaIdentificacion.push(jQuery("#grid_dental").getValue(i, 3).trim());
  }

  $.each(columnaIdentificacion, function (key, value) {
    // alert("columnaIdentificacion : " + value);
  });

  var matriz = [];
  var rowsDependientes = $("#grid_seguro_exequial").getNumberRows();

  //Carga todas las filas con cedulas que NO esten en Beneficiario
  for (f = 1; f <= rowsDependientes; f++) {

    if (columnaIdentificacion.indexOf(jQuery("#grid_seguro_exequial").getValue(f, 3).trim()) < 0) {

      var x = jQuery("#grid_seguro_exequial").getControl(f, 9).val().split("/");
      var dia = x[0];
      var mes = x[1];
      var ano = x[2];
      fechaNacimiento = ano + '-' + mes + '-' + dia

      var fila = [];
      fila.push(jQuery("#grid_seguro_exequial").getControl(f, 1).val());
      fila.push(jQuery("#grid_seguro_exequial").getControl(f, 2).val());
      fila.push(jQuery("#grid_seguro_exequial").getValue(f, 3));
      fila.push(jQuery("#grid_seguro_exequial").getValue(f, 4));
      fila.push(jQuery("#grid_seguro_exequial").getValue(f, 5));
      fila.push(jQuery("#grid_seguro_exequial").getValue(f, 6));
      fila.push(jQuery("#grid_seguro_exequial").getValue(f, 7));
      fila.push(jQuery("#grid_seguro_exequial").getControl(f, 8).val());
      fila.push(fechaNacimiento);
      fila.push(jQuery("#grid_seguro_exequial").getValue(f, 10));
      fila.push(jQuery("#grid_seguro_exequial").getControl(f, 11).val());

      matriz.push(fila);
    }
  }

  // $.each( matriz, function( key, value ) {
  // alert(value[0]);
  // alert(value[1]);
  // alert(value[2]);
  // alert(value[3]);
  // alert(value[4]);
  // alert(value[5]);
  // alert(value[6]);
  // alert(value[7]);
  // alert(value[8]);
  // alert(value[9]);
  // alert(value[10]);
  // });
  $("#grid_seguro_exequial").clear();

  //filas copiadas de Beneficiario
  for (i = 1; i <= rowsBeneficiario; i++) {
    var array = [3, 4, 15, 22];//Hij@	//Conyuge

    if (array.indexOf(jQuery("#grid_dental").getValue(i, 8) * 1) >= 0) {

      var aData = [
        { value: jQuery("#grid_dental").getControl(i, 1).val() },
        { value: jQuery("#grid_dental").getControl(i, 2).val() },
        { value: jQuery("#grid_dental").getValue(i, 3) },
        { value: jQuery("#grid_dental").getValue(i, 4) },
        { value: jQuery("#grid_dental").getValue(i, 5) },
        { value: jQuery("#grid_dental").getValue(i, 6) },
        { value: jQuery("#grid_dental").getValue(i, 7) },
        { value: jQuery("#grid_dental").getControl(i, 8).val() },
        { value: jQuery("#grid_dental").getValue(i, 9) },
        { value: jQuery("#grid_dental").getValue(i, 10) },
        { value: jQuery("#grid_dental").getControl(i, 11).val() }
      ];
      jQuery("#grid_seguro_exequial").addRow(aData);

    }
  }


  // filas q ya existian y q NO hay en Beneficiario
  $.each(matriz, function (key, value) {

    var aData = [
      { value: value[0] },
      { value: value[1] },
      { value: value[2] },
      { value: value[3] },
      { value: value[4] },
      { value: value[5] },
      { value: value[6] },
      { value: value[7] },
      { value: value[8] },
      { value: value[9] },
      { value: value[10] }
    ];
    jQuery("#grid_seguro_exequial").addRow(aData);

  });

});

// CONTROL SOBRE TIPO DE PLAN DENTAL
$("#grid_dental").onAddRow(calcula_dental);
$("#grid_dental").onDeleteRow(calcula_dental);

function calcula_dental() {
  var num = $("#grid_dental").getNumberRows() * 1;
  if (num > 1) { $("#frm_tipo_plan_dental").setValue('FAMILIA'); }
  if (num == 1) { $("#frm_tipo_plan_dental").setValue('TITULAR+1'); }
  if (num == 0) { $("#frm_tipo_plan_dental").setValue('TITULAR'); }
}

$("#grid_seguro_exequial").onAddRow(calcula_exequial);
$("#grid_seguro_exequial").onDeleteRow(calcula_exequial);

function calcula_exequial() {
  var num = $("#grid_seguro_exequial").getNumberRows() * 1;
  $("#frm_num_exequial").setValue(num);
}




$("#frm_tipo_plan_dental").hide("slow");
jQuery("#frm_tipo_plan_dental").disableValidation();

$("#tri_bandera_dental").hide("slow");
jQuery("#tri_bandera_dental").disableValidation();

$("#tri_bandera_exquial").hide("slow");
jQuery("#tri_bandera_exquial").disableValidation();

$("#frm_num_exequial").hide("slow");
jQuery("#frm_num_exequial").disableValidation();
