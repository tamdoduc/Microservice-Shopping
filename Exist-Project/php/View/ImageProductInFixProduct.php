<?php


if (!isset($_GET['idProduct']))
    return;

$listImageProduct = ImageProductDTO::getInstance()->GetListImageProductByIdProduct($idProduct);
$countImage = count($listImageProduct);
for ($i = 0; $i < $countImage; $i++) {
    $imageURL = $listImageProduct[$i]->GetImageURL();
?>
<div class="add__img-item" id="image<?php echo $i+1; ?>">
    <img src="<?php echo $imageURL; ?>" alt="" class="add__img-image">
</div>
<?php
}