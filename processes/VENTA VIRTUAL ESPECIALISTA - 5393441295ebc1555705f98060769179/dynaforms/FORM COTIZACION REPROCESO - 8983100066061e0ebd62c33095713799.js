$('#1852090325ec434cca75924044427744').hide();

$("#8983100066061e0ebd62c33095713799").setOnSubmit(function(){
  $("#8983100066061e0ebd62c33095713799").saveForm() ;
  var bandera = true;

  //PDF
  var array_PDF = $("#file_cotizacion").find( ".pmdynaform-field-control li" );

  if(array_PDF.length == 0){
    alert("Cotizacion PDF - requerido");
    bandera = false;
  }else if(array_PDF.length > 1){
    alert("Cotizacion PDF - Por favor adjunte solo un archivo");
    bandera = false;
  }

  const nombresArchivos = [];
  $.each(array_PDF, function( index, value ) {

    nombreArchivo_PDF = $(value).html();

    if(nombreArchivo_PDF != '' && typeof nombreArchivo_PDF !== 'undefined'){
      var pizza = nombreArchivo_PDF.toString().trim().split('.');
      var ext = pizza[pizza.length - 1];
      if(ext != "pdf"){
        alert("Cotizacion PDF - debe ser un archivo .pdf");
        bandera = false;
      }
    }

    //verificar repetidos
    if(jQuery.inArray(nombreArchivo_PDF, nombresArchivos) !== -1){
      alert("Archivos PDF repetidos");
      bandera = false;
    }
    nombresArchivos.push(nombreArchivo_PDF);

  });

  //CSV
  var array_CSV = $("#file_cotizacion_csv").find( ".pmdynaform-field-control li" );

  if(array_CSV.length == 0){
    alert("Cotizacion CSV - requerido");
    bandera = false;
  }else if(array_CSV.length > 1){
    alert("Cotizacion CSV - Por favor adjunte solo un archivo");
    bandera = false;
  }

  const nombresArchivos_2 = [];
  $.each(array_CSV, function( index, value ) {

    nombreArchivo_CSV = $(value).html();

    if(nombreArchivo_CSV != '' && typeof nombreArchivo_CSV !== 'undefined'){
      var pizza = nombreArchivo_CSV.toString().trim().split('.');
      var ext = pizza[pizza.length - 1];
      if(ext != "csv" && ext != "CSV"){
        alert("Cotizacion CSV - debe ser un archivo .csv");
        bandera = false;
      }
    }

    //verificar repetidos
    if(jQuery.inArray(nombreArchivo_CSV, nombresArchivos_2) !== -1){
      alert("Archivos CSV repetidos");
      bandera = false;
    }
    nombresArchivos_2.push(nombreArchivo_CSV);

  });

  return bandera;
});