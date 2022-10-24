<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
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
    $listProduct = ProductDTO::getInstance()->GetListProduct($idAccount);
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
    <link rel="stylesheet" href="../assets/css/catalog.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cửa hàng của bạn</title>
</head>

<body>
    <?php include("./View/Header.php"); ?>

    <div class="body">
        <div class="products grid block">
            <h1 class="products__title">CỬA HÀNG CỦA BẠN</h1>
            <div class="grid products__container" style="margin-bottom: 60px;">
                <div class="products__filter">
                    <h2 class="product__filter__name">BỘ LỌC TÌM KIẾM</h2>

                    <div class="products__filter-zone">
                        <h2 class="products__filter-title">Theo Giá</h2>
                        <form action="" class="products__fiter-form" onsubmit="return false;">
                            <input type="radio" name="price-base" id="price0" value="0" checked>Trên 0 đồng<br>
                            <input type="radio" name="price-base" id="price1" value="1">Dưới 200K<br>
                            <input type="radio" name="price-base" id="price2" value="2">Từ 200K đến 500K<br>
                            <input type="radio" name="price-base" id="price3" value="3">Từ 500K đến 1Tr<br>
                            <input type="radio" name="price-base" id="price4" value="4">Từ 1Tr đến 5Tr<br>
                            <input type="radio" name="price-base" id="price5" value="5">Trên 5Tr<br>
                            <input type="radio" name="price-base" id="price6" value="6">Tuỳ chỉnh<br>
                            <input type="number" name="" id="min" placeholder="Từ" style="width:110px; height:35px; transform: none; cursor: text;" class="products__price-filter"><span style="padding: 0 5px;">-</span>
                            <input type="number" name="" id="max" placeholder="Đến" style="width:110px; height:35px; transform: none; cursor: text;" class="products__price-filter">
                            <button class="products__price-filter-apply" onclick="ChangePrice()">ÁP DỤNG</button>
                        </form>
                    </div>

                    <div class="products__filter-zone">
                        <h2 class="products__filter-title">Theo Số lượng đã bán</h2>
                        <form action="" class="products__fiter-form">
                            <input type="radio" name="count-base" id="countSold1" onclick="ChangeMinCountSold(0)" checked>Trên 0 sản phẩm<br>
                            <input type="radio" name="count-base" id="countSold2" onclick="ChangeMinCountSold(100)">Trên 100 sản phẩm<br>
                            <input type="radio" name="count-base" id="countSold3" onclick="ChangeMinCountSold(200)">Trên 200 sản phẩm<br>
                            <input type="radio" name="count-base" id="countSold4" onclick="ChangeMinCountSold(300)">Trên 300 sản phẩm<br>
                            <input type="radio" name="count-base" id="countSold5" onclick="ChangeMinCountSold(500)">Trên 500 sản phẩm<br>
                            <input type="radio" name="count-base" id="countSold6" onclick="ChangeMinCountSold(1000)">Trên 1000 sản phẩm<br>
                            <input type="radio" name="count-base" id="countSold7" onclick="ChangeMinCountSold(3000)">Trên 3000 sản phẩm
                        </form>
                    </div>

                    <div class="products__filter-zone">
                        <h2 class="products__filter-title">Theo Đánh giá</h2>
                        <div class="products__filter-vote-item" onclick="ChangeMinCountStar(1)" id="star1">
                            <img src="../assets/images/stars/1.png" alt="" class="products__filter-vote-img">
                            <span>trở lên</span>
                        </div>
                        <div class="products__filter-vote-item" onclick="ChangeMinCountStar(2)" id="star2">
                            <img src="../assets/images/stars/2.png" alt="" class="products__filter-vote-img">
                            <span>trở lên</span>
                        </div>
                        <div class="products__filter-vote-item" onclick="ChangeMinCountStar(3)" id="star3">
                            <img src="../assets/images/stars/3.png" alt="" class="products__filter-vote-img">
                            <span>trở lên</span>
                        </div>
                        <div class="products__filter-vote-item" onclick="ChangeMinCountStar(4)" id="star4">
                            <img src="../assets/images/stars/4.png" alt="" class="products__filter-vote-img">
                            <span>trở lên</span>
                        </div>
                        <div class="products__filter-vote-item" onclick="ChangeMinCountStar(5)" id="star5">
                            <img src="../assets/images/stars/5.png" alt="" class="products__filter-vote-img">
                            <span>trở lên</span>
                        </div>
                    </div>
                </div>

                <div class="products__list">
                    <div class="products__sort">
                        <h2>Sắp xếp theo</h2>
                        <?php
                        $minPrice = $_GET['minPrice'];
                        $maxPrice = $_GET['maxPrice'];
                        $minCountSold = $_GET['minCountSold'];
                        $minCountStar = $_GET['minCountStar'];
                        if (!isset($_GET['typeSort']))
                            $type = "sortNew";
                        else
                            $type = $_GET['typeSort'];
                        //$type = "sortBestSeller";
                        $typeSort = $type;
                        switch ($type) {
                            case "sortNew":
                                $displayNew = "background-color: var(--blue-color);color:white;border:none";
                                $displayBestSeller = "background-color: white;color:black;border:1px solid black;";
                                $valueSort = "Theo giá";
                                break;
                            case "sortBestSeller":
                                $displayNew = "background-color: white;color:black;border:1px solid black;";
                                $displayBestSeller = "background-color: var(--blue-color);color:white;border:none";
                                $valueSort = "Theo giá";
                                break;
                            case "sortMinToMax":
                                $displayNew = "background-color: white;color:black;border:1px solid black;";
                                $displayBestSeller = "background-color: white;color:black;border:1px solid black;";
                                $valueSort = "Thấp đến cao";
                                break;
                            case "sortMaxToMin":
                                $displayNew = "background-color: white;color:black;border:1px solid black;";
                                $displayBestSeller = "background-color: white;color:black;border:1px solid black;";
                                $valueSort = "Cao đến thấp";
                                break;
                            default:
                                $displayNew = "background-color: var(--blue-color);color:white;border:none";
                                $displayBestSeller = "background-color: white;color:black;border:1px solid black;";
                                $valueSort = "Theo giá";
                                $type = "sortNew";
                                break;
                        }
                        ?>
                        <button onclick="ChangeTypeSort('sortNew')" class="products__sort-button products__sort-selected js-latest-button" style="<?php echo $displayNew ?>">Mới nhất</button>
                        <button onclick="ChangeTypeSort('sortBestSeller')" class="products__sort-button js-best-seller-button" style="<?php echo $displayBestSeller ?>">Bán chạy nhất</button>
                        <select class="products__sort-button" value="<?php echo $valueSort ?>" onchange="ChangeTypeSortPrice(this)">
                            <option value="" disabled selected>Theo giá</option>
                            <option value="sortMinToMax" <?php if ($valueSort == "Thấp đến cao") echo "selected"; ?>>Từ thấp đến cao</option>
                            <option value="sortMaxToMin" <?php if ($valueSort == "Cao đến thấp") echo "selected"; ?>>Từ cao đến thấp</option>
                        </select>
                        <a href="addProduct.php">
                            <button class="products__add-button">Thêm sản phẩm</button>
                        </a>
                    </div>
                    <div class=" product-card-list">
                        <!--  <div class="product-card-item-3">
                            <img src="../assets/images/products/giaysneaker.jpg" alt="" class="product-card-image">
                            <p class="product-card-name">Giày sneaker thể thao chạy bộ chính hãng</p>
                            <p class="product-card-price">290.000 VNĐ</p>
                            <p class="product-card-sold">Đã bán 1,3k sản phẩm</p>
                        </div>-->
                        <?php include("./View/ProductInYourStore.php"); ?>
                    </div>
                    <?php if (count($listProduct) <= 9) {
                        $displayPageBar = "none";
                    } else
                        $displayPageBar = "block";
                    $count = count($listProduct) / 9;
                    $count = (int)$count;
                    ?>

                    <div class="paging" name="pageBar" id="pageBar" style="text-align: center;display:<?php echo $displayPageBar ?>">
                        <button class="paging__trans" onclick="Search(1)">Trang đầu</button>
                        <?php if ($pageNumber > 0) { ?>
                            <button class="paging__trans" onclick="Search(<?php echo $pageNumber-1 ?>)"><i class="fa-solid fa-arrow-left"></i></button>
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
                                <button class="paging__page-number paging__current"> <?php echo $i; ?> </button>
                            <?php
                            } else {
                            ?>
                                <button class="paging__page-number" onclick="Search(<?php echo $i; ?>)"> <?php echo $i; ?> </button>
                        <?php
                            }
                        }
                        ?>
                        <?php if ($pageNumber+1 < $lastNumberPage) { ?>
                            <button class="paging__trans" onclick="Search(<?php echo $pageNumber+2 ?>)"><i class="fa-solid fa-arrow-right"></i></button>
                        <?php } ?>
                        <button class="paging__trans" onclick="Search(<?php echo $lastNumberPage; ?>)"> >Trang cuối</button> <br>
                        <p>Đang ở trang <?php echo $pageNumber + 1 ?> trong tổng số <?php echo $count + 1 ?> trang</p>
                        <input type="hidden" name="hiddenTypeSort" id="hiddenTypeSort" value="<?php echo $typeSort ?>">
                        <input type="hidden" name="hiddenMinPrice" id="hiddenMinPrice" value="<?php echo $minPrice ?>">
                        <input type="hidden" name="hiddenMaxPrice" id="hiddenMaxPrice" value="<?php echo $maxPrice ?>">
                        <input type="hidden" name="hiddenMinCountSold" id="hiddenMinCountSold" value="<?php echo $minCountSold ?>">
                        <input type="hidden" name="hiddenMinCountStar" id="hiddenMinCountStar" value="<?php echo $minCountStar ?>">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include("./View/Footer.php") ?>
    </div>
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
    <script>
        const latestButton = document.querySelector(".js-latest-button");
        console.log("latestButton: ", latestButton);
        const bestButton = document.querySelector(".js-best-seller-button");

        function ClickLatestButton() {
            if (latestButton.classList.contains("products__sort-selected")) {
                latestButton.classList.remove("products__sort-selected");
            } else {
                latestButton.classList.add("products__sort-selected");
            }
        }

        function ClickBestSellButton() {
            if (bestButton.classList.contains("products__sort-selected")) {
                bestButton.classList.remove("products__sort-selected");
            } else {
                bestButton.classList.add("products__sort-selected");
            }
        }
    </script>
    <script src="../assets/js/yourStore3.js"></script>
</body>

</html>