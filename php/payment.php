<?php
require_once('./DAO/Account.php');
require_once('./DTO/AccountDTO.php');
require_once('./DAO/Address.php');
require_once('./DTO/AddressDTO.php');
//error_reporting(E_ALL ^ E_NOTICE);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$idAccount = $_SESSION['idAccount'];
if ($idAccount == null || $idAccount == -1)
    header("Location:login.php");
else {
    $account = new Account();
    $account = AccountDTO::getInstance()->GetAccount($idAccount);
    $coin = $account->GetCoin();
    $address = AddressDTO::getInstance()->GetAddress($account->GetLastIdAddress());
    if ($address != null) {
        $fullName = $address->GetFullName();
        $phoneNumber = $address->GetPhoneNumber();
        $city = $address->GetLevel1();
        $district = $address->GetLevel2();
        $ward = $address->GetLevel3();
        $detail = $address->GetDetail();
    }
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
    <link rel="stylesheet" href="../assets/css/payment.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Đặt hàng</title>
</head>

<body style="background-color: var(--background-gray-color)">
    <?php include("./View/Header.php"); ?>
    <div class="body">
        <div class="grid block" style="padding-bottom: 20px; margin-bottom: 40px;">
            <h1 class="block__title">XÁC NHẬN ĐẶT HÀNG</h1>
            <div class="cart__container">
                <div class="cart__heading">
                    <p class="cart__heading-name" style="width: 40%; text-align: center;">Sản Phẩm</p>
                    <p class="cart__heading-name" style="width: 20%; text-align: center;">Phân loại</p>
                    <p class="cart__heading-name" style="width: 15%; text-align: center;">Đơn Giá</p>
                    <p class="cart__heading-name" style="width: 10%; text-align: center;">Số Lượng</p>
                    <p class="cart__heading-name" style="width: 15%; text-align: center;">Thành Tiền</p>
                </div>
                <?php include("./View/productInPayMent.php") ?>
                <table style="margin-left: auto; margin-right: 0;">
                    <tr>
                        <td>
                            <div class="use-cent">
                                <input type="checkbox" name="" id="applyCoin" style="width: 20px; height: 20px; cursor: pointer; transform: translateY(-2px);">
                                <p class="use-cent__text">Sử dụng Xu để giảm giá</p>
                            </div>
                        </td>
                        <td>
                            <input type="number" name="" id="coin" class="use-cent__input" placeholder="Nhập số Xu" max="<?php echo $coin ?>" min="0" value="0">
                            <button class="use-cent__button" id="btApply">Áp dụng</button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <p style="font-size: 1.4rem; font-weight:500; color: var(--text-color); text-align: left; margin-left: 30px; opacity: 0.8; margin-top: 5px;">
                                Số dư Xu:<span id="maxCoin"><?php echo $coin ?></span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="order-total">Tổng tiền hàng:</p>
                        </td>
                        <td>
                            <p class="order-total money-column" id="total"><?php echo number_format($totalAll); ?> VNĐ</p>
                            <p class="order-total money-column" style="display:none" id="hiddenDefaultPrice"><?php echo $totalAll; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="order-total">Giảm giá:</p>
                        </td>
                        <td>
                            <p class="order-total money-column" name="discount" id="discount">0 VNĐ</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="order-total">Thành tiền:</p>
                        </td>
                        <td>
                            <p class="order-total money-column" id="intoMoney"><?php echo number_format($totalAll); ?> VNĐ</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="payment__info-container">
                <h1 class="payment__title">ĐỊA CHỈ NHẬN HÀNG</h1>
                <input type="hidden" name="hiddenFullName" id="hiddenFullName" value="<?php echo $fullName ?>">
                <input type="hidden" name="hiddenPhoneNumber" id="hiddenPhoneNumber" value="<?php echo $phoneNumber ?>">
                <input type="hidden" name="hiddenCity" id="hiddenCity" value="<?php echo $city ?>">
                <input type="hidden" name="hiddenDistrict" id="hiddenDistrict" value="<?php echo $district ?>">
                <input type="hidden" name="hiddenWard" id="hiddenWard" value="<?php echo $ward ?>">
                <input type="hidden" name="hiddenDetail" id="hiddenDetail" value="<?php echo $detail ?>">
                <form action="./GetPaymentValue.php" method="POST" class="payment__info-wrapper">
                    <?php
                    $realCount = 0;
                    for ($i = 0; $i < $_GET['countProduct']; $i++) {
                        $id = $i + 1;
                        if ($_GET['tick' . $id] == "on") {
                            $realCount++;
                            $idProduct = $_GET['id' . $id];
                            $countProduct = $_GET['count' . $id];
                            $color = $_GET['color' . $id];
                    ?>
                            <input type="hidden" name="id<?php echo $realCount; ?>" value="<?php echo $idProduct ?>">
                            <input type="hidden" name="count<?php echo $realCount; ?>" value="<?php echo $countProduct ?>">
                            <input type="hidden" name="color<?php echo $realCount; ?>" value="<?php echo $color ?>">
                    <?php
                        }
                    }
                    ?>
                    <input type="hidden" name="hiddenCountShop" id="hiddenCountShop" value="<?php echo count($arrayShop) ?>">
                    <input type="hidden" name="hiddenCountProduct" value="<?php echo $realCount ?>">
                    <input type="hidden" name="hiddenTotalPrice" id="hiddenTotalPrice" value="<?php echo $totalAll ?>">
                    <input type="hidden" name="hiddenDiscount" id="hiddenDiscount" value="0">
                    <input class="payment__input-text" type="text" name="fullName" id="" placeholder="Họ và tên" value="<?php echo $fullName ?>" required>
                    <input class="payment__input-text" type="text" name="phoneNumber" id="" placeholder="Số điện thoại" value="<?php echo $phoneNumber ?>" required>
                    <select class="payment__select" id="city" name="city" required>
                        <option>Chọn tỉnh / thành phố</option>
                    </select>
                    <select class="payment__select" id="district" name="district" required>
                        <option>Chọn quận / huyện</option>
                    </select>
                    <select class="payment__select" id="ward" name="ward" required>
                        <option>Chọn phường / xã</option>
                    </select>
                    <input class="payment__input-text" type="text" name="street" id="" placeholder="Số nhà, tên đường" value="<?php echo $detail ?>" required>
                    <div class="payment__buttons-wrapper">
                        <input class="payment__button" type="submit" value="Xác nhận đặt hàng">
                        <a href="./cart.php">
                            <button type="button" class="payment__button" style="background-color: var(--red-color);">
                                <i class="fa-solid fa-reply" style="margin-right: 3px;"></i>
                                Quay lại Giỏ hàng
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php include("./View/Footer.php") ?>
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="../assets/js/AddressPayment3.js"></script>
    <script src="../assets/js/payment3.js"></script>
    </script>
</body>

</html>