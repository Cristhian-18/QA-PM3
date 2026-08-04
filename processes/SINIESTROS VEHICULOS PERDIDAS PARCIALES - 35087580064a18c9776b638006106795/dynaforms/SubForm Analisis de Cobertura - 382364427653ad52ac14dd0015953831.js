 

if($("#frm_taller").getValue().includes('MUNDO MOTRIZ')){
  console.log("SI");
  $("#frm_analisisCobertura_analisisTecnico").setValue('NO');
} else {
  $("#frm_analisisCobertura_analisisTecnico").setValue('SI');
}