//let  value = roundToFixed(value, 2);
let numberRows = $("#grd_cobertura").getNumberRows();

for (let i = 1; i <= numberRows; i++) {
    for (let j = 1; j <= 10; j++) {
        if (j == 7 || j == 9 || j == 10) {
            console.log(j);
            let value = $("#grd_cobertura").getValue(i, j);
            value = limitMaxMin(value, 9999999, -999999999);
            console.log(value);
            if (value != '') {
                value = roundToFixed(value, 2);
              }
            $("#grd_cobertura").setValue(value, i, j);
        }
    }

}