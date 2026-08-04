var appNumber = (function() {
    const casoTab = window.parent.document.querySelector(".x-tab-strip-text");
    return casoTab?.innerText.match(/\d+/)?.[0] || null;
})();

var token = $("#token_portal").getValue();
sessionStorage.setItem('token', token);



var currentFila = null;
var infoContratante = null;
var indexCobertura = null;
let dataCoberturas = [];
let nombreCoberturas = [];
var totalCoberturas = 0;
var isDataProcesada = false;

const loaderDialog = $("<div>")
    .attr("id", "loaderDialog")
    .css({
        position: "fixed",
        top: "0",
        left: "0",
        width: "100%",
        height: "100%",
        backgroundColor: "rgba(0, 0, 0, 0.5)",
        display: "flex",
        alignItems: "center",
        justifyContent: "center",
        zIndex: "9999"
    })
    .append(
        $("<div>")
            .css({
                backgroundColor: "#fff",
                padding: "20px",
                borderRadius: "10px",
                display: "flex",
                flexDirection: "column",
                alignItems: "center",
                boxShadow: "0px 0px 10px rgba(0,0,0,0.2)"
            })
            .append(
                $("<div>")
                    .css({
                        width: "50px",
                        height: "50px",
                        border: "5px solid #f3f3f3",
                        borderTop: "5px solid #3498db",
                        borderRadius: "50%",
                        animation: "spin 1s linear infinite"
                    })
            )
            .append(
                $("<p>")
                    .text("Procesando...")
                    .css({
                        marginTop: "10px",
                        fontSize: "16px",
                        fontWeight: "bold",
                        color: "#333"
                    })
            )
    );

// Agregamos el dialogo al `body`, pero oculto por defecto
$("body").append(loaderDialog);
$("#loaderDialog").hide();

// **Funciones para mostrar y ocultar el loader**
function showLoader() {
    $("#loaderDialog").show();
}

function hideLoader() {
    $("#loaderDialog").hide();
}

// **Estilos para la animacion del loader**
$("<style>")
  .prop("type", "text/css")
  .html(`
      @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      }
  `)  
  .appendTo("head");

function setStylesComboBox(comboBoxId) {
  $(comboBoxId).css({
    'font-size': '16px',  // Tamano de fuente
    'padding': '8px',     // Espaciado interno
    'border-radius': '4px', // Bordes redondeados    
    'background-color': '#fff' // Fondo blanco
  });
}  

function obtenerCoberturas(){
  if ($("#grd_coberturas").getNumberRows() !== 0){
    var indiceCoberturaPago = 1;
    for (var i = 1; i <= $("#grd_coberturas").getNumberRows(); i++){      
      var aplicaCobertura = $("#grd_coberturas").getValue(i,3);
      if (aplicaCobertura === "SI"){
        var valor = parseFloat($("#grd_coberturas").getValue(i, 12)) || 0;        
        if (valor > 0){
          totalCoberturas += valor;
          $('#form\\[frmCmbCoberturaPago\\]').append("<option value='item"+indiceCoberturaPago+"'>"+$("#grd_coberturas").getValue(i,1)+"</option>");        
          dataCoberturas.push(valor);
          nombreCoberturas.push($("#grd_coberturas").getValue(i,1));
          indiceCoberturaPago += 1;
        }
      }
    }
  }
}

function limpiarCoberturas(){
  $('#form\\[frmCmbCoberturaPago\\]').empty();
  $('#form\\[frmCmbCoberturaPago\\]').append(new Option("Seleccione", ""));
}

function ocultarCobertura(){
  $("#btnAddBeneficiario").hide();
  $("#btnDelBeneficiario").hide();
  $("#btnSavePago").hide();
  $("#btnDelPago").hide();
  var numPagos = $("#grdDetallePago").getNumberRows();

  if (numPagos > 0 && $("#grdDetallePago").getValue(1, 1) != ""){
    $("#btnAddDetalle").prop("disabled", true).css({
      "pointer-events": "none", // Bloquea clics
      "opacity": "0.5", // Lo hace visualmente mas tenue
      "cursor": "not-allowed" // Cambia el cursor a "prohibido"
    });
    obtenerCoberturas();
    limpiarInfoContratante();
    limpiarInfoPagos();
    deshabilitarInfoContratante();
    deshabilitarInfoPagos();
    return;
  }
  $("#frmCmbTipoLiquidacion").hide();
  $("#lblMensajePago").hide();
  $("#btnDelCobertura").hide();
  $("#btnSaveCobertura").hide();
  $("#frmCmbCoberturaPago").hide();
  $("#frmCmbCoberturaPago").disableValidation();
  $("#frmCmbPagarAPago").hide();
  $("#frmCmbPagarAPago").disableValidation();
  $("#frmTxtCodigoContratante").hide();
  $("#frmTxtCodigoContratante").disableValidation();
  $("#frmChkPagoTransferencia").hide();
  $("#frmTxtValorPagar").hide();
  $("#frmTxtValorPagar").disableValidation();
  $("#frmTxtNombreCobertura").hide();
  $("#frmTxtNombreCobertura").disableValidation();
  $("#frmTxtNombreCobertura").prop("disabled", true).attr("tabindex", "-1").css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  }).off("focus"); 
  $("#frmTxtConceptoCobertura").hide();
  $("#frmTxtConceptoCobertura").disableValidation();
  $("#frmCmbClasePago").hide();
  $("#frmCmbClasePago").disableValidation();
  $("#frmCmbGenerarOp").hide();
  $("#frmCmbGenerarOp").disableValidation();
  $("#frmCmbTipoPago").hide();
  $("#frmCmbTipoPago").disableValidation();
  $("#frmCmbAplicaDeducible").hide();
  $("#frmCmbAplicaDeducible").disableValidation();
  $("#frmTxtValorDeducible").hide();
  $("#frmTxtObservaciones").hide(); 
  $("#chkPagoIndividual").hide();
  $("#grdDetallePago").hide();  
  $("#pnlContenedor").hide();
  $("#esAseguradoBenficiario").setValue("0");
}

function mostrarCobertura(){
  $("#frmCmbTipoLiquidacion").show();
  $("#lblMensajePago").show();
  $("#btnDelCobertura").show();
  $("#btnSaveCobertura").show();
  $("#frmCmbCoberturaPago").show();
  $("#frmCmbCoberturaPago").enableValidation();
  $("#frmCmbPagarAPago").show();
  $("#frmCmbPagarAPago").enableValidation();
  $("#frmTxtCodigoContratante").show();
  $("#frmTxtCodigoContratante").enableValidation();
  $("#frmChkPagoTransferencia").show();
  $("#frmTxtValorPagar").show();
  $("#frmTxtValorPagar").enableValidation();
  $("#frmTxtNombreCobertura").show();
  $("#frmTxtNombreCobertura").enableValidation();
  $("#frmTxtNombreCobertura").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
  $("#frmTxtConceptoCobertura").show();
  $("#frmTxtConceptoCobertura").enableValidation();
  $("#frmCmbClasePago").show();
  $("#frmCmbClasePago").enableValidation();
  $("#frmCmbGenerarOp").show();
  $("#frmCmbGenerarOp").enableValidation();
  $("#frmCmbTipoPago").show();
  $("#frmCmbTipoPago").enableValidation();
  $("#frmCmbAplicaDeducible").show();
  $("#frmCmbAplicaDeducible").enableValidation();
  $("#frmTxtValorDeducible").show();
  $("#frmTxtObservaciones").show();
  $("#frmTxtObservaciones").enableValidation();
  $("#chkPagoIndividual").show();
  $("#grdDetallePago").show(); 
  $("#pnlContenedor").show(); 
  $("#btnAddDetalle").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  }); 

  setStylesComboBox($('#frmCmbTipoLiquidacion'));
  deshabilitarInfoContratante();
  deshabilitarInfoPagos();
  $("#btnAddBeneficiario").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
  $("#btnDelBeneficiario").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
  $("#esAseguradoBenficiario").setValue("1");
}

function limpiarCobertura(){
  $("#frmCmbCoberturaPago").setValue("");
  $("#frmCmbCoberturaPago").disableValidation();
  $("#frmCmbPagarAPago").setValue("");
  $("#frmCmbPagarAPago").disableValidation();
  $("#frmTxtCodigoContratante").setValue("");
  $("#frmTxtCodigoContratante").disableValidation();
  $("#frmTxtValorPagar").setValue("");
  $("#frmTxtValorPagar").disableValidation();
  $("#frmTxtNombreCobertura").setValue("");
  $("#frmTxtNombreCobertura").disableValidation();
  $("#frmTxtConceptoCobertura").setValue("42");
  $("#frmCmbClasePago").setValue("INDEMNIZACION");
  $("#frmCmbGenerarOp").setValue("");
  $("#frmCmbGenerarOp").disableValidation();
  $("#frmCmbTipoPago").setValue("");
  $("#frmCmbTipoPago").disableValidation();
  $("#frmCmbAplicaDeducible").setValue("");
  $("#frmTxtValorDeducible").setValue("");
  $("#frmTxtObservaciones").setValue("");
  $("#frmTxtObservaciones").disableValidation();
}

function info_detalle_pagos(){
  var tipoAbona = ($('#form\\[frmCmbPagarAPago\\]').val() == "BENEFICIARIO") ? 15 : 7;
  var codigoContratante = $('input.pmdynaform-control-text[name="form[frmTxtCodigoContratante]"]').val();  
  $("#frmTxtNombreCobertura").setValue("");  
  if (codigoContratante !== ""){
    $.ajax({
      url: '../beesmartec/services/siniestrosVida/ajax_pantalla.php',
      data: {
        'funcion': 'info_detalle_pagos', 
        'tipoAbona': tipoAbona,
        'codContratante': codigoContratante,
         'frm_token': sessionStorage.getItem('token'),
         'app_number': appNumber
      },
      type: "POST",
      beforeSend : function(){
        showLoader();
      },
      success: function(respuesta){
        if (respuesta !== null){
          var resData = JSON.parse(respuesta);
          infoContratante = resData;
          if (infoContratante != "Error en los datos recibidos"){
            const datos = typeof infoContratante === "string" ? JSON.parse(infoContratante) : infoContratante;
            if (datos.nombre !== null){
              $('[name="form[frmTxtNombreCobertura]"]').val(datos.nombre);              
              habilitarInfoContratante();
              habilitarInfoPagos();
              $('#form\\[frmChkPagoTransferencia\\]').focus();
            }else{
              alert("No se encontro informacion para el contratante con codigo: " + codigoContratante);
              $('[name="form[frmTxtNombreCobertura]"]').val("");   
            }
          }else{
            alert("No se encontro informacion para el contratante con codigo: " + codigoContratante);
            $('[name="form[frmTxtNombreCobertura]"]').val("");   
          }
        }
        else{
          alert("No se encontro informacion para el contratante con codigo: " + codigoContratante);
          $('[name="form[frmTxtNombreCobertura]"]').val("");   
        }
      },
      error: function(xhr, status){
        alert("Ocurrio un error al obtener la informacion del contratante." + status);
      },
      complete : function(xhr, status) {
        hideLoader();          
      }
    });
  }
}

function validaMontoPagar(){
  var montoPagar = parseFloat($('input[id="form\\[frmTxtValorPagar\\]"]').val().trim());  
  if (isNaN(montoPagar) || montoPagar <= 0){
    alert("Es necesario definir un monto a pagar ");
    $('input[id="form\\[frmTxtValorPagar\\]"]').val("");
    return;
  }
  
  var cobertura = $('select[id="form\\[frmCmbCoberturaPago\\]"]').val();
  if (cobertura === ""){
    alert("Es necesario definir una cobertura ");
    $('input[id="form\\[frmTxtValorPagar\\]"]').val("").trigger("change");
    return;
  }

  indexCobertura = parseInt(cobertura.replace("item",""))-1;
  var montoCobertura = dataCoberturas[indexCobertura];
  var sumMontos = 0;
  for (var i = 1; i <= $("#grdDetallePago").getNumberRows(); i++){
    if (currentFila != i){
      if ($("#grdDetallePago").getValue(i, 15) == $('#form\\[frmCmbCoberturaPago\\]').val()){
        sumMontos = sumMontos + parseFloat($("#grdDetallePago").getValue(i, 5));
      }      
    }
  }

  if (montoPagar+sumMontos > montoCobertura){
    alert("El sumatoria de los montos a pagar no puede ser mayor al monto de la cobertura seleccionada: " + montoCobertura);
    $('select[id="form\\[frmCmbTipoPago\\]"]').val("").trigger("change");
    $('input[id="form\\[frmTxtValorPagar\\]"]').val("").trigger("change");
  }
  else if(montoPagar+sumMontos == montoCobertura){
    $('select[id="form\\[frmCmbTipoPago\\]"]').val("TOTAL").trigger("change");
    $("#btnSavePago").prop("disabled", true).css({
      "pointer-events": "auto", // Permite interacciones
      "opacity": "1", // Restaura la opacidad normal
      "cursor": "default" // Restaura el cursor
    });
    $("#btnSavePago").show();
  }else{    
    $('select[id="form\\[frmCmbTipoPago\\]"]').val("PARCIAL").trigger("change");
    $("#btnSavePago").prop("disabled", true).css({
      "pointer-events": "auto", // Permite interacciones
      "opacity": "1", // Restaura la opacidad normal
      "cursor": "default" // Restaura el cursor
    });
    $("#btnSavePago").show();
  }  
}

function eliminarPagosBeneficiario(beneficiario){
  for (var i = $("#grdDetallePago").getNumberRows(); i >= 1; i--){
    var rowBeneficiario = $("#grdDetallePago").getValue(i, 6);
    if (rowBeneficiario === beneficiario){
      $("#grdDetallePago").deleteRow(i);
    }
  }
}

function verificarPagos(){
  var numPagos = $("#grdDetallePago").getNumberRows();
  for (var i = numPagos; i >= 1; i--){
    var rowIndex = $("#grdDetallePago").getValue(i, 15);
    if (rowIndex == ""){
      $("#grdDetallePago").deleteRow(i);
    }
  }
}

function eliminarPagos(){
  var numPagos = $("#grdDetallePago").getNumberRows();
  for (var i = numPagos; i >= 1; i--){
    if ($("#grdDetallePago").getValue(i, 16) != "1"){
      $("#grdDetallePago").deleteRow(i);           
    }else{
      isDataProcesada = true; 
    }
  }
}

function deshabilitarInfoContratante(){
  $("#frmChkPagoTransferencia").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#frmCmbGenerarOp").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#frmTxtNombreCobertura").prop("disabled", true).attr("tabindex", "-1").css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  }).off("focus");

  $("#frmTxtObservaciones").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
}

function habilitarInfoContratante(){
  $("#frmChkPagoTransferencia").prop("disabled", false).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmCmbGenerarOp").prop("disabled", false).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });  

  $("#frmTxtObservaciones").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });
}

function limpiarInfoContratante(){
  $('#form\\[frmCmbPagarAPago\\]').val("");
  $("#frmCmbPagarAPago").disableValidation();
  $('#form\\[frmTxtCodigoContratante\\]').val("");
  $("#frmTxtCodigoContratante").disableValidation();
  $('#form\\[frmTxtNombreCobertura\\]').val("");
  $("#frmTxtNombreCobertura").disableValidation();
  $('#form\\[frmChkPagoTransferencia\\]').val("");
  $('input[id="form\\[frmChkPagoTransferencia\\]"]').prop("checked", false);
  $('#form\\[frmCmbGenerarOp\\]').val("");
  $('#form\\[frmTxtObservaciones\\]').val("");
  $("#frmTxtObservaciones").disableValidation();
}

function deshabilitarInfoPagos(){
  $("#frmCmbCoberturaPago").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#frmTxtValorPagar").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#frmCmbTipoPago").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#frmCmbClasePago").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#frmTxtConceptoCobertura").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#frmCmbAplicaDeducible").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#frmTxtValorDeducible").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#chkPagoIndividual").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });

  $("#btnSavePago").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
}

function habilitarInfoPagos(){
  $("#frmCmbCoberturaPago").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmTxtValorPagar").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmCmbTipoPago").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmCmbClasePago").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmTxtConceptoCobertura").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmCmbAplicaDeducible").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmTxtValorDeducible").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#chkPagoIndividual").prop("disabled", true).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });
}

function limpiarInfoPagos(){  
  $('#form\\[frmCmbCoberturaPago\\]').val("");
  $("#frmCmbCoberturaPago").disableValidation();
  $('#form\\[frmTxtValorPagar\\]').val("");
  $("#frmTxtValorPagar").disableValidation();
  $('#form\\[frmCmbTipoPago\\]').val("");
  $("#frmCmbTipoPago").disableValidation();
  $('#form\\[frmCmbClasePago\\]').val("INDEMNIZACION");  
  $('#form\\[frmTxtConceptoCobertura\\]').val("42");
  $('#form\\[chkPagoIndividual\\]').prop('checked', false).trigger('change');
  $("#btnSavePago").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
}

function validarTotales(){
  var numPagos = $("#grdDetallePago").getNumberRows();
  var totalPagos = 0;
  for (var i = 1; i <= numPagos; i++){
    var valorPagar = parseFloat($("#grdDetallePago").getValue(i, 5)) || 0;
    totalPagos += valorPagar;
  }
  if (totalPagos == totalCoberturas)
    $("#frmCmbTipoLiquidacion").setValue("TOTAL");
  else
    $("#frmCmbTipoLiquidacion").setValue("PARCIAL");
}

ocultarCobertura();

$("#btnAddDetalle").click(function(event) {
  event.preventDefault();
  limpiarCoberturas();
  obtenerCoberturas();
  $("#frmCmbPagarAPago").prop("disabled", false).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmTxtCodigoContratante").prop("disabled", false).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  }); 

  $('#form\\[frmChkPagoTransferencia\\]').prop('checked', false).trigger('change');  

  if ($("#grdDetallePago").getNumberRows() > 0){
    if ($("#grdDetallePago").getValue(1, 1)===""){
      $("#grdDetallePago").deleteRow(1);
      $(".pmdynaform-grid-removerow-static", '#grdDetallePago').hide();
    }
  }

  $('#form\\[chkPagoIndividual\\]').prop('checked', false).trigger('change');
  
  console.log("Valor Pago individual: " + $('#form\\[chkPagoIndividual\\]').val());

  if (dataCoberturas.length === 0){
    alert("No se existen Montos Aprobados para las Coberturas.");
    return;    
  }
  mostrarCobertura();
});

$("#btnDelCobertura").click(function(event) {
  var numPagos = $("#grdDetallePago").getNumberRows();
  if (numPagos > 0){
    const confirmar = confirm("Esta accion eliminara todos los pagos registrados: ("+numPagos+")\nSeguro que desea continuar?");
    if (confirmar) {
      eliminarPagos();
      if (isDataProcesada){
        return;
      }
      verificarPagos();      
      limpiarCoberturas();
      limpiarInfoContratante();
      limpiarInfoPagos();
      ocultarCobertura();
      $("#btnAddDetalle").prop("disabled", false).css({
      "pointer-events": "auto", // Permite interacciones
      "opacity": "1", // Restaura la opacidad normal
      "cursor": "default" // Restaura el cursor
      });
    }
  }
  else{
    limpiarCoberturas();
    limpiarCoberturas();
    ocultarCobertura();
    $("#btnAddDetalle").prop("disabled", false).css({
      "pointer-events": "auto", // Permite interacciones
      "opacity": "1", // Restaura la opacidad normal
      "cursor": "default" // Restaura el cursor
      });
  }
});

$("#btnSavePago").click(function(event) {
  event.preventDefault();
  if (verificarPago()){
    var frmCmbCoberturaPago = nombreCoberturas[indexCobertura];
    var txtNombreCobertura = $('#form\\[frmCmbCoberturaPago\\]').val();
    var frmCmbPagarAPago = $('#form\\[frmCmbPagarAPago\\]').val();
    var frmTxtCodigoContratante = $('#form\\[frmTxtCodigoContratante\\]').val();  
    var frmChkPagoTransferencia = $('input[name="form[frmChkPagoTransferencia][]"]').prop('checked') ? "SI" : "NO";
    var frmTxtValorPagar = $('#form\\[frmTxtValorPagar\\]').val();
    var frmTxtNombreCobertura = $('#form\\[frmTxtNombreCobertura\\]').val();
    var frmTxtConceptoCobertura = $('#form\\[frmTxtConceptoCobertura\\]').val();
    var frmCmbClasePago = $('#form\\[frmCmbClasePago\\]').val();
    var frmCmbGenerarOp = $('select[name="form[frmCmbGenerarOp]"] option:selected').text();
    if (frmCmbGenerarOp == "Seleccione"){
      frmCmbGenerarOp = "";
      $('select[name="form[frmCmbGenerarOp]"] option:selected').enableValidation();
    }
    var frmCmbTipoPago = $('#form\\[frmCmbTipoPago\\]').val();
    var frmCmbAplicaDeducible = $('#form\\[frmCmbAplicaDeducible\\]').val();
    var frmTxtValorDeducible = $('#form\\[frmTxtValorDeducible\\]').val();
    var frmTxtObservaciones = $('#form\\[frmTxtObservaciones\\]').val();
    var frmPagoIndividual = $('input[name="form[chkPagoIndividual][]"]').prop('checked') ? "SI" : "NO";    
  
    var procesado = 0;
    var txtIndexCobertura = indexCobertura;

    if (frmCmbCoberturaPago == "" || frmCmbPagarAPago == "" ||
        frmTxtCodigoContratante == "" || frmTxtValorPagar== "" ||
        frmTxtNombreCobertura == "" || frmTxtConceptoCobertura == "" ||
        frmCmbClasePago == "" || frmCmbGenerarOp == "" ||
        frmCmbTipoPago == ""|| frmTxtObservaciones == ""){
      alert("Todos los campos marcados con * son obligatorios.");
      return;
    }
    
    if (currentFila === null){
      var numRows = $("#grdDetallePago").getNumberRows(); 
      var newRowIndex = 0;
      if (numRows > 0) {
        var lastRowValue = $("#grdDetallePago").getValue(numRows, 1);
        if (!lastRowValue) {
          newRowIndex = numRows; 
        } else {
          $("#grdDetallePago").addRow();
          newRowIndex = $("#grdDetallePago").getNumberRows();
        }
      } else {
        $("#grdDetallePago").addRow();
        newRowIndex = $("#grdDetallePago").getNumberRows();
      }  
    }else{
      newRowIndex = currentFila;
    }
    
    $("#grdDetallePago").setValue(frmCmbCoberturaPago, newRowIndex, 1);
    $("#grdDetallePago").setValue(frmCmbPagarAPago, newRowIndex, 2);
    $("#grdDetallePago").setValue(frmTxtCodigoContratante, newRowIndex, 3);
    $("#grdDetallePago").setValue(frmChkPagoTransferencia, newRowIndex, 4);
    $("#grdDetallePago").setValue(frmTxtValorPagar, newRowIndex, 5);
    $("#grdDetallePago").setValue(frmTxtNombreCobertura, newRowIndex, 6);
    $("#grdDetallePago").setValue(frmTxtConceptoCobertura, newRowIndex, 7);
    $("#grdDetallePago").setValue(frmCmbClasePago, newRowIndex, 8);
    $("#grdDetallePago").setValue(frmCmbGenerarOp, newRowIndex, 9);
    $("#grdDetallePago").setValue(frmCmbTipoPago, newRowIndex, 10);
    $("#grdDetallePago").setValue(frmCmbAplicaDeducible, newRowIndex, 11);
    $("#grdDetallePago").setValue(frmTxtValorDeducible, newRowIndex, 12);
    $("#grdDetallePago").setValue(frmTxtObservaciones, newRowIndex, 13);
    $("#grdDetallePago").setValue(txtIndexCobertura, newRowIndex, 14);
    $("#grdDetallePago").setValue(txtNombreCobertura, newRowIndex, 15);
    $("#grdDetallePago").setValue(procesado, newRowIndex, 16);
    $("#grdDetallePago").setValue(frmPagoIndividual, newRowIndex, 17); 
    
    $("#frmCmbCoberturaPago").prop("disabled", false).css({
      "pointer-events": "auto", // Permite interacciones
      "opacity": "1", // Restaura la opacidad normal
      "cursor": "default" // Restaura el cursor
      });
    $("#btnAddBeneficiario").prop("disabled", false).css({
      "pointer-events": "auto", // Permite interacciones
      "opacity": "1", // Restaura la opacidad normal
      "cursor": "default" // Restaura el cursor
      });
    $("#btnAddBeneficiario").show();  
    limpiarInfoPagos();
    deshabilitarInfoContratante();
    $("#btnSavePago").prop("disabled", true).css({
      "pointer-events": "none", // Bloquea clics
      "opacity": "0.5", // Lo hace visualmente mas tenue
      "cursor": "not-allowed" // Cambia el cursor a "prohibido"
    });
    $("#btnSavePago").hide();

    $("#frmCmbPagarAPago").prop("disabled", true).css({
      "pointer-events": "none", // Permite interacciones
      "opacity": "0.5", // Restaura la opacidad normal
      "cursor": "not-allowed" // Restaura el cursor
    });

    $("#frmTxtCodigoContratante").prop("disabled", true).css({
      "pointer-events": "none", // Permite interacciones
      "opacity": "0.5", // Restaura la opacidad normal
      "cursor": "not-allowed" // Restaura el cursor
    });

    $("#btnDelPago").prop("disabled", true).css({
      "pointer-events": "none", // Bloquea clics
      "opacity": "0.5", // Lo hace visualmente mas tenue
      "cursor": "not-allowed" // Cambia el cursor a "prohibido"
    });
    $("#btnDelPago").hide();

    currentFila = null;
    infoContratante = null;
    validarTotales();
  }
});

$("#btnDelPago").click(function(event) {
  const confirmar = confirm("Se eliminara el pago de "+ $("#frmTxtValorPagar").getValue()+ " al beneficiario: "+$("#frmTxtNombreCobertura").getValue()+"\nSeguro que desea continuar?");
  if (confirmar) {    
    $("#grdDetallePago").deleteRow(currentFila);
    currentFila = null;
    limpiarInfoPagos();
    habilitarInfoPagos();
    validarTotales();
    $("#btnDelPago").prop("disabled", true).css({
      "pointer-events": "none", // Bloquea clics
      "opacity": "0.5", // Lo hace visualmente mas tenue
      "cursor": "not-allowed" // Cambia el cursor a "prohibido"
    });
    $("#btnDelPago").hide();

    $("#btnSavePago").prop("disabled", true).css({
      "pointer-events": "none", // Bloquea clics
      "opacity": "0.5", // Lo hace visualmente mas tenue
      "cursor": "not-allowed" // Cambia el cursor a "prohibido"
    });
    $("#btnSavePago").hide();
  }
});

$("#btnDelBeneficiario").click(function(event) {
  const confirmar = confirm("Se eliminaran todos los pagos registrados al beneficiario: "+$("#frmTxtNombreCobertura").getValue()+"\nSeguro que desea continuar?");
  if (confirmar) {    
    eliminarPagosBeneficiario($('#form\\[frmTxtNombreCobertura\\]').val());
    limpiarInfoPagos();
    limpiarInfoContratante();
    $("#btnDelBeneficiario").hide();
    $("#btnSavePago").hide();
    $("#btnDelPago").hide();
    validarTotales();
    currentFila = null;
  }
});

function mostrarPopup(datosContratante){
  const datos = typeof datosContratante === "string" ? JSON.parse(datosContratante) : datosContratante;

  const fondo = $("<div>").css({
        position: "fixed",
        top: 0,
        left: 0,
        width: "100%",
        height: "100%",
        backgroundColor: "rgba(0, 0, 0, 0.5)",
        zIndex: "999"
    });
  
  const popup = $("<div>").css({
        position: "fixed",
        top: "50%",
        left: "50%",
        transform: "translate(-50%, -50%)",
        backgroundColor: "#fff",
        padding: "25px",
        border: "1px solid #ccc",
        boxShadow: "0 0 15px rgba(0, 0, 0, 0.2)",
        zIndex: "1000",
        width: "700px",
        maxHeight: "85vh",
        overflowY: "auto",
        borderRadius: "5px"
    });

    const tabla = $("<table>").css({
      width: "100%",
      borderCollapse: "separate",
      borderSpacing: "0 15px", // Espacio vertical entre filas
      marginBottom: "20px",
      border: "none"
    });

    function crearCelda(etiqueta, valor, colspan = 1) {
      const celda = $("<td>").css({
          padding: "10px",
          border: "none",
          verticalAlign: "top"
      }).attr("colspan", colspan);
      
      const label = $("<div>").text(etiqueta).css({
        fontWeight: "600",
        marginBottom: "8px",
        color: "#333",
        fontSize: "11px"
      });
      
      const textbox = $("<textarea>")
        .attr("readonly", true)
        .val(valor)
        .css({
            width: "100%",
            height: "20px", 
            minHeight: "20px", 
            padding: "5px",
            border: "1px solid #e0e0e0",
            borderRadius: "4px",
            resize: "none",
            backgroundColor: "#f9f9f9",
            fontFamily: "inherit",
            fontSize: "10px",
            lineHeight: "normal",
            overflow: "hidden"
      });
        
      return celda.append(label, textbox);
    }

    const fila1 = $("<tr>");
    fila1.append(
        crearCelda("Tipo cuenta", datos.tipoCuenta),
        crearCelda("Banco", datos.banco),
        crearCelda("Num cuenta", datos.numCuenta)
    );
    tabla.append(fila1);

    const fila2 = $("<tr>");
    fila2.append(
        crearCelda("Mail", datos.mail),
        crearCelda("Tipo documento", datos.tipoDoc),
        crearCelda("Num documento", datos.numDoc)
    );
    tabla.append(fila2);

    const fila3 = $("<tr>");
    const colectivoCheck = $("<input>").attr({
        type: "checkbox",
        id: "chkColectivo"
    }).prop("checked", false);
    
    const colectivoTextBox = $("<textarea>")
      .attr("readonly", true)
      .val(datos.colectivo)
      .css({
        width: "100%",
        height: "20px",
        minHeight: "20px",
        padding: "5px",
        border: "1px solid #e0e0e0",
        borderRadius: "4px",
        resize: "none",
        backgroundColor: "#f9f9f9",
        fontFamily: "inherit",
        fontSize: "10px",
        lineHeight: "normal",
        overflow: "hidden"
      });
    
    const celdaColectivo = $("<td>").css({
        padding: "10px",
        border: "none",
        verticalAlign: "middle"
    }).attr("colspan", 3).append(
        $("<div>").css({display: "flex", alignItems: "center"}).append(
            colectivoCheck,
            $("<label>").attr("for", "chkColectivo").text(" Colectivo").css({
              marginLeft: "5px",
              marginRight: "15px",
              fontWeight: "600",
              minWidth: "70px",
              fontSize: "11px"
            }),
            colectivoTextBox
        )
    );
    fila3.append(celdaColectivo);
    tabla.append(fila3);

    const fila4 = $("<tr>").css({
      border: "none"
    });
    const masivoCheck = $("<input>").attr({
        type: "checkbox",
        id: "chkMasivo"
    }).prop("checked", false);
    
    const masivoTextBox = $("<textarea>")
        .attr("readonly", true)
        .val(datos.masivo)
        .css({
          width: "100%",
          height: "20px", 
          minHeight: "20px",
          padding: "5px",
          border: "1px solid #e0e0e0",
          borderRadius: "4px",
          resize: "none",
          backgroundColor: "#f9f9f9",
          fontFamily: "inherit",
          fontSize: "10px",
          lineHeight: "normal",
          overflow: "hidden"
        });

    const celdaMasivo = $("<td>").css({
        padding: "10px",
        border: "none",
        verticalAlign: "middle"
    }).attr("colspan", 3).append(
        $("<div>").css({display: "flex", alignItems: "center"}).append(
            masivoCheck,
            $("<label>").attr("for", "chkMasivo").text(" Masivo").css({
              marginLeft: "5px",
              marginRight: "15px",
              fontWeight: "600",
              minWidth: "70px",
              fontSize: "11px"
            }),
            masivoTextBox
        )
    );
    fila4.append(celdaMasivo);
    tabla.append(fila4);
    
    popup.append(tabla);
    
    const botonesContainer = $("<div>").css({
      marginTop: "25px",
      textAlign: "right",
      paddingTop: "15px",
      borderTop: "1px solid #eee"
    });

   
    const btnAceptar = $("<button>").text("Aceptar").click(function () {
      const colectivoValue = $("#chkColectivo").is(":checked") ? "1" : "0";
      const masivoValue = $("#chkMasivo").is(":checked") ? datos.masivo : "";
      //$("#frmTxtNombreCobertura").setValue(datos.nombre);
      infoContratante = datosContratante;
      $('#form\\[frmCmbGenerarOp\\]').val("1");
      popup.remove();
      fondo.remove();
    }).css({
      padding: "10px 25px",
      marginLeft: "15px",
      backgroundColor: "#0073b7",
      color: "white",
      border: "none",
      borderRadius: "4px",
      cursor: "pointer",
      fontSize: "12px",
      fontWeight: "600",
      transition: "background-color 0.3s"
    }).hover(
        function() { $(this).css("backgroundColor", "#1C9DD9"); },
        function() { $(this).css("backgroundColor", "#0073b7"); }
    );

    const btnCancelar = $("<button>").text("Cancelar").click(function () {
      $('#form\\[frmCmbGenerarOp\\]').val("0");
      $('#form\\[frmChkPagoTransferencia\\]').prop('checked', false).trigger('change');
      popup.remove();
      fondo.remove();
    }).css({
      padding: "10px 25px",
      backgroundColor: "#c5c5c5",
      color: "white",
      border: "none",
      borderRadius: "4px",
      cursor: "pointer",
      fontSize: "12px",
      fontWeight: "600",
      transition: "background-color 0.3s"
    }).hover(
        function() { $(this).css("backgroundColor", "#1C9DD9"); },
        function() { $(this).css("backgroundColor", "#c5c5c5"); }
    );

    botonesContainer.append(btnAceptar, btnCancelar);
    popup.append(botonesContainer);
    // Agregar el popup al body
    $("body").append(fondo, popup);
}

function verificarPago(){
  var tmpPagoIndividual = $('input[name="form[chkPagoIndividual][]"]').prop('checked') ? "SI" : "NO";  

  var _txtCobertura = $('#form\\[frmCmbCoberturaPago\\]').val();
  var _txtPagarA = $('#form\\[frmCmbPagarAPago\\]').val();
  var _txtCodContratante = $('#form\\[frmTxtCodigoContratante\\]').val();
  
  var numPagos = $("#grdDetallePago").getNumberRows();
  for (var i = 1; i <= numPagos; i++){
    var _grdCobertura = $("#grdDetallePago").getValue(i, 15);
    var _grdPagarA = $("#grdDetallePago").getValue(i, 2);
    var _grdCodContratante = $("#grdDetallePago").getValue(i, 3);

    if (_grdCobertura ==  _txtCobertura && _grdPagarA == _txtPagarA &&
      _grdCodContratante == _txtCodContratante && tmpPagoIndividual === "NO"){
      alert("Ya existe un pago registrado para el beneficiario: "+$("#grdDetallePago").getValue(i, 6)+", con la cobertura: "+$("#grdDetallePago").getValue(i, 1));
      return false;
    }
  }
  return true;
}

$("#frmChkPagoTransferencia").change(function () {
    if ($('input[id="form\\[frmChkPagoTransferencia\\]"]').prop("checked")) {  
      $('#form\\[frmChkPagoTransferencia\\]').prop('checked', true);
      $("#frmCmbGenerarOp").setValue("1");
      if (infoContratante !== null){
        mostrarPopup(infoContratante);       
      }      
    }else{
      $("#frmCmbGenerarOp").setValue("0");
      $('#form\\[frmChkPagoTransferencia\\]').prop('checked', false);
    }
});

$("#grdDetallePago").on("click", ".pmdynaform-label-options", function(event) {
 
  const hiddenInput = $(this).find("input.value-hidden");
  
  if (hiddenInput.length) {
    const inputId = hiddenInput.attr("id");    
    const rowIndex = inputId.match(/\[([0-9]+)\]/)[1];
    var numRows = $("#grdDetallePago").getNumberRows();
    console.log("Fila seleccionada: " + $("#grdDetallePago").getValue(rowIndex, 16));
    if ($("#grdDetallePago").getValue(rowIndex, 16) !== "1"){
      if (rowIndex >= 1 && rowIndex <= numRows){
        $('#form\\[frmCmbCoberturaPago\\]').val($("#grdDetallePago").getValue(rowIndex, 15));      
        $('#form\\[frmCmbPagarAPago\\]').val($("#grdDetallePago").getValue(rowIndex, 2));      
        $('#form\\[frmTxtCodigoContratante\\]').val($("#grdDetallePago").getValue(rowIndex, 3));      
        $('#form\\[frmChkPagoTransferencia\\]').val($("#grdDetallePago").getValue(rowIndex, 4)=="SI" ? 1 : 0);
        $('#form\\[frmTxtValorPagar\\]').val($("#grdDetallePago").getValue(rowIndex, 5));      
        $('#form\\[frmTxtNombreCobertura\\]').val($("#grdDetallePago").getValue(rowIndex, 6));      
        $('#form\\[frmTxtConceptoCobertura\\]').val($("#grdDetallePago").getValue(rowIndex, 7));
        $('#form\\[frmCmbClasePago\\]').val($("#grdDetallePago").getValue(rowIndex, 8));
        $("#frmCmbGenerarOp").setValue($("#grdDetallePago").getValue(rowIndex, 9)=="SI" ? "1" : "0");      
        $('#form\\[frmCmbTipoPago\\]').val($("#grdDetallePago").getValue(rowIndex, 10));
        $('#form\\[frmCmbAplicaDeducible\\]').val($("#grdDetallePago").getValue(rowIndex, 11));
        $('#form\\[frmTxtValorDeducible\\]').val($("#grdDetallePago").getValue(rowIndex, 12));
        $('#form\\[frmTxtObservaciones\\]').val($("#grdDetallePago").getValue(rowIndex, 13));
        $('#form\\[chkPagoIndividual\\]').prop('checked', $("#grdDetallePago").getValue(rowIndex, 17)=="SI").trigger('change');
        indexCobertura = $("#grdDetallePago").getValue(rowIndex, 14);
        currentFila = rowIndex;
        $('#frmCmbCoberturaPago').prop('disabled', true) .css({
          "pointer-events": "none", // Bloquea clics
          "opacity": "0.5", // Lo hace visualmente mas tenue
          "cursor": "not-allowed" // Cambia el cursor a "prohibido"
        })
        .off("click"); 

        $("#btnDelBeneficiario").prop("disabled", false).css({
          "pointer-events": "auto", // Permite interacciones
          "opacity": "1", // Restaura la opacidad normal
          "cursor": "default" // Restaura el cursor
          });
        $("#btnDelBeneficiario").show();

        $("#btnSavePago").prop("disabled", true).css({
          "pointer-events": "auto", // Permite interacciones
          "opacity": "1", // Restaura la opacidad normal
          "cursor": "default" // Restaura el cursor
        });
        $("#btnSavePago").show();


        $("#btnDelPago").prop("disabled", true).css({
          "pointer-events": "auto", // Permite interacciones
          "opacity": "1", // Restaura la opacidad normal
          "cursor": "default" // Restaura el cursor
        });
        $("#btnDelPago").show();
      }
    }
  }
});

$("#btnAddBeneficiario").click(function(event) {
  event.preventDefault();
  limpiarInfoContratante();
  limpiarInfoPagos();
  deshabilitarInfoPagos();
  //habilitarInfoContratante();

  $("#frmCmbPagarAPago").prop("disabled", false).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  });

  $("#frmTxtCodigoContratante").prop("disabled", false).css({
    "pointer-events": "auto", // Permite interacciones
    "opacity": "1", // Restaura la opacidad normal
    "cursor": "default" // Restaura el cursor
  }); 

  $('#btnDelPago').prop('disabled', true) .css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
  $('#btnDelPago').hide();

  $('#btnSavePago').prop('disabled', true) .css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
  $('#btnSavePago').hide();

  $("#btnAddBeneficiario").prop("disabled", true).css({
    "pointer-events": "none", // Bloquea clics
    "opacity": "0.5", // Lo hace visualmente mas tenue
    "cursor": "not-allowed" // Cambia el cursor a "prohibido"
  });
  $("#btnAddBeneficiario").hide();
});

$("#frmTxtCodigoContratante").focusout(info_detalle_pagos);
$("#frmTxtValorPagar").focusout(validaMontoPagar);

$(document).ready(function () {
  let fila1 = [
      $("#frmCmbPagarAPago"),
      $("#frmTxtCodigoContratante"),
      $("#frmTxtNombreCobertura"),
      $("#frmChkPagoTransferencia"),
      $("#frmCmbGenerarOp"),
      $("#frmTxtObservaciones"),
      $("#btnAddBeneficiario"),
      $("#btnDelBeneficiario")      
  ];
  
  let fila2 = [
    $("#frmCmbCoberturaPago"),
    $("#frmTxtValorPagar"),
    $("#frmCmbTipoPago"),
    $("#frmCmbClasePago"),
    $("#frmTxtConceptoCobertura"),
    $("#frmCmbAplicaDeducible"),
    $("#frmTxtValorDeducible"),
    $("#chkPagoIndividual"),
    $("#btnSavePago"),
    $("#btnDelPago")
  ];

  // Insertar en el mismo orden dentro del GroupBox
  fila1.forEach(elemento => $("#groupAsegurado").append(elemento));
  fila2.forEach(elemento => $("#groupCobertura").append(elemento));
});