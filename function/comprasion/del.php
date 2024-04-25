<?php 
    session_start();

    $_SESSION['comprasion'] = '';

    require_once('../../config/category.php');
    require_once('../../config/products.php');
?>

<p id="comprasionCount" class="header-line-text topbar-basket">
    <?php 
    if(isset($_SESSION['comprasion']) && $_SESSION['comprasion'] !== '') {
        echo ' '.count($_SESSION['comprasion']).' ';
    } else echo '0 ';
    ?>
</p>

<div id="comparison-block-prod">
    <div class="layout">
        <div class="column column_1">
            
            <div class="clear-comparison-block">
                <button type="button">
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