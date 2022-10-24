
const buttonPreImage = document.querySelector("#buttonPreImage");
const buttonNextImage = document.querySelector("#buttonNextImage");
const countImage = document.querySelector("#countImage");
const imageProduct = document.querySelector("#imageProduct");
const hiddenURL = document.querySelector("#hiddenURL");
const typeButton = document.querySelector("#typeButton");
const btAddToCart = document.querySelector("#btAddToCart");
const btAddToWish = document.querySelector("#btAddToWish");

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
const countSold = document.querySelector("#countSold");
const idProduct = document.querySelector("#idProduct");
var id = idProduct.value;
function FixProduct() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            if (result == "false") {
                alert('Không thể sửa sản phẩm đã bán');
            } else {
                //alert("Được xóa");
                 window.location = "fixProduct.php?idProduct="+id;
            }
        }
    };
    xmlhttp.open("GET", "CheckFixDeleteProduct.php?idProduct=" + id, true);
    xmlhttp.send();
}
function DeleteProduct() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            if (result == "false") {
                alert('Không thể sửa sản phẩm đã bán');
            } else {
                alert("Xóa thành công");
                 window.location = "deleteProduct.php?idProduct="+id;
            }
        }
    };
    xmlhttp.open("GET", "CheckFixDeleteProduct.php?idProduct=" + id, true);
    xmlhttp.send();
}
function LoadComment(pn) {
    var str = "";
    str += "?idProduct=" + idProduct.value + "&" + "page-number=" + pn;
    window.location = str;
}