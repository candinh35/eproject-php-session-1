
// tăng giảm số lượng sản phẩm

const quantity = document.querySelector('.qty');
const qtyplus = document.querySelector('.qtyplus');
const qtyminus = document.querySelector('.qtyminus');
var i = 1;
qtyplus.addEventListener('click', function() {
    i++
    quantity.value = i;
})
console.log(i);
qtyminus.addEventListener('click', function() {
    i--
    if (i > 0) {
        quantity.value = i;
    } else {
        i = 1
    }
})
