
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
        typeButton.value = "buttonPreImage";
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
        typeButton.value = "buttonNextImage";
    }
})
btAddToCart.addEventListener("click", () => {
    typeButton.value = "buttonAddToCart";
})
btAddToWish.addEventListener("click", () => {
    typeButton.value = "buttonAddToWishList";
})

function CheckButton() {
    switch (typeButton.value) {
        case "buttonPreImage":
        case "buttonNextImage":
            return false;
            break;
        case "buttonAddToCart":
            hiddenURL.value = "cart.php";
            return true;
            break;
        case "buttonAddToWishList":
            hiddenURL.value = "wishlist.php";
            return true;
            break;
        default:
            return false;
    }
}
function SearchType(type) 
{
    window.location = "../php/catalog.php?searchValue="+type;
}