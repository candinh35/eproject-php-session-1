"use strict";

// tăng giảm số lượng sản phẩm
var quantity = document.querySelectorAll('.qty');
var qtyplus = document.querySelectorAll('.qtyplus');
var qtyminus = document.querySelectorAll('.qtyminus');
var i = 1;
console.log(qtyplus);
console.log(qtyminus);

for (var a in qtyplus) {
  qtyplus[a].addEventListener('click', function () {
    for (var index in quantity) {
      i = quantity[index].value;
      i++;
      quantity[index].value = i;
      console.log(1);
    }
  });

  var _loop = function _loop(j) {
    qtyminus[j].addEventListener('click', function () {
      for (var index1 in quantity) {
        i = quantity[index1].value;
        i--;

        if (i > 0) {
          quantity[index1].value = i;
          console.log(qtyminus[j]);
          console.log(quantity[index1].value);
          break;
        } else {
          i = 1;
        }
      }
    });
  };

  for (var j in qtyminus) {
    _loop(j);
  }
}