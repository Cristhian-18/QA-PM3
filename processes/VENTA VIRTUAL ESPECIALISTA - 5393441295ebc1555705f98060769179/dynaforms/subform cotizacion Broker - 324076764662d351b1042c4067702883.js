/*
//sets the value of the independent fields in each row in the grid:
function setIndependent (newVal, oldVal) {
//  alert ("entre");
  var oGrid = $("#grd_coberturas"); //change to the ID of the grid
  for (var i = 1; i <= oGrid.getNumberRows(); i++) {
    //change 2 to the column position of the hidden text field:
    oGrid.setValue(newVal, i, 8); 
  }   
}
//change selectUserId to the ID of the independent field outside the grid   
$("#selectUserId").setOnchange(setIndependent);
setIndependent($("#frm_producto").getValue(), '');
*/

$("#frm_impuesto").hide();
$("#grd_coberturas").hideColumn(1);
var impuesto = $("#frm_impuesto").getValue();
$("#frm_prima_iva").setLabel(impuesto+'% Impuesto');
$("#tri_error_producto").hide();
$("#btn_calcular").hide();


/*
$("#grd_coberturas").onAddRow(function(aNewRow, oGrid, rowIndex) {
  var aux = $("#frm_producto").getControl().val();
  aNewRow[0].setValue(aux);

});


$("#grd_coberturas").on("change" , function() {
  alert ("entrando");
  //$("#grd_coberturas").clear();
});
*/

$("#frm_producto").on("change" , function() {
  $("#grd_coberturas").clear();
});

$("#btn_calcular").on("click" , function() {
  validar_beneficio();
  calcular()
});

function calcular(){
  $("#3751077885fbe75756c4ec1052766767").saveForm();  
  recorrer_beneficio();
  var numRows = $("#grd_coberturas").getNumberRows();
  var suma=0;
  var dscto = 0;
  //alert (numRows);
  for (var i=1; i <= numRows; i++) {
    var dato = $("#grd_coberturas").getValue(i, 8)*1;   
    var des = $("#grd_coberturas").getValue(i, 6);
    suma = suma + dato*1;
    dscto = dscto + des*1;
    var dato1 = dato.toFixed(2);
    $("#grd_coberturas").setValue(dato1,i, 8);
    // alert (suma);
  };  
  var impuesto = $("#frm_impuesto").getValue();
  var derecho = $("#frm_prima_derechos").getValue();  
  var adicional = $("#frm_aporte_adicional").getValue();
  //  alert ('adicional '+ adicional);
  var val_impuesto = suma * impuesto / 100;
  //  alert ('impouesto '+ val_impuesto);

  var subtotal = val_impuesto*1 + suma*1 ;
  //  alert ('subtotal '+ subtotal);
  var porRecargo = $("#frm_por_recargo").getValue();
  //  alert ('por'+porRecargo);
  var recargo = subtotal * porRecargo / 100; //subtotal
  //   alert ('recar'+recargo);  



  var suma = suma.toFixed(2);  
  var val_impuesto = val_impuesto.toFixed(2);
  
  var total = subtotal + derecho*1 +recargo*1 +adicional*1;  

  var subtotal = subtotal.toFixed(2);
  var recargo = recargo.toFixed(2);
  var dscto = dscto.toFixed(2);   
  var total = total.toFixed(2); 

  $("#frm_prima_subtt").setValue(suma);
  $("#frm_prima_iva").setValue(val_impuesto);
  $("#frm_prima_dscto").setValue(dscto);
  $("#frm_prima_conimpuestos").setValue(subtotal);  
  $("#frm_prima_recargo").setValue(recargo);  
//  $("#frm_prima_total").setValue(total); 


  //  ponerDecimales('frm_prima_total');
  //  ponerDecimales('frm_prima_iva');  
  //  ponerDecimales('frm_prima_conImpuesto');    

}

function recorrer_beneficio(){
  var numRows = $("#grd_coberturas").getNumberRows();
  var dental=0;
  var exequial=0; 
  var suma = 0;
  for (var i=1; i <= numRows; i++) {
    var dato= 	$("#grd_coberturas").getValue(i, 2);
    var prima = $("#grd_coberturas").getValue(i, 8)*1;
    if (dato >= 24 && dato <= 32){
      //    alert ('dental '+prima);
      dental = dental + prima;
    }
    if (dato >= 5801 && dato <= 5820){
      //    alert ('exequial '+prima);
      exequial = exequial + prima;
    }
    if (dato == 1 ){
      var asegurado = $("#grd_coberturas").getValue(i, 3)*1;
    }    
    suma = suma + prima;
  };
  var suma = suma.toFixed(2);
  var dental = dental.toFixed(2);
  var exequial = exequial.toFixed(2);  
  $("#frm_prima_subtt").setValue(suma);  
  $("#frm_prima_dental").setValue(dental);  
  $("#frm_prima_exequial").setValue(exequial);  
  $("#frm_valor_asegurado").setValue(asegurado);    
}