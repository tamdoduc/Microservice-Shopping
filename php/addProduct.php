<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DAO/Color.php');
require_once('./DTO/ColorDTO.php');
require_once('./DTO/ImageProductDTO.php');
require_once('./DAO/ImageProduct.php');
error_reporting(E_ALL ^ E_NOTICE);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$idAccount = $_SESSION['idAccount'];
if ($idAccount == null || $idAccount == -1) {
    header("Location:Login.php");
} else {
    //echo $idAccount;
    if (isset($_POST['nameProduct'])) {
        //Add product 
        $nameProduct = $_POST['nameProduct'];
        $price = $_POST['price'];
        $decribe = $_POST['decribe'];
        $type = $_POST['type'];

        $product = new Product();
        $product->SetNameProduct($nameProduct)->SetPrice($price)
            ->SetDecribe($decribe)
            ->SetType($type)
            ->SetIdAccount($idAccount);

        ProductDTO::getInstance()->CreateProduct($product);
        $idProduct = ProductDTO::getInstance()->GetMaxId();

        //Add ImageProduct
        $imageProduct = new ImageProduct();
        $imageProduct->SetIdProduct($idProduct);
        $uploaddir = '../assets/images/products/';
        // echo "</p>";
        //echo '<pre>';
        // echo 'Here is some more debugging info:';
        //print_r($_FILES);
        //print "</pre>";
        foreach ($_FILES['userfile']['name'] as $key => $value) {
            $rand1 = rand('1111111111', '9999999999');
            $rand2 = rand('1111111111', '9999999999');
            $uploadfile = $uploaddir . $rand1 . $rand2 . $value;
            if (move_uploaded_file($_FILES['userfile']['tmp_name'][$key], $uploadfile)) {
                // echo "File is valid, and was successfully uploaded.\n";
                $imageProduct->SetImageURL($uploadfile);
                ImageProductDTO::getInstance()->CreateImageProduct($imageProduct);
            } else {
                // echo "Upload failed";
            }
        }

        // Add color information
        for ($i = 1; $i <= $_POST['indexColor']; $i++) {
            $color = new Color();
            $color->SetNameColor($_POST['color' . $i]);
            $color->SetIdProduct($idProduct);
            ColorDTO::getInstance()->CreateColor($color);
        }

        header("Location:yourStore.php");
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
    <link rel="stylesheet" href="../assets/css/addProduct.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Thêm sản phẩm</title>
</head>

<body>
    <?php include("./View/Header.php"); ?>
    <div class="body">
        <form action="#" enctype="multipart/form-data" method="post" name="form" class="grid block" onsubmit=" return IsSubmit()">
            <h1 class="block__title">THÊM SẢN PHẨM</h1>
            <div class="add__container">
                <input id="nameProduct" type="text" name="nameProduct" class="add__input" placeholder="Tên sản phẩm" value="<?php echo $nameProduct; ?>">
                <select name="type" id="" class="add__select">
                    <option disabled selected>Chọn danh mục sản phẩm</option>
                    <option selected>Thời trang nam</option>
                    <option>Thời trang nữ</option>
                    <option>Điện thoại</option>
                    <option>Laptop</option>
                    <option>Thiết bị điện tử</option>
                    <option>Giày nam</option>
                    <option>Giày nữ</option>
                    <option>Sách</option>
                    <option>Đồng hồ</option>
                    <option>Dụng cụ gia đình</option>
                    <option>Trang sức</option>
                    <option>Làm đẹp</option>
                    <option>Nhà bếp</option>
                    <option>Sức khoẻ</option>
                    <option>Cho bé</option>
                    <option>Khác</option>
                </select>
                <input id="price" name="price" value="<?php echo $price; ?>" type="number"  class="add__input" placeholder="Giá" style="width: 40%; margin-left: auto; margin-right: 0">
                <textarea id="decribe" class="add__textarea" name="decribe" id="" cols="30" rows="20" placeholder="Mô tả chi tiết sản phẩm"><?php echo $decribe; ?></textarea>
                <!--<p class="add__label">Hình ảnh</p> -->
                <p class="add__label">Hình ảnh</p>
                <br>
                <input name="userfile[]" type="file" id="image-input" accept="image/jpeg, image/png, image/jpg" multiple></input>

                <div id="listImage" class="add__img-container">
                    <input id="indexImage" type="hidden" name="indexImage" value="0">
                    <!-- <div class="add__img-item">
                        <img src="../assets/images/products/aokhoackakinam.jpg" id="testitem" alt="" class="add__img-image">
                        <button class="add__img-delete">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div> -->
                </div>
                <div>
                    </img>
                    <p class="add__label">Phân loại hàng</p>
                    <input id="addColorInput" type="text" class="add__input" placeholder="Nhập tên phân loại hàng" style="width: 300px; margin-left: 30px; margin-top: 6px;">
                    <input type="hidden" value="" id="typeButton" name="typeButton" value="???">

                    <button id="addColorButton" class="add__button">+</button>
                    <input id="indexColor" type="hidden" name="indexColor" value="0">
                    <div id="listColor" class="add__type-container">
                        <!-- <div class="add__type-item">
                            <p class="add__type-name">Màu trắng</p>
                            <button class="add__type-delete">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div> -->
                    </div>
                    <div class="add__buttons">
                        <button id="submitButton" class="add__submit-button"><i class="fa-solid fa-check" style="margin-right: 5px;"></i>Hoàn tất</button>
                            <button id="cancelButton" class="add__submit-button" style="background-color: var(--red-color);">Huỷ</button>
                    </div>
                </div>
            </div>
        </form>
        <?php include("./View/Footer.php") ?>
        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
        <script src="../assets/js/addProduct2.js"></script>
</body>