<?php 
    require_once('../config/products.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/catalog.css">
    <link rel="stylesheet" href="../css/catalog-admin.css">
</head>
<body>
    
<?php 
    require_once('header-admin.php')
?>

<div id="title-category">
    <div class="layout">
        <h1 class="title-category">
            Каталог
        </h1>
        <a href="addProdAdm.php">
            <button class="update" type="button">Добавить товар</button>
        </a>
    </div>
</div>

<div id="catalog-body">
    <div class="layout">
        <div id="filters">
        <form action="" method="get" id="formFilters">
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
                    addProdListAdm($TableProd, $TablePhotos);
                ?>
            </div>


        </div>
    </div>
</div>

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
            if (url.indexOf('?') > -1) {
                url = url + '&sort=' + sort;
            } else {
                url = url + '?sort=' + sort;
            }
        }
        
        let xhr = new XMLHttpRequest();   

        xhr.responseType = 'document';  
        
        xhr.open('GET', url);

        xhr.send();
        xhr.onload = () => {
            document.getElementById('block-prod-list').innerHTML = xhr.response.getElementById('block-prod-list').innerHTML;
        } 
    }
    
    function delProd(id) {
        let formData = new FormData();
        formData.append('idProd', id);
        var url = '../function/product/del.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.responseType = 'document';
        xhr.send(formData);
        xhr.onload = () => {
            alert('Товар удален');
            document.getElementById('block-prod-list').innerHTML = xhr.response.getElementById('block-prod-list').innerHTML;
        } 
    }

</script>

</body>
</html>