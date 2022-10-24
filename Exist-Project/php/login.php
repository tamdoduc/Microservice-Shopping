<?php
require_once('./DAO/Account.php');
require_once('./DTO/AccountDTO.php');
error_reporting(E_ALL ^ E_NOTICE);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password =  md5($_POST['password']);

    $id = AccountDTO::getInstance()->GetId($username, $password);
    if ($id!=-1) {
        $_SESSION['idAccount'] = $id;
        header("Location:index.php");
    } else
    {
        echo '<script>alert("Tên tài khoản hoặc mật khẩu không chính xác")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
        <div class="login-card">
            <img class="register-logo" src="../assets/images/other/logo.png" alt="">
            <h1 class="register-title" style="margin-bottom: 60px;">ĐĂNG NHẬP</h1>
            <form action="#" class="register-field-container" method="POST">
                <input type="text" name="username" id="" class="register-text-input" value="<?php echo $username; ?>" placeholder="Tên đăng nhập" required>
                <input type="password" name="password" id="" class="register-text-input" placeholder="Mật khẩu" required>
                <input class="login-button" type="submit" value="ĐĂNG NHẬP">
                <a href="" class="forgot-password-link">Quên mật khẩu ?</a>
                <p class="policy-label" style="margin-top: 20px;">Bạn chưa có tài khoản ? <a href="register.php" class="login-now">Đăng ký ngay</a></p>
            </form>
        </div>
    </div>
</body>

</html>