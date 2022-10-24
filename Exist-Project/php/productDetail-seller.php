<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DAO/Color.php');
require_once('./DTO/ColorDTO.php');
require_once('./DTO/ImageProductDTO.php');
require_once('./DAO/ImageProduct.php');
require_once('./DTO/ProductInCartDTO.php');
require_once('./DAO/ProductInCart.php');
require_once('./DTO/EvaluteDTO.php');
require_once('./DAO/Evalute.php');
require_once('./DTO/AccountDTO.php');
require_once('./DAO/Account.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL ^ E_NOTICE);
if (!isset($_GET['idProduct'])) {
    header("Location:index.php");
} else {
    $id = $_GET['idProduct'];
    $idProduct = $_GET['idProduct'];
    $product = ProductDTO::getInstance()->GetProduct($id);
    $nameProduct = $product->GetNameProduct();
    $price = $product->GetPrice();
    $countSold = $product->GetCountSold();
    $countStar = $product->GetCountStar();
    $decribe = $product->GetDecribe();
} ?>

<?php
$listImageProduct = ImageProductDTO::getInstance()->GetListImageProductByIdProduct($id);
$countImage = count($listImageProduct);
for ($i = 1; $i <= $countImage; $i++) {
    $idname = "image" . $i;
    $imageURL = $listImageProduct[$i - 1]->GetImageURL();
?>
    <input type="hidden" id="<?php echo $idname; ?>" value="<?php echo $imageURL; ?>">
<?php
}
$index = 1;
if (count($listImageProduct) > 0)
    $firstImage = $listImageProduct[0]->GetImageURL();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/catalog.css">
    <link rel="stylesheet" href="../assets/css/productDetail2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Chi tiết sản phẩm</title>
</head>

<body>
    <?php include("./View/Header.php"); ?>
    <div class="body">
        <div class="grid block product-detail__container">
            <div class="product-detail__wrapper">
                <div class="product-detail__general">
                    <table>
                        <colgroup>
                            <col span="1" style="width: 45%;">
                            <col span="1" style="width: 28%;">
                            <col span="1" style="width: 27%;">
                        </colgroup>

                        <tbody>
                            <tr>
                                <td rowspan="6">
                                    <img id="imageProduct" src="<?php echo $imageURL; ?>" alt="" class="product-detail__img">
                                </td>
                                <input type="hidden" id="idProduct" value="<?php echo $idProduct; ?>">
                                <td colspan="2" style="padding-left: 30px;">
                                    <h1 class="product__detail-name"><?php echo $nameProduct; ?></h1>
                                </td>
                            </tr>
                            <tr style="height: 30px;">
                                <td colspan="2">
                                    <p class="product-detail__general-info" style="padding-left: 30px;">
                                        <?php echo $countStar ?> <img src="../assets/images/stars/<?php if (intval($countStar) == 0)
                                                                                                        $countStar = 5;
                                                                                                    echo intval($countStar) ?>.png" alt="" style="height:30px; vertical-align: middle; transform: translateY(-2px);">
                                    </p>
                                    <p class="product-detail__general-info" style="border-left: 1px solid rgba(0, 0, 0, 0.5); margin-left: 10px; padding: 0 10px;">
                                        <?php echo $countEvalute ?> lượt đánh giá
                                    </p>
                                    <p class="product-detail__general-info" style="border-left: 1px solid rgba(0, 0, 0, 0.5); margin-left: 10px; padding: 0 10px;">
                                        <span id="countSold"> <?php echo $countSold ?></span> lượt mua
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p class="product-detail__price"><?php echo number_format($price); ?> VNĐ</p>
                                </td>
                            </tr>
                            <tr style="height: 40px;">
                                <td>
                                    <p class="product-detail__button-label" style="padding-left: 30px;">Phân loại hàng:</p>
                                </td>
                            </tr>
                            <tr style="height: 40px;">
                                <td>
                                    <select id="color" name="color" class="product-detail__select-box">
                                        <?php
                                        $listColor = ColorDTO::getInstance()->GetListColor($id);
                                        $countColor = count($listColor);
                                        for ($i = 0; $i < $countColor; $i++) {
                                            $value = $listColor[$i]->GetNameColor();
                                        ?>
                                            <option><?php echo $value; ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 30px; vertical-align: top;">
                                    <button onclick="FixProduct()" class="product-detail__button" style="width: 90%;">Sửa thông tin sản phẩm</button>
                                </td>
                                <td style="vertical-align: top;">
                                    <button onclick="DeleteProduct()" class="product-detail__button" style="background-color: var(--orange-color);"><i class="product-detail__icon fa-solid fa-trash-can"></i>Xoá sản phẩm</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-detail__trans-img-container">
                                        <button id="buttonPreImage" class="product-detail__trans-img">Ảnh trước</button>
                                        <p id="indexImage">1</p>
                                        <p>/</p>
                                        <p id="countImage"><?php echo $countImage; ?></p>
                                        <button id="buttonNextImage" class="product-detail__trans-img">Ảnh sau</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="product-detail__desciption">
                    <h1 class="product-detail__title">MÔ TẢ SẢN PHẨM</h1>
                    <p class="product-detail__description-content">
                        <?php echo $decribe; ?>
                    </p>
                </div>

                <div class="product-detail__desciption">
                    <h1 class="product-detail__title">
                        ĐÁNH GIÁ
                        <span class="star-count"><?php echo $countStar ?></span>
                        <img src="../assets/images/stars/<?php if (intval($countStar) == 0)
                                                                $countStar = 5;
                                                            echo intval($countStar) ?>.png" alt="" style="height: 30px; transform: translateY(9px);">
                    </h1>
                    <div class="review__container" id="review__container">
                        <?php include("./View/EvaluteInProductDetail.php");

                        $count = count($listEvalute) / 5;
                        $count = (int)$count;

                        if ($count >= 1) {
                            $displayPageBar = "block";
                        } else
                            $displayPageBar = "none"; ?>
                        <div class="paging-wrapper" style="text-align: center;display:<?php echo $displayPageBar ?>">
                            <div class="paging paging-review">
                                <button class="paging__trans" onclick="LoadComment(1)">Trang đầu</button>
                                <?php if ($pageNumber > 0) { ?>
                                    <button class="paging__trans" onclick="LoadComment(<?php echo $pageNumber - 1 ?>)"><i class="fa-solid fa-arrow-left"></i></button>
                                <?php } ?>
                                <?php
                                if ($pageNumber == 0) {
                                    $startNumberPage = 1;
                                    $lastNumberPage = min($count + 1, $startNumberPage + 2);
                                }
                                if ($pageNumber == $count) {
                                    $startNumberPage = max(1, $pageNumber - 2);
                                    $lastNumberPage = $pageNumber + 1;
                                }
                                for ($i = $startNumberPage; $i <= $lastNumberPage; $i++) {
                                    if ($pageNumber + 1 == $i) { ?>
                                        <button class="paging__page-number paging__current" onclick="LoadComment(<?php echo $i ?>)"><?php echo $i; ?></button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="paging__page-number" onclick="LoadComment(<?php echo $i ?>)"><?php echo $i; ?></button>
                                <?php }
                                } ?>
                                <?php if ($pageNumber + 1 < $lastNumberPage) { ?>
                                    <button class="paging__trans" onclick="LoadComment(<?php echo $pageNumber + 2 ?>)"><i class="fa-solid fa-arrow-right"></i></button>
                                <?php } ?>
                                <button class="paging__trans" onclick="LoadComment(<?php echo $lastNumberPage ?>)">Trang cuối</button> <br>
                                <p>Đang ở trang <?php echo $pageNumber + 1 ?> trong tổng số <?php echo $count + 1 ?> trang</p>
                            </div>
                        </div>
                        <?php ?>
                    </div>
                </div>
            </div>

        </div>
        <?php include("./View/Footer.php"); ?>
        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
        <script src="../assets/js/productDetail-seller3.js"></script>
</body>

</html>