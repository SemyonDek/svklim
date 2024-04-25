<?php
    require_once('../config/main_text.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/updMainText.css">
</head>
<body>
    
<?php 
    require_once('header-admin.php')
?>

<div id="updTextBody">
    <div class="layout">

        <div class="headerUpd">
            <h3 class="titleUpd">Изменение текста на главной</h3>
        </div>

        <div class="bodyUpd">    
            <form id="formUpdText" action="">
                <div class="inputBlock">
                    <div class="title-input">Заголовок:</div>
                    <input id="title" class="input-basic" type="text" placeholder="Заголовок" name="title" value="<?= $MainText['NAME'] ?>">
                </div>
                <div class="inputBlock">
                    <div class="title-input">Описание:</div>
                    <textarea id="text" class="input-basic" name="text" rows="8" placeholder="Описание"><?= $MainText['TEXT'] ?></textarea>
                </div>
                <button class="update" type="button" onclick="updMainText()" >Изменить</button>
            </form>
            <button class="update" type="button" onclick="javascript:history.back()" >Вернуться назад</button>
        </div>

    </div>
</div>


<script>
    function updMainText() {
        const form = document.getElementById('formUpdText');
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
        var url = '../function/main_text/upd.php';
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