<?php
    session_start();

    if(!isset($_SESSION['account']) || $_SESSION['account'] !== 'admin') {
        header('Location: ../index.php');
    }
?>

<link rel="stylesheet" href="../css/header-user.css">
<link rel="stylesheet" href="../css/font.css">

<div id="header-line">
    <div class="layout">

        <div id="tobar-menu">
            <a href="index-admin.php" class="">
                <p id="orders" class="header-line-text">
                    Главная
                </p>   
            </a>
            <a href="catalog-admin.php" class="">
                <p id="orders" class="header-line-text">
                    Каталог
                </p>   
            </a>
            <a href="reviews-admin.php" class="">
                <p id="reviews" class="header-line-text">
                    Отзывы
                </p>   
            </a>
            <a href="orders-admin.php" class="">
                <p id="orders" class="header-line-text">
                    Заказы
                </p>   
            </a>
        </div>
        
        <div id="topbar-user">
            <a href="../function/login/unlog.php" id="login" class="">
                <div id="login-img" class="topbar-img"></div>
                <p class="header-line-text">
                    Выход
                </p>   
            </a>
        </div>

    </div>
</div>

<div id="header-category">
    <div class="layout">
        <div class="menu">

            <div class="section-menu-header__item section-menu-header--31">
                <a class="dropdown-toggle" href="category-admin.php?idcat=1">
                    <span class="img">
                        <i class="sp3 sp3-icon-konditsionery"></i>
                    </span>

                    <span class="title">Кондиционеры</span>
                </a>
            </div>
            
            <div class="section-menu-header__item section-menu-header--56">
                <a class="dropdown-toggle" href="category-admin.php?idcat=2">
                    <span class="img">
                        <i class="sp3 sp3-icon-ventilyatsiya"></i>
                    </span> <span class="title">Вентиляция</span>
                </a> 
            </div>

            <div class="section-menu-header__item section-menu-header--65">
                <a class="dropdown-toggle" href="category-admin.php?idcat=3">
                    <span class="img">
                        <i class="sp3 sp3-icon-mikroklimat"></i>
                    </span>
                    <span class="title">Микроклимат</span>
                </a> 
            </div>

        </div>

    </div>
</div>