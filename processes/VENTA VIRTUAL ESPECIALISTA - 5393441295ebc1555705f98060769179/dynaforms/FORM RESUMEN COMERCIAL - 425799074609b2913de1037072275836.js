$( ".pmdynaform-grid-title" ).removeClass( "pmdynaform-grid-title" );
//getFieldById("grd_especificos").$el.css("padding-bottom", "150px")

ocultar_todo();
$("#subtit_datos").show();
$("#25830987060590cf686aa76067215111").show();




$('.menu').on('click', function(){
  ocultar_todo();
  switch(this.id)
      {
    case 'solicitud' :
      $("#subtit_datos").show();

      $("#25830987060590cf686aa76067215111").show();
      break;

    case 'documentos' :
      $("#subtit_docs").show();
      $("#7232410255f4510e7ddb431040314312").show();
      $("#4134920295f9c8c87b37d96033269232").show();      
      break;

    case 'historial' :
      $("#subtit_cambios").show();      
      $("#subtit_commen").show();
      $("#3659092825f484ded40e690037283996").show();      
      $("#frm_accion").show();
      $("#frm_comentario").show();
      $("#btn_continuar").show();
      break;      
  }
});


function ocultar_todo(){
  $("#subtit_commen").hide();
  $("#3659092825f484ded40e690037283996").hide();
  $("#subtit_datos").hide();
  
  $("#25830987060590cf686aa76067215111").hide();
  $("#6479360225f976335c43157021199308").hide();
  $("#subtit_docs").hide();
  $("#7232410255f4510e7ddb431040314312").hide();
  $("#4134920295f9c8c87b37d96033269232").hide();        
  $("#subtit_cambios").hide();
  $("#frm_accion").hide();
  $("#frm_comentario").hide();
  $("#btn_continuar").hide();


}