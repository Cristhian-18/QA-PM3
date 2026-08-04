$("#grd_detalle").hideColumn(8);
$("#grd_detalle").hideColumn(9);
$("#error_presupuesto").hide();

function roundToFixed(_float, _digits) {
  var rounder = Math.pow(10, _digits);
  return (Math.round(_float * rounder) / rounder).toFixed(_digits);
}

$('#prod_cantidad').on('change', function () {
  calcular_producto();
});

$('#prod_con_iva').on('change', function () {
  calcular_producto();
});


$('#prod_precio').on('change', function () {
  calcular_producto();
});

//$('#btn_actualizar').on('click', function(){  
//  actualizar_producto();
//});


ocultar_detalle();
//para el change de las grillas
var formId = $("form").prop("id");

//validaciones de que grid se cambia
//Set an onchange event handler for the form. When the value of a field changes in the Dynaform, 
//check whether the changed field is the hasDiscount field in the grid. 
//If so, then if hasDiscount is set to "Discount", then enable the discountRate field in the same row. 
//If set to "No Discount", then disable the discountRate field.
$("#" + formId).setOnchange(function (fieldId, newVal, oldVal) {
  //check if a field changed inside the grid baf:
  var aMatches = fieldId.match(/^\[grd_detalle\]\[(\d+)\]\[chk_ver\]$/);
  console.log(aMatches);
  console.log(newVal);
  if (aMatches) {
    var rowNo = aMatches[1];

    if (newVal == '"1"') {

      var fila = $("#fila").getControl().val();
      $("#grd_detalle").setValue(0, fila, 0);
      // consulta valores
      var cod_prod = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_codigo\\]").val();
      var producto = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto\\]").val();
      var detalle = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_detalle\\]").val();
      var cantidad = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_cantidad\\]").val();
      var unidad = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_unidad\\]").val();
      var precio = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_precio\\]").val();
      var subtotal = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_subtotal\\]").val();
      var por_iva = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_por_iva\\]").val();

      var iva = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_iva\\]").val();
      var total = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_total\\]").val();

      var partida = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_producto_partida\\]").val();
      var presupuesto = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_partida_presupuesto\\]").val();
      var tipo_compra = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_tipo_compra\\]").val();
      var responsable = $("#form\\[grd_detalle\\]\\[" + rowNo + "\\]\\[frm_resp_compra\\]").val();

      // inicailiza campos
      $("#prod_codigo").setValue(producto);
      $("#prod_detalle").setValue(detalle);
      $("#prod_cantidad").setValue(cantidad);
      $("#prod_unidad").setValue(unidad);
      $("#prod_precio").setValue(precio);
      $("#prod_subtotal").setValue(subtotal);
      $("#prod_con_iva").setValue(por_iva);
      $("#prod_iva").setValue(iva);
      $("#prod_total").setValue(total);

      $("#prod_partida").setValue(partida);
      $("#prod_presupuesto").setValue(presupuesto);
      $("#prod_tipo_compra").setValue(tipo_compra);
      $("#prod_responsable_compra").setValue(responsable);

      $("#fila").setValue(rowNo);
      mostrar_detalle();


    }
    else {   // if (newVal=="No Discount"):
      //$("#form\\[grd_detalle\\]\\["+rowNo+"\\]\\[baf_provincia\\]").prop("disabled", false);
      //$("#grd_detalle").enableValidation(3);    
      inicializar_producto();
      ocultar_detalle();
      console.log("oculta data");
    }
  }
});

//ocultar columan de la grid
// $("#grd_detalle").hideColumn(2);




function inicializar_producto() {

  $("#prod_codigo").setValue("");
  $("#prod_detalle").setValue("");
  $("#prod_cantidad").setValue("");
  $("#prod_unidad").setValue("");
  $("#prod_precio").setValue("");
  $("#prod_subtotal").setValue("");
  $("#prod_con_iva").setValue("SI");
  $("#prod_iva").setValue("");
  $("#prod_total").setValue("");
  $("#prod_partida").setValue("");
  $("#prod_presupuesto").setValue("");
  $("#prod_tipo_compra").setValue("");
  $("#prod_responsable_compra").setValue("");

  $("#btn_grabar").hide();
  $("#btn_cancelar").hide();
  $("#btn_consultar").show();
}


function calcular_producto() {
  var cantidad = $("#prod_cantidad").getControl().val();
  var precio = $("#prod_precio").getControl().val();
  var subtotal = cantidad * precio;
  var por_iva = $("#prod_por_iva").getControl().val();
  var con_iva = $("#prod_con_iva").getControl().val();
  // alert (con_iva);
  if (con_iva == 'NO') { por_iva = 0; }
  var iva = subtotal * por_iva / 100;
  var total = subtotal + iva;
  var presupuesto = $("#prod_presupuesto").val();
  $("#prod_precio").setValue(roundToFixed(precio, 2));
  $("#prod_subtotal").setValue(roundToFixed(subtotal, 2));
  $("#prod_iva").setValue(roundToFixed(iva, 2));
  $("#prod_total").setValue(roundToFixed(total, 2));

}

function ocultar_detalle() {
  $("#prod_codigo").hide();
  $("#prod_detalle").hide();
  $("#prod_cantidad").hide();
  $("#prod_unidad").hide();
  $("#prod_precio").hide();
  $("#prod_subtotal").hide();
  $("#prod_por_iva").hide();
  $("#prod_con_iva").hide();
  $("#prod_iva").hide();
  $("#prod_total").hide();
  $("#prod_partida").hide();
  $("#prod_presupuesto").hide();
  $("#prod_tipo_compra").hide();
  $("#prod_responsable_compra").hide();
  $("#btn_actualizar").hide();
}

function mostrar_detalle() {
  $("#prod_codigo").show();
  $("#prod_detalle").show();
  $("#prod_cantidad").show();
  $("#prod_unidad").show();
  $("#prod_precio").show();
  $("#prod_subtotal").show();
  $("#prod_con_iva").show();
  $("#prod_iva").show();
  $("#prod_total").show();
  $("#prod_partida").show();
  $("#prod_presupuesto").show();
  $("#prod_tipo_compra").show();
  $("#prod_responsable_compra").show();
  $("#btn_actualizar").show();
}

function actualizar_producto() {
  var fila = $("#fila").getControl().val();
  var cantidad = $("#prod_cantidad").getControl().val();
  var precio = $("#prod_precio").getControl().val();
  var iva = $("#prod_iva").getControl().val();
  var subtotal = $("#prod_subtotal").getControl().val();
  var total = $("#prod_total").getControl().val();
  var con_iva = $("#prod_con_iva").getControl().val();

  $("#grd_detalle").setValue(cantidad, fila, 5);
  $("#grd_detalle").setValue(precio, fila, 7);
  $("#grd_detalle").setValue(subtotal, fila, 8);
  $("#grd_detalle").setValue(iva, fila, 9);
  $("#grd_detalle").setValue(total, fila, 10);
  $("#grd_detalle").setValue(con_iva, fila, 15);
  validar_presupuesto();
  inicializar_producto();
  ocultar_detalle();
}

function validar_presupuesto() {
  //  alert ('consultar');
  var arrprod = $('#grd_detalle').getValue();
  var prod = JSON.stringify($('#grd_detalle'));
  var ccostos = $('#frm_solicitante_ccostos').getValue();
  var anio = $('#presupuesto_anio').getValue();

  //var iva =    $('#prod_por_iva').getValue();

  $.ajax({
    url: '../beesmartec/services/solicitud_pago/ajax_compras.php',
    data: {
      'funcion': 'validar_presupuesto',
      'detalle': arrprod,
      'ccostos': ccostos,
      'anio': anio
    },
    type: 'POST',
    dataType: 'json',
    beforeSend: function () {
      //      $("#8192690485b99b27401fe49060443037").showFormModal();
    },
    success: function (respuesta) {
      //console.log (respuesta);
      var error_pre = "NO";
      fila = 1;
      for (element in respuesta) {
        var nov = (respuesta[element][0])
        var pre = (respuesta[element][10])

        $("#grd_detalle").setValue(nov, fila, 1);
        $("#grd_detalle").setValue("0", fila, 2);
        $("#grd_detalle").setValue(roundToFixed(pre, 2), fila, 11);
        fila = fila + 1;

        if (nov == "NO" || error_pre == "SI") {
          var error_pre = "SI";
          $("#error_presupuesto").show();
        }
        //alert (error_pre);
      };
      $("#error_presupuesto").setValue(error_pre);

      if (error_pre == "SI") {
        $("#frm_accion").hide();
        $("#btn_continuar").hide();
        $("#error_presupuesto").show();

      }
      else {
        $("#frm_accion").show();
        $("#btn_continuar").show();
        $("#error_presupuesto").hide();
      }
      //alert ("satisfaccion");


    },
    error: function (xhr, status) {
      //alert(status);
    },
    complete: function (xhr, status) {
      //    $("#8192690485b99b27401fe49060443037").hideFormModal();
      //alert ("hola fin ");
    }
  });
}

