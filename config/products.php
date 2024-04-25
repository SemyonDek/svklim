<?php 
    require_once('connect.php');
    require_once('photos.php');
    require_once('producer.php');
    require_once('series.php');
    require_once('filters.php');

    $TableProd = mysqli_query($ConnectDatabase, "SELECT * FROM `products` 
    WHERE PRICE BETWEEN $min_prod_mass AND $max_prod_mass $str_class $str_producer $str_series $searchStr $idChildProd $sort"); 
    $TableProd = mysqli_fetch_all($TableProd, MYSQLI_ASSOC);

    function addProdList($TableProd, $TablePhotos) {
        foreach($TableProd as $value) {
            $photo = '';
            foreach ($TablePhotos as $photoVal) {
                if ($photoVal['IDPROD'] == $value['ID']) {
                    $photo = $photoVal['SRC'];
                    break;
                }
            }
            ?>
                <div class="prod-item">
                    <div class="prod-item-block">
                        <a href="product-card.php?id=<?= $value['ID'] ?>">
                            <img class="prod-img" src="<?= $photo ?>" alt="">
                        </a>
                        <div class="prod-caption">
                            <a href="product-card.php?id=<?= $value['ID'] ?>">
                                <?= $value['NAME'] ?>
                            </a>
                        </div>
    
                        <div class="prod-price">
                            <div class="price-quantity">
                                <span class="prod-price-num">
                                    <?= number_format($value['PRICE'], 0, '.', ' ') ?>  
                                </span>
                                руб.
                            </div>
                            <div class="button-buy">
                                <input type="button" class="buy-prod" value="в корзину" onclick="addBasket(<?= $value['ID'] ?>, <?= $value['PRICE'] ?>)" >
                            </div>

                        </div>
                    </div>
                </div>

            <?php
        }
    }
    function addProdListAdm($TableProd, $TablePhotos) {
        foreach($TableProd as $value) {
            $photo = '';
            foreach ($TablePhotos as $photoVal) {
                if ($photoVal['IDPROD'] == $value['ID']) {
                    $photo = $photoVal['SRC'];
                    break;
                }
            }
            ?>
                <div class="prod-item">
                    <div class="prod-item-block">
                        <div>
                            <img class="prod-img" src="../<?= $photo ?>" alt="">
                            <button class="delProd" type="button" onclick="delProd(<?= $value['ID'] ?>)" >x</button>
                        </div>
                        <div class="prod-caption">
                            <?= $value['NAME'] ?>
                        </div>
    
                        <div class="prod-price">
                            <div class="price-quantity">
                                <span class="prod-price-num">
                                    <?= number_format($value['PRICE'], 0, '.', ' ') ?>  
                                </span>
                                руб.
                            </div>
                            <div class="button-buy">
                                <a href="updProdAdm.php?id=<?= $value['ID'] ?>">
                                    <input type="button" class="buy-prod" value="изменить">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
        }
    }

    function addFilterClass($producerGet = []) {
        ?>
            <h4>Класс</h4>
            <div class="checkbox-block">

                <div class="line-checkbox">
                    <input id="class-checkbox-1" name="class[0]" type="checkbox" <?php
                        if (isset($producerGet[0])) echo "checked";
                        ?>/>
                    <label for="class-checkbox-1">
                        <p class="checkbox-text">
                            Премиум 
                        </p>
                    </label>
                </div>

                <div class="line-checkbox">
                    <input id="class-checkbox-2" name="class[1]" type="checkbox" <?php
                        if (isset($producerGet[1])) echo "checked";
                        ?>/>
                    <label for="class-checkbox-2">
                        <p class="checkbox-text">
                            Дизайн
                        </p>
                    </label>
                </div>

                <div class="line-checkbox">
                    <input id="class-checkbox-3" name="class[2]" type="checkbox" <?php
                        if (isset($producerGet[2])) echo "checked";
                        ?>/>
                    <label for="class-checkbox-3">
                        <p class="checkbox-text">
                            Комфорт 
                        </p>
                    </label>
                </div>

                <div class="line-checkbox">
                    <input id="class-checkbox-4" name="class[3]" type="checkbox" <?php
                        if (isset($producerGet[3])) echo "checked";
                        ?>/>
                    <label for="class-checkbox-4">
                        <p class="checkbox-text">
                            Эконом 
                        </p>
                    </label>
                </div>
            </div>
        <?php
    }

    function addFilterProducer($producer, $producerGet = []) {
        ?>
        <h4>Произодитель</h4>
        <div class="checkbox-block">
            <?php 
                foreach($producer as $key => $item) {
                    ?>
                        <div class="line-checkbox">
                            <input id="producer-checkbox-<?= $key ?>" name="producer[<?= $key ?>]" type="checkbox" <?php
                            if (isset($producerGet[$key])) echo "checked";
                            ?>/>
                            <label for="producer-checkbox-<?= $key ?>">
                                <p class="checkbox-text">
                                    <?= $item ?>
                                </p>
                            </label>
                        </div>
                    <?
                }
            ?>
        </div>
        <?php
    }

    function addFilterSeries($series, $seriesGet = []) {
        ?>
        <h4>Серия</h4>
        <div class="checkbox-block">
            <?php 
                foreach($series as $key => $item) {
                    ?>
                        <div class="line-checkbox">
                            <input id="series-checkbox-<?= $key ?>" name="series[<?= $key ?>]" type="checkbox" <?php
                            if (isset($seriesGet[$key])) echo "checked";
                            ?>/>
                            <label for="series-checkbox-<?= $key ?>">
                                <p class="checkbox-text">
                                    <?= $item ?>
                                </p>
                            </label>
                        </div>
                    <?
                }
            ?>
        </div>
        <?php
    }
    
    function addBasketBody($idProdBasket, $TableProd, $TablePhotos) {
        foreach($idProdBasket as $key => $item_basket) {
            foreach($TableProd as $valueProd) {

                if ($valueProd['ID'] == $item_basket['ID']) {

                    $photo = '';
                    foreach ($TablePhotos as $valuePhoto) {
                        if ($valuePhoto['IDPROD'] == $valueProd['ID']) {
                            $photo = $valuePhoto['SRC'];
                            break;
                        }
                    }
                    ?>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"><img src="<?= $photo ?>" alt=""></td>
                            <td class="name"><a href="product-card.php?id=<?= $valueProd['ID'] ?>"><?= $valueProd['NAME'] ?></a></td>
                            <td class="quantity">
                                <span>
                                    <?= $item_basket['VALUE'] ?>     
                                </span>
                                шт.
                            </td>
                            <td class="price">
                                <span><?= $item_basket['AMOUNT'] ?></span>    
                                руб.
                            </td>
                            <td class="del">
                                <button class="delProdBasket" type="button" onclick="delBasketItem(<?= $key ?>)">✕</button>
                            </td>
                            <td class="clear"></td>
                        </tr>

                    <?php
                    break;
                }
            }
        }
    }

    function addComprasionProd($idProdComprasion, $TableProd, $TablePhotos) {
        $i = 1;
        foreach($idProdComprasion as $item) {
            $i++;
            if ($i < 5) {
                ?>
                    <div class="column column_<?= $i ?>">
                        <?php 
                            foreach($TableProd as $itemProd) {
                                if ($itemProd['ID'] == $item['ID']) {

                                    $photo = '';
                                    foreach ($TablePhotos as $valuePhoto) {
                                        if ($valuePhoto['IDPROD'] == $itemProd['ID']) {
                                            $photo = $valuePhoto['SRC'];
                                            break;
                                        }
                                    }
                                    ?>
                                        <div class="prod-item">
                                            <div class="prod-item-block">
                                                <a href="product-card.php?id=<?= $itemProd['ID'] ?>">
                                                    <img class="prod-img" src="<?= $photo ?>" alt="">
                                                </a>
                                                <div class="prod-caption">
                                                    <a href="product-card.php?id=<?= $itemProd['ID'] ?>">
                                                        <?= $itemProd['NAME'] ?>
                                                    </a>
                                                </div>

                                                <div class="prod-price">
                                                    <div class="price-quantity">
                                                        <span class="prod-price-num">
                                                            <?= $itemProd['PRICE'] ?>  
                                                        </span>
                                                        руб.
                                                    </div>
                                                    <div class="button-buy">
                                                        <input type="button" class="buy-prod" value="в корзину" onclick="addBasket(<?= $itemProd['ID'] ?>, <?= $itemProd['PRICE'] ?>)">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    break;
                                }
                            }
                        ?>
                    </div>
                <?php
            } else {
                break;
            }
        } 
    }

    function addComprasionInfo($idProdComprasion, $TableProd, $TableCat) {
        $i = 1;
        foreach($idProdComprasion as $item) {
            $i++;
            if ($i < 5) {
                ?>
                    <div class="column column_<?= $i ?>">
                        <?php 
                            foreach($TableProd as $itemProd) {
                                if ($itemProd['ID'] == $item['ID']) {
                                    $cat = '';
                                    foreach ($TableCat as $itemCat) {
                                        if ($itemCat['ID'] == $itemProd['IDCAT']) {
                                            $cat = $itemCat['NAME'];
                                            break;
                                        }
                                    }
                                    ?>
                                        <ul class="parametrs-prod colomn_prod">
                                            <li><span><?= $cat ?></span></li>
                                            <li><span><?php 
                                                if ($itemProd['CLASS'] == 1) {
                                                    echo 'Премиум';
                                                } elseif ($itemProd['CLASS'] == 2) {
                                                    echo 'Дизайн';
                                                } elseif ($itemProd['CLASS'] == 3) {
                                                    echo 'Комфорт';
                                                } elseif ($itemProd['CLASS'] == 4) {
                                                    echo 'Эконом';
                                                }
                                            ?></span></li>
                                            <li><span><?= $itemProd['SQUARE'] ?> м²</span></li>
                                            <li><span><?php
                                                if($itemProd['INVER'] == 1) {
                                                    echo 'Есть';
                                                } else echo 'Нет'
                                            ?></span></li>
                                            <li><span><?= $itemProd['PRODUCER'] ?></span></li>
                                            <li><span><?= $itemProd['SERIES'] ?></span></li>
                                            <li><span><?= $itemProd['NOISE'] ?> дБ</span></li>
                                            <li><span><?= $itemProd['POWER'] ?> кВт</span></li>
                                            <li><span><?= $itemProd['GUARANTEE'] ?></span></li>
                                        </ul>
                                    <?php
                                    break;
                                }
                            }
                        ?>
                    </div>
                <?php
            } else {
                break;
            }
        } 
    }
?>