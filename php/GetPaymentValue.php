
<?php
require_once('./DAO/Account.php');
require_once('./DTO/AccountDTO.php');
require_once('./DAO/Bill.php');
require_once('./DTO/BillDTO.php');
require_once('./DAO/DetailBill.php');
require_once('./DTO/DetailBillDTO.php');
require_once('./DAO/Address.php');
require_once('./DTO/AddressDTO.php');
require_once('./DAO/ProductInBill.php');
require_once('./DTO/ProductInBillDTO.php');
require_once('./DAO/ProductInCart.php');
require_once('./DTO/ProductInCartDTO.php');
require_once('./DAO/Product.php');
require_once('./DTO/ProductDTO.php');
error_reporting(E_ALL ^ E_NOTICE);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$idAccount = $_SESSION['idAccount'];
if ($idAccount == null || $idAccount == -1)
    header("Location:login.php");
else {
    /// lọc sản phẩm của từng shop
    $countProduct = $_POST['hiddenCountProduct'];
    $arrayShop = array();
    for ($i = 0; $i < $countProduct; $i++) {
        $id = $i + 1;
        $productInBill = new ProductInBill();
        $idProduct = $_POST['id' . $id];
        $count = $_POST['count' . $id];
        $product = ProductDTO::getInstance()->GetProduct($idProduct);
        $idAccount = $product->GetIdAccount();
        if (!in_array($idAccount, $arrayShop)) {
            array_push($arrayShop, $idAccount);
        }
    }
    echo count($arrayShop) . "<br>";
    for ($i = 0; $i < count($arrayShop); $i++) {
        echo $arrayShop[$i] . "<br>";
        // create Bill
        $bill = new Bill();
        $s = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQUVTXYZ", 5)), 0, 5);
        $num = rand('11111', '99999');
        $code = $s . $num;
        $time = Date('y-m-d');
        $idAccount = $_SESSION['idAccount'];
        $bill->SetCode($code)->SetTime($time)->SetIdAccount($idAccount)->SetIdAccountSeller($arrayShop[$i]);
        if (BillDTO::getInstance()->CreateBill($bill)) {
            echo "<br>Bill created successfully<br>";
        }
        // create DetailBill
        $bill = BillDTO::getInstance()->GetNewestBill();
        $idBill = $bill->GetId();
        $detailBill = new DetailBill();
        $totalPrice = $_POST['hiddenTotalPrice'];
        $discount = $_POST['hiddenDiscount'] / count($arrayShop);
        $account = AccountDTO::getInstance()->GetAccount($idAccount);
        if ($account!=null)
        {
            $account->SetCoin($account->GetCoin() - $_POST['hiddenDiscount']);
            AccountDTO::getInstance()->UpdateAccount($account);
        }
        $state = "Đang chờ xác nhận";
        $detailBill->SetIdBill($idBill)->SetDiscount($discount)->SetTotalPrice($totalPrice)->SetState($state);
        if (DetailBillDTO::getInstance()->CreateDetailBill($detailBill))
            echo "<br>DetailBill created successfully<br>";

        $detailBill = DetailBillDTO::getInstance()->GetNewestDetailBill();
        $fullName = $_POST["fullName"];
        $phoneNumber = $_POST["phoneNumber"];
        $city = $_POST["city"];
        $district = $_POST["district"];
        $ward = $_POST["ward"];
        $street = $_POST["street"];

        $address = new Address();
        $address->SetFullName($fullName)->SetPhoneNumber($phoneNumber)->SetLevel1($city)->SetLevel2($district)->SetLevel3($ward)->SetDetail($street);
        if (AddressDTO::getInstance()->CreateAddress($address))
            echo "<br>Address created successfully<br>";
        $address = AddressDTO::getInstance()->GetNewestAddress();


        $detailBill->SetIdAddress($address->GetId());
        $bill->SetIdDetailBill($detailBill->GetId());
        if (
            BillDTO::getInstance()->UpdateBill($bill)
        )
            echo "<br>Bill updated successfully<br>";
        if (DetailBillDTO::getInstance()->UpdateDetailBill($detailBill))
            echo "<br>DetailBill updated successfully<br>";

        $listProductOfShop = array();
        $totalPrice = 0;
        for ($j = 0; $j < $countProduct; $j++) {
            $id = $j + 1;
            $productInBill = new ProductInBill();
            $idProduct = $_POST['id' . $id];
            $product = ProductDTO::getInstance()->GetProduct($idProduct);
            $price = $product->GetPrice();
            $idShop = $arrayShop[$i];
            if ($product->GetIdAccount() == $idShop) {
                $count = $_POST['count' . $id];
                $color = $_POST['color' . $id];
                $totalPrice += $count * $price;
                $productInBill = new ProductInBill();
                $productInBill->SetIdBill($idBill)
                    ->SetColor($color)
                    ->SetCount($count)
                    ->SetIdProduct($idProduct);
                if (ProductInBillDTO::getInstance()->CreateProductInBill($productInBill))
                    echo "<br>" . $idBill . "ProductInBill" . $idProduct . "<br>";
                $idAccountBuy = $_SESSION['idAccount'];
                if (ProductInCartDTO::getInstance()->DeleteProductInCart($idAccountBuy, $idProduct, $color))
                    echo "<br>" . $idAccount . "De le te ProductInCart";
                $account = AccountDTO::getInstance()->GetAccount($idAccountBuy);
                $account->SetLastIdAddress($address->GetId());
                if (AccountDTO::getInstance()->UpdateAccount($account)) {
                    echo "<br>Update" . $idAccountBuy . ":::" . $address->GetId() . "<br>";
                }
            }
        }
        $detailBill->SetTotalPrice($totalPrice);
        DetailBillDTO::getInstance()->UpdateDetailBill($detailBill);
        header("Location:orderList.php");
    }



    /*
    // create Address
    
    //Create ProductInBill*/
}
