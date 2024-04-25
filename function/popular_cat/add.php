<?php 
    require_once('../../config/connect.php');

    $id = $_POST['selectCat'];
    $photo = $_FILES['photoPopCat'];

    $Cat = mysqli_query($ConnectDatabase, "SELECT * FROM `category` WHERE `ID`='$id'");
    $Cat = mysqli_fetch_assoc($Cat);

    $name = $Cat['NAME'];

    $typeFIle = substr($photo['name'], strrpos($photo['name'], '.') + 1);

    $prov = True;
    while ($prov) {
        $fileName = uniqid() . '.' . $typeFIle;
        $fileUrl = '../../img/category/popular/' . $fileName;
        $fileUrlDataBase = 'img/category/popular/' . $fileName;

        if (!file_exists($fileUrl)) {
            move_uploaded_file($photo['tmp_name'], $fileUrl);
            $prov = False;
        }
    }

    mysqli_query($ConnectDatabase, "INSERT INTO `popular_cat` 
    (`ID`, `IDCAT`, `NAME`, `PHOTO`) VALUES 
    (NULL, '$id', '$name', '$fileUrlDataBase')");

?>