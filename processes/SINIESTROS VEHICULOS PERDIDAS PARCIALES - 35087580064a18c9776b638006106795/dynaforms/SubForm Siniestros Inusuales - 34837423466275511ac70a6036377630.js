//Siniestros inusuales


function checkInusual(newVal, oldVal){

    /*file_siniestroInusual_fiscalia
    file_siniestroInusual_judicatura
    file_siniestroInusual_super
    sub_siniestroInusual_causal
    frm_siniestroInusual_categoria
    frm_siniestroInusual_observaciones*/

    $("#file_siniestroInusual_fiscalia").hide();
    $("#file_siniestroInusual_judicatura").hide();
    $("#file_siniestroInusual_super").hide();
    $("#sub_siniestroInusual_causal").hide();
    $("#frm_siniestroInusual_categoria").hide();
    $("#frm_siniestroInusual_observaciones").hide();

    $("#file_siniestroInusual_fiscalia").disableValidation();
    $("#file_siniestroInusual_judicatura").disableValidation();
    $("#file_siniestroInusual_super").disableValidation();
    $("#sub_siniestroInusual_causal").disableValidation();
    $("#frm_siniestroInusual_categoria").disableValidation();
    $("#frm_siniestroInusual_observaciones").disableValidation();

    if(newVal == '1'){
        $("#file_siniestroInusual_fiscalia").show();
        $("#file_siniestroInusual_judicatura").show();
        $("#file_siniestroInusual_super").show();
        $("#sub_siniestroInusual_causal").show();
        $("#frm_siniestroInusual_categoria").show();
        $("#frm_siniestroInusual_observaciones").show();

        $("#file_siniestroInusual_fiscalia").enableValidation();
        $("#file_siniestroInusual_judicatura").enableValidation();
        $("#file_siniestroInusual_super").enableValidation();
        $("#sub_siniestroInusual_causal").enableValidation();
        $("#frm_siniestroInusual_categoria").enableValidation();
        $("#frm_siniestroInusual_observaciones").enableValidation();

        //if bandera_inusual == 1, disable sub_siniestroInusual_causal
        let bandera_inusual = $("#frm_tri_bandera_inusual").getValue();
        if(bandera_inusual == '1'){
            $("#sub_siniestroInusual_causal").getControl().attr('disabled', true);
        } else {
            $("#sub_siniestroInusual_causal").getControl().attr('disabled', false);
        }
    
    }

}
checkInusual($("#frm_siniestroInusual_check").getValue(), ''); 
$('#frm_siniestroInusual_check').setOnchange(checkInusual);

let bandera_inusual = $("#frm_tri_bandera_inusual").getValue();
if(bandera_inusual == '1'){
    //disable frm_siniestroInusual_check
    $("#frm_siniestroInusual_check").getControl().attr('disabled', true);

} else {
    //enable frm_siniestroInusual_check
    $("#frm_siniestroInusual_check").getControl().attr('disabled', false);
}