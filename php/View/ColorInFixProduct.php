<?php


if (!isset($_GET['idProduct']))
    return;

$listColor = ColorDTO::getInstance()->GetListColor($idProduct);
$countImage = count($listColor);
for ($i = 0; $i < $countImage; $i++) {
    $nameColor = $listColor[$i]->GetNameColor();
?>
    <div class="add__type-item" id="color<?php echo $i+1?>">
        <p class="add__type-name" ><?php echo $nameColor ?></p>
        <button class="add__type-delete" id="btDelete">
            <i class="fa-solid fa-xmark"></i>
            <input type="hidden" name="color<?php echo $i+1?>" value="<?php echo $nameColor ?>">
        </button>
    </div>
<?php
}
