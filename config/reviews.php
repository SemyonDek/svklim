<?php 
    require_once('connect.php');
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $idStr = "WHERE `IDPROD`='".$id."'";
    } else $idStr = '';
    if (isset($_POST['idprod'])) {
        $id = $_POST['idprod'];
        $idStr = "WHERE `IDPROD`='".$id."'";
    }
    
    $TableReviews = mysqli_query($ConnectDatabase, "SELECT * FROM `reviews` $idStr");    
    $TableReviews = mysqli_fetch_all($TableReviews, MYSQLI_ASSOC);

    function addCommProd($TableReviews, $TableUsers) {
        foreach ($TableReviews as $item) {
            $name = '';
            foreach($TableUsers as $itemUser) {
                if ($itemUser['ID'] == $item['IDUSER']) {
                    $name = $itemUser['NAME'];
                    break;
                }
            }
            ?>
                <li>
                    <h4 class="name"><?= $name ?></h4>
                    <div class="item-right">
                        <span class="gray"><?= $item['DATE'] ?></span>
                    </div>

                    <div class="clear-both"></div>
                    <p style="text-align: justify;">
                        <?= $item['COMM'] ?>
                    </p>

                </li>
            <?php
        }
    }
    function addCommAdm($TableReviews, $TableUsers, $TableProd) {
        foreach ($TableReviews as $item) {
            $name = '';
            foreach($TableUsers as $itemUser) {
                if ($itemUser['ID'] == $item['IDUSER']) {
                    $name = $itemUser['NAME'];
                    break;
                }
            }

            $nameProd = '';
            foreach($TableProd as $itemProd) {
                if ($itemProd['ID'] == $item['IDPROD']) {
                    $nameProd = $itemProd['NAME'];
                    break;
                }
            }
            ?>  
                <li>
                    <div class="item-right">
                        <button type="button" onclick="delComm(<?= $item['ID'] ?>)" >Удалить</button>
                    </div>
                    <div class="clear-both"></div>
                    <h4 class="name">Товар:</h4>
                    <p style="text-align: justify;">
                        <?= $nameProd ?>
                    </p>

                    <h4 class="name"><?= $name ?></h4>
                    <div class="item-right">
                        <span class="gray"><?= $item['DATE'] ?></span>
                    </div>

                    <div class="clear-both"></div>
                    <p style="text-align: justify;">
                        <?= $item['COMM'] ?>
                    </p>

                </li>
            <?php
        }
    }
?>