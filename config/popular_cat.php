<?php 
    require_once('connect.php');

    $TablePopCat = mysqli_query($ConnectDatabase, "SELECT * FROM `popular_cat`");    
    $TablePopCat = mysqli_fetch_all($TablePopCat, MYSQLI_ASSOC);

    function addPopCatAdm($TablePopCat) {
        ?>
            <div id="popular-categories">
                    <div class="layout">
                        <div class="h2_seo">Популярные разделы</div>
                        <div id="popular-wrapper">

                            <?php
                                 foreach($TablePopCat as $item) {
                                    ?>
                                        <div class="popular-item">
                                            <div class="popular-item-image">
                                                <img width="360" height="160" alt="" src="../<?= $item['PHOTO'] ?>" class="img-responsive">
                                            </div>
                                            <div class="popular-item-title"><?= $item['NAME'] ?></div>
                                            <button class="del" type="button" onclick="delPopCat(<?= $item['ID'] ?>)">Удалить</button>
                                        </div>
                                    <?php
                                }      
                            ?>
                            
                        </div>
                        <a href="addPopCat.php">
                            <button class="update" type="button">Добавить</button>
                        </a>
                    </div>
                </div>
        <?php    
    }

    function addPopCatUser($TablePopCat) {
        ?>
            <div id="popular-categories">
                    <div class="layout">
                        <div class="h2_seo">Популярные разделы</div>
                        <div id="popular-wrapper">

                            <?php
                                 foreach($TablePopCat as $item) {
                                    ?>
                                        <div class="popular-item">
                                            <a href="catalog.php?idchildcat=<?= $item['IDCAT'] ?>" rel="">
                                                <div class="popular-item-image">
                                                    <img width="360" height="160" alt="" src="<?= $item['PHOTO'] ?>" class="img-responsive">
                                                </div>
                                                <div class="popular-item-title"><?= $item['NAME'] ?></div>
                                            </a>
                                        </div>
                                    <?php
                                }      
                            ?>
                            
                        </div>
                    </div>
                </div>
        <?php    
    }
?>