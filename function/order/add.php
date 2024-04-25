<?php 
    session_start();
    require_once('../../config/connect.php');

    $name = $_POST['fioOrder'];
    $number = $_POST['numberOrder'];
    $mail = $_POST['mailOrder'];
    $addres = 'г. '.$_POST['cityOrder'].' ул. '.$_POST['streetOrder'].' д. '.$_POST['houseOrder'].' кв. '.$_POST['flatOrder'];
    $comment = $_POST['commOrder'];
    $sum = $_SESSION['basketSum'];
    if (isset($_SESSION['account'])) {
        $idAccount = $_SESSION['accountId'];
    } else {
        $idAccount = 0;
    }

    mysqli_query($ConnectDatabase, "INSERT INTO `orders` 
    (`ID`, `IDUSER`, `NAME`, `NUMBER`, `MAIL`, `ADDRES`, `COMM`, `SUM`, `STATUS`) VALUES 
    (NULL, '$idAccount', '$name', '$number', '$mail', '$addres', '$comment', '$sum', '1')");

    $idOrder = mysqli_query($ConnectDatabase, "SELECT MAX(id) FROM `orders`"); 
    $idOrder = mysqli_fetch_all($idOrder);
    $idOrder = $idOrder[0][0];

    foreach($_SESSION['basket'] as $item) {
        $idProd = $item['ID'];
        $value = $item['VALUE'];
        $amount = $item['AMOUNT'];
        
        mysqli_query($ConnectDatabase, "INSERT INTO `order_item` 
        (`IDORDER`, `IDPROD`, `VALUE`, `SUMM`) VALUES 
        ('$idOrder', '$idProd', '$value', '$amount')");
    }

    $_SESSION['basket'] = '';
    $_SESSION['basketSum'] = 0;

    echo 'Заказ оформлен';
?>