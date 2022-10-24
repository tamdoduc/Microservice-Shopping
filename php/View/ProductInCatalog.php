<?php
$listProduct = ProductDTO::getInstance()->GetListProductByTypeSort($type);
if ($minPrice!="")
{
    $newArray = array();
    foreach($listProduct as $product)
    {
        if ($product->GetPrice() >=(int) $minPrice && $product->GetPrice() <= (int)$maxPrice)
            array_push($newArray,$product);
    }
    $listProduct = $newArray;
}
if ($minCountSold!="")
{
    $newArray = array();
    foreach($listProduct as $product)
    {
        if ($product->GetCountSold() >= (int)$minCountSold)
            array_push($newArray,$product);
    }
    $listProduct = $newArray;
} 
if ($minCountStar!="")
{
    $newArray = array();
    foreach($listProduct as $product)
    {
        if ($product->GetCountStar()>= intval($minCountStar)||$product->GetCountStar()==0)
        array_push($newArray,$product);
    }
    $listProduct = $newArray;
}
if ($searchValue!="")
{
    $newArray = array();
    foreach($listProduct as $product)
    {
        $sName = " ".mb_strtolower($product->GetNameProduct(),'UTF-8');
        $sType = " ".mb_strtolower($product->GetType(),'UTF-8');
        $sSearchValue = mb_strtolower($searchValue,'UTF-8');
        if (strpos($sName, $sSearchValue)!=false||strpos($sType, $sSearchValue)!=false) {
            array_push($newArray,$product);
        }
    }
    $listProduct = $newArray;
}

if ($_GET['page-number'])
    $pageNumber = $_GET['page-number'] - 1;
else
    $pageNumber = 0;

$startNumber = ($pageNumber * 9);
$lastNumber = min($startNumber + 9, count($listProduct));

$count = count($listProduct);
$count = min($count, 9);
for ($i = $startNumber; $i < $lastNumber; $i++) {
    $name = $listProduct[$i]->GetNameProduct();
    $price = $listProduct[$i]->GetPrice();
    $countSold = $listProduct[$i]->GetCountSold();
    $id = $listProduct[$i]->GetId();
    $imageProduct = ImageProductDTO::getInstance()->GetFirstImageProduct($id);
    if ($imageProduct != null) {
        $imageURL = $imageProduct->GetImageURL();
?>
        <form class="product-card-item-3" method="Get" action="./productDetail.php">
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