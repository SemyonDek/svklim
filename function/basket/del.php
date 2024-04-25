<?php 
    session_start();

    $id = $_POST['id'];
    unset($_SESSION['basket'][$id]);

    $sum = 0;
    $_SESSION['basketSum'] = 0;
    foreach ($_SESSION['basket'] as $value) {
        $sum += $value['AMOUNT'];
    }
    $_SESSION['basketSum'] = $sum;

    require_once('../../config/products.php');
?>

<p id="basketCount" class="header-line-text topbar-basket">
    <?php 
    if(isset($_SESSION['basket']) && $_SESSION['basket'] !== '') {
        echo ' '.count($_SESSION['basket']).' ';
    } else echo 0;
    ?>
</p>
<table id="basket-table">
    <tbody id="bodyBasket">
        <?php 
            addBasketBody($_SESSION['basket'], $TableProd, $TablePhotos);
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td class="clear"></td>
            <td class="img"></td>
            <td class="name"></td>
            <td class="quantity">Итого:</td>
            <td id="finalPrice" class="price">
                <span>
                    <?php 
                        if(isset($_SESSION['basketSum']) && $_SESSION['basketSum'] !== '') {
                            echo number_format($_SESSION['basketSum'], 0, '.', ' ');
                        } else echo 0;
                    ?>
                    руб.
                </span>    
            </td>
            <td class="del"></td>
            <td class="clear"></td>
        </tr>
    </tfoot>

</table>