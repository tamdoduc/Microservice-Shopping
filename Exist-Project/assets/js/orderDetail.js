const btCancel = document.querySelector("#btCancel");

function CancelOrder() {

    var str = document.getElementById("idDetailBill").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            if (result == "true") {
                const state = document.querySelector("#state");
                state.innerHTML = "Tình trạng đơn hàng: Đã hủy";
                btCancel.style.display = "none";
            }
        }
    };
    xmlhttp.open("GET", "cancelOrder.php?idDetailBill=" + str, true);
    xmlhttp.send();
}
btCancel.addEventListener("click", CancelOrder)

const btGetItem = document.querySelector("#btGetItem");

function GetItem() {

    var str = document.getElementById("idDetailBill").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            alert(result);
            if (result == "true") {
                const state = document.querySelector("#state");
                state.innerHTML = "Tình trạng đơn hàng: Đã giao hàng";
                btGetItem.style.display = "none";
                location.reload();
            }
        }
    };
    xmlhttp.open("GET", "ConfirmGetItem.php?idDetailBill=" + str, true);
    xmlhttp.send();
}
btGetItem.addEventListener("click", GetItem);

function GetItem() {
    var str = document.getElementById("idDetailBill").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            alert(result);
            if (result == "true") {
                const state = document.querySelector("#state");
                state.innerHTML = "Tình trạng đơn hàng: Đã giao hàng";
                btGetItem.style.display = "none";
                location.reload();
            }
        }
    };
    xmlhttp.open("GET", "ConfirmGetItem.php?idDetailBill=" + str, true);
    xmlhttp.send();
}
btGetItem.addEventListener("click", GetItem);

function SetStar(i) {
    const countStar = document.querySelector("#countStar");
    countStar.value =i;
}

const btSend = document.querySelector("#btSend");
const comment = document.querySelector("#comment");
const hiddenIdAccount = document.querySelector("#idAccount");
function SendEvalute( ) {
    alert("   sending");
    var sComment = comment.value;
    var sCountStar = countStar.value;
    var idProduct = hiddenIdProduct.value;
    var idAccount = hiddenIdAccount.value;
    var idBill = hiddenIdBill.value;
    if (sCountStar == "0")
    {
        alert("Chưa chọn số sao");
        return;
    }
    var str = "idAccount="+idAccount;
    str += "&idProduct="+idProduct;
    str += "&star="+sCountStar;
    str += "&comment="+sComment;
    str += "&idBill="+idBill;

    alert(str);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            result = this.responseText;
            location.reload();
        }
    };
    xmlhttp.open("GET", "CreateEvalute.php?" + str, true);
    xmlhttp.send();
}
btSend.addEventListener("click", SendEvalute);