
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
function FixProduct(){
    if (parseInt(countSold.innerHTML)>0)
        alert('Không thể sửa sản phẩm đã bán')
    else
    {
        window.location = "fixProduct.php?idProduct="+id;
    }
}
function DeleteProduct(){
    alert("test");
    return false;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                result = this.responseText;
                if (result=="true") {
                    alert('Không thể xóa sản phẩm đã bán');
                } else
                {
                   // window.location = "deleteProduct.php?idProduct="+id;
                }
            }
        };
        xmlhttp.open("GET", "confirmOrder.php?idProduct=" + id, true);
        xmlhttp.send();
}