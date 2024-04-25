<?php
    require_once('../../config/connect.php');

    $title = $_POST['title'];
    $text = $_POST['text'];

    mysqli_query($ConnectDatabase, "UPDATE `main_text` SET `NAME` = '$title', `TEXT` = '$text' WHERE `main_text`.`ID` = 1");

    echo 'Изменено';
?>