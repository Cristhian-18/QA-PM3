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

$(document).ready(function () {
  ocultar_todo();
  $('#menu1').show();
  $("#2103186295d09b1e15c6ea1035176468").show();
  $("#8772332725d09b1b69b4e27050529844").show();
  $("#frm_accion").show();
  $("#frm_chk_documento").show();
  $("#frm_comentario").show();
  $("#subtit_solicitante").show();
  $("#subtit_requerimiento").show();
  $("#btn_continuar").show();
  $("#subtit_acc").show();
  $("#5354114765d09b78de33941005151445").hide();
  $('#subtit_prov').show();
  $('#8920896775d37d1cf470856076601548').show();

  var num_prod = $("#grd_detalle").getNumberRows();
  var cod_prod = $("#grd_detalle").getValue(1, 1);
  //  alert (cod_prod);
  if (num_prod > 0 && cod_prod != '') { no_cambiar(); }

  $ccosto = $('#frm_solicitante_ccostos').getControl().val();
  if ($ccosto && $ccosto !== '' && $ccosto !== 'undefined' && $ccosto !== 'null') {
    consultar_listado_productos();
    inicializar_producto();
    consultar_producto();
    desabilitar_campos();
  }
});

/**
 * Inicialización de estilos
 */
$('.panel').css("border", "none");
$(".row").css("box-shadow", "none");
$(".panel").css("box-shadow", "none");
$('.pmdynaform-form').css("border", "none");
$(".form-control").css("box-shadow", "none");
$(".pmdynaform-grid-row").css("border-bottom", "none");
$(".pmdynaform-label-options").css("text-align", "left");
$(".pmdynaform-grid-title").css("display", "none");
$("prod_tipo_compra").hide();

$(function () {
  $('.subtitulo').css('cursor', 'pointer');
  $('.subtitulo').on('click', function () {
    id = this.id;
    subforms = $('#' + this.id).attr('subform').split('|');
    if ($('#' + id).children().attr('class') == 'glyphicon glyphicon-plus')
      $('#' + id).children().removeClass('glyphicon-plus').addClass('glyphicon-minus');
    else
      $('#' + id).children().removeClass('glyphicon-minus').addClass('glyphicon-plus');
    $.each(subforms, function (index, subform) {
      $('#' + subform).toggle('slow');
    });
  })
});

//$('#presupuesto_anio').on('change', function(){  
$('#frm_solicitante_ccostos').on('change', function () {
  consultar_listado_productos();
});

function consultar_listado_productos() {

  var ccostos = $('#frm_solicitante_ccostos').getControl().val();
  var anio = $('#presupuesto_anio').getControl().val();

  if ($ccosto !== '' && $ccosto !== 'undefined' && $ccosto !== 'null' || anio != '') {

    $.ajax({
      url: '../beesmartec/services/solicitud_pago/ajax_pagos.php',
      data: {
        'funcion': 'consultar_listado_productos',
        'ccostos': ccostos,
        'anio': anio
      },
      type: 'POST',
      dataType: 'json',
      beforeSend: function () {
        //      $("#8192690485b99b27401fe49060443037").showFormModal();
      },
      success: function (respuesta) {
        getFieldById("prod_codigo").mergeOptions(respuesta);
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
}

$("#grd_detalle").onDeleteRow(function () {
  var num_prod = $("#grd_detalle").getNumberRows();
  if (num_prod == 0) {
    //  alert (num_prod);
    $("#frm_solicitante_ccostos").getControl().attr('disabled', false);
  }
})


$("#btn_save").click(function () {
  $("#9891392165d09b15744efe8017167361").saveForm()
  alert("Formulario guardado ...");
})
/*
$("#9891392165d09b15744efe8017167361").setOnSubmit(function() {
  var iva = $("#grd_detalle").getSummary("frm_producto_iva");
  var total = $("#grd_detalle").getSummary("frm_producto_total");
  var subtotal = total - iva;
  $("#frm_valor_total").setValue(roundToFixed(total,2));
  $("#frm_valor_subtotal").setValue(roundToFixed(subtotal,2));
  $("#frm_valor_iva").setValue(roundToFixed(iva,2));
  var num_prod = $("#grd_detalle").getSummary("frm_producto_total");
  //alert(num_prod);
  if (num_prod == 0){
      alert ("Error: No se ha ingresado ningun producto en el detalle");
    return false;
      }
  
})*/

$("#9891392165d09b15744efe8017167361").setOnSubmit(function () {
  var gridData = $("#grd_detalle").getData();
  var rows = gridData.gridtable || [];
  var iva = 0, total = 0;

  for (var i = 0; i < rows.length; i++) {
    var row = rows[i];
    for (var j = 0; j < row.length; j++) {
      if (row[j].name === "frm_producto_iva") {
        iva += parseFloat(row[j].value) || 0;
      }
      if (row[j].name === "frm_producto_total") {
        total += parseFloat(row[j].value) || 0;
      }
    }
  }

  var subtotal = total - iva;
  $("#frm_valor_total").setValue(roundToFixed(total, 2));
  $("#frm_valor_subtotal").setValue(roundToFixed(subtotal, 2));
  $("#frm_valor_iva").setValue(roundToFixed(iva, 2));

  console.log("iva: " + iva + " total: " + total + " subtotal: " + subtotal + " filas: " + rows.length);

  if (rows.length == 0) {
    alert("Error: No se ha ingresado ningun producto en el detalle");
    return false;
  }
});

function desabilitar_campos() {
  $("#frm_solicitante").getControl().attr('disabled', true);
  $("#frm_solicitante_gerencia").getControl().attr('disabled', true);
  $("#frm_solicitante_sucursal").getControl().attr('disabled', true);
  $("#frm_proveedor_ruc").getControl().attr('disabled', true);
  $("#frm_proveedor_email").getControl().attr('disabled', true);
  $("#frm_proveedor_dir").getControl().attr('disabled', true);
}