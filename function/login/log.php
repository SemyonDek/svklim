<?php 
    session_start();
    require_once('../../config/connect.php');

    $login = $_POST['login'];
    $password = $_POST['password'];
    
    if($login == "admin" && $password == "a"){
        $_SESSION['account'] = 'admin';
    } else {
        $Account = mysqli_query($ConnectDatabase, "SELECT * FROM `users` WHERE LOGIN = '$login' AND PASS = '$password'");    
        $Account = mysqli_fetch_all($Account, MYSQLI_ASSOC);
        if($Account !== []){
            $_SESSION['account'] = 'user';  
            $_SESSION['accountId'] = $Account[0]['ID'];  
        } else {
            echo "Данные не верны";
        }
    }

?>