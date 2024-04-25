<?php 
    require_once('../config/category.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/product-card.css">
    <link rel="stylesheet" href="../css/addProdAdm.css">
</head>
<body>

<?php 
    require_once('header-admin.php')
?>


<form id="form_prod" action="">
    <div id="title-category">
        <div class="layout">
            <h1 class="title-category">
                Название:
            </h1>
            <input name="nameProd" id="nameProd" class="input-basic" type="text" placeholder="Название">
        </div>
    </div>
    <div id="product-card-body">
        <div class="layout">
    
            <div class="left-block">
                <div class="row-body">
                    <div class="photo-block">
                        <div class="file_photo">
                            <input type="file" id="file_photo">
                            <button class="add_photo" type="button" onclick="addPhotos()">Добавить фото</button>
                            <input type="file" class="hidden" name="file_photo_1" id="file_photo_1">
                            <input type="file" class="hidden" name="file_photo_2" id="file_photo_2">
                            <input type="file" class="hidden" name="file_photo_3" id="file_photo_3">
                            <input type="file" class="hidden" name="file_photo_4" id="file_photo_4">
                            <input type="file" class="hidden" name="file_photo_5" id="file_photo_5">
                        </div>
                        
                        <div id="phot_prod_add">
                            
                        </div>
                        <!-- <div class="file_photo">
                            
                            <input type="file" name="file_photo_1" id="file_photo_1">
                            <input type="file" name="file_photo_2" id="file_photo_2">
                            <input type="file" name="file_photo_3" id="file_photo_3">
                            <input type="file" name="file_photo_4" id="file_photo_4">
                            <input type="file" name="file_photo_5" id="file_photo_5">
                        </div> -->
                    </div>
                    <div class="main-info-block">
                        <div class="title-prod">
                            Основные характеристики
                        </div>
                        <ul class="parametrs-prod">
                            <li>
                                <span>Подкатегория</span>
                                <span>
                                    <select class="input-basic" name="idCat" id="idCat">
                                        <?php 
                                            addSelect($TableCat);
                                        ?>
                                    </select>
                                </span>
                            </li>
                            <li>
                                <span>Класс</span>
                                <span>
                                    <select class="input-basic" name="calssProd" id="calssProd">
                                        <option value=""></option>
                                        <option value="1">Премиум</option>
                                        <option value="2">Дизайн</option>
                                        <option value="3">Комфорт</option>
                                        <option value="4">Эконом</option>
                                    </select>
                                </span>
                            </li>
                            <li>
                                <span>S помещения</span>
                                <span><input name="squareProd" id="squareProd" class="input-basic" type="number" placeholder="м2"></span>
                            </li>
                            <li>
                                <span>Инвертор</span>
                                <span>
                                    <select class="input-basic" name="inverProd" id="inverProd">
                                        <option value=""></option>
                                        <option value="1">Есть</option>
                                        <option value="0">Нет</option>

                                    </select>
                                </span>
                            </li>
                            <li>
                                <span>Производитель</span>
                                <span><input name="producProd" id="producProd" class="input-basic" type="text" placeholder="Производитель"></span>
                            </li>
                            <li>
                                <span>Серия</span>
                                <span><input name="seriesProd" id="seriesProd" class="input-basic" type="text" placeholder="Серия"></span>
                            </li>
                            <li>
                                <span>Уровень шума</span>
                                <span><input name="noiseProd" id="noiseProd" class="input-basic" type="number" placeholder="дБ"></span>
                            </li>
                            <li>
                                <span>Мощность</span>
                                <span><input name="powerProd" id="powerProd" class="input-basic" type="number" placeholder="кВт"></span>
                            </li>
                            <li>
                                <span>Гарантия</span>
                                <span><input name="guarProd" id="guarProd" class="input-basic" type="text" placeholder="Гарантия"></span>
                            </li>
                            <li>
                                <span>Цена</span>
                                <span><input name="priceProd" id="priceProd" class="input-basic" type="number" placeholder="рублей"></span>
                            </li>
                        </ul>
                    </div>
    
    
                </div>
            </div>

            <div class="right-block">
                <button class="update" type="button" onclick="addProd()">Добавить товар</button>
            </div>
    
            <div class="left-block">
                <ul class="nav nav-tabs">
                    <li class="active-li" id="tabDesc-li">
                        <button type="button" id="tabDesc">Описание</button>
                    </li>
                </ul>
                <div class="tab-content" id="tab-content">
                    <div class="tab-pane active-div" id="tab-about">
                        <textarea name="descProd" id="descProd" class="input-basic" name="" rows="10" placeholder="Описание"></textarea>
                    </div>
    
                </div>
                <button class="update" type="button" onclick="javascript:history.back()" >Вернуться назад</button>
            </div>
            <div class="clear-both"></div>
        </div>
    </div>
</form>

<script>
    function addPhotos() {
        
        let file = document.getElementById('file_photo');
        if (file.value == '') {
            alert('Изображение не выбрано');
            return;
        }
        
        let div = document.createElement('div');
        div.className = 'photo_add';
        let block = document.getElementById('phot_prod_add');
        
        
        var img = file.files[0];
        
        var reader  = new FileReader();

        var src;
        
        reader.onload = function () {
            src = reader.result;
            
            if (document.getElementById('file_photo_1').files.length == 0) {
                document.getElementById('file_photo_1').files = file.files;
                
                div.id = 'photo_1';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_1'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else if (document.getElementById('file_photo_2').files.length == 0) {
                document.getElementById('file_photo_2').files = file.files;
                
                div.id = 'photo_2';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_2'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else if (document.getElementById('file_photo_3').files.length == 0) {
                document.getElementById('file_photo_3').files = file.files;
                
                div.id = 'photo_3';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_3'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else if (document.getElementById('file_photo_4').files.length == 0) {
                document.getElementById('file_photo_4').files = file.files;
                
                div.id = 'photo_4';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_4'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else if (document.getElementById('file_photo_5').files.length == 0) {
                document.getElementById('file_photo_5').files = file.files;

                div.id = 'photo_5';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_5'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else {
                alert('Можно загрузить только 5 фотографий!')
                return;
            }
            
        }

        if (img) {
            reader.readAsDataURL(img);
        } else {
            preview.src = "";
        }

    }

    function delPhoto(id) {
        document.getElementById(id).remove();
        document.getElementById('file_' + id).value = '';
    }

    function addProd() {
        const form = document.getElementById('form_prod');
    
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
            if (element['value'] == '' && (!element['name'].startsWith('file_photo_') ||  element['name'].startsWith('file_photo_1'))) {
                document.getElementById(element['name']).style = style_input_red;
                prov = false;
                if (element['name'].startsWith('file_photo_1')) alert('Добавьте изображение');
            } else {
                document.getElementById(element['name']).style = style_input_gray;
            }
        });

        if (!prov) return;
        
        let formData = new FormData(form);
        
        var url = '../function/product/add.php';

        let xhr = new XMLHttpRequest();    
        
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            alert(xhr.response);

            data.forEach(element => {
                if (element['value'] !== '') {
                    document.getElementById(element['name']).value = null;

                    if (element['name'].startsWith('file_photo_')) {
                        document.getElementById(element['name'].substr(5)).remove();
                    }
                }
            });
            document.getElementById('file_photo').value = null;
        } 
    }

</script>

</body>
</html>