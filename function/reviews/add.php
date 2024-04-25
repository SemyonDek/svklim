<?php 
    session_start();

    require_once('../../config/connect.php');
    
    $iduser = $_SESSION['accountId'];
    $idprod = $_POST['idprod'];
    $date = date('d.m.Y').' г.';
    $commtext = $_POST['commtext'];
    
    mysqli_query($ConnectDatabase, "INSERT INTO `reviews` 
    (`ID`, `IDUSER`, `IDPROD`, `DATE`, `COMM`) VALUES 
    (NULL, '$iduser', '$idprod', '$date', '$commtext')");

    require_once('../../config/reviews.php');
    require_once('../../config/users.php');

?>

<ul id="commList" class="comment-list">
    <?php 
        addCommProd($TableReviews, $TableUsers);
    ?>
</ul>