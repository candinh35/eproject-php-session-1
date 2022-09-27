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



document.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector('.header')
        //Truy xuất div menu
    var trangthai = "300";
    window.addEventListener("scroll", function() {
        var x = pageYOffset;
        if (x > 300) {
            if (trangthai == "300") {
                trangthai = "301";
                header.classList.add('open');
            }
        } else {
            if (trangthai == "301") {
                header.classList.remove('open');
                trangthai = "300";
            }
        }

    })
})