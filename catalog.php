<?php 
    require_once('config/connect.php');
    $idChild = $_GET['idchildcat'];
    $Cat = mysqli_query($ConnectDatabase, "SELECT * FROM `category` WHERE `ID`='$idChild'");
    $Cat = mysqli_fetch_assoc($Cat);
    require_once('config/products.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Cat['NAME'] ?></title>
    <link rel="stylesheet" href="css/catalog.css">
</head>
<body>
<?php 
    require_once('header-user.php');
?>
<div id="title-category">
    <div class="layout">
        <div id="breadcrumbs">
            <a href="index.php" class="breadcrumbs-link" >Главная</a>
            <a href="category.php?idcat=<?= $Cat['PARENT'] ?>" class="breadcrumbs-link">
                <?php 
                    if ($Cat['PARENT'] == 1) {
                        echo 'Кондиционеры';
                    } elseif ($Cat['PARENT'] == 2) {
                        echo 'Вентиляция';
                    } elseif ($Cat['PARENT'] == 3) {
                        echo 'Микроклимат';
                    }
                ?>
            </a>
            <a href="catalog.php?idchildcat=<?= $Cat['ID'] ?>" class="breadcrumbs-link active"><?= $Cat['NAME'] ?></a>
        </div>
        <h1 class="title-category">
            <?= $Cat['NAME'] ?>
        </h1>
    </div>
</div>
<div id="catalog-body">
    <div class="layout">
        <div id="filters">
            <form action="" method="get" id="formFilters">
                <input type="hidden" name="idchildcat" value="<?= $Cat['ID'] ?>">
                <h4>Цена</h4>
                <div id="price-filter">
                    <input type="number" name="min_price" id="min_price" class="input-filter-price" value="<?php 
                        if(isset($_GET['min_price'])) echo $_GET['min_price'];
                    ?>">
                    <span class="price-text">-</span>
                    <input type="number" name="max_price" id="max_price" class="input-filter-price" value="<?php 
                        if(isset($_GET['max_price'])) echo $_GET['max_price'];
                    ?>">
                    <span class="price-text">руб.</span>
                </div>
                <?php
                    if(isset($_GET['class'])) {
                        addFilterClass($_GET['class']);
                    } else {
                        addFilterClass();
                    }
                    if(isset($_GET['producer'])) {
                        addFilterProducer($producer, $_GET['producer']);
                    } else {
                        addFilterProducer($producer);
                    }
                    if(isset($_GET['series'])) {
                        addFilterSeries($series, $_GET['series']);
                    } else {
                        addFilterSeries($series);
                    }
                ?>
                <input type="submit" class="btn-filter" value="Применить">
            </form>
            <form action="" method="get">
                <input type="hidden" name="idchildcat" value="<?= $Cat['ID'] ?>">
                <input type="submit" class="btn-filter" value="Сбросить">
            </form>
        </div>
        <div id="list-product">
            <div id="sorting-filter">
                <p class="sort-text">
                    Сортировать по:
                    <span id="price-sort" class="" onclick="sortPrice()">
                        Цене
                        <span id="icon-sort-up" class="none"></span>
                        <span id="icon-sort-down" class="none"></span>
                    </span>
                </p>
            </div>
            <div id="block-prod-list">
                <?php 
                    addProdList($TableProd, $TablePhotos);
                ?>
            </div>
        </div>
    </div>
</div>
<?php 
    require_once('footer-user.php'); 
?>
<script>
    function sortPrice() {
        let url = document.URL;
        let priceSort = document.getElementById('price-sort');
        let up = document.getElementById('icon-sort-up');
        let down = document.getElementById('icon-sort-down');
        let sort = '';
        if (priceSort.classList == 'active-price') {
            if (up.classList == 'active') {
                up.classList.remove('active');
                up.classList.add('none');
                down.classList.remove('none');
                down.classList.add('active');
                // по убыванию
                sort = 'DESC';
                
            } else {
                priceSort.classList.remove('active-price');
                down.classList.remove('active');
                down.classList.add('none');
                // отключить
            }
        } else {
            priceSort.classList.add('active-price');
            up.classList.remove('none');
            up.classList.add('active');
            // по возрастанию
            sort = 'ASC';
        }
        if (sort !== '') {
            url = url + '&sort=' + sort;
        }
        let xhr = new XMLHttpRequest();   
        xhr.responseType = 'document';  
        xhr.open('GET', url);
        xhr.send();
        xhr.onload = () => {
            document.getElementById('block-prod-list').innerHTML = xhr.response.getElementById('block-prod-list').innerHTML;
        } 
    }

    function addBasket(id, price) {
        let formData = new FormData();
        formData.append('prodid', id);
        formData.append('value', 1);
        formData.append('prodprice', price);
        var url = 'function/basket/add.php';
        let xhr = new XMLHttpRequest();   
        xhr.responseType = 'document';  
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            document.getElementById('basketCount').innerHTML = xhr.response.getElementById('basketCount').innerHTML;
            document.getElementById('basketFooter').innerHTML = xhr.response.getElementById('basketCount').innerHTML;
        } 
    }
</script>
</body>
</html>