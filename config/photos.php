<?php 
    require_once('connect.php');

    $TablePhotos = mysqli_query($ConnectDatabase, "SELECT * FROM `photos`");    
    $TablePhotos = mysqli_fetch_all($TablePhotos, MYSQLI_ASSOC);
?>