<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL ^ E_NOTICE);
$idAccount = $_SESSION['idAccount'];
if ($idAccount != null && $idAccount != -1) {
    //echo "<h1>Đăng nhập thành công id = $idAccount</h1><br>";
    //$_SESSION['idAccount'] = $idAccount;    
} else {
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
    <link rel="stylesheet" href="../assets/css/main1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Trang chủ</title>
    <link href="https://trial.chatcompose.com/static/trial/all/global/export/css/main.5b1bd1fd.css" rel="stylesheet">
    <script async type="text/javascript" src="https://trial.chatcompose.com/static/trial/all/global/export/js/main.a7059cb5.js?user=trial_turtleTea&lang=VI" user="trial_turtleTea" lang="VI"></script>
</head>

<body>
    <?php include("./View/Header.php"); ?>
    <div class="body">
        <div class="catalog grid block">
            <h1 class="block__title">DANH MỤC SẢN PHẨM</h1>
            <div class="catalog__list">
                <div class="catalog__item" onclick="SearchType('Thời trang nam')">
                    <img src="../assets/images/catalog/thoitrangnam.png" alt="" class="catalog__image">
                    <p class="catalog__title">Thời trang nam</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Điện thoại')">
                    <img src="../assets/images/catalog/smartphone.png" alt="" class="catalog__image">
                    <p class="catalog__title">Điện thoại</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Laptop')">
                    <img src="../assets/images/catalog/laptop.png" alt="" class="catalog__image">
                    <p class="catalog__title">Laptop</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Thiết bị điện tử')">
                    <img src="../assets/images/catalog/thietbidientu.png" alt="" class="catalog__image">
                    <p class="catalog__title">Thiết bị điện tử</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Giày nam')">
                    <img src="../assets/images/catalog/giaynam.png" alt="" class="catalog__image">
                    <p class="catalog__title">Giày nam</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Sách')">
                    <img src="../assets/images/catalog/sach.png" alt="" class="catalog__image">
                    <p class="catalog__title">Sách</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Đồng hồ')">
                    <img src="../assets/images/catalog/dongho.png" alt="" class="catalog__image">
                    <p class="catalog__title">Đồng hồ</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Dụng cụ gia đình')">
                    <img src="../assets/images/catalog/dungcugiadinh.png" alt="" class="catalog__image">
                    <p class="catalog__title">Dụng cụ gia đình</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Thời trang nữ')">
                    <img src="../assets/images/catalog/thoitrangnu.png" alt="" class="catalog__image">
                    <p class="catalog__title">Thời trang nữ</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Trang sức')">
                    <img src="../assets/images/catalog/trangsuc.png" alt="" class="catalog__image">
                    <p class="catalog__title">Trang sức</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Làm đẹp')">
                    <img src="../assets/images/catalog/lamdep.png" alt="" class="catalog__image">
                    <p class="catalog__title">Làm đẹp</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Nhà bếp')">
                    <img src="../assets/images/catalog/nhabep.png" alt="" class="catalog__image">
                    <p class="catalog__title">Nhà bếp</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Giày nữ')">
                    <img src="../assets/images/catalog/giaynu.png" alt="" class="catalog__image">
                    <p class="catalog__title">Giày nữ</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Sức khỏe')">
                    <img src="../assets/images/catalog/suckhoe.png" alt="" class="catalog__image">
                    <p class="catalog__title">Sức khoẻ</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Cho bé')">
                    <img src="../assets/images/catalog/embe.png" alt="" class="catalog__image">
                    <p class="catalog__title">Cho bé</p>
                </div>
                <div class="catalog__item" onclick="SearchType('Khác')">
                    <img src="../assets/images/catalog/other.png" alt="" class="catalog__image">
                    <p class="catalog__title">Khác</p>
                </div>
            </div>
        </div>

        <div class="best-seller-product grid block">
            <h1 class="block__title">SẢN PHẨM ĐANG HOT</h1>
            <div class="product-card-list">
                <?php include("./View/ProductInYourBestSeller.php");
                if ($count > 12) { ?>
                    <button class="see-more-button" onclick="SearchBestSeller()">Xem thêm</button>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="recommend-product grid block">
            <h1 class="block__title">GỢI Ý CHO BẠN</h1>
            <div class="product-card-list">
                <?php include("./View/ProductTopStar.php");
                if ($count > 12) { ?>
                    <a href="./catalog.php">
                        <button class="see-more-button">Xem thêm</button>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php include("./View/Footer.php") ?>
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
    <script src="../assets/js/index.js"></script>

</body>

</html>