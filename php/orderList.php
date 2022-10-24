<?php
require_once('./DAO/Account.php');
require_once('./DTO/AccountDTO.php');
require_once('./DAO/Bill.php');
require_once('./DTO/BillDTO.php');
require_once('./DAO/DetailBill.php');
require_once('./DTO/DetailBillDTO.php');
require_once('./DAO/Address.php');
require_once('./DTO/AddressDTO.php');
require_once('./DAO/ProductInBill.php');
require_once('./DTO/ProductInBillDTO.php');
require_once('./DAO/ProductInCart.php');
require_once('./DTO/ProductInCartDTO.php');
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
error_reporting(E_ALL ^ E_NOTICE);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$idAccount = $_SESSION['idAccount'];
if ($idAccount == null || $idAccount == -1)
    header("Location:login.php");
else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="stylesheet" href="../assets/css/orderList.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Danh sách Đơn mua</title>
</head>

<body style="background-color: var(--background-gray-color)">
    <?php include("./View/Header.php") ?>
    <div class="body">
        <div class="grid block" style="padding-bottom: 10px; margin-bottom: 40px">
            <h1 class="block__title">DANH SÁCH ĐƠN MUA</h1>
            <div class="order-list-container">
                <div class="order-list__filter">
                    <p class="order-list__label">Bộ lọc:</p>
                    <select class="order-list__select" id="slTime">
                        <option value="Thời gian" disabled selected>Thời gian</option>
                        <option value="Tất cả">Tất cả</option>
                        <option value="Hôm nay">Hôm nay</option>
                        <option value="Tuần này">Tuần này</option>
                        <option value="Tháng này">Tháng này</option>
                        <option value="Năm này">Năm này</option>
                    </select>
                    <select class="order-list__select" id="slState">
                        <option value="Tình trạng đơn hàng" disabled selected>Tình trạng đơn hàng</option>
                        <option value="Tất cả">Tất cả</option>
                        <option value="Đang chờ xác nhận">Đang chờ xác nhận</option>
                        <option value="Đang giao hàng">Đang giao hàng</option>
                        <option value="Đã giao hàng">Đã giao hàng</option>
                        <option value="Đã hủy">Đã huỷ</option>
                    </select>
                    <?php
                    if (isset($_GET['time']))
                        $hiddenTime = $_GET['time'];
                    if (isset($_GET['state']))
                        $hiddenState = $_GET['state']; ?>
                    <input type="hidden" name="hiddenTime" id="hiddenTime" value="<?php echo $hiddenTime ?>"></input>

                    <input type="hidden" name="hiddenState" id="hiddenState" value="<?php echo $hiddenState ?>"></input>
                    <button class="order-list__filter-button" id="btFill"><i class="fa-solid fa-filter" style="margin-right: 5px;"></i>Lọc</button>
                </div>
                <div class="order-list">
                    <div class="order-list__heading">
                        <p style="width: 30%; text-align: center;">Sản phẩm</p>
                        <p style="width: 15%; text-align: center;">Phân loại</p>
                        <p style="width: 10%; text-align: center;">Số lượng</p>
                        <p style="width: 15%; text-align: center;">Ngày đặt hàng</p>
                        <p style="width: 15%; text-align: center;">Tổng thanh toán</p>
                        <p style="width: 15%; text-align: center;">Tình trạng đơn hàng</p>
                    </div>
                    <?php include("./View/BillInOrderList.php") ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("./View/Footer.php") ?>
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
    <script src="../assets/js/orderList.js"></script>
    <script>
        var time = document.getElementById('hiddenTime').value;

        for (var i, j = 0; i = slTime.options[j]; j++) {
            if (i.value == time) {
                slTime.selectedIndex = j;
                break;
            }
        }
        var state = document.getElementById('hiddenState').value;

        for (var i, j = 0; i = slState.options[j]; j++) {
            if (i.value == state) {
                slState.selectedIndex = j;
                break;
            }
        }
    </script>
</body>

</html>