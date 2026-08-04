
/* original henry
var id_op = $("#html_op").html('Id Stro - '+$("#tri_id_stro").getValue()+' | '+'Nro Stro - '+$("#tri_nro_stro").getValue());
*/

/*$("#tri_id_stro").setValue("12345");
$("#tri_nro_stro").setValue("9863");*/

if ($("#tri_id_stro").getValue() == null || $("#tri_id_stro").getValue() == "") {
    $("#id-stro").html('' + $("#nro_stro").getValue());
} else {
    $("#id-stro").html('' + $("#tri_id_stro").getValue());

}



if ($("#tri_nro_stro").getValue() == null || $("#tri_nro_stro").getValue() == "" || $("#tri_nro_stro").getValue() == " - 2024") {
    $("#nro-stro").html('' + $("#nro_inspeccion").getValue() + $("#tri_nro_stro").getValue());
} else {
    $("#nro-stro").html('' + $("#tri_nro_stro").getValue() );
}
