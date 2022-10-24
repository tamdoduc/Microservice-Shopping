<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DTO/ImageProductDTO.php');
require_once('./DAO/ImageProduct.php');

$test = ProductDTO::getInstance()->GetListProductBestSeller();
$count = count($test);
for ($i = 0; $i < min($count,12); $i++) {
    $name = $test[$i]->GetNameProduct();
    $price = $test[$i]->GetPrice();
    $countSold = $test[$i]->GetCountSold();
    $id = $test[$i]->GetId();
    $imageProduct = ImageProductDTO::getInstance()->GetFirstImageProduct($id);
    if ($imageProduct != null) {
        $imageURL = $imageProduct->GetImageURL();
?>

        <form class="product-card-item" method="GET" action="./productDetail.php">
            <button class=product-card-button>
                <img src="<?php echo $imageURL; ?>" alt="" class="product-card-image">
                <input type="hidden" name="idProduct" value="<?php echo $id; ?>">
                <p class="product-card-name"><?php echo $name; ?> </p>
                <p class="product-card-price"><?php echo number_format($price); ?> VNĐ</p> <br>
                <p class="product-card-sold">Đã bán được <?php echo $countSold; ?> sản phẩm</p>
            </button>
        </form>

<?php
    }
}
?>