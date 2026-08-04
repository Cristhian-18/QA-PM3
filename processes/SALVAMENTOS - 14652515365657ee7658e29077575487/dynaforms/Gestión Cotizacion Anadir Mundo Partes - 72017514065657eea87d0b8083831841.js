function checkGrid(newVal, oldVal){
    let rowNum = 0;
    rowNum = $("#grd_valores_siniestros").getNumberRows();
    console.log(rowNum);
    for (let i = 1; i <= rowNum; i++) {
        let pvp = $("#grd_valores_siniestros").getValue(i,4);
        pvp = roundToFixed(pvp, 2);
        $("#grd_valores_siniestros").setValue(pvp,i,4);

        let dias_entrega = $("#grd_valores_siniestros").getValue(i,5);
        dias_entrega = roundToFixed(dias_entrega, 0);
        $("#grd_valores_siniestros").setValue(dias_entrega,i,5);
    }
}

checkGrid($("#grd_valores_siniestros").getValue(), '');
$('#grd_valores_siniestros').change(checkGrid);
