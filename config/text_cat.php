<?php 
    require_once('connect.php');

    $TableTextCat = mysqli_query($ConnectDatabase, "SELECT * FROM `text_cat`");    
    $TableTextCat = mysqli_fetch_all($TableTextCat, MYSQLI_ASSOC);

    if(isset($idCat)) {
        $TextCat = mysqli_query($ConnectDatabase, "SELECT * FROM `text_cat` WHERE `IDCAT`='$idCat'");  
        $TextCat = mysqli_fetch_assoc($TextCat);
        $titleCat = $TextCat['TITLE'];
        $textCat = $TextCat['TEXT'];
    }
?>