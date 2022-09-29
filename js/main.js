const qtyminus = document.querySelectorAll('.qtyminus')
const qtyplus = document.querySelectorAll('.qtyplus')
const i = 1;

for (let i = 0; i < qtyminus.length; i++) {
    const btnMinus = qtyminus[i];
    const btnPlus = qtyplus[i];
    btnMinus.addEventListener('click', function(event) {
        const quantity = event.target.nextElementSibling;
        i = quantity.value;
        i--;
        if (i > 0) {
            quantity.value = i;
        } else {
            i = 1
        }
    })
    btnPlus.addEventListener('click', function(event) {
        const quantity = event.target.previousElementSibling;

        i = quantity.value;
        i++;
        quantity.value = i;
    })
}

// search
const modal = document.querySelector('.modal-click');
const search = document.querySelector('#form-search');
const searchBox = document.querySelector('.product_search');


search.addEventListener('click', function() {
    search.classList.toggle('product1');
});

modal.addEventListener('click', function() {
    search.classList.remove('product1')
})

searchBox.addEventListener('click', function(e) {
    e.stopPropagation();
})