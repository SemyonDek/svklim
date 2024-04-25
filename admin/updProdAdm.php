<?php 
    require_once('../config/connect.php');
    require_once('../config/category.php');

    $idProd = $_GET['id'];

    $Prod = mysqli_query($ConnectDatabase, "SELECT * FROM `products` WHERE `ID`='$idProd'");    
    $Prod = mysqli_fetch_assoc($Prod);
    
    $Photos = mysqli_query($ConnectDatabase, "SELECT * FROM `photos` WHERE `IDPROD`='$idProd'");    
    $Photos = mysqli_fetch_all($Photos, MYSQLI_ASSOC);

?>

<?php 
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
            <input name="idProd" id="idProd" type="hidden" value="<?= $Prod['ID'] ?>">
            <input value="<?= $Prod['NAME'] ?>" name="nameProd" id="nameProd" class="input-basic" type="text" placeholder="Название">
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
                            <?php 
                                foreach($Photos as $key => $value) {
                                    ?>
                                    <div class="photo_add" id="photo_<?= $key + 1 ?>" style="background-image: url(<?= '../' . $value['SRC'] ?>)">
                                    <button class="del_photo" type="button" onclick="delPhoto('photo_<?= $key + 1 ?>')">✕</button></div>
                                    <?php
                                }
                            ?>
                        </div>
                        <!-- <div class="file_photo">
                            <span>Заменить фотографии:</span>
                            <br>
                            <br>
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
                                            addSelectActive($TableCat, $Prod['IDCAT'])
                                        ?>
                                    </select>
                                </span>
                            </li>
                            <li>
                                <span>Класс</span>
                                <span>
                                    <select class="input-basic" name="calssProd" id="calssProd">
                                        <option value=""></option>
                                        <option value="1" <?php 
                                            if ($Prod['CLASS'] == 1) echo 'selected="selected"';
                                        ?>>Премиум</option>
                                        <option value="2" <?php 
                                            if ($Prod['CLASS'] == 2) echo 'selected="selected"';
                                        ?>>Дизайн</option>
                                        <option value="3" <?php 
                                            if ($Prod['CLASS'] == 3) echo 'selected="selected"';
                                        ?>>Комфорт</option>
                                        <option value="4" <?php 
                                            if ($Prod['CLASS'] == 4) echo 'selected="selected"';
                                        ?>>Эконом</option>
                                    </select>
                                </span>
                            </li>
                            <li>
                                <span>S помещения</span>
                                <span><input value="<?= $Prod['SQUARE'] ?>" name="squareProd" id="squareProd" class="input-basic" type="number" placeholder="м2"></span>
                            </li>
                            <li>
                                <span>Инвертор</span>
                                <span>
                                    <select class="input-basic" name="inverProd" id="inverProd">
                                        <option value=""></option>
                                        <option value="1" <?php 
                                            if ($Prod['INVER'] == 1) echo 'selected="selected"';
                                        ?>>Есть</option>
                                        <option value="0" <?php 
                                            if ($Prod['INVER'] == 0) echo 'selected="selected"';
                                        ?>>Нет</option>

                                    </select>
                                </span>
                            </li>
                            <li>
                                <span>Производитель</span>
                                <span><input value="<?= $Prod['PRODUCER'] ?>" name="producProd" id="producProd" class="input-basic" type="text" placeholder="Производитель"></span>
                            </li>
                            <li>
                                <span>Серия</span>
                                <span><input value="<?= $Prod['SERIES'] ?>" name="seriesProd" id="seriesProd" class="input-basic" type="text" placeholder="Серия"></span>
                            </li>
                            <li>
                                <span>Уровень шума</span>
                                <span><input value="<?= $Prod['NOISE'] ?>" name="noiseProd" id="noiseProd" class="input-basic" type="number" placeholder="дБ"></span>
                            </li>
                            <li>
                                <span>Мощность</span>
                                <span><input value="<?= $Prod['POWER'] ?>" name="powerProd" id="powerProd" class="input-basic" type="number" placeholder="кВт"></span>
                            </li>
                            <li>
                                <span>Гарантия</span>
                                <span><input value="<?= $Prod['GUARANTEE'] ?>" name="guarProd" id="guarProd" class="input-basic" type="text" placeholder="Гарантия"></span>
                            </li>
                            <li>
                                <span>Цена</span>
                                <span><input value="<?= $Prod['PRICE'] ?>" name="priceProd" id="priceProd" class="input-basic" type="number" placeholder="рублей"></span>
                            </li>
                        </ul>
                    </div>
    
    
                </div>
            </div>

            <div class="right-block">
                <button class="update" type="button" onclick="updProd()">Изменить товар</button>
            </div>
    
            <div class="left-block">
                <ul class="nav nav-tabs">
                    <li class="active-li" id="tabDesc-li">
                        <button type="button" id="tabDesc">Описание</button>
                    </li>
                </ul>
                <div class="tab-content" id="tab-content">
                    <div class="tab-pane active-div" id="tab-about">
                        <textarea name="descProd" id="descProd" class="input-basic" name="" rows="10" placeholder="Описание"><?= $Prod['DESCRIPTION'] ?></textarea>
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

            if (document.getElementById('file_photo_1').files.length == 0 && document.getElementById('photo_1') == null) {
                document.getElementById('file_photo_1').files = file.files;
                
                div.id = 'photo_1';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_1'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else if (document.getElementById('file_photo_2').files.length == 0 && document.getElementById('photo_2') == null) {
                document.getElementById('file_photo_2').files = file.files;
                
                div.id = 'photo_2';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_2'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else if (document.getElementById('file_photo_3').files.length == 0 && document.getElementById('photo_3') == null) {
                document.getElementById('file_photo_3').files = file.files;
                
                div.id = 'photo_3';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_3'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else if (document.getElementById('file_photo_4').files.length == 0 && document.getElementById('photo_4') == null) {
                document.getElementById('file_photo_4').files = file.files;
                
                div.id = 'photo_4';
                div.innerHTML = '<button class="del_photo" type="button" onclick="delPhoto(' + "'photo_4'" +')">✕</button>';
                div.style.backgroundImage = "url(" + src + ")";
                block.append(div);
                
            } else if (document.getElementById('file_photo_5').files.length == 0 && document.getElementById('photo_5') == null) {
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

    function updProd() {
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
        
        let elmentFilePhoto = Array();

        prov = true;

        data.forEach(element => {
            if (element['name'].startsWith('file_photo_')) {
                elmentFilePhoto.push(element);
            }
            if (element['value'] == '' && (!element['name'].startsWith('file_photo_'))) {
                document.getElementById(element['name']).style = style_input_red;
                prov = false;
            } else {
                if (!element['name'].startsWith('file_photo_1')) {
                    document.getElementById(element['name']).style = style_input_gray;
                }
            }
        });

        let fileCount = 0;
        for (let i = 1; i < 6; i++) {
            if (document.getElementById('photo_' + (i)) !== null) {
                fileCount++;
            }
        }

        if (fileCount == 0) {
            alert('Добавьте изображение');
            prov = false;
        }

        let FilesUpdDell = Array();
        for (let i = 0; i < 5; i++) {
            if (elmentFilePhoto[i]['value'] == '') {
                if (document.getElementById('photo_' + (i+1)) == null) {
                    FilesUpdDell.push(1);
                } else FilesUpdDell.push(0);
            } else FilesUpdDell.push(0);
        }

        if (!prov) return;
        
        let formData = new FormData(form);

        let i = 0;
        FilesUpdDell.forEach(element => {
            i++;
            formData.append('FilesDell_' + i, element);
        });
        
        var url = '../function/product/upd.php';

        let xhr = new XMLHttpRequest();    
        
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            alert(xhr.response);
        } 
    }

</script>

</body>
</html>