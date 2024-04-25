<?php
    session_start();

    $prod = [];
    $prod['ID'] = $_POST['prodid'];
    $prod['VALUE'] = $_POST['value'];
    $prod['AMOUNT'] = $_POST['prodprice'];

    
    if(isset($_SESSION['basket']) && $_SESSION['basket'] !== '') {
        $basket = $_SESSION['basket'];
    } else $basket = [];
    
    array_push($basket, $prod);

    $_SESSION['basket'] = $basket;

    $sum = 0;
    $_SESSION['basketSum'] = 0;
    foreach ($_SESSION['basket'] as $value) {
        $sum += $value['AMOUNT'];
    }
    $_SESSION['basketSum'] = $sum;

?>

<p id="basketCount" class="header-line-text topbar-basket">
    <?php 
    if(isset($_SESSION['basket']) && $_SESSION['basket'] !== '') {
        echo ' '.count($_SESSION['basket']).' ';
    } else echo 0;
    ?>
</p>