<?php 
    require_once('connect.php');

    $TableProdAll = mysqli_query($ConnectDatabase, "SELECT * FROM `products`");    
    $TableProdAll = mysqli_fetch_all($TableProdAll, MYSQLI_ASSOC);
    
    $series = [];
    $prov = true;

    foreach($TableProdAll as $item) {
        foreach($series as $item_series) {
            if($item['SERIES'] == $item_series) {
                $prov = false;
                break;
            }
        }
        if ($prov) {
            $series[] = $item['SERIES'];
        }
        $prov = true;
    }

?>