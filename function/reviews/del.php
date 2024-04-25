<?php 
    require_once('../../config/connect.php');

    $id = $_POST['idComm'];

    mysqli_query($ConnectDatabase, "DELETE FROM reviews WHERE `reviews`.`ID` = $id");

    require_once('../../config/reviews.php');
    require_once('../../config/users.php');
    require_once('../../config/products.php');
?>

<ul id="commList" class="comment-list">
    <?php 
        addCommAdm($TableReviews, $TableUsers, $TableProd);
    ?>
</ul>