<?php 
    require_once('../../config/connect.php');

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


    mysqli_query($ConnectDatabase, "INSERT INTO `products` 
    (`ID`, `IDCAT`, `NAME`, `CLASS`, `PRODUCER`, `SERIES`, `GUARANTEE`, `SQUARE`, `INVER`, `NOISE`, `POWER`, `PRICE`, `DESCRIPTION`) VALUES 
    (NULL, '$catid', '$name', '$class', '$produc', '$series', '$guar', '$square', '$inver', '$noise', '$power', '$price', '$desc')");

    $idProd = mysqli_query($ConnectDatabase, "SELECT MAX(id) FROM `products`"); 
    $idProd = mysqli_fetch_all($idProd);
    $idProd = $idProd[0][0];

    foreach ($_FILES as $key => $item) {
        if ($item['name'] !== '') {
            $typeFIle = substr($item['name'], strrpos($item['name'], '.') + 1);

            $prov = True;
            while ($prov) {
                $fileName = uniqid() . '.' . $typeFIle;
                $fileUrl = '../../img/product/' . $fileName;
                $fileUrlDataBase = 'img/product/' . $fileName;

                if (!file_exists($fileUrl)) {
                    move_uploaded_file($item['tmp_name'], $fileUrl);

                    mysqli_query($ConnectDatabase, "INSERT INTO `photos` (`ID`, `IDPROD`, `SRC`) 
                    VALUES (NULL, '$idProd', '$fileUrlDataBase')");

                    $prov = False;
                }
            }
        }
    }

    echo 'Товар добавлен';
 
?>