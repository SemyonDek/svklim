<?php
    require_once('../config/main_text.php');
    require_once('../config/sliders.php');
    require_once('../config/popular_cat.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/index-admin.css">
</head>
<body>
    
<?php 
    require_once('header-admin.php');
    slidersAdm($TableSlider);
    addMainTextAdm($MainText);
    addPopCatAdm($TablePopCat);
?>

<script src="../script/slider.js"></script>

<script>
    function delSlider(id) {
        let sliders = document.getElementsByClassName('img-slider-img');

        if (sliders.length == 1) {
            alert('Нельзя удалить последний слайд');
        } else {
            let formData = new FormData();
            formData.append('idSlide', id);
            var url = '../function/sliders/del.php';
            let xhr = new XMLHttpRequest();    
            xhr.open('POST', url);
            xhr.responseType = 'document';
            xhr.send(formData);
            xhr.onload = () => {
                alert('Слайд удален');
                location.reload();
                showSlides(1);
            } 
        }
    }

    function addSlider() {
        let sliders = document.getElementsByClassName('img-slider-img');

        if (sliders.length == 4) {
            alert('Уже добавлено максимальное число слайдов');
        } else {
            window.location.replace("addSlider.php");
        }
    }

    function delPopCat(id) {
        let formData = new FormData();
        formData.append('idPopCat', id);
        var url = '../function/popular_cat/del.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.responseType = 'document';
        xhr.send(formData);
        xhr.onload = () => {
            alert('Категория удалена');
            document.getElementById('popular-categories').innerHTML = xhr.response.getElementById('popular-categories').innerHTML;
        } 
    }

</script>

</body>
</html>