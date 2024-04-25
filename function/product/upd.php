<?php
    require_once('../../config/connect.php');

    $idProd = $_POST['idProd'];
    $name = $_POST['nameProd'];
    $catid = $_POST['idCat'];
    $class = $_POST['calssProd'];
    $square = $_POST['squareProd'];
    $inver = $_POST['inverProd'];
    $produc = $_POST['producProd'];
    $series = $_POST['seriesProd'];
    $noise = $_POST['noiseProd'];
    $power = $_POST['powerProd'];
    $guar = $_POST['guarProd'];
    $price = $_POST['priceProd'];
    $desc = $_POST['descProd'];

    $Photos = mysqli_query($ConnectDatabase, "SELECT * FROM `photos` WHERE `IDPROD` = '$idProd'");    
    $Photos = mysqli_fetch_all($Photos, MYSQLI_ASSOC);  
    
    mysqli_query($ConnectDatabase, "UPDATE `products` SET 
    `IDCAT` = '$catid', `NAME` = '$name',  `CLASS` = '$class', `PRODUCER` = '$produc', 
    `SERIES` = '$series', `GUARANTEE` = '$guar', `SQUARE` = '$square', `INVER` = '$inver', 
    `NOISE` = '$noise',`POWER` = '$power', `PRICE` = '$price', `DESCRIPTION` = '$desc'
    WHERE `products`.`ID` = '$idProd'");

    $length = count($Photos);
    for ($i=0; $i < 5; $i++) {
        if ($i < $length) {
            if ($_FILES['file_photo_'.$i+1]['name'] == '') {
                if ($_POST['FilesDell_'.$i+1] == 1) {

                    $idPhoto = $Photos[$i]['ID'];
                    unlink('../../'.$Photos[$i]['SRC']);
                    mysqli_query($ConnectDatabase, "DELETE FROM photos WHERE `photos`.`ID` = $idPhoto");
                    
                }
            } else {
                
                $typeFIle = substr($_FILES['file_photo_'.$i+1]['name'], strrpos($_FILES['file_photo_'.$i+1]['name'], '.') + 1);
                $urlNewFile = substr($Photos[$i]['SRC'], 0, strrpos($Photos[$i]['SRC'], '.'));
                $urlNewFile = $urlNewFile.'.'.$typeFIle;
                unlink('../../'.$Photos[$i]['SRC']);
                move_uploaded_file($_FILES['file_photo_'.$i+1]['tmp_name'], '../../'.$urlNewFile);
                $idPhoto = $Photos[$i]['ID'];
                mysqli_query($ConnectDatabase, "UPDATE `photos` SET `SRC` = '$urlNewFile' WHERE `photos`.`ID` = '$idPhoto'");
                
            } 

        } else if ($_FILES['file_photo_'.$i+1]['name'] !== '') {

            $typeFIle = substr($_FILES['file_photo_'.$i+1]['name'], strrpos($_FILES['file_photo_'.$i+1]['name'], '.') + 1);

            $prov = True;
            while ($prov) {
                $fileName = uniqid() . '.' . $typeFIle;
                $fileUrl = '../../img/product/' . $fileName;
                $fileUrlDataBase = 'img/product/' . $fileName;

                if (!file_exists($fileUrl)) {
                    move_uploaded_file($_FILES['file_photo_'.$i+1]['tmp_name'], $fileUrl);

                    mysqli_query($ConnectDatabase, "INSERT INTO `photos` (`ID`, `IDPROD`, `SRC`) 
                    VALUES (NULL, '$idProd', '$fileUrlDataBase')");

                    $prov = False;
                }
            }

        } 
    }

    echo 'Товар изменен';

?>