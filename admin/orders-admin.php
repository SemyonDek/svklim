<?php 
    require_once('../config/orders.php');
    require_once('../config/products.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/order.css">
    <link rel="stylesheet" href="../css/basket.css">
    <link rel="stylesheet" href="../css/orders-admin.css">
</head>
<body>
    
<?php 
    require_once('header-admin.php')
?>


<div id="title-category">
    <div class="layout">
        
        <h1 class="title-category">
            Список заказов
        </h1>
    </div>
</div>


<div id="basket-body">
    <div class="layout">
        <?php 
            addOrdersList($TableOrders, $TableOrderItem, $TableProd, $TablePhotos);
        ?>
    </div>
</div>

<script>
    function orderUpd(id) {
        let status = document.getElementById('status_' + id).value;
        let formData = new FormData();
        formData.append('idOrder', id);
        formData.append('status', status);
        var url = '../function/order/upd.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.responseType = 'document';
        xhr.send(formData);
        xhr.onload = () => {
            alert('Состояние заказа изменено');
        } 
    }

</script>

</body>
</html>