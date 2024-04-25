<?php 
    require_once('../config/reviews.php');
    require_once('../config/users.php');
    require_once('../config/products.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/product-card.css">
    <link rel="stylesheet" href="../css/reviews-admin.css">
</head>
<body>
    
<?php 
    require_once('header-admin.php')
?>


<div id="title-category">
    <div class="layout">
        
        <h1 class="title-category">
            Отзывы
        </h1>
    </div>
</div>

<div id="reviewsBody">
    <div class="layout">
        <div class="tab-pane" id="tab-replies">
            <ul id="commList" class="comment-list">
                <?php 
                    addCommAdm($TableReviews, $TableUsers, $TableProd);
                ?>
            </ul>
        </div>
    </div>
</div>

<script>
    function delComm(id) {
        let formData = new FormData();

        formData.append('idComm', id);
        
        var url = '../function/reviews/del.php';
        
        let xhr = new XMLHttpRequest();   

        xhr.responseType = 'document';  
        
        xhr.open('POST', url);

        xhr.send(formData);
        xhr.onload = () => {
            document.getElementById('commList').innerHTML = xhr.response.getElementById('commList').innerHTML;
        } 
    }
</script>

</body>
</html>