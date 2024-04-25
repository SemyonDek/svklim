<?php 
    session_start();
    require_once('config/products.php');
    require_once('config/category.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сравнение</title>
    <link rel="stylesheet" href="css/comparison.css">
</head>
<body>
<?php 
    require_once('header-user.php');
?>
<div id="title-category">
    <div class="layout">
        <div id="breadcrumbs">
            <a href="index.php" class="breadcrumbs-link" >Главная</a>
            <a href="comparison.php" class="breadcrumbs-link active">Сравнение</a>
        </div>
        <h1 class="title-category">
            Сравнение
        </h1>
    </div>
</div>
<div id="comparison-block-prod">
    <div class="layout">
        <div class="column column_1">
            <div class="clear-comparison-block">
                <button type="button" onclick="delComprasion()">
                    Очистить весь список
                </button>
            </div>
        </div>
        <?php
            if ($_SESSION['comprasion'] !== '') {
                addComprasionProd($_SESSION['comprasion'], $TableProd, $TablePhotos);
            }
        ?>
    </div>
</div>
<div id="comparison-block-info">
    <div class="layout">
        <div class="column column_1">
            <div class="title-prod">
                Основные характеристики
            </div>
            <ul class="parametrs-prod">
                <li><span>Тип</span></li>
                <li><span>Класс</span></li>
                <li><span>S помещения</span></li>
                <li><span>Инвертор</span></li>
                <li><span>Производитель</span></li>
                <li><span>Серия</span></li>
                <li><span>Уровень шума</span></li>
                <li><span>Мощность</span></li>
                <li><span>Гарантия</span></li>
            </ul>
        </div>
        <?php
            if ($_SESSION['comprasion'] !== '') {
                addComprasionInfo($_SESSION['comprasion'], $TableProd, $TableCat);
            }
        ?>
    </div>
</div>
<?php 
    require_once('footer-user.php'); 
?>
<script>
    function delComprasion() {
        var url = 'function/comprasion/del.php';
        let xhr = new XMLHttpRequest();   
        xhr.responseType = 'document';  
        xhr.open('POST', url);
        xhr.send();
        xhr.onload = () => {
            document.getElementById('comprasionCount').innerHTML = xhr.response.getElementById('comprasionCount').innerHTML;
            document.getElementById('comparison-block-prod').innerHTML = xhr.response.getElementById('comparison-block-prod').innerHTML;
            document.getElementById('comparison-block-info').innerHTML = xhr.response.getElementById('comparison-block-info').innerHTML;
        } 
    }
</script>
</body>
</html>