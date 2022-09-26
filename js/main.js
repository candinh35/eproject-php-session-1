var i = 1;
for (var a in qtyplus) {
    qtyplus[a].addEventListener('click', function() {
        for (var index in quantity) {
            i = quantity[index].value;
            i++;
            quantity[index].value = i;
            console.log(quantity[index])
            console.log(i)
        }
    })
}
for (var j = 0; j < qtyminus.length; j++) {
    console.log(qtyminus[j])
    qtyminus[j].addEventListener('click', function() {
        for (var index1 in quantity) {
            i = quantity[index1].value;
            i--;
            if (i > 0) {
                quantity[index1].value = i;
                console.log(qtyminus[j])
                console.log(quantity[index1].value)
                break
            } else {
                i = 1
            }
        }
    })
}