<?php
    require_once('../config/category.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/addPopCat.css">
</head>
<body>

<?php 
    require_once('header-admin.php')
?>

<div id="addPopCat">
    <div class="layout">

        <div class="headerAdd">
            <h3 class="titleAdd">Изменение текста на главной</h3>
        </div>

        <div class="bodyAdd">    
            <form id="formAddPopCat" action="">

                <div class="inputBlock">
                    <div class="title-input">Подкатегория:</div>
                    <select class="input-basic" name="selectCat" id="selectCat">
                        <?php 
                            addSelect($TableCat);
                        ?>
                    </select>
                </div>
                
                <div class="inputBlock">
                    <div class="title-input">Добавьте фото:</div>
                    <input type="file" name="photoPopCat" id="photoPopCat">
                </div>
                <button class="update" type="button" onclick="addPopCat()">Добавить</button>
            </form>
            <button class="update" type="button" onclick="window.location.replace('index-admin.php')" >Вернуться назад</button>
        </div>

    </div>
</div>

<script>
    function addPopCat() {
        const form = document.getElementById('formAddPopCat');
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
                if (element['name'] == 'photoPopCat') {
                    alert('Добавьте фото')
                } else {
                    document.getElementById(element['name']).style = style_input_red;
                }
                prov = false;
            } else {
                if (element['name'] !== 'photoPopCat') {
                    document.getElementById(element['name']).style = style_input_gray;
                }
            }
        });
        if (!prov) return;
        
        let formData = new FormData(form);
        var url = '../function/popular_cat/add.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.responseType = 'document';
        xhr.send(formData);
        xhr.onload = () => {
            alert('Категория добавлена');
            data.forEach(element => {
                document.getElementById(element['name']).value = '';
            });
        } 
    }
    
</script>

</body>
</html>