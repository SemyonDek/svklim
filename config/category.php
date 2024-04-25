<?php 
    require_once('connect.php');

    if (isset($idCat)) {
        $TableCat = mysqli_query($ConnectDatabase, "SELECT * FROM `category` WHERE `PARENT`='$idCat'");
    } else {
        $TableCat = mysqli_query($ConnectDatabase, "SELECT * FROM `category`");
    }
    
    $TableCat = mysqli_fetch_all($TableCat, MYSQLI_ASSOC);
    
    function addCategoryAdm($TableCat, $idCat = 0) {
        ?>
            <div id="category-list-categories">
                <div class="layout">
                    <h2 class="list-categories">
                        Выберите подходящую категорию:
                    </h2>

                    <div id="list-categoryes-items">
                        <?php 
                            foreach($TableCat as $item) {
                                ?>
                                    <div class="category-item">
                                        <div class="category-item-link-img">
                                            <img class="category-item-img" src="../<?= $item['PHOTO'] ?>" alt="">
                                            <button class="delCat" onclick="delCat(<?= $item['ID'] ?>, <?= $idCat ?>)" >x</button>
                                        </div>

                                        <div class="category-item-name">
                                            <?= $item['NAME'] ?>
                                        </div>

                                        <div class="category-item-text">
                                            <?= $item['DESCR'] ?>
                                        </div>
                                    </div>
                                <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php 
    }

    function addCategoryUser($TableCat) {
        ?>
            <div id="category-list-categories">
                <div class="layout">
                    <h2 class="list-categories">
                        Выберите подходящую категорию:
                    </h2>

                    <div id="list-categoryes-items">
                        <?php 
                            foreach($TableCat as $item) {
                                ?>
                                    <div class="category-item">
                                        <div class="category-item-link-img">
                                            <a href="catalog.php?idchildcat=<?= $item['ID'] ?>" class="category-item-link-img">
                                                <img class="category-item-img" src="<?= $item['PHOTO'] ?>" alt="">
                                            </a>
                                        </div>

                                        <div class="category-item-name">
                                            <a href="catalog.php?idchildcat=<?= $item['ID'] ?>" onclick=""><?= $item['NAME'] ?></a>
                                        </div>

                                        <div class="category-item-text">
                                            <?= $item['DESCR'] ?>
                                        </div>
                                    </div>
                                <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php 
    }

    function addSelect($TableCat) {
        ?>  
            <option value=""></option>
            <option value="">Кондиционеры</option>
            <?php 
                foreach($TableCat as $item) {
                    if($item['PARENT'] == 1) {
                        ?>
                            <option value="<?= $item['ID'] ?>"> <?= $item['NAME'] ?></option>
                        <?php
                    }
                }
            ?>
            <option value="">Вентиляция</option>
            <?php 
                foreach($TableCat as $item) {
                    if($item['PARENT'] == 2) {
                        ?>
                            <option value="<?= $item['ID'] ?>"> <?= $item['NAME'] ?></option>
                        <?php
                    }
                }
            ?>
            <option value="">Микроклимат</option>
            <?php 
                foreach($TableCat as $item) {
                    if($item['PARENT'] == 3) {
                        ?>
                            <option value="<?= $item['ID'] ?>"> <?= $item['NAME'] ?></option>
                        <?php
                    }
                }
            ?>
        <?php 
    }
    function addSelectActive($TableCat, $id) {
        ?>  
            <option value=""></option>
            <option value="">Кондиционеры</option>
            <?php 
                foreach($TableCat as $item) {
                    if($item['PARENT'] == 1) {
                        if ($item['ID'] == $id) {
                            ?>
                                <option value="<?= $item['ID'] ?>" selected="selected"> <?= $item['NAME'] ?></option>
                            <?php
                        } else {    
                            ?>
                                <option value="<?= $item['ID'] ?>"> <?= $item['NAME'] ?></option>
                            <?php
                        }
                    }
                }
            ?>
            <option value="">Вентиляция</option>
            <?php 
                foreach($TableCat as $item) {
                    if($item['PARENT'] == 2) {
                        if ($item['ID'] == $id) {
                            ?>
                                <option value="<?= $item['ID'] ?>" selected="selected"> <?= $item['NAME'] ?></option>
                            <?php
                        } else {    
                            ?>
                                <option value="<?= $item['ID'] ?>"> <?= $item['NAME'] ?></option>
                            <?php
                        }
                    }
                }
            ?>
            <option value="">Микроклимат</option>
            <?php 
                foreach($TableCat as $item) {
                    if($item['PARENT'] == 3) {
                        if ($item['ID'] == $id) {
                            ?>
                                <option value="<?= $item['ID'] ?>" selected="selected"> <?= $item['NAME'] ?></option>
                            <?php
                        } else {    
                            ?>
                                <option value="<?= $item['ID'] ?>"> <?= $item['NAME'] ?></option>
                            <?php
                        }
                    }
                }
            ?>
        <?php 
    }

?>

