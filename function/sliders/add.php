<?php 
    require_once('../../config/connect.php');

    $name = $_POST['nameSlide'];
    $photo = $_FILES['imgSlide'];

    $typeFIle = substr($photo['name'], strrpos($photo['name'], '.') + 1);

    $prov = True;
    while ($prov) {
        $fileName = uniqid() . '.' . $typeFIle;
        $fileUrl = '../../img/main/slider/' . $fileName;
        $fileUrlDataBase = 'img/main/slider/' . $fileName;

        if (!file_exists($fileUrl)) {
            move_uploaded_file($photo['tmp_name'], $fileUrl);
            $prov = False;
        }
    }

    mysqli_query($ConnectDatabase, "INSERT INTO `sliders` 
    (`ID`, `NAME`, `PHOTO`) VALUES 
    (NULL, '$name', '$fileUrlDataBase')");

    $TableSlider = mysqli_query($ConnectDatabase, "SELECT * FROM `sliders`");    
    $TableSlider = mysqli_fetch_all($TableSlider, MYSQLI_ASSOC);

    echo count($TableSlider);

?>