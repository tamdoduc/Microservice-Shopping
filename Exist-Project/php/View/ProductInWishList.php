<?php
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
require_once('./DAO/Color.php');
require_once('./DTO/ColorDTO.php');
require_once('./DTO/ImageProductDTO.php');
require_once('./DAO/ImageProduct.php');
require_once('./DTO/ProductInFavoriteDTO.php');
require_once('./DAO/ProductInFavorite.php');

$productInFavorite = new ProductInFavorite();
$listProductInFavorite = ProductInFavoriteDTO::getInstance()->GetListProductInFavorite($idAccount);
$countProduct = count($listProductInFavorite);

?>
<input type="hidden" name="countProduct" id="countProduct" value="<?php echo $countProduct; ?>" />;
<div class="grid block">
    <h1 class="block__title">SẢN PHẨM YÊU THÍCH</h1>
    <div class="cart__container">
        <div class="cart__heading">
            <p class="cart__heading-name" style="width: 40%; text-align: center;">Sản Phẩm</p>
            <p class="cart__heading-name" style="width: 20%; text-align: center;">Phân loại</p>
            <p class="cart__heading-name" style="width: 20%; text-align: center;">Đơn Giá</p>
            <p class="cart__heading-name" style="width: 20%; text-align: center;"></p>
        </div>
        <?php
        for ($i = 0; $i < $countProduct; $i++) {
            $idProduct = $listProductInFavorite[$i]->GetIdProduct();
            $product = ProductDTO::getInstance()->GetProduct($idProduct);
            $nameProduct = $product->getNameProduct();
            $color = $listProductInFavorite[$i]->GetColor();
            $price = $product->GetPrice();
            $imageProduct = ImageProductDTO::getInstance()->GetFirstImageProduct($idProduct);
            $imageURL = $imageProduct->GetImageURL();
        ?>
            <div class="cart__products" id="product<?php echo $i + 1; ?>">
                <input type="hidden" name="idProduct<?php echo $i + 1; ?>" id="idProduct<?php echo $i + 1; ?>" value="<?php echo $idProduct; ?>">
                <input type="hidden" name="color<?php echo $i + 1; ?>" id="color<?php echo $i + 1; ?>" value="<?php echo $color; ?>">
                <div class="cart__item" >
                    <div class="cart__product" style="width: 40%;">
                        <input class="cart__product-check" type="checkbox" name="tick<?php echo $i + 1; ?>" id="tick<?php echo $i + 1; ?>">
                        <img src="<?php echo $imageURL; ?>" alt="" class="cart__product-img">
                        <p class="cart__product-name"><?php echo $nameProduct; ?></p>
                    </div>
                    <p class=" cart__type" style="width: 20%" id="color"><?php echo $color; ?> </p>
                    <p class="wishlist__price" style="width: 20%"><?php echo number_format($price) ?> VNĐ</p>
                    <div class="wishlist__advanced" style="width: 20%">
                        <button class="wishlist__button" onclick="AddToCart(<?php echo $i + 1; ?>)">Thêm vào Giỏ hàng</button>
                        <button class="wishlist__button-2" onclick="DeleteProductInWishList(<?php echo $i + 1; ?>)">Xoá</button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>