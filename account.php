<?php
session_start();
if (!isset($_SESSION['account'])) {
    header('Location: index.php');
}
require_once('config/orders.php');
require_once('config/products.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заказы</title>
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/basket.css">
    <link rel="stylesheet" href="css/orders-admin.css">
</head>

<body>
    <?php
    require_once('header-user.php');
    ?>
    <div id="title-category">
        <div class="layout">
            <div id="breadcrumbs">
                <a href="index.php" class="breadcrumbs-link">Главная</a>
                <a href="account.php" class="breadcrumbs-link active">Мои заказы</a>
            </div>
            <h1 class="title-category">
                Мои зазказы
            </h1>
        </div>
    </div>
    <div id="basket-body">
        <div class="layout">
            <?php
            addOrdersListUser($TableOrders, $TableOrderItem, $TableProd, $TablePhotos);
            ?>
        </div>
    </div>
    <?php
    require_once('footer-user.php');
    ?>
</body>

</html>