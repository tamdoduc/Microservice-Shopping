<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DAO/Color.php');
require_once('./DTO/ColorDTO.php');
require_once('./DTO/ImageProductDTO.php');
require_once('./DAO/ImageProduct.php');
require_once('./DTO/ProductInCartDTO.php');
require_once('./DAO/ProductInCart.php');

$productInCart = new ProductInCart();

$listProductInCart = ProductInCartDTO::getInstance()->GetListProductInCart($idAccount);
$countProduct = count($listProductInCart);
?>




<input type="hidden" name="countProduct" id="countProduct" value="<?php echo $countProduct; ?>" />;
<div class="grid block">
    <h1 class="block__title">GIỎ HÀNG</h1>
    <div class="cart__container">
        <div class="cart__heading">
            <p class="cart__heading-name" style="width: 40%; text-align: center;">Sản Phẩm</p>
            <p class="cart__heading-name" style="width: 20%; text-align: center;">Phân loại</p>
            <p class="cart__heading-name" style="width: 15%; text-align: center;">Đơn Giá</p>
            <p class="cart__heading-name" style="width: 10%; text-align: center;">Số Lượng</p>
            <p class="cart__heading-name" style="width: 15%; text-align: center;">Thành Tiền</p>
        </div>
        <?php
        for ($i = 0; $i < $countProduct; $i++) {
            $count = $listProductInCart[$i]->GetCount();
            $idProduct = $listProductInCart[$i]->GetIdProduct();
            $product = ProductDTO::getInstance()->GetProduct($idProduct);
            $nameProduct = $product->GetNameProduct();
            $color = $listProductInCart[$i]->GetColor();
            $price = $product->GetPrice();
            $imageProduct = ImageProductDTO::getInstance()->GetFirstImageProduct($idProduct);
            $imageURL = $imageProduct->GetImageURL();
        ?>
            <div class="cart__products" id="product<?php echo $i + 1; ?>">
                <input type="hidden" name="id<?php echo $i + 1; ?>" id="idProduct<?php echo $i + 1; ?>" value="<?php echo $idProduct; ?>">
                <input type="hidden" name="color<?php echo $i + 1; ?>" id="color<?php echo $i + 1; ?>" value="<?php echo $color; ?>">
                <div class="cart__item">
                    <div class="cart__product">
                        <input class="cart__product-check" type="checkbox" name="tick<?php echo $i + 1; ?>" id="tick<?php echo $i + 1; ?>">
                        <img src="<?php echo $imageURL; ?>" alt="" class="cart__product-img">
                        <p class="cart__product-name"><?php echo $nameProduct; ?></p>
                    </div>
                    <p class="cart__type" style="width: 20%;text-align:center; "><?php echo $color; ?></p>
                    <p class=" cart__price" id="price"><?php echo $price; ?> VNĐ</p>
                    <input type="number" class="cart__count" name="count<?php echo $i + 1; ?>" id="countProduct" value="<?php echo $count; ?>" min="1">
                    <p class="cart__money" id="totalPriceProduct"><?php echo $price * $count; ?> VNĐ</p>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>
</div>