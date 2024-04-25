<?php
    require_once('../../config/connect.php');

    $id = $_POST['idCat'];
    $idCat = $_POST['idParent'];

    $Cat = mysqli_query($ConnectDatabase, "SELECT * FROM `category` WHERE `ID`='$id'");
    $Cat = mysqli_fetch_assoc($Cat);
    $TableProd = mysqli_query($ConnectDatabase, "SELECT * FROM `products`"); 
    $TableProd = mysqli_fetch_all($TableProd, MYSQLI_ASSOC);
    
    $prov = true;
    foreach ($TableProd as $item) {
        if ($item['IDCAT'] == $id) {
            $prov = false;
        }
    }

    if ($prov) {
        unlink('../../'.$Cat['PHOTO']);
        mysqli_query($ConnectDatabase, "DELETE FROM category WHERE `category`.`ID` = $id");
        require_once('../../config/category.php');
        addCategoryAdm($TableCat, $idCat);
    }
?>