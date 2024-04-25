<?php 
    require_once('connect.php');

    session_start();
    if (isset($_SESSION['accountId'])) {
        $id = $_SESSION['accountId'];
        $idStr = "WHERE `IDUSER`='".$id."'";
    } else $idStr = '';

    $TableOrders = mysqli_query($ConnectDatabase, "SELECT * FROM `orders` $idStr");    
    $TableOrders = mysqli_fetch_all($TableOrders, MYSQLI_ASSOC);

    $TableOrderItem = mysqli_query($ConnectDatabase, "SELECT * FROM `order_item`");    
    $TableOrderItem = mysqli_fetch_all($TableOrderItem, MYSQLI_ASSOC);

    function addOrdersList($TableOrders, $TableOrderItem, $TableProd, $TablePhotos) {
        foreach($TableOrders as $itemOrders) {
            ?>
                <table id="basket-table">
                    <thead>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"><div class="div-td-basket-icon"></div></td>
                            <td class="name"><h5>Заказ №<?= $itemOrders['ID'] ?></h5></td>
                            <td class="quantity">
                                <select class="input-basic" name="" id="status_<?= $itemOrders['ID'] ?>">
                                    <option value="1" <?php 
                                        if ($itemOrders['STATUS'] == 1) echo 'selected="selected"'
                                    ?>>В обработке</option>

                                    <option value="2" <?php 
                                        if ($itemOrders['STATUS'] == 2) echo 'selected="selected"'
                                    ?>>Собирается</option>

                                    <option value="3" <?php 
                                        if ($itemOrders['STATUS'] == 3) echo 'selected="selected"'
                                    ?>>В доставке</option>

                                    <option value="4" <?php 
                                        if ($itemOrders['STATUS'] == 4) echo 'selected="selected"'
                                    ?>>Принят</option>
                                </select>
                            </td>
                            <td class="price">
                                <button type="button" onclick="orderUpd(<?= $itemOrders['ID'] ?>)">Изменить</button>
                            </td>
                            <td class="del"></td>
                            <td class="clear"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"><div class="icon-info-user"></div></td>
                            <td class="name"><?= $itemOrders['NAME'] ?></td>
                            <td class="quantity">
                                <?= $itemOrders['NUMBER'] ?>
                            </td>
                            <td class="price">
                                <?= $itemOrders['MAIL'] ?>
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"><div class="icon-info-address"></div></td>
                            <td class="name">
                                <?= $itemOrders['ADDRES'] ?>
                            </td>
                            <td class="quantity">
                            </td>
                            <td class="price">
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"></td>
                            <td class="name">
                                <h5>Комментарий</h5>
                            </td>
                            <td class="quantity">
                            </td>
                            <td class="price">
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"></td>
                            <td class="name">
                                <?= $itemOrders['COMM'] ?>
                            </td>
                            <td class="quantity">
                            </td>
                            <td class="price">
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"></td>
                            <td class="name">
                                <h5>Товары</h5>
                            </td>
                            <td class="quantity">
                            </td>
                            <td class="price">
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <?php 
                            foreach($TableOrderItem as $itemOrdersProd) {
                                if ($itemOrdersProd['IDORDER'] == $itemOrders['ID']) {
                                    
                                    foreach($TableProd as $itemProd) {
                                        if ($itemProd['ID'] == $itemOrdersProd['IDPROD']) {
                                            $photo = '';
                                            foreach ($TablePhotos as $valuePhoto) {
                                                if ($valuePhoto['IDPROD'] == $itemOrdersProd['IDPROD']) {
                                                    $photo = $valuePhoto['SRC'];
                                                    break;   
                                                }
                                                
                                            }
                                            ?>
                                                <tr>
                                                    <td class="clear"></td>
                                                    <td class="img"><img src="../<?= $photo ?>" alt=""></td>
                                                    <td class="name"><?= $itemProd['NAME'] ?></td>
                                                    <td class="quantity">
                                                        <span><?= $itemOrdersProd['VALUE'] ?></span> 
                                                        шт.
                                                    </td>
                                                    <td class="price">
                                                        <span><?= $itemOrdersProd['SUMM'] ?></span>    
                                                        руб.
                                                    </td>
                                                    <td class="del">
                                                    </td>
                                                    <td class="clear"></td>
                                                </tr>
                                            <?php
                                            break;
                                        }
                                    }
                                }
                            }
                        ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"></td>
                            <td class="name"></td>
                            <td class="quantity">Итого:</td>
                            <td class="price">
                                <span><?= $itemOrders['SUM'] ?> руб.</span>    
                            </td>
                            <td class="del"></td>
                            <td class="clear"></td>
                        </tr>
                    </tfoot>

                </table>
            <?php
        }
    }

    function addOrdersListUser($TableOrders, $TableOrderItem, $TableProd, $TablePhotos) {
        foreach($TableOrders as $itemOrders) {
            ?>
                <table id="basket-table">
                    <thead>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"><div class="div-td-basket-icon"></div></td>
                            <td class="name"><h5>Заказ №<?= $itemOrders['ID'] ?></h5></td>
                            <td class="quantity">
                                <?php 
                                    if ($itemOrders['STATUS'] == 1) {
                                        echo 'В обработке';
                                    } else if ($itemOrders['STATUS'] == 2) {
                                        echo 'Собирается';
                                    } else if ($itemOrders['STATUS'] == 3) {
                                        echo 'В доставке';
                                    } else if ($itemOrders['STATUS'] == 4) {
                                        echo 'Принят';
                                    } else
                                ?>
                            </td>
                            <td class="price"></td>
                            <td class="del"></td>
                            <td class="clear"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"><div class="icon-info-user"></div></td>
                            <td class="name"><?= $itemOrders['NAME'] ?></td>
                            <td class="quantity">
                                <?= $itemOrders['NUMBER'] ?>
                            </td>
                            <td class="price">
                                <?= $itemOrders['MAIL'] ?>
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"><div class="icon-info-address"></div></td>
                            <td class="name">
                                <?= $itemOrders['ADDRES'] ?>
                            </td>
                            <td class="quantity">
                            </td>
                            <td class="price">
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"></td>
                            <td class="name">
                                <h5>Комментарий</h5>
                            </td>
                            <td class="quantity">
                            </td>
                            <td class="price">
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"></td>
                            <td class="name">
                                <?= $itemOrders['COMM'] ?>
                            </td>
                            <td class="quantity">
                            </td>
                            <td class="price">
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"></td>
                            <td class="name">
                                <h5>Товары</h5>
                            </td>
                            <td class="quantity">
                            </td>
                            <td class="price">
                            </td>
                            <td class="del">
                            </td>
                            <td class="clear"></td>
                        </tr>
                        <?php 
                            foreach($TableOrderItem as $itemOrdersProd) {
                                if ($itemOrdersProd['IDORDER'] == $itemOrders['ID']) {
                                    
                                    foreach($TableProd as $itemProd) {
                                        if ($itemProd['ID'] == $itemOrdersProd['IDPROD']) {
                                            $photo = '';
                                            foreach ($TablePhotos as $valuePhoto) {
                                                if ($valuePhoto['IDPROD'] == $itemOrdersProd['IDPROD']) {
                                                    $photo = $valuePhoto['SRC'];
                                                    break;   
                                                }
                                                
                                            }
                                            ?>
                                                <tr>
                                                    <td class="clear"></td>
                                                    <td class="img"><img src="../<?= $photo ?>" alt=""></td>
                                                    <td class="name"><?= $itemProd['NAME'] ?></td>
                                                    <td class="quantity">
                                                        <span><?= $itemOrdersProd['VALUE'] ?></span> 
                                                        шт.
                                                    </td>
                                                    <td class="price">
                                                        <span><?= $itemOrdersProd['SUMM'] ?></span>    
                                                        руб.
                                                    </td>
                                                    <td class="del">
                                                    </td>
                                                    <td class="clear"></td>
                                                </tr>
                                            <?php
                                            break;
                                        }
                                    }
                                }
                            }
                        ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="clear"></td>
                            <td class="img"></td>
                            <td class="name"></td>
                            <td class="quantity">Итого:</td>
                            <td class="price">
                                <span><?= $itemOrders['SUM'] ?> руб.</span>    
                            </td>
                            <td class="del"></td>
                            <td class="clear"></td>
                        </tr>
                    </tfoot>

                </table>
            <?php
        }
    }
?>