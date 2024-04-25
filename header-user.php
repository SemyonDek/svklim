<?php 
    session_start();  
    if(isset($_SESSION['account']) && $_SESSION['account'] == 'admin') {
        header('Location: admin/index-admin.php');
    }
?>
<link rel="stylesheet" href="css/header-user.css">
<link rel="stylesheet" href="css/font.css">
<div id="header-line">
    <div class="layout">
        <?php 
            if(isset($_SESSION['account'])) {
                ?>
                    <div id="topbar-user-order">
                        <a href="account.php" id="user-order" class="">
                            <p class="header-line-text">
                                Мои заказы
                            </p>   
                        </a>
                    </div>
                <?php
            }
        ?>
        <div id="topbar-basket">
            <a href="basket.php" id="basket" class="topbar-basket-link">
                <div id="basket-img" class="topbar-img"></div>
                <p id="basketCount" class="header-line-text topbar-basket">
                    <?php 
                    if(isset($_SESSION['basket']) && $_SESSION['basket'] !== '') {
                        echo count($_SESSION['basket']);
                    } else echo 0;
                    ?>
                </p>   
            </a>
            <a href="comparison.php" id="comparison" class="topbar-basket-link">
                <div id="comparison-img" class="topbar-img"></div>
                <p id="comprasionCount" class="header-line-text topbar-basket">
                    <?php 
                    if(isset($_SESSION['comprasion']) && $_SESSION['comprasion'] !== '') {
                        echo count($_SESSION['comprasion']);
                    } else echo 0;
                    ?>
                </p>   
            </a>
        </div>
        <?php 
            if(isset($_SESSION['account'])) {
                ?>
                    <div id="topbar-user">
                        <a href="function/login/unlog.php" id="login" class="">
                            <div id="login-img" class="topbar-img"></div>
                            <p class="header-line-text">
                                Выход
                            </p>   
                        </a>
                    </div>
                <?php
            } else {
                ?>
                    <div id="topbar-user">
                        <a href="login.php" id="login" class="">
                            <div id="login-img" class="topbar-img"></div>
                            <p class="header-line-text">
                                Вход
                            </p>   
                        </a>
                    </div>
                <?php
            }
        ?>
    </div>
</div>
<div id="header-main">
    <div class="layout">
        <div id="header-wrapper">
            <a href="index.php" id="header-logo">
                <img src="img/main/logo-desctop.svg" alt="" id="logo-img" >
            </a>
            <div id="header-search">
                <div id="header-search-slogan">кондиционеры и вентиляция с гарантией 5 лет</div>
                <div id="header-search-search">
                    <form action="search.php" method="get">
                        <input id="search-input" type="text" name="search" class="search-title__input" value="" autocomplete="off" placeholder="поиск по сайту..." required="">
                        <button type="submit" class="search-title__button d-none d-sm-block">
                            <i class="sp sp-3"></i>
                        </button>
                        <button type="button" class="search-title__button d-sm-none" id="show-search"></button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="header-category">
    <div class="layout">
        <div class="menu">
            <div class="section-menu-header__item section-menu-header--31">
                <a class="dropdown-toggle" href="category.php?idcat=1">
                    <span class="img">
                        <i class="sp3 sp3-icon-konditsionery"></i>
                    </span>
                    <span class="title">Кондиционеры</span>
                </a>
            </div>
            <div class="section-menu-header__item section-menu-header--56">
                <a class="dropdown-toggle" href="category.php?idcat=2">
                    <span class="img">
                        <i class="sp3 sp3-icon-ventilyatsiya"></i>
                    </span> <span class="title">Вентиляция</span>
                </a> 
            </div>
            <div class="section-menu-header__item section-menu-header--65">
                <a class="dropdown-toggle" href="category.php?idcat=3">
                    <span class="img">
                        <i class="sp3 sp3-icon-mikroklimat"></i>
                    </span>
                    <span class="title">Микроклимат</span>
                </a> 
            </div>
        </div>
    </div>
</div>