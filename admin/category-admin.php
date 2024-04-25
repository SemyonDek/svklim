<?php 
    $idCat = $_GET['idcat'];
    require_once('../config/category.php');
    require_once('../config/text_cat.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/category.css">
    <link rel="stylesheet" href="../css/footer-user.css">
    <link rel="stylesheet" href="../css/category-admin.css">
</head>
<body>
    
<?php 
    require_once('header-admin.php')
?>

<div id="title-category">
    <div class="layout">
        <h1 class="title-category">
            <?php 
                if ($idCat == 1) {
                    echo 'Кондиционеры';
                } elseif ($idCat == 2) {
                    echo 'Вентиляция';
                } elseif ($idCat == 3) {
                    echo 'Микроклимат';
                }
            ?>
        </h1>

        <form id="formAddCat" action="">
            <input id="idParent" type="hidden" name="idParent" value="<?= $idCat ?>">
            <div class="inputBlock">
                <div class="title-input">Фото:</div>
                <input id="photoCat" type="file" name="photoCat">
            </div>

            <div class="inputBlock">
                <div class="title-input">Название:</div>
                <input id="titleCat" class="input-basic" name="titleCat" type="text" placeholder="Заголовок">
            </div>

            <div class="inputBlock">
                <div class="title-input">Описание:</div>
                <textarea id="descrCat" class="input-basic" name="descrCat" rows="2" placeholder="Описание"></textarea>
            </div>

            <button class="update" type="button" onclick="addCat()">Добавить</button>
        </form>
    </div>
</div>

<?php 
    addCategoryAdm($TableCat, $idCat);
?>

<div id="category-info">
    <div class="layout">
        <form id="formTextUpdCat" action="">
            <input id="idParentText" type="hidden" name="idParentText" value="<?= $idCat ?>">
            <div class="inputBlock">
                <div class="title-input">Заголовок:</div>
                <input id="titleCatParent" name="titleCatParent" class="input-basic" type="text" placeholder="Заголовок" value="<?= $titleCat ?>">
            </div>

            <div class="inputBlock">
                <div class="title-input">Описание:</div>
                <textarea id="textCatParent" name="textCatParent" class="input-basic" rows="20" placeholder="Описание"><?= $textCat ?></textarea>
            </div>

            <button class="update" type="button" onclick="updTextCat()">Изменить</button>
        </form>
        
    </div>
</div>

<script>
    function addCat() {
        const form = document.getElementById('formAddCat');
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
                if (element['name'] == 'photoCat') {
                    alert('Добавьте фото')
                } else {
                    document.getElementById(element['name']).style = style_input_red;
                }
                prov = false;
            } else {
                if (element['name'] !== 'photoCat') {
                    document.getElementById(element['name']).style = style_input_gray;
                }
            }
        });
        if (!prov) return;
        
        let formData = new FormData(form);
        var url = '../function/category/add.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.responseType = 'document';
        xhr.send(formData);
        xhr.onload = () => {
            alert('Категория добавлена');
            document.getElementById('category-list-categories').innerHTML = xhr.response.getElementById('category-list-categories').innerHTML;
            data.forEach(element => {
                if (element['name'] !== 'idParent') {
                    document.getElementById(element['name']).value = '';
                }
            });
        } 
    }

    function updTextCat() {
        const form = document.getElementById('formTextUpdCat');
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
                document.getElementById(element['name']).style = style_input_red;
                prov = false;
            } else {
                document.getElementById(element['name']).style = style_input_gray;
            }
        });
        if (!prov) return;
        
        let formData = new FormData(form);
        var url = '../function/text_cat/upd.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.send(formData);
        xhr.onload = () => {
            alert('Текст изменен');
        } 
    }

    function delCat(id, idCat) {
        let formData = new FormData();
        formData.append('idCat', id);
        formData.append('idParent', idCat);
        var url = '../function/category/del.php';
        let xhr = new XMLHttpRequest();    
        xhr.open('POST', url);
        xhr.responseType = 'document';
        xhr.send(formData);
        xhr.onload = () => {
            if (xhr.response.getElementById('category-list-categories') == null) {
                alert('В категории есть товары');
            } else {
                alert('Категория удалена');
                document.getElementById('category-list-categories').innerHTML = xhr.response.getElementById('category-list-categories').innerHTML
            }
        } 
    }


</script>


</body>
</html>