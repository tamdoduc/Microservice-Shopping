
const countProduct = document.querySelector("#countProduct");
const total = document.querySelector("#total");
const tickAll = document.querySelector("#tickAll");

var typeButton = " ";

for (let i = 0; i < countProduct.value; i++) {

    const id = i + 1;
    const product = document.querySelector("#product" + id);
    const price = product.querySelector("#price");
    const countProduct = product.querySelector("#countProduct");
    const tick = product.querySelector("#tick"+id);
    const totalPriceProduct = product.querySelector("#totalPriceProduct");
    countProduct.addEventListener("input", () => {
        totalPriceProduct.innerHTML = (countProduct.value * price.innerHTML.slice(0, -3)) + " VNĐ";
        LoadTotal();
    })
    tick.onchange = function () {
        if (tick.checked == false)
            tickAll.checked = false;
        LoadTotal();
    }
}
tickAll.onchange = function () {
    if (tickAll.checked == true)
        for (let i = 0; i < countProduct.value; i++) {

            const id = i + 1;
            const product = document.querySelector("#product" + id);
            const tick = product.querySelector("#tick"+id);
            tick.checked = tickAll.checked;
        }
    LoadTotal();
}

function LoadTotal() {
    let t = 0;
    for (let i = 0; i < countProduct.value; i++) {
        const id = i + 1;
        const product = document.querySelector("#product" + id);
        const totalPriceProduct = product.querySelector("#totalPriceProduct");
        const tick = product.querySelector("#tick"+id);
        if (tick.checked) {
            t += parseInt((totalPriceProduct.innerHTML.slice(0, -3)));
        }

    }
    total.innerHTML = t + " VNĐ";
}
function CheckCountProduct() {
    if (typeButton == "btPay") {
        for (let i = 0; i < countProduct.value; i++) {
            const id = i + 1;
            const product = document.querySelector("#product" + id);
            const tick = product.querySelector("#tick"+id);
            if (tick.checked) {
                return true;
            }
        }
    }
    return false;
}
const idAccount = document.querySelector("#idAccount");
function DeleteProductInCart(i) {
    const idProduct = document.querySelector("#idProduct" + i);
    const color = document.querySelector('#color' + i);
    var str = "";
    str += "?count=1&idProduct=" + idProduct.value + "&" + "idAccount=" + idAccount.value + "&" + "color=" + color.value;
    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            if (result != "true")
                alert("Chưa xóa được");
            else {
                const product = document.querySelector('#product' + i);
                product.style.display = "none";
                const tick = document.querySelector('#tick' + i);
                tick.checked=false;
                
                LoadTotal();
            }
        }
    };
    xmlhttp2.open("GET", "DeleteProductInCart.php" + str, true);
    xmlhttp2.send();
}
function DeleteAllProduct() {
    typeButton = "delete";
    for (let i = 0; i < countProduct.value; i++) {
        const id = i + 1;
        const product = document.querySelector("#product" + id);
        const tick = product.querySelector("#tick" + id);
        if (tick.checked) {
            DeleteProductInCart(id);
        }
    }
}
const btDeleteAll = document.querySelector('#btDeleteAll');
btDeleteAll.addEventListener('click', DeleteAllProduct);

const btPay = document.querySelector('#btPay');
btPay.addEventListener('click',()=>{
    typeButton = "btPay";
})
