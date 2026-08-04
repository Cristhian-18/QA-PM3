//$('#3662047915f238f68a7fa92019816378').toggle();

$("#8825188155f482dee871e01077011907").setOnSubmit(function(){
  $("#8825188155f482dee871e01077011907").saveForm() ;
  return showConfirmDlg();
});

$("#btn_financiera_save").find("button").on("click" , function() {
  $("#8825188155f482dee871e01077011907").saveForm();
  alert ("Formulario guardado ...");  
});
