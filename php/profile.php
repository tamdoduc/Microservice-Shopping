<?php
require_once('./DAO/Account.php');
require_once('./DTO/AccountDTO.php');
error_reporting(E_ALL ^ E_NOTICE);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$idAccount = $_SESSION['idAccount'];
if ($idAccount == null || $idAccount == -1)
    header("Location:login.php");
else {
    $account = new Account();
    $account = AccountDTO::getInstance()->GetAccount($idAccount);
    $username = $account->GetUsername();
    $fullName = $account->GetFullName();
    $password = $account->GetPassword();
    $email = $account->GetEmail();
    $phoneNumber = $account->GetPhoneNumber();
    $sex = $account->GetSex();
    if (isset($_POST['infoType'])) {
        $type = $_POST['infoType'];
        $id = $account->GetId();
        switch ($type) {
            case 'fullName':
                $newValue = $_POST['newValue'];
                $fullName = $newValue;
                $account->SetFullName($fullName);
                AccountDTO::getInstance()->UpdateAccount($account);
                break;
            case 'email':
                $newValue = $_POST['newValue'];
                $email = $newValue;
                $account->SetEmail($email);
                AccountDTO::getInstance()->UpdateAccount($account);
                break;
            case 'phoneNumber':
                $newValue = $_POST['newValue'];
                $phoneNumber = $newValue;
                $account->SetPhoneNumber($phoneNumber);
                AccountDTO::getInstance()->UpdateAccount($account);
                break;
        }
    } else
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
        $sex = $gender;
        $account->SetSex($sex);
        AccountDTO::getInstance()->UpdateAccount($account);
    }
    if (isset($_POST['oldPassword'])) {
        $oldPassword = md5($_POST['oldPassword']);
        $newPassword = $_POST['newPassword'];
        $renewPassword = $_POST['re-newPassword'];
        if ($oldPassword != $password) {
        } else 
        if ($newPassword != $renewPassword) {
            echo '<script>alert("Mật khẫu nhập lại không khớp!!!!!")</script>';
        } else {
            $password = md5($newPassword);
            $account->SetPassword($password);
            AccountDTO::getInstance()->UpdateAccount($account);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Quản lý tài khoản</title>
</head>

<body>
    <?php include("./View/Header.php"); ?>
    <div class="body">
        <div class="profile-block grid block">
            <h1 class="block__title">THÔNG TIN TÀI KHOẢN</h1>
            <div class="profile__container">
                <img src="../assets/images/other/avatar.png" alt="" class="profile__avatar">
                <h2 class="profile__username"><?php echo $username; ?></h2>
                <div class="profile__line-infor">
                    <p class="profile__line-label">Họ và tên</p>
                    <p class="profile__line-content"><?php echo $fullName; ?></p>
                    <i class="profile__edit-icon fa-solid fa-pen" onclick="showChangeInfoModal('name')"></i>
                </div>
                <div class="profile__line-infor">
                    <p class="profile__line-label">Địa chỉ email</p>
                    <p class="profile__line-content"><?php echo $email; ?></p>
                    <i class="profile__edit-icon fa-solid fa-pen" onclick="showChangeInfoModal('email')"></i>></i>
                </div>
                <div class="profile__line-infor">
                    <p class="profile__line-label">Số điện thoại</p>
                    <p class="profile__line-content"><?php echo $phoneNumber; ?></p>
                    <i class="profile__edit-icon fa-solid fa-pen" onclick="showChangeInfoModal('phone')"></i>></i>
                </div>
                <div class="profile__line-infor">
                    <p class="profile__line-label">Giới tính</p>
                    <p class="profile__line-content"><?php echo $sex; ?></p>
                    <i class="profile__edit-icon fa-solid fa-pen" onclick="showChangeGenderModal()"></i>></i>
                </div>
                <button class="profile__button profile__button__change-pass" onclick="showChangePasswordModal()">Đổi mật khẩu</button>
                <a href="logout.php"><button class="profile__button profile__button__logout">Đăng xuất</button>
                </a>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="footer__menu-container">
            <div class="footer__column">
                <span class="footer__title">Tiện ích</span>
                <ul class="footer__list">
                    <li class="footer__item"><a href="#" class="footer__link">Đăng nhập</a></li>
                    <li class="footer__item"><a href="#" class="footer__link">Tra cứu đơn hàng</a></li>
                    <li class="footer__item"><a href="#" class="footer__link">Đến giỏ hàng</a></li>
                </ul>
            </div>
            <div class="footer__column">
                <span class="footer__title">Về chúng tôi</span>
                <ul class="footer__list">
                    <li class="footer__item"><a href="#" class="footer__link">Chính sách mua hàng</a></li>
                    <li class="footer__item"><a href="#" class="footer__link">Chính sách bảo mật</a></li>
                    <li class="footer__item"><a href="#" class="footer__link">Tuyển dụng</a></li>
                </ul>
            </div>
            <div class="footer__column">
                <span class="footer__title">Trợ giúp</span>
                <ul class="footer__list">
                    <li class="footer__item"><a href="#" class="footer__link">Câu hỏi thường gặp</a></li>
                    <li class="footer__item"><a href="#" class="footer__link">Phản hồi</a></li>
                    <li class="footer__item"><a href="#" class="footer__link">Hotline</a></li>
                </ul>
            </div>
            <div class="footer__column">
                <span class="footer__title">Mạng xã hội</span>
                <div class="footer__social">
                    <a href="#" class="footer__social-link">
                        <i class="footer__social-icon fab fa-facebook-square"></i>
                    </a>
                    <a href="#" class="footer__social-link">
                        <i class="footer__social-icon fab fa-instagram-square"></i>
                    </a>
                    <a href="#" class="footer__social-link">
                        <i class="footer__social-icon fab fa-twitter-square"></i>
                    </a>
                    <a href="#" class="footer__social-link">
                        <i class="footer__social-icon fab fa-youtube-square"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer__copyright">
            <p>Copyright © 2022 UIT. All rights reserved.</p>
        </div>
    </div>

    <div class="change-password-modal">
        <div id="formChangePassword" class="change-password__container">
            <img src="../assets/images/other/avatar.png" alt="" class="change-password__avatar">
            <h2 style="margin-bottom: 20px;"><?php echo $user->username; ?></h2>
            <form action="#" method="POST" class="change-password-form">
                <input class="change-password__input" type="password" name="oldPassword" id="" placeholder="Mật khẩu cũ" required>
                <input class="change-password__input" type="password" name="newPassword" id="newPassword" placeholder="Mật khẩu mới" required>
                <input class="change-password__input" type="password" name="re-newPassword" id="re-newPassword" placeholder="Nhập lại mật khẩu mới" required>
                <div class="change-password__buttons">
                    <input class="change-password__button" type="submit" value="Đổi mật khẩu" style="background-color: var(--blue-color); padding: 0 15px;">
                    <button type="button" class="change-password__button" onclick="hideChangePasswordModal()">Huỷ</button>
                </div>
            </form>
        </div>
    </div>

    <div class="change-info-modal">
        <div class="change-info__container">
            <img src="../assets/images/other/avatar.png" alt="" class="change-password__avatar">
            <h2 style="margin-bottom: 20px;"><?php echo $user->username; ?></h2>
            <form method="post" action="#" class="change-password-form">
                <input class="change-password__input" id="js-change-info-input" type="text" name="newValue" id="" placeholder="Họ và tên mới" required>
                <div class="change-password__buttons">
                    <input id="infoType" type="hidden" name="infoType" value="test"></input>
                    <input class="change-password__button" type="submit" value="Lưu lại" style="background-color: var(--blue-color); padding: 0 15px;">
                    <button type="button" class="change-password__button" onclick="hideChangeInfoModal()">Huỷ</button>
                </div>
            </form>
        </div>
    </div>
    <div class="change-gender-modal">
        <div class="change-info__container">
            <img src="../assets/images/other/avatar.png" alt="" class="change-password__avatar">
            <h2 style="margin-bottom: 20px;"><?php echo $user->username; ?></h2>
            <form action="#" method="post" class="change-password-form">
                <select class="change-password__input" name="gender">
                    <option>Nam</option>
                    <option>Nữ</option>
                    <option>Khác</option>
                </select>
                <div class="change-password__buttons">
                    <input class="change-password__button" type="submit" value="Lưu lại" style="background-color: var(--blue-color); padding: 0 15px;">
                    <button type="button" class="change-password__button" onclick="hideChangeGenderModal()">Huỷ</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
    <script>
        const changePasswordModal = document.querySelector(".change-password-modal");
        const changeInfoModal = document.querySelector(".change-info-modal");
        const changeGenderModal = document.querySelector(".change-gender-modal");

        function showChangePasswordModal() {
            changePasswordModal.classList.add("open-modal");
        }

        function hideChangePasswordModal() {
            changePasswordModal.classList.remove("open-modal");
        }

        function showChangeInfoModal(infoType) {
            const changeInfoInput = document.getElementById('js-change-info-input');
            const changeInfoTypeInput = document.getElementById('infoType');
            if (infoType == 'name') {
                changeInfoInput.type = "text";
                console.log(infoType);
                changeInfoInput.placeholder = "Họ và tên mới";
                changeInfoTypeInput.value = "fullName";

            } else
            if (infoType == 'email') {
                changeInfoInput.type = "email";
                changeInfoInput.placeholder = "Địa chỉ email mới";
                changeInfoTypeInput.value = "email";
            } else
            if (infoType == 'phone') {
                changeInfoInput.type = "number";
                changeInfoInput.placeholder = "Số điện thoại mới";
                changeInfoTypeInput.value = "phoneNumber";
            }
            changeInfoModal.classList.add("open-modal");
        }

        function hideChangeInfoModal() {
            changeInfoModal.classList.remove("open-modal");
        }

        function showChangeGenderModal() {
            changeGenderModal.classList.add("open-modal");
        }

        function hideChangeGenderModal() {
            changeGenderModal.classList.remove("open-modal");
        }
    </script>
</body>

</html>