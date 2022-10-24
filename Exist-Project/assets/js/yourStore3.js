const hiddenTypeSort = document.querySelector("#hiddenTypeSort");
const hiddenMinPrice = document.querySelector("#hiddenMinPrice");
const hiddenMaxPrice = document.querySelector("#hiddenMaxPrice");
const hiddenMinCountSold = document.querySelector("#hiddenMinCountSold");
const hiddenMinCountStar = document.querySelector("#hiddenMinCountStar");


function ChangeTypeSort(typeSort) {
    hiddenTypeSort.value = typeSort;
    Search(1);
}
function ChangeTypeSortPrice(selected) {
    hiddenTypeSort.value = selected.value;
    Search(1);
}
function ChangeMinCountSold(value) {
    hiddenMinCountSold.value = value;
    Search(1);
}

function CheckedCount() {
    switch (hiddenMinCountSold.value) {
        case "0":
            document.querySelector("#countSold1").checked = true;
            break;
        case "100":
            document.querySelector("#countSold2").checked = true;
            break;
        case "200":
            document.querySelector("#countSold3").checked = true;
            break;
        case "300":
            document.querySelector("#countSold4").checked = true;
            break;
        case "500":
            document.querySelector("#countSold5").checked = true;
            break;
        case "1000":
            document.querySelector("#countSold6").checked = true;
            break;
        case "3000":
            document.querySelector("#countSold7").checked = true;
            break;
    }
}
CheckedCount();
function ChangeMinCountStar(minCountStart) {
    hiddenMinCountStar.value = minCountStart;
    Search(1);
}
function CheckStar() {
    if (document.querySelector("#star" + hiddenMinCountStar.value) != null)
        document.querySelector("#star" + hiddenMinCountStar.value).style = "background-color:var(--background-gray-color)";
}
CheckStar();
function ChangePrice() {
    var value = document.querySelector('input[name="price-base"]:checked').value;
    switch (value) {
        case "0":
            hiddenMinPrice.value = 0;
            hiddenMaxPrice.value = 99999999999;
            break;
        case "1":
            hiddenMinPrice.value = 0;
            hiddenMaxPrice.value = 200000;
            break;
        case "2":
            hiddenMinPrice.value = 200000;
            hiddenMaxPrice.value = 500000;
            break;
        case "3":
            hiddenMinPrice.value = 500000;
            hiddenMaxPrice.value = 1000000;
            break;
        case "4":
            hiddenMinPrice.value = 1000000;
            hiddenMaxPrice.value = 5000000;
            break;
        case "5":
            hiddenMinPrice.value = 5000000;
            hiddenMaxPrice.value = 99999999999;
            break;
        case "6":
            const min = document.querySelector("#min");
            const max = document.querySelector("#max");
            if (min.value > max.value) {
                min.style = "border-top: 1px solid red";
                max.style = "border-top: 1px solid red";
                return;
            } else {
                hiddenMinPrice.value = min.value;
                hiddenMaxPrice.value = max.value;
            }
            break;
    }
    Search(1);
}
function CheckPrice() {
    var min = hiddenMinPrice.value;
    var max = hiddenMaxPrice.value;
    var index;
    if (min == "0" && max == "99999999999") {
        index = 0;
    } else
        if (min == "0" && max == "200000") {
            index = 1;
        } else
            if (min == "200000" && max == "500000") {
                index = 2;
            } else
                if (min == "500000" && max == "1000000") {
                    index = 3;
                } else
                    if (min == "1000000" && max == "5000000") {
                        index = 4;
                    } else
                        if (min == "5000000" && max == "99999999999") {
                            index = 5;
                        } else {
                            index = 6;
                            document.querySelector("#min").value = min;
                            document.querySelector("#max").value = max;
                        }
    document.querySelector("#price" + index).checked = true;
}
CheckPrice();

function Search(numberPage) {
    //  alert("test");
    var typeSort = "typeSort=" + hiddenTypeSort.value;
    var minPrice = "minPrice=" + hiddenMinPrice.value;
    var maxPrice = "maxPrice=" + hiddenMaxPrice.value;
    var minCountSold = "minCountSold=" + hiddenMinCountSold.value;
    var minCountStar = "minCountStar=" + hiddenMinCountStar.value;
    var numberPage = "page-number=" + numberPage;

    var get = "?" + typeSort + "&" + minPrice + "&" + maxPrice + "&" + minCountSold + "&" + minCountStar + "&" + numberPage;
    //alert(get);
    window.location = get;
}
