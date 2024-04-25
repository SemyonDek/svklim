<?php
    require_once('config/main_text.php');
    require_once('config/sliders.php');
    require_once('config/popular_cat.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<?php 
    require_once('header-user.php');
    slidersUser($TableSlider);
    addMainTextUser($MainText);
    addPopCatUser($TablePopCat);
    require_once('footer-user.php'); 
?>
<script src="script/slider.js"></script>
</body>
</html>