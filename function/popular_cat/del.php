<?php
    require_once('../../config/connect.php');

    $id = $_POST['idPopCat'];

    $PopCat = mysqli_query($ConnectDatabase, "SELECT * FROM `popular_cat` WHERE `ID`='$id'");
    $PopCat = mysqli_fetch_assoc($PopCat);
    unlink('../../'.$PopCat['PHOTO']);

    mysqli_query($ConnectDatabase, "DELETE FROM popular_cat WHERE `popular_cat`.`ID` = $id");

    require_once('../../config/popular_cat.php');

    addPopCatAdm($TablePopCat);

?>