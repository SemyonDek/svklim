<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/addSlider.css">
</head>
<body>
    
<?php 
    require_once('header-admin.php')
?>

<div id="addSlidert">
    <div class="layout">

        <div class="headerAdd">
            <h3 class="titleAdd">Добавить элемент в слайдер</h3>
        </div>

        <div class="bodyAdd">    
            <form id="formAddSlider" action="">
                <div class="inputBlock">
                    <div class="title-input">Название:</div>
                    <input id="nameSlide" name="nameSlide" class="input-basic" type="text" placeholder="Название">
                </div>
                <div class="inputBlock">
                    <div class="title-input">Добавьте фото:</div>
                    <input id="imgSlide" name="imgSlide" type="file">
                </div>
                <button class="update" type="button" onclick="addSlider()">Добавить</button>
            </form>
            <button class="update" type="button" onclick="window.location.replace('index-admin.php')" >Вернуться назад</button>
        </div>

    </div>
</div>

<script>
    function addSlider() {
        const form = document.getElementById('formAddSlider');
        const { elements } = form;
        const data = Array.from(elements)
            .filter((item) => !!item.name)
            .map((element) => {
            const { name, value } = element

            return { name, value }
        })  
        style_input_red = 'border-color: red;';
        style_input_gray = 'border-color: #bababa;';
        prov = true;
        data.forEach(element => {
            if (element['value'] == '') {
                if (element['name'] == 'imgSlide') {
                    alert('Добавьте фото')
                } else {
                    document.getElementById(element['name']).style = style_input_red;
                }
                prov = false;
            } else {
                if (element['name'] !== 'imgSlide') {
                    document.getElementById(element['name']).style = style_input_gray;
                }
            }
        });
        if (!prov) {
            return;
        } 
        
        let formData = new FormData(form);
        var url = '../function/sliders/add.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            alert('Слайд добавлен');
            if (xhr.response == '4') {
                alert('Добавлено максимальное число слайдов');
                window.location.replace("index-admin.php");
            }
        } 
    }


</script>


</body>
</html>