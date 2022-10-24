
const countProduct = document.querySelector("#countProduct");
const tickAll = document.querySelector("#tickAll");

for (let i = 0; i < countProduct.value; i++) {

    const id = i + 1;
    const product = document.querySelector("#product" + id);
    const tick = product.querySelector("#tick"+id);
    tick.onchange = function () {
        if (tick.checked == false)
            tickAll.checked = false;
    }
}
tickAll.onchange = function () {
    if (tickAll.checked)
        for (let i = 0; i < countProduct.value; i++) {
            const id = i + 1;
            const product = document.querySelector("#product" + id);
            const tick = product.querySelector("#tick"+id);
            tick.checked = tickAll.checked;
        }
}
function CheckCountProduct() {
    for (let i = 0; i < countProduct.value; i++) {
        const id = i + 1;
        const product = document.querySelector("#product" + id);
        const tick = product.querySelector("#tick");
        if (tick.checked) {
            return true;
        }
    }
    return false;
}
const idAccount = document.querySelector("#idAccount");
function AddToCart(i) {
    const idProduct = document.querySelector("#idProduct" + i);
    const color = document.querySelector('#color' + i);
    var str = "";
    str += "?count=1&idProduct=" + idProduct.value + "&" + "idAccount=" + idAccount.value + "&" + "color=" + color.value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            if (result != "true")
                alert("Không thể thêm sản phẩm vào giỏ hàng");
            else
            {
                var xmlhttp2 = new XMLHttpRequest();
                xmlhttp2.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        result = this.responseText;
                        if (result != "true")
                            alert("Chưa xóa được");
                        else
                        {
                            const product = document.querySelector('#product'+i);
                            product.style.display = "none";
                        }
                    }
                };
                xmlhttp2.open("GET", "DeleteProductInWishList.php" + str, true);
                xmlhttp2.send();
                alert("Đã thêm sản phẩm vào giỏ hàng");
            }
        }
    };
    xmlhttp.open("GET", "AddToCart.php" + str, true);
    xmlhttp.send();
}
function AddAllToCart() {
    for (let i = 0; i < countProduct.value; i++) {
        const id = i + 1;
        const product = document.querySelector("#product" + id);
        const tick = product.querySelector("#tick"+id);
        if (tick.checked) {
            AddToCart(id);
        }
    }
}
const btAddAllToCart = document.querySelector('#btAddAllToCart');
btAddAllToCart.addEventListener('click', AddAllToCart);
function DeleteProductInWishList(i)
{
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
            else
            {
                const product = document.querySelector('#product'+i);
                product.style.display = "none";
            }
        }
    };
    xmlhttp2.open("GET", "DeleteProductInWishList.php" + str, true);
    xmlhttp2.send();
}
function DeleteAllProduct() {
    for (let i = 0; i < countProduct.value; i++) {
        const id = i + 1;
        const product = document.querySelector("#product" + id);
        const tick = product.querySelector("#tick"+id);
        if (tick.checked) {
            AddToCart(id);
        }
    }
}
const btDeleteAll = document.querySelector('#btDeleteAll');
btDeleteAll.addEventListener('click', DeleteAllProduct);
