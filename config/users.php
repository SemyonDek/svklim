<?php 
    require_once('connect.php');

    $TableUsers = mysqli_query($ConnectDatabase, "SELECT * FROM `users`");    
    $TableUsers = mysqli_fetch_all($TableUsers, MYSQLI_ASSOC);
?>