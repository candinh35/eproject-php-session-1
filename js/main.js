var qtyminus = document.querySelector('.qtyminus')
var qtyplus = document.querySelector('.qtyplus')
var quantity = document.querySelector('.qty')
var i = 1;
qtyplus.addEventListener('click', function() {
    i = quantity.value;
    i++;
    quantity.value = i;
})


qtyminus.addEventListener('click', function() {
    i = quantity.value;
    i--;
    if (i > 0) {
        quantity.value = i;
    } else {
        i = 1
    }
})