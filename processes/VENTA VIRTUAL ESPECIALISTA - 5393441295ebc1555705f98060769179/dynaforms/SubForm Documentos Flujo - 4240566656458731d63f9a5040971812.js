// Resuelve el bug de que el link de la grilla
// no funciona al cargar la data desde trigger.
$(function(){
  var numero_columna_link = 5;

  for(var i = 1; i<=$("#gridDocumentos").getNumberRows(); i++){
    /*
    console.log('****************************');
    console.log($("#gridDocumentos").getText (i, numero_columna_link));
    console.log($("#gridDocumentos").getValue(i, numero_columna_link));
    */
    
    var url = $("#gridDocumentos").getValue (i, numero_columna_link);
    $("#gridDocumentos").setValue(url, i, numero_columna_link);
  } 
})

