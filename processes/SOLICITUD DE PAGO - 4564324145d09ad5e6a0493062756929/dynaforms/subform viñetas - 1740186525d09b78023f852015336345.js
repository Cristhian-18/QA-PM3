/**
 * Inicialización de estilos
 */
$('.panel').css("border","none");
$(".row").css("box-shadow", "none");
$(".panel").css("box-shadow", "none");
$('.pmdynaform-form').css("border","none");
$(".form-control").css("box-shadow", "none");
$(".pmdynaform-grid-row").css("border-bottom", "none");
$(".pmdynaform-label-options").css("text-align", "left");
$(".pmdynaform-grid-title").css("display", "none");

$('.menu').on('click', function(){
  ocultar_todo();
  switch(this.id)
      {
    case 'menu1' :
      $("#subtit_solicitante").show(); // solicitante
      $("#2103186295d09b1e15c6ea1035176468").show(); // detalle
      $("#subtit_requerimiento").show();
      $("#7953612365d09b9efcecfa7084181429").show();        
      $("#subtit_accion").show();  
      $('#frm_accion').show();  
      $('#frm_fecha_aprobacion').show();        
      $('#frm_comentario').show();        
      $('#btn_continuar').show();        
      $('#frm_chk_documento').show();        
      $("#subtit_prov").show();
      $("#8920896775d37d1cf470856076601548").show()      
      break;
    case 'menu2' :
      $('#subtit_historial').show();
      $('#5354114765d09b78de33941005151445').show();
      break;
  }
});

function ocultar_todo(){
  // SOLICITUD
  $('#subtit_prov').hide();
  $('#8920896775d37d1cf470856076601548').hide();
  $("#subtit_solicitante").hide();
  $("#2103186295d09b1e15c6ea1035176468").hide();
  $("#subtit_requerimiento").hide();
  $("#7953612365d09b9efcecfa7084181429").hide();  
  $("#subtit_accion").hide();
  $("#frm_accion").hide();  
  $("#frm_fecha_aprobacion").hide();  
  $('#frm_comentario').hide();
  $('#btn_continuar').hide();  
  $('#frm_chk_documento').hide();  
  $('#subtit_historial').hide();  
  $('#5354114765d09b78de33941005151445').hide();   
  $('#prod_tipo_compra').hide();

 
}


$( function(){
  $('.subtitulo').css( 'cursor', 'pointer' );
  $('.subtitulo').on('click', function(){
    id = this.id;
    subforms = $('#'+this.id).attr('subform').split('|');
    if( $('#'+id).children().attr('class') == 'glyphicon glyphicon-plus')
      $('#'+id).children().removeClass('glyphicon-plus').addClass('glyphicon-minus');
    else
      $('#'+id).children().removeClass('glyphicon-minus').addClass('glyphicon-plus');
    $.each( subforms , function( index, subform ) {
      $('#'+subform).toggle('slow');
    });
  })
});

