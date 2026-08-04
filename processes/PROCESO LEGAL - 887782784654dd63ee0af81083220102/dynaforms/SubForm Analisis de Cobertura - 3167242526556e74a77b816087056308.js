console.log($("#frm_taller").getValue());
console.log("SHOW1");

if($("#frm_taller").getValue() == 'MUNDO MOTRIZ SA'){
  console.log("SI");
  $("#frm_analisisCobertura_analisisTecnico").setValue('NO');
} else {
    console.log("NO");

  $("#frm_analisisCobertura_analisisTecnico").setValue('SI');
}