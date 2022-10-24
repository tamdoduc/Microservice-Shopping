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
    if ($_GET['idBill']) {
        $idBill = $_GET['idBill'];
        $bill = BillDTO::getInstance()->GetBill($idBill);
        $code = $bill->GetCode();
        $time = $bill->GetTime();
        $detailBill = DetailBillDTO::getInstance()->GetDetailBill($bill->GetIdDetailBill());
        $idDetailBill = $detailBill->GetId();
        $idAddress = $detailBill->GetIdAddress();
        $address = AddressDTO::getInstance()->GetAddress($idAddress);
        $fullName = $address->GetFullName();
        $phoneNumber = $address->GetPhoneNumber();
        $discount = $detailBill->GetDiscount();
        $totalPrice = $detailBill->GetTotalPrice();
        $street = $address->GetDetail();
        $city = $address->GetLevel1();
        $district = $address->GetLevel2();
        $ward = $address->GetLevel3();
        $data = file_get_contents("data.json");
        $data = json_decode($data, true);

        // print_r($data);
        foreach ($data as $rowCity) {
            if ($rowCity["Id"] == $city) {
                $city = $rowCity["Name"];
                foreach ($rowCity["Districts"] as $rowDistrict) {
                    if ($rowDistrict["Id"] == $district) {
                        $district =  $rowDistrict["Name"];
                        foreach ($rowDistrict["Wards"] as $rowWard) {
                            if ($rowWard["Id"] == $ward)
                                $ward = $rowWard["Name"];
                        }
                    }
                }
            }
        }

        $fullAddress = $street . ", " . $ward . ", " . $district . ", " . $city;

        $state = $detailBill->getState();
        if ($state != "Đang chờ xác nhận") {
            $displayConfirmButton = "none";
            $displayCancelButton = "none";
        } else {
            $displayConfirmButton = "block";
            $displayCancelButton = "block";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global2.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="stylesheet" href="../assets/css/orderList.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Chi tiết đơn hàng</title>
</head>

<body style="background-color: var(--background-gray-color)">
    <?php include("./View/Header.php") ?>
    <div class="body">
        <div class="grid block" style="padding-bottom: 10px; margin-bottom: 40px">
            <h1 class="block__title">CHI TIẾT ĐƠN HÀNG</h1>
            <div class="order-list-container">
                <div class="order-detail__top">
                    <p class="order-detail__top-text">Mã đơn hàng: #<?php echo $code ?></p>
                    <p class="order-detail__top-text">Thời gian đặt hàng: <?php echo $time ?></p>
                </div>
                <div class="order-list">
                    <div class="order-list__heading">
                        <p style="width: 40%; text-align: center;">Sản phẩm</p>
                        <p style="width: 20%; text-align: center;">Phân loại</p>
                        <p style="width: 15%; text-align: center;">Đơn giá</p>
                        <p style="width: 10%; text-align: center;">Số lượng</p>
                        <p style="width: 15%; text-align: center;">Thành tiền</p>
                    </div>
                    <?php include("./View/ProductInOrderDetail-seller.php") ?>
                </div>
            </div>
            <div class="order-detail__bottom">
                <div class="order-detail__botleft">
                    <h1 class="order-detail__botleft-title">ĐỊA CHỈ NHẬN HÀNG</h1>
                    <p class="order-detail__botleft-text"><span style="font-weight: 500;">Họ và tên: </span><?php echo $fullName ?></p>
                    <p class="order-detail__botleft-text"><span style="font-weight: 500;">Số điện thoại: </span><?php echo $phoneNumber ?></p>
                    <p class="order-detail__botleft-text"><span style="font-weight: 500;">Địa chỉ: </span> <?php echo $fullAddress ?></p>
                </div>
                <input type="hidden" name="idDetailBill" id="idDetailBill" value="<?php echo $idDetailBill?>">
                <div class="order-detail__botright">
                    <p class="order-detail__botright-money">Giảm giá: <?php echo number_format($discount) ?> VNĐ</p>
                    <p class="order-detail__botright-money">Tổng thanh toán: <?php echo number_format($totalPrice - $discount) ?> VNĐ</p>
                    <p class="order-detail__botright-status" id="state">Tình trạng đơn hàng: <?php echo $state ?></p>
                    <div class="order-detail__comfirm-buttons">
                        <button class="order-detail__botright-button-comfirm" id="btConfirm" style="display:<?php echo $displayConfirmButton?>">Xác Nhận Đơn Hàng</button>
                        <button class="order-detail__botright-button" id="btCancel" style="display:<?php echo $displayCancelButton?>">Từ Chối Đơn Hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./View/Footer.php") ?>
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
    <script type="text/javascript" src="../assets/js/orderDetail-seller2.js"></script>
</body>

</html>