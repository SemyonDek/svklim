<?php 
    session_start();  
    if(isset($_SESSION['account'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<?php 
    require_once('header-user.php');
?>
<div id="title-category">
    <div class="layout">
        <div id="breadcrumbs">
            <a href="" class="breadcrumbs-link" >Главная</a>
            <a href="" class="breadcrumbs-link active">Авторизация</a>
        </div>
        <h1 class="title-category">
            Авторизация
        </h1>
    </div>
</div>
<div id="login-body">
    <div class="layout">
        <form id="login_account" action="">
            <div class="block-in-form">
                <div class="title-info-block">
                    <div class="icon-info-user"></div>
                    <h5>Авторизация на сайте</h5>
                </div>
                <div class="input-info-block">
                    <div class="input-info-block-div">
                        <i class="login-icon-input icon"></i>
                        <input class="input-basic" placeholder="Логин" type="text" name="login" id="login" value="">
                    </div>
                    <div class="input-info-block-div">
                        <i class="password-icon-input icon"></i>
                        <input class="input-basic" placeholder="Пароль" type="password" name="password" id="password" autocomplete="on" value="">
                    </div>
                </div>
                <button type="button" onclick="loginAccount()" >ВОЙТИ</button>
            </div>
        </form>
    </div>
</div>
<?php 
    require_once('footer-user.php'); 
?>
<script>
    function loginAccount() {
        let form = document.getElementById('login_account');
        let formData = new FormData(form);
        var url = 'function/login/log.php';
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            if (xhr.response == '') {
                window.location.replace("index.php");
            } else {
                alert(xhr.response);
            }   
        }
    }
</script>
</body>
</html>