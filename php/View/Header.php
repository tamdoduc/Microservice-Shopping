<link rel="stylesheet" href="../assets/css/global2.css">
<link rel="stylesheet" href="../assets/css/main1.css">
<style>
    .header__user-dropdown-item:hover a{
        cursor: pointer;
        background-color: var(--blue-color);
        color: #FFF !important;
    }
</style>
<div id="header">
    <!-- Logo -->
    <a href="./index.php" class="header__logo-link">
        <img class="header__logo-img" src="../assets/images/other/logo.png" alt="logo">
    </a>

    <!-- Search -->
    <div class="search-bar">
        <input id="inputSearch" class="search-bar__text" type="text" placeholder="Tìm kiếm sản phẩm">
        <!-- <img class="search-bar__icon" src="../assets/icons/search.png"> -->
        <lord-icon src="https://cdn.lordicon.com/pvbutfdk.json" trigger="loop-on-hover" onclick="SearchWithValue()" class="search-bar__icon">
        </lord-icon>
    </div>
    <script type="text/javascript">
        function SearchWithValue() {
            const input = document.getElementById('inputSearch');
            window.location = "../php/catalog.php?searchValue=" + input.value;
        }
    </script>

    <!-- Advanced -->
    <div class="header__advanced">
        <a href="./cart.php">
            <lord-icon src="https://cdn.lordicon.com/aoggitwj.json" trigger="loop-on-hover" colors="primary:#ffffff" class="header__advanced-icon">
            </lord-icon>
        </a>
        <a href="./wishlist.php">
            <lord-icon src="https://cdn.lordicon.com/kkcllwsu.json" trigger="loop-on-hover" colors="primary:#ffffff" class="header__advanced-icon">
            </lord-icon>
        </a>
        <div class="header__user">
            <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="loop-on-hover" colors="primary:#ffffff" class="header__advanced-icon">
            </lord-icon>
            <ul class="header__user-dropdown">
                <li class="header__user-dropdown-item" style="border-radius: 12px 12px 0px 0px;"><a href="./profile.php"> Tài Khoản</a></li>
                <li class="header__user-dropdown-item"><a href="./yourStore.php"> Cửa hàng của bạn</a></li>
                <li class="header__user-dropdown-item"><a href="./orderList.php"> Đơn mua</a></li>
                <li class="header__user-dropdown-item"><a href="./orderList-seller.php"> Đơn bán</a></li>
                <li class="header__user-dropdown-item" style="border-radius: 0px 0px 12px 12px;"><a href="./logout.php"> Đăng xuất</a></li>
            </ul>
        </div>
    </div>
</div>