<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DAO/Color.php');
require_once('./DTO/ColorDTO.php');
require_once('./DTO/ImageProductDTO.php');
require_once('./DAO/ImageProduct.php');
require_once('./DTO/ProductInCartDTO.php');
require_once('./DAO/ProductInCart.php');
if (isset($_GET['countProduct'])) {

    $countProduct = $_GET['countProduct'];
    $totalAll = 0;
    $arrayShop = array();
    for ($i = 0; $i < $countProduct; $i++) {
        $index = $i + 1;
        if (isset($_GET['tick' . $index])) {
            $product = ProductDTO::getInstance()->GetProduct($_GET['id' . $index]);
            $idAccount = $product->GetIdAccount();
            if (!in_array($idAccount, $arrayShop)) {
                array_push($arrayShop, $idAccount);
            }
            $nameProduct = $product->GetNameProduct();
            $price = $product->GetPrice();
            $count = $_GET['count' . $index];
            $color = $_GET['color' . $index];
            $total = $price * $count;
            $totalAll += $total;
            $idProduct = $product->GetId();
            $imageProduct = ImageProductDTO::getInstance()->GetFirstImageProduct($idProduct);
            $imageURL = $imageProduct->GetImageURL();
?>
            <div class="cart__products">
                <div class="cart__item">
                    <div class="cart__product">
                        <img src="<?php echo $imageURL; ?>" alt="" class="cart__product-img">
                        <p class="cart__product-name"><?php echo $nameProduct; ?></p>
                    </div>
                    <p class="order__type"><?php echo $color; ?></p>
                    <p class="cart__price"><?php echo number_format($price); ?> VNĐ</p>
                    <p class="order-count"><?php echo $count; ?></p>
                    <p class="cart__money"><?php echo number_format($total); ?> VNĐ</p>
                </div>
            </div>
<?php
        }
    }
}
?>