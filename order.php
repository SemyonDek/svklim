<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <link rel="stylesheet" href="css/order.css">
</head>
<body>  
<?php 
    require_once('header-user.php');
?>
<div id="title-category">
    <div class="layout">
        <div id="breadcrumbs">
            <a href="" class="breadcrumbs-link" >Главная</a>
            <a href="" class="breadcrumbs-link active">Оформление заказа</a>
        </div>
        <h1 class="title-category">
            Оформление заказа
        </h1>
    </div>
</div>
<div id="order-body">
    <div class="layout">
        <div class="left-block">
            <form action="" id="info-order-form">
                <div class="block-in-form">
                    <div class="title-info-block">
                        <div class="icon-info-user"></div>
                        <h5>Получатель заказа</h5>
                    </div>
                    <div class="input-info-block">
                        <div class="input-info-block-div">
                            <i class="name-icon-input icon"></i>
                            <input class="input-basic" placeholder="Ф.И.О." type="text" name="fioOrder" id="fioOrder" value="">
                        </div>
                        <div class="input-info-block-div">
                            <i class="tele-icon-input icon"></i>
                            <input class="input-basic" placeholder="Ваш Номер" type="number" name="numberOrder" id="numberOrder" autocomplete="on" value="">
                        </div>
                        <div class="input-info-block-div">
                            <i class="mail-icon-input icon"></i>
                            <input class="input-basic" placeholder="Ваш E-mail" type="text" name="mailOrder" id="mailOrder" value="">
                        </div>
                    </div>
                </div>
                <div class="block-in-form">
                    <div class="title-info-block">
                        <div class="icon-info-address"></div>
                        <h5>Адресс получения</h5>
                    </div>
                    <div class="input-info-block">
                        <div class="input-info-block-div">
                            <i class="address-icon-input icon icon-address"></i>
                            <input class="input-basic" placeholder="Город" type="text" name="cityOrder" id="cityOrder" value="">
                        </div>
                        <div class="input-info-block-div">
                            <i class="address-icon-input icon icon-address"></i>
                            <input class="input-basic" placeholder="Улица" type="text" name="streetOrder" id="streetOrder" autocomplete="on" value="">
                        </div>
                        <div class="input-info-block-div input-min">
                            <i class="address-icon-input icon icon-address"></i>
                            <input class="input-basic" placeholder="Дом" type="text" name="houseOrder" id="houseOrder" value="">
                        </div>
                        <div class="input-info-block-div input-min">
                            <i class="address-icon-input icon icon-address"></i>
                            <input class="input-basic" placeholder="Кв." type="text" name="flatOrder" id="flatOrder" value="">
                        </div>
                    </div>
                </div>
                <div class="block-in-form">
                    <div class="input-info-block">
                        <textarea class="input-basic"  rows="4" name="commOrder" id="commOrder" placeholder="Комментарий к заказу"></textarea>
                    </div>
                </div>
                <button type="button" onclick="addOrder()">Оформить заказ</button>
            </form>
        </div>
        <div class="right-block">
            <div class="block-in-form">
                <div class="title-info-block">
                    <div class="div-td-basket-icon"></div>
                    <h5>Ваш заказ</h5>
                </div>
                <div class="title-info-block text-block-order">
                    <p class="order-sum-text">
                        <?php 
                            if(isset($_SESSION['basket']) && $_SESSION['basket'] !== '') {
                                echo count($_SESSION['basket']);
                            } else echo 0;
                        ?> шт. товаров в заказе
                    </p>
                    <p class="order-sum-text">
                        Всего на сумму:
                        <span class="price-order">
                            <?php 
                                if(isset($_SESSION['basketSum']) && $_SESSION['basketSum'] !== '') {
                                    echo number_format($_SESSION['basketSum'], 0, '.', ' ');
                                } else echo 0;
                            ?>
                            <span>р.</span>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="clear-both"></div>
    </div>
</div>
<?php 
    require_once('footer-user.php'); 
?>
<script>
    function addOrder() {
        const form = document.getElementById('info-order-form');
        const { elements } = form;
        const data = Array.from(elements)
            .filter((item) => !!item.name)
            .map((element) => {
            const { name, value } = element

            return { name, value }
        })           
        style_input_red = 'border-color: red;';
        style_input_gray = 'border-color: #bababa;';
        prov = true;
        data.forEach(element => {
            if (element['value'] == '' && (!element['name'].startsWith('commOrder'))) {
                document.getElementById(element['name']).style = style_input_red;
                prov = false;
            } else {
                document.getElementById(element['name']).style = style_input_gray;
            }
        });
        if (!prov) return;
        let formData = new FormData(form);
        var url = 'function/order/add.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            alert(xhr.response);
            window.location.replace("index.php");
        } 
    }
</script>
</body>
</html>