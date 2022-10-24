const btFill = document.querySelector('#btFill');
const hiddenTime = document.querySelector('#hiddenTime');
const hiddenState = document.querySelector('#hiddenState');

const slTime = document.querySelector('#slTime');
const slState = document.querySelector('#slState');

btFill.addEventListener('click', () => {
    if (slTime.value == "Thời gian" && slState.value == "Tình trạng đơn hàng")
        return;
    var str = "?time="+slTime.value + '&state=' + slState.value;
    window.location = str;
})