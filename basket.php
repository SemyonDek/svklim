<?php 
    require_once('config/products.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="css/basket.css">
</head>
<body>
<?php 
    require_once('header-user.php');
?>
<div id="title-category">
    <div class="layout">
        <div id="breadcrumbs">
            <a href="index.php" class="breadcrumbs-link" >Главная</a>
            <a href="basket.php" class="breadcrumbs-link active">Корзина</a>
        </div>
        <h1 class="title-category">
            Моя корзина
        </h1>
    </div>
</div>
<div id="basket-body">
    <div class="layout">
        <form action="" id="basket-form" >
            <table id="basket-table">
                <thead>
                    <tr>
                        <td class="clear"></td>
                        <td class="img"><div class="div-td-basket-icon"></div></td>
                        <td class="name"><h5>Корзина</h5></td>
                        <td class="quantity"></td>
                        <td class="price"></td>
                        <td class="del"></td>
                        <td class="clear"></td>
                    </tr>
                </thead>
                <tbody id="bodyBasket">
                    <?php
                        if ($_SESSION['basket'] !== '') {
                            addBasketBody($_SESSION['basket'], $TableProd, $TablePhotos);
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="clear"></td>
                        <td class="img"></td>
                        <td class="name"></td>
                        <td class="quantity">Итого:</td>
                        <td id="finalPrice" class="price">
                            <span>
                                <?php 
                                    if(isset($_SESSION['basketSum']) && $_SESSION['basketSum'] !== '') {
                                        echo number_format($_SESSION['basketSum'], 0, '.', ' ');
                                    } else echo 0;
                                ?>
                                руб.
                            </span>    
                        </td>
                        <td class="del"></td>
                        <td class="clear"></td>
                    </tr>
                </tfoot>
            </table>
            <button type="button" onclick="order()">Оформить заказ</button>
        </form>
    </div>
</div>
<?php 
    require_once('footer-user.php'); 
?>
<script>
    function delBasketItem(id) {
        let formData = new FormData();
        formData.append('id', id);
        var url = 'function/basket/del.php';
        let xhr = new XMLHttpRequest();   
        xhr.responseType = 'document';  
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            console.log(xhr.response);
            document.getElementById('basketCount').innerHTML = xhr.response.getElementById('basketCount').innerHTML;
            document.getElementById('bodyBasket').innerHTML = xhr.response.getElementById('bodyBasket').innerHTML;
            document.getElementById('finalPrice').innerHTML = xhr.response.getElementById('finalPrice').innerHTML;
        } 
    }

    function order() {
        if (document.getElementById('bodyBasket').querySelectorAll('tr').length !== 0) {
            window.location.replace("order.php");
        } else {
            alert('Корзина пуста')
        }
    }
</script>
</body>
</html>