<?php
require_once('./DAO/Account.php');
require_once('./DTO/AccountDTO.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['submit'])) {
    if (AccountDTO::getInstance()->AccountExists($_POST['username'])) {
        echo '<script>alert("Tên tài khoản đã tồn tại")</script>';
    } else {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $repassword = md5($_POST['re-password']);
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $sex = $_POST['gender'];
        $account = new ACCOUNT();
        $account->SetUsername($username)->SetPassword($password)->SetEmail($email)
            ->SetPhoneNumber($phoneNumber)->SetSex($sex)->SetFullName($fullname);

        if (AccountDTO::getInstance()->CreateAccount($account) != null) {
            $_SESSION['idAccount'] = AccountDTO::getInstance()->GetId($username, $password);
            include 'index.php';
        } else {
            echo '<script>alert("Tạo tài khoản thất bại")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript">
        function validate() {
            var password = document.forms["registerForm"]["password"].value;
            var repassword = document.forms["registerForm"]["re-password"].value;
            if (password != repassword) {
                document.forms["registerForm"]["password"].style.border = "1px solid red";
                document.forms["registerForm"]["re-password"].style.border = "1px solid red";
                document.forms["registerForm"]["password"].value = "";
                document.forms["registerForm"]["re-password"].value = "";
                return false;
            }
            return true;
        }
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    
<div class="register-container">
        <img class="register-background" src="../assets/images/other/bg.jpg" alt="">
        <div class="register-card">
            <img class="register-logo" src="../assets/images/other/logo.png" alt="">
            <h1 class="register-title">ĐĂNG KÝ</h1>
            <form name="registerForm" action="#" method="POST" class="register-field-container" onsubmit=" return validate()">
                <input type="text" name="fullname" id="" class="register-text-input" placeholder="Họ và tên" required value="<?php echo (isset($fullname)) ? $fullname : ''; ?>">
                <input type="email" name="email" id="" class="register-text-input" placeholder="Địa chỉ Email" required value="<?php echo (isset($email)) ? $email : ''; ?>">
                <div class="tel-wrapper">
                    <input type="number" name="phoneNumber" id="std" class="register-text-input" placeholder="Số điện thoại" required style="width: 150px;" value="<?php echo (isset($phoneNumber)) ? $phoneNumber : ''; ?>">
                    <label class="gender-label" style="margin-left: 20px;">Giới tính:</label>
                    <input type="radio" name="gender" value="Nam" id="" class="gender-radio" checked="checked"><span class="gender-label">Nam</span>
                    <input type="radio" name="gender" value="Nữ" id="" class="gender-radio"><span class="gender-label">Nữ</span>
                </div>
                <input type="text" name="username" id="" class="register-text-input" placeholder="Tên đăng nhập" required value="<?php echo (isset($username)) ? $username : ''; ?>">
                <input type="password" name="password" id="pd" class="register-text-input" placeholder="Mật khẩu" required>
                <input type="password" name="re-password" id="repd" class="register-text-input" placeholder="Nhập lại mật khẩu" required>
                <div class="policy-wrapper">
                    <p class="policy-label">Bằng việc đăng kí, bạn đã đồng ý với các điều khoản</p>
                </div>
                <input class="register-button" name="submit" type="submit" value="ĐĂNG KÝ">
                <p name="policy" class="policy-label" style="margin-top: 20px;">Bạn đã có tài khoản ? <a href="login.php" class="login-now">Đăng nhập ngay</a></p>
            </form>
        </div>
    </div>
</body>

</html>