
var btApply = document.querySelector('#btApply');
var coin = document.querySelector('#coin');
var maxCoin = document.querySelector('#maxCoin');
var applyCoin = document.querySelector('#applyCoin');
var discount = document.querySelector('#discount');
var total = document.querySelector('#total');
var intoMoney = document.querySelector('#intoMoney');

var hiddenTotalPrice = document.querySelector('#hiddenTotalPrice');
var hiddenDiscount = document.querySelector('#hiddenDiscount');
var hiddenCountShop = document.querySelector('#hiddenCountShop');
var hiddenDefaultPrice = document.querySelector('#hiddenDefaultPrice');
btApply.addEventListener('click', () => {
    if (coin.value > parseInt(maxCoin.innerHTML)) {
        coin.style.border = '1px solid red';
    } else {
        if (applyCoin.checked) {
            if (coin.value > 0) {

                total.innerHTML = hiddenDefaultPrice.innerHTML;
                discount.innerHTML = coin.value * hiddenCountShop.value;
                let tmpMoney = parseInt(total.innerHTML) - coin.value * hiddenCountShop.value;
                if (tmpMoney < 0) {
                    coin.value = parseInt(total.innerHTML);
                    discount.innerHTML = tmpMoney;
                    tmpMoney = 0;
                }
                intoMoney.innerHTML = tmpMoney;
                intoMoney.innerHTML = parseInt(intoMoney.innerHTML).toLocaleString('vi-VN') + ' VNĐ';
                total.innerHTML = parseInt(total.innerHTML).toLocaleString('vi-VN') + ' VNĐ';
                discount.innerHTML += ' VNĐ';
            }
        } else {

            discount.innerHTML = "0 VNĐ";
            intoMoney.innerHTML = total.innerHTML;
        }
        hiddenTotalPrice.value = intoMoney.innerHTML;
        hiddenDiscount.value = discount.innerHTML;
    }
})

var hiddenCity = document.querySelector('#hiddenCity');
var hiddenDistrict = document.querySelector('#hiddenDistrict');
var hiddenWard = document.querySelector('#hiddenWard');


