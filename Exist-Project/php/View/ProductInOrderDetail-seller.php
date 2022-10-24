<?php
require_once('./DAO/ImageProduct.php');
require_once('./DTO/ImageProductDTO.php');
$listProductInBill = ProductInBillDTO::getInstance()->GetListProductInBill($bill->GetId());
for ($i = 0; $i < count($listProductInBill); $i++) {
    $count = $listProductInBill[$i]->GetCount();
    $idProduct = $listProductInBill[$i]->GetIdProduct();
    $product = ProductDTO::getInstance()->GetProduct($idProduct);
    $price = $product->GetPrice();
    $nameProduct = $product->GetNameProduct();
    $imageProduct = ImageProductDTO::getInstance()->GetFirstImageProduct($product->GetId());
    $imageURL = $imageProduct->GetImageURL();
    $color = $listProductInBill[$i]->GetColor();
?>
    <div class="order__item">
        <div class="order__product-info" style="width: 40%">
            <img src="<?php echo $imageURL; ?>" alt="" class="order__product-img">
            <a href="./productDetail.php?idProduct=<?php echo $idProduct ?>">
                <p class="order__product-name"><?php echo $nameProduct; ?></p>
            </a>
        </div>
        <p class="order__type" style="width: 20%; text-align: center;font-size: 1.5em;"><?php echo $color; ?></p>
        <p class="order__price" style="width: 15%"><?php echo number_format($price); ?> VNĐ</p>
        <p class="order__count" style="width: 10%"><?php echo $count; ?></p>
        <p class="order__price" style="width: 15%"><?php echo number_format($price * $count); ?> VNĐ</p>
    </div>
<?php
}
?>