<?php
require_once('./DAO/Account.php');
require_once('./DTO/AccountDTO.php');
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Giỏ hàng</title>
</head>

<body style="background-color: var(--background-gray-color)">
    <input type="hidden" name="idAccount" id="idAccount" value="<?php echo $idAccount ?>">
    <?php include("./View/Header.php"); ?>
    <div class="body">
        <form method="GET" action="payment.php" onsubmit="return CheckCountProduct()">
            <?php include("./View/ProductAndCart.php"); ?>
            <div class="payment-bar grid">
                <div style="display: flex; align-items: center;">
                    <input class="payment-bar__checkbox" type="checkbox" name="" id="tickAll">
                    <p class="payment-bar__text">Chọn tất cả</p>
                </div>
                <p class="payment-bar__text-total">Tổng thanh toán:</p>
                <p id="total" style="color:red" class="payment-bar__text-total">0 VNĐ</p>
                <div style="display: flex; align-items: center;">
                    <button class="payment-bar__button" id="btPay">
                        <lord-icon src="https://cdn.lordicon.com/hjeefwhm.json" trigger="loop" colors="primary:#ffffff" delay="2000" style="width:25px;height:25px; margin-right: 2px;">
                        </lord-icon>
                        Thanh Toán
                    </button>
                    <button id="btDeleteAll" class="payment-bar__button payment-bar__button-2" style="background-color: var(--red-color);">
                        <lord-icon src="https://cdn.lordicon.com/dovoajyj.json" trigger="loop" colors="primary:#ffffff" delay="2000" style="width:25px;height:25px; margin-right: 2px;">
                        </lord-icon>
                        Xoá
                    </button>
                </div>
            </div>
        </form>
        <?php include("./View/Footer.php") ?>
        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
        <script src="../assets/js/productAndCart2.js"></script>
</body>

</html>