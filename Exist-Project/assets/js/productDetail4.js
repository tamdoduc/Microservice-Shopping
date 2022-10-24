
const buttonPreImage = document.querySelector("#buttonPreImage");
const buttonNextImage = document.querySelector("#buttonNextImage");
const countImage = document.querySelector("#countImage");
const imageProduct = document.querySelector("#imageProduct");
const btAddToCart = document.querySelector("#btAddToCart");
const btAddToWish = document.querySelector("#btAddToWish");
const count = document.querySelector("#count");
const color = document.querySelector("#color");
const idProduct = document.querySelector("#idProduct");
const idAccount = document.querySelector("#idAccount");

buttonPreImage.addEventListener("click", () => {
    let index = document.querySelector("#indexImage");
    if (parseInt(index.innerHTML) <= 1) {
        return;
    } else {
        index.innerHTML = parseInt(index.innerHTML) - 1;
        const indexImage = document.querySelector("#image" + index.innerHTML);
        imageProduct.setAttribute('src', indexImage.value);
    }
})
buttonNextImage.addEventListener("click", () => {
    let index = document.querySelector("#indexImage");
    if (parseInt(index.innerHTML) >= parseInt(countImage.innerHTML)) {
        return;
    } else {
        index.innerHTML = parseInt(index.innerHTML) + 1;
        const indexImage = document.querySelector("#image" + index.innerHTML);
        imageProduct.setAttribute('src', indexImage.value);
    }
})
btAddToCart.addEventListener("click", () => {
    var str = "";
    str += "?idProduct=" + idProduct.value + "&" + "idAccount=" + idAccount.value + "&" + "count=" + count.value + "&" + "color=" + color.value;
    //alert(str);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            //alert(result);
            if (result == "false") {
                alert('Không thể thêm sản phẩm vào giỏ hàng');
            } else {
                alert('Đã thêm sản phẩm vào giỏ hàng');
            }
        }
    };
    xmlhttp.open("GET", "AddToCart.php" + str, true);
    xmlhttp.send();
})
btAddToWish.addEventListener("click", () => {
    var str = "";
    str += "?idProduct=" + idProduct.value + "&" + "idAccount=" + idAccount.value + "&" + "color=" + color.value;
    //alert(str);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            if (result != "true")
                alert("Không thể thêm sản phẩm vào mục yêu thích");
            else
                alert("Đã thêm sản phẩm vào mục yêu thích");
        }
    };
    xmlhttp.open("GET", "AddToWishList.php" + str, true);
    xmlhttp.send();
})

function SearchType(type) {
    window.location = "../php/catalog.php?searchValue=" + type;
}

function LoadComment(pn) {
    var str = "";
    str += "?idProduct=" + idProduct.value + "&" + "page-number=" + pn;
    window.location = str;
}