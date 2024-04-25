<?php
    require_once('../../config/connect.php');

    $idCat = $_POST['idParent'];
    $title = $_POST['titleCat'];
    $text = $_POST['descrCat'];

    $photo = $_FILES['photoCat'];

    $typeFIle = substr($photo['name'], strrpos($photo['name'], '.') + 1);

    $prov = True;
    while ($prov) {
        $fileName = uniqid() . '.' . $typeFIle;
        $fileUrl = '../../img/category/item/' . $fileName;
        $fileUrlDataBase = 'img/category/item/' . $fileName;

        if (!file_exists($fileUrl)) {
            move_uploaded_file($photo['tmp_name'], $fileUrl);
            $prov = False;
        }
    }

    mysqli_query($ConnectDatabase, "INSERT INTO `category` 
    (`ID`, `PARENT`, `NAME`, `DESCR`, `PHOTO`) VALUES 
    (NULL, '$idCat', '$title', '$text', '$fileUrlDataBase')");

    require_once('../../config/category.php');

    addCategoryAdm($TableCat, $idCat);
?>