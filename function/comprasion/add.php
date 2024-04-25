<?php 
    session_start();

    $prod = [];
    $prod['ID'] = $_POST['prodid'];

    if(isset($_SESSION['comprasion']) && $_SESSION['comprasion'] !== '') {
        $comprasion = $_SESSION['comprasion'];
    } else $comprasion = [];

    if (count($comprasion) < 3) {
        array_push($comprasion, $prod);
        $_SESSION['comprasion'] = $comprasion;
        ?>
            <p id="comprasionCount" class="header-line-text topbar-basket">
                <?php 
                if(isset($_SESSION['comprasion']) && $_SESSION['comprasion'] !== '') {
                    echo ' '.count($_SESSION['comprasion']).' ';
                } else echo 0;
                ?>
            </p>  
        <?php
    }
?>
