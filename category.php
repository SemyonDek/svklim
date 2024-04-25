<?php 
    $idCat = $_GET['idcat'];
    require_once('config/category.php');
    require_once('config/text_cat.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php 
            if ($idCat == 1) {
                echo 'Кондиционеры';
            } elseif ($idCat == 2) {
                echo 'Вентиляция';
            } elseif ($idCat == 3) {
                echo 'Микроклимат';
            }
        ?>
    </title>
    <link rel="stylesheet" href="css/category.css">
</head>
<body>
<?php 
    require_once('header-user.php');
?>
<div id="title-category">
    <div class="layout">
        <div id="breadcrumbs">
            <a href="index.php" class="breadcrumbs-link">Главная</a>
            <a href="category.php?idcat=<?= $idCat ?>" class="breadcrumbs-link active">
                <?php 
                    if ($idCat == 1) {
                        echo 'Кондиционеры';
                    } elseif ($idCat == 2) {
                        echo 'Вентиляция';
                    } elseif ($idCat == 3) {
                        echo 'Микроклимат';
                    }
                ?>
            </a>
        </div>
        <h1 class="title-category">
            <?php 
                if ($idCat == 1) {
                    echo 'Кондиционеры';
                } elseif ($idCat == 2) {
                    echo 'Вентиляция';
                } elseif ($idCat == 3) {
                    echo 'Микроклимат';
                }
            ?>
        </h1>
    </div>
</div>
<?php 
    addCategoryUser($TableCat);
?>
<div id="category-info">
    <div class="layout">
        <h2>
            <?= $titleCat ?>
        </h2>
        <p> 
            <?= nl2br($textCat) ?>
        </p>
    </div>
</div>
<?php 
    require_once('footer-user.php'); 
?>
</body>
</html>