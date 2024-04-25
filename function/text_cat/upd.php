<?php
    require_once('../../config/connect.php');

    $id = $_POST['idParentText'];
    $title = $_POST['titleCatParent'];
    $text = $_POST['textCatParent'];

    mysqli_query($ConnectDatabase, "UPDATE `text_cat` SET `TITLE` = '$title', `TEXT` = '$text' WHERE `text_cat`.`IDCAT` = '$id'");

    echo 'Изменено';
?>