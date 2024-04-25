<?php 
    require_once('connect.php');

    $TableOrderItem = mysqli_query($ConnectDatabase, "SELECT * FROM `order_item`");    
    $TableOrderItem = mysqli_fetch_all($TableOrderItem, MYSQLI_ASSOC);
?>