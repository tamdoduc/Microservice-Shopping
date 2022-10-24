const btCancel = document.querySelector("#btCancel");

function CancelOrder() {
    
    var str = document.getElementById("idDetailBill").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                result = this.responseText;
                alert(result);
                if (result=="true") {
                    const state = document.querySelector("#state");
                    state.innerHTML= "Tình trạng đơn hàng: Đã hủy";
                    btCancel.style.display="none";
                    btContinue.style.display="none";
                }
            }
        };
        xmlhttp.open("GET", "cancelOrder.php?idDetailBill=" + str, true);
        xmlhttp.send();
    }
btCancel.addEventListener("click", CancelOrder)
const btConfirm = document.querySelector("#btConfirm");

function ConfirmOrder() {
    
    var str = document.getElementById("idDetailBill").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                result = this.responseText;
                if (result=="true") {
                    const state = document.querySelector("#state");
                    state.innerHTML= "Tình trạng đơn hàng: Đang giao hàng";
                    btCancel.style.display="none";
                    btConfirm.style.display="none";
                }
            }
        };
        xmlhttp.open("GET", "confirmOrder.php?idDetailBill=" + str, true);
        xmlhttp.send();
    }
btConfirm.addEventListener("click", ConfirmOrder)