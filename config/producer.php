<?php 
    require_once('connect.php');

    $TableProdAll = mysqli_query($ConnectDatabase, "SELECT * FROM `products`");    
    $TableProdAll = mysqli_fetch_all($TableProdAll, MYSQLI_ASSOC);

    $producer = [];
    $prov = true;

    foreach($TableProdAll as $item) {
        foreach($producer as $item_producer) {
            if($item['PRODUCER'] == $item_producer) {
                $prov = false;
                break;
            }
        }
        if ($prov) {
            $producer[] = $item['PRODUCER'];
        }
        $prov = true;
    }

?>