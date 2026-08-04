function checkGrid(newVal, oldVal){
    let rowNum = 0;
    rowNum = $("#grd_valores_siniestros_alcance").getNumberRows();
    console.log(rowNum);
    for (let i = 1; i <= rowNum; i++) {
        let pvp = $("#grd_valores_siniestros_alcance").getValue(i,5);
        pvp = roundToFixed(pvp, 2);
        $("#grd_valores_siniestros_alcance").setValue(pvp,i,5);

        let dias_entrega = $("#grd_valores_siniestros_alcance").getValue(i,6);
        dias_entrega = roundToFixed(dias_entrega, 0);
        $("#grd_valores_siniestros_alcance").setValue(dias_entrega,i,6);
    }
}

checkGrid($("#grd_valores_siniestros_alcance").getValue(), '');
$('#grd_valores_siniestros_alcance').change(checkGrid);
