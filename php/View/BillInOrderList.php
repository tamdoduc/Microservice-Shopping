<?php
require_once('./DAO/ImageProduct.php');
require_once('./DTO/ImageProductDTO.php');

$listBill = BillDTO::getInstance()->GetListBillByIdAccount($idAccount);

if (isset($_GET['time']) && $_GET['time'] != "Thời gian") {
    $newArray = array();
    switch ($_GET['time']) {
        case "Tất cả":
            $newArray = $listBill;
            break;
        case "Hôm nay":
            foreach ($listBill as $bill) {
                if ($bill->GetTime() == date('Y-m-d'))
                    array_push($newArray, $bill);
            }
            break;
        case "Tuần này":
            $datetime = new DateTime(date('y-m-d'));
            $indexDate = intval($datetime->format('w'));
            $dateBeginWeek = new DateTime(date('y-m-d'));
            $dateEndWeek = new DateTime(date('y-m-d'));

            date_sub($dateBeginWeek, date_interval_create_from_date_string(($indexDate - 1) . " days"));
            date_add($dateEndWeek, date_interval_create_from_date_string((7 - $indexDate) . " days"));
            foreach ($listBill as $bill) {
                if ("20" . $dateBeginWeek->format('y-m-d') <= $bill->GetTime() && $bill->GetTime() <= "20" . $dateEndWeek->format('y-m-d'))
                    array_push($newArray, $bill);
            }
            break;
        case "Tháng này":
            $datetime = new DateTime(date('y-m-d'));
            $indexDate = intval($datetime->format('m'));
            foreach ($listBill as $bill) {
                $time = new DateTime($bill->GetTime());
                if ($time->format('m') == $indexDate)
                    array_push($newArray, $bill);
            }
            break;
        case "Năm này":
            $datetime = new DateTime(date('y-m-d'));
            $indexDate = intval($datetime->format('y'));
            foreach ($listBill as $bill) {
                $time = new DateTime($bill->GetTime());
                if ($time->format('y') == $indexDate)
                    array_push($newArray, $bill);
            }
            break;
    }
    $listBill = $newArray;
}
if (isset($_GET['state']) && $_GET['state'] != 'Tình trạng đơn hàng') {

    if ($_GET['state'] != "Tất cả") {
        $newArray = array();
        foreach ($listBill as $bill) {
            $detailBill = DetailBillDTO::getInstance()->GetDetailBill($bill->GetIdDetailBill());
            if ($detailBill->GetState() == $_GET['state'])
                array_push($newArray, $bill);
        }
        $listBill = $newArray;
    }
}

for ($i = 0; $i < count($listBill); $i++) {
    $detailBill = DetailBillDTO::getInstance()->GetDetailBill($listBill[$i]->GetIdDetailBill());
    $state = $detailBill->GetState();
    $time = $listBill[$i]->GetTime();
    $totalPrice = $detailBill->GetTotalPrice();
    $discount = $detailBill->GetDiscount();
    $money  = $totalPrice - $discount;
    $listProductInBill = ProductInBillDTO::getInstance()->GetListProductInBill($listBill[$i]->GetId());
    $color = $listProductInBill[0]->GetColor();
    $product = ProductDTO::getInstance()->GetProduct($listProductInBill[0]->GetIdProduct());
    $imageProduct = ImageProductDTO::getInstance()->GetFirstImageProduct($product->GetId());
    $imageURL = $imageProduct->GetImageURL();
    $nameProduct = $product->GetNameProduct();
    $count = $listProductInBill[0]->GetCount();
?>
    <div class="order__item">
        <div class="order__product-info" style="width: 30%">
            <img src="<?php echo $imageURL ?>" alt="" class="order__product-img">
            <a href="./OrderDetail.php?idBill=<?php echo $listBill[$i]->GetId(); ?>">
                <p class="order__product-name"><?php echo $nameProduct ?></p>
            </a>
        </div>
        <p class="order__type" style="width: 15% ; text-align: center;font-size: 1.5em;"><?php echo $color ?></p>
        <p class="order__count" style="width: 10%"><?php echo $count ?></p>
        <p class="order__date" style="width: 15%"><?php echo $time ?></p>
        <p class="order__price" style="width: 15%"><?php echo number_format($money) ?> VNĐ</p>
        <p class="order__status" style="width: 15%"><?php echo $state ?></p>
        <?php
        if (count($listProductInBill) > 1) {
            $countOther = count($listProductInBill) - 1;
        ?>
            <p class="order__remain">và <?php echo $countOther ?>sản phẩm khác</p>
        <?php
        }
        ?>
    </div>
<?php
}
?>