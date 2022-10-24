
const btApply = document.querySelector('#btApply');
const coin = document.querySelector('#coin');
const maxCoin = document.querySelector('#maxCoin');
const applyCoin = document.querySelector('#applyCoin');
const discount = document.querySelector('#discount');
const total = document.querySelector('#total');
const intoMoney = document.querySelector('#intoMoney');

const hiddenTotalPrice = document.querySelector('#hiddenTotalPrice');
const hiddenDiscount = document.querySelector('#hiddenDiscount');
const hiddenCountShop = document.querySelector('#hiddenCountShop');
const hiddenDefaultPrice = document.querySelector('#hiddenDefaultPrice');
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
                intoMoney.innerHTML.toLocaleString('vi-VN');

                intoMoney.innerHTML += " VNĐ";
                total.innerHTML += "VNĐ";
                discount.innerHTML += " VNĐ";
            }
        } else {
            discount.innerHTML = "0 VNĐ";
            intoMoney.innerHTML = total.innerHTML;
        }
        hiddenTotalPrice.value = intoMoney.innerHTML;
        hiddenDiscount.value = discount.innerHTML;
    }
})

const hiddenCity = document.querySelector('#hiddenCity');
const hiddenDistrict = document.querySelector('#hiddenDistrict');
const hiddenWard = document.querySelector('#hiddenWard');


citis.addEventListener('change', () => {
    alert('change');
})
