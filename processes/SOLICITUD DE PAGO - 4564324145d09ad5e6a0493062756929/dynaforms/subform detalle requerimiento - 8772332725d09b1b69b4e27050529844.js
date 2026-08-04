(function () {
  var _origGetFieldById = window.getFieldById;

  window.getFieldById = function (id) {
    var field = _origGetFieldById(id);

    if (field && typeof field.mergeOptions !== 'function') {
      field.mergeOptions = function (opciones) {
        var select = document.getElementById("form[" + id + "]"); // confirma este patrón de id en tu DOM
        if (!select) {
          console.warn('mergeOptions (polyfill): no se encontró el select para ' + id);
          return;
        }

        select.innerHTML = '';

        (opciones || []).forEach(function (item) {
          var opt = document.createElement("OPTION");
          opt.value = item.value;
          opt.text = item.text || item.label; // por si algún endpoint usa "label" en vez de "text"
          select.appendChild(opt);
        });

        $(select).trigger('change');
      };
    }

    return field;
  };
})();


function recalcular_totales_grid() {
  var rows = $("#grd_detalle").getNumberRows();
  var total_iva = 0;
  var total_total = 0;

  for (var i = 1; i <= rows; i++) {
    var val_iva = parseFloat($("#grd_detalle").getValue(i, 6)) || 0;
    var val_total = parseFloat($("#grd_detalle").getValue(i, 7)) || 0;
    total_iva += val_iva;
    total_total += val_total;
  }

  $("#frm_producto_iva").setValue(roundToFixed(total_iva, 2));
  $("#frm_producto_total").setValue(roundToFixed(total_total, 2));
}

$("#btn_grabar").hide();
$("#btn_cancelar").hide();
$("#prod_presupuesto").hide();


$('#prod_codigo').on('change', function () {
  inicializar_producto();
  consultar_producto();
});

$('#prod_con_iva').on('change', function () {
  calcular_producto();
});

$('#prod_cantidad').on('change', function () {
  calcular_producto();
});

$('#prod_precio').on('change', function () {
  calcular_producto();
});


function roundToFixed(_float, _digits) {
  var rounder = Math.pow(10, _digits);
  return (Math.round(_float * rounder) / rounder).toFixed(_digits);
}

$('#btn_calcular').on('click', function () {
  calcular_producto();
});

$('#btn_cancelar').on('click', function () {
  inicializar_producto();
});

$('#btn_grabar').on('click', function () {
  grabar_producto();
});

function consultar_producto() {
  //alert ('consultar');
  var producto = $('#prod_codigo').getControl().val();


  var ccostos = $('#frm_solicitante_ccostos').getValue();
  var anio = $('#presupuesto_anio').getValue();
  var iva = $('#prod_por_iva').getValue();
  $.ajax({
    url: '../beesmartec/services/solicitud_pago/ajax_pagos.php',
    data: {
      'funcion': 'consultar_detalle_producto',
      'producto': producto,
      'ccostos': ccostos,
      'anio': anio
    },
    type: 'POST',
    dataType: 'json',
    beforeSend: function () {
      //      $("#8192690485b99b27401fe49060443037").showFormModal();
    },
    success: function (respuesta) {
      console.log(respuesta);
      $("#prod_unidad").setValue(respuesta.data.UNIDAD);
      $("#prod_con_iva").setValue(respuesta.data.IVA);
      $("#prod_presupuesto").setValue(roundToFixed(respuesta.data.SALDO_COMPROMETIDO, 2));
      $("#pro_id_presupuesto").setValue(respuesta.data.ID);
      $("#prod_tipo_compra").setValue(respuesta.data.TIPO_COMPRA);
      $("#frm_saldo_disponible").setValue(respuesta.data.SALDO_DISPONIBLE);
      getFieldById("prod_partida").mergeOptions(respuesta.data.partida);
      getFieldById("prod_responsable_compra").mergeOptions(respuesta.data.responsableCompra);
      //$("#prod_partida").setValue(respuesta.data.PARTIDA);
      //$("#prod_responsable_compra").setValue(respuesta.data.RESPONSABLE);
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

function inicializar_producto() {

  //  $("#prod_codigo").setValue("");
  $("#prod_detalle").setValue("");
  $("#prod_cantidad").setValue("");
  $("#prod_unidad").setValue("");
  $("#prod_precio").setValue("");
  $("#prod_subtotal").setValue("");
  $("#prod_con_iva").setValue("");
  $("#prod_iva").setValue("");
  $("#prod_total").setValue("");
  $("#prod_partida").setValue("");
  $("#prod_presupuesto").setValue("");
  $("#pro_id_presupuesto").setValue("");
  $("#prod_tipo_compra").setValue("");
  $("#prod_responsable_compra").setValue("");

  $("#btn_grabar").hide();
  $("#btn_cancelar").hide();
  $("#btn_consultar").show();
}

function grabar_producto() {
  var det = $("#prod_detalle").getValue();
  if (det == '') { alert('Ingrese el detalle del producto'); return false; }
  var saldoDisponible = ($("#frm_saldo_disponible").getValue() * 1);
  var prodtotal = ($("#prod_total").getValue() * 1);

  //alert(saldoDisponible);
  //alert(prodtotal);

  if (saldoDisponible > prodtotal) {
    var rows = $("#grd_detalle").getNumberRows();
    if (rows == 1 && $("#grd_detalle").getValue(1, 1) == '') {
      $("#grd_detalle").deleteRow(1);
    }
    var producto = $("#prod_codigo").getText();
    var codigo = $("#prod_codigo").getValue();
    var detalle = $("#prod_detalle").getValue();
    var cantidad = $("#prod_cantidad").getValue();
    var unidad = $("#prod_unidad").getValue();
    var precio = $("#prod_precio").getValue();
    var subtotal = $("#prod_subtotal").getValue();
    var por_iva = $("#prod_con_iva").getValue();
    var iva = $("#prod_iva").getValue();
    var total = $("#prod_total").getValue();
    var partida = $("#prod_partida").getValue();
    var presupuesto = $("#prod_presupuesto").getValue();
    var tipo_compra = $("#prod_tipo_compra").getValue();
    var responsable = $("#prod_responsable_compra").getValue();
    var id = $("#pro_id_presupuesto").getValue();
    //alert (detalle);
    var aData = [
      { value: producto },
      { value: detalle },
      { value: cantidad },
      { value: unidad },
      { value: precio },
      { value: iva },
      { value: total },
      { value: tipo_compra },
      { value: responsable },
      { value: partida },
      { value: presupuesto },
      { value: subtotal },
      { value: por_iva },
      { value: codigo },
      { value: id },
      { value: 'ok' }
    ];
    //if ($("#grd_detalle").getValue(1,1) != ''){ 
    $("#grd_detalle").addRow(aData);
    recalcular_totales_grid();
    inicializar_producto();
    $("#btn_grabar").hide();
    $("#btn_cancelar").hide();
    $("#btn_consultar").show();
    no_cambiar();
    //$("#prod_codigo").setValue("");    
  } else {
    alert("No tiene saldo disponible");
  }

}

function calcular_producto() {
  var cantidad = $("#prod_cantidad").getControl().val();
  if (cantidad == '' || cantidad < 1) {
    $("#prod_cantidad").setValue('0');
    $("#prod_total").setValue('0');
    $("#prod_subtotal").setValue('0');
    $("#btn_grabar").hide();
    //    alert ('cantidad debe ser mayor a 0');    
    return false;
  }

  var precio = $("#prod_precio").getControl().val();
  if (precio == '') {
    precio = 0;
    $("#prod_total").setValue('0');
    $("#prod_subtotal").setValue('0');
    $("#btn_grabar").hide();
    $("#prod_precio").setValue('0');
    //   alert ('precio debe ser mayor a 0');    
    return false;
  }


  if (cantidad > 0 && precio > 0) {
    var subtotal = cantidad * precio;
    var con_iva = $("#prod_con_iva").getControl().val();
    if (con_iva == 'SI') { var por_iva = $("#prod_por_iva").getControl().val(); }
    else { var por_iva = 0; }
    //alert (subtotal);
    var iva = subtotal * por_iva / 100;
    var total = subtotal + iva;
    var presupuesto = $("#prod_presupuesto").getValue();
    $("#prod_precio").setValue(roundToFixed(precio, 2));
    $("#prod_subtotal").setValue(roundToFixed(subtotal, 2));
    //$("#prod_por_iva").setValue(roundToFixed(por_iva,2));
    $("#prod_iva").setValue(roundToFixed(iva, 2));
    $("#prod_total").setValue(roundToFixed(total, 2));

    //alert ('botones');
    $("#btn_grabar").show();
    $("#btn_cancelar").show();
    $("#btn_consultar").hide();
    /*
  $("#prod_codigo").setValue("");
  $("#prod_detalle").setValue("");
  $("#prod_cantidad").setValue("");
  $("#prod_unidad").setValue("");  
  $("#prod_partida").setValue("");
  $("#prod_presupuesto").setValue("");
  $("#prod_tipo_compra").setValue("");		
  $("#prod_responsable_compra").setValue("");										  
*/
  }
  else {
    $("#btn_grabar").hide();
  }
}

function no_cambiar() {
  //  alert('no cambiar');
  //$("#frm_solicitante").getControl().attr('disabled', true);
  //$("#frm_solicitante_gerencia").getControl().attr('disabled', true);
  //$("#frm_solicitante_sucursal").getControl().attr('disabled', true);
  //$("#frm_solicitante_email").getControl().attr('disabled', true);
  $("#frm_solicitante_ccostos").getControl().attr('disabled', true);
  //$("#frm_proveedor_ruc").getControl().attr('disabled', true);
  //$("#frm_proveedor_email").getControl().attr('disabled', true);
  //$("#frm_proveedor_dir").getControl().attr('disabled', true);
  //$("#btn_ruc").hide();
}

function si_cambiar() {
  //  alert('is cambiar');  
  //$("#frm_solicitante").getControl().attr('disabled', false);
  //$("#frm_solicitante_gerencia").getControl().attr('disabled', false);
  //$("#frm_solicitante_sucursal").getControl().attr('disabled', false);
  //$("#frm_solicitante_email").getControl().attr('disabled', false);
  $("#frm_solicitante_ccostos").getControl().attr('disabled', false);
  //$("#frm_proveedor_ruc").getControl().attr('disabled', false);
  //$("#frm_proveedor_email").getControl().attr('disabled', false);
  //$("#frm_proveedor_dir").getControl().attr('disabled', false);
  //$("#btn_ruc").show();
}