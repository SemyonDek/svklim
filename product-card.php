<?php 
    require_once('config/connect.php');
    require_once('config/reviews.php');
    require_once('config/users.php');
    $idProd = $_GET['id'];
    $Prod = mysqli_query($ConnectDatabase, "SELECT * FROM `products` WHERE `ID`='$idProd'");    
    $Prod = mysqli_fetch_assoc($Prod);
    $Photos = mysqli_query($ConnectDatabase, "SELECT * FROM `photos` WHERE `IDPROD`='$idProd'");    
    $Photos = mysqli_fetch_all($Photos, MYSQLI_ASSOC);
    $idCat = $Prod['IDCAT'];
    $Cat = mysqli_query($ConnectDatabase, "SELECT * FROM `category` WHERE `ID`='$idCat'");
    $Cat = mysqli_fetch_assoc($Cat);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Prod['NAME'] ?></title>
    <link rel="stylesheet" href="css/product-card.css">
    <link rel="stylesheet" href="css/order.css">
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
            <a href="catalog.php?idchildcat=<?= $Cat['ID'] ?>" class="breadcrumbs-link"><?= $Cat['NAME'] ?></a>
            <a href="product-card.php?id=<?= $idProd ?>" class="breadcrumbs-link active"><?= $Prod['NAME'] ?></a>
        </div>
        <h1 class="title-category">
            <?= $Prod['NAME'] ?>
        </h1>
    </div>
</div>
<div id="product-card-body">
    <div class="layout">
        <div class="left-block">
            <div class="row-body">
                <div class="photo-block">
                    <div class="main-photo">
                        <img id="main-photo-block" src="<?= $Photos[0]['SRC'] ?>" alt="">
                    </div>
                    <div class="list-photo">
                        <?php 
                            $i = 0;
                            foreach($Photos as $item) {
                                $i++;
                                if ($i == 1) {
                                    ?>
                                        <img id="photo-prod_<?= $i ?>" onclick="swipePhotos(<?= $i ?>)" class="active-photo" src="<?= $item['SRC'] ?>" alt="">
                                    <?php
                                } else {
                                    ?>
                                        <img id="photo-prod_<?= $i ?>" onclick="swipePhotos(<?= $i ?>)" class="" src="<?= $item['SRC'] ?>" alt="">
                                    <?php
                                }
                            }
                        ?>
                    </div>    
                </div>
                <div class="main-info-block">
                    <div class="title-prod">
                        Основные характеристики
                    </div>
                    <ul class="parametrs-prod">
                        <li>
                            <span>Тип</span>
                            <span><?= $Cat['NAME'] ?></span>
                        </li>
                        <li>
                            <span>Класс</span>
                            <span>
                            <?php 
                                if ($Prod['CLASS'] == 1) {
                                    echo 'Премиум';
                                } elseif ($Prod['CLASS'] == 2) {
                                    echo 'Дизайн';
                                } elseif ($Prod['CLASS'] == 3) {
                                    echo 'Комфорт';
                                } elseif ($Prod['CLASS'] == 4) {
                                    echo 'Эконом';
                                }
                            ?>
                            </span>
                        </li>
                        <li>
                            <span>S помещения</span>
                            <span><?= $Prod['SQUARE'] ?> м²</span>
                        </li>
                        <li>
                            <span>Инвертор</span>
                            <span>
                                <?php 
                                    if ($Prod['INVER'] == 0) {
                                        echo 'Нет';
                                    } elseif ($Prod['INVER'] == 1) {
                                        echo 'Есть';
                                    } 
                                ?>
                            </span>
                        </li>
                        <li>
                            <span>Производитель</span>
                            <span><?= $Prod['PRODUCER'] ?></span>
                        </li>
                        <li>
                            <span>Серия</span>
                            <span><?= $Prod['SERIES'] ?></span>
                        </li>
                        <li>
                            <span>Уровень шума</span>
                            <span><?= $Prod['NOISE'] ?> дБ</span>
                        </li>
                        <li>
                            <span>Мощность</span>
                            <span><?= $Prod['POWER'] ?> кВт</span>
                        </li>
                        <li>
                            <span>Гарантия</span>
                            <span><?= $Prod['GUARANTEE'] ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="right-block">
            <form action="">
                <div class="price-prod">
                    Цена 
                    <br> 
                    <span><?= number_format($Prod['PRICE'], 0, '.', ' ') ?></span> 
                    руб. 
                </div>
                <div class="quantity-prod">
                    <span class="count-label">Количество</span>

                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="minus" id="minusQuantity">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input id="quantityInput" type="text" class="countAddProd form-control" value="1" onkeypress="return false">
                        <div class="input-group-btn">
                            <button type="button" class="plus" id="plusQuantity">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addBasket(<?= $idProd ?>, <?= $Prod['PRICE'] ?>)">
                    Добавить в корзину
                </button>
                <button type="button" onclick="addComprasion(<?= $idProd ?>)">
                    Добавить товар к сравнению
                </button>
            </form>
        </div>
        <div class="left-block">
            <ul class="nav nav-tabs">
                <li class="active-li" id="tabDesc-li">
                    <button type="button" id="tabDesc">Описание</button>
                </li>
                <li class="" id="tabRev-li">
                    <button type="button" id="tabRev">Отзывы</button>
                </li>
            </ul>
            <div class="tab-content" id="tab-content">
                <div class="tab-pane active-div" id="tab-about">
                    <p style="text-align: justify;">
                        <?= nl2br($Prod['DESCRIPTION']) ?>
                    </p>
                </div>
                <div class="tab-pane" id="tab-replies">
                    <?php 
                        if(isset($_SESSION['account'])) {
                            ?>
                                <form action="" id="commForm">
                                    <textarea class="input-basic" name="commText" id="commText" rows="6" placeholder="Текст комментария"></textarea>
                                    <br>
                                    <button type="button" onclick="addComm(<?= $idProd ?>)">Отправить</button>
                                    <br>
                                </form>
                            <?php
                        }
                    ?>
                    <ul id="commList" class="comment-list">
                        <?php 
                            addCommProd($TableReviews, $TableUsers);
                        ?>
                    </ul>
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
    minusQuantity.onclick = function() {
        if (quantityInput.value > 1) {
            quantityInput.value = Number(quantityInput.value) - 1;
        } 
    };
    plusQuantity.onclick = function() {
        if (quantityInput.value < 98) {
            quantityInput.value = Number(quantityInput.value) + 1;
        }
    };

    function swipePhotos(number) {
        let mainPhoto = document.getElementById('main-photo-block');
        let swipePhoto = document.getElementById('photo-prod_' + number);
        let oldPhoto = document.getElementsByClassName('active-photo')[0];
        oldPhoto.classList.remove('active-photo');
        swipePhoto.classList.add('active-photo');
        mainPhoto.src = swipePhoto.src;
    }

    tabDesc.onclick = function() {
        document.getElementsByClassName('active-li')[0].classList.remove('active-li');
        document.getElementsByClassName('active-div')[0].classList.remove('active-div');
        document.getElementById('tab-about').classList.add('active-div');
        document.getElementById('tabDesc-li').classList.add('active-li');
    }
    tabRev.onclick = function() {
        document.getElementsByClassName('active-li')[0].classList.remove('active-li');
        document.getElementsByClassName('active-div')[0].classList.remove('active-div');
        document.getElementById('tab-replies').classList.add('active-div');
        document.getElementById('tabRev-li').classList.add('active-li');
    }

    function addBasket(id, price) {
        let formData = new FormData();
        formData.append('prodid', id);
        let value = document.getElementById('quantityInput').value; 
        formData.append('value', value);
        price = Number(price) * Number(value);
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

    function addComprasion(id) {
        let formData = new FormData();
        formData.append('prodid', id);
        var url = 'function/comprasion/add.php';
        let xhr = new XMLHttpRequest();   
        xhr.responseType = 'document';  
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            if (xhr.response.getElementById('comprasionCount') == null) {
                alert('Достигнут лимит сравнения (3 товара)')
            } else {
                document.getElementById('comprasionCount').innerHTML = xhr.response.getElementById('comprasionCount').innerHTML;
                document.getElementById('comparisonFooter').innerHTML = xhr.response.getElementById('comprasionCount').innerHTML;
            }
        } 
    }

    function addComm(idprod) {
        if (document.getElementById('commText').value == '') {
            alert('Введите комментарий')
            return;
        } else {
            let formData = new FormData();
            let commtext = document.getElementById('commText').value;
            formData.append('idprod', idprod);
            formData.append('commtext', commtext);
            var url = 'function/reviews/add.php';
            let xhr = new XMLHttpRequest();   
            xhr.responseType = 'document';  
            xhr.open('POST', url);
            xhr.send(formData);
            xhr.onload = () => {
                document.getElementById('commList').innerHTML = xhr.response.getElementById('commList').innerHTML;
                document.getElementById('commText').value = '';
            } 
        }
    }
</script>
</body>
</html>