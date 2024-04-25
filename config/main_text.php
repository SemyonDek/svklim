<?php 
    require_once('connect.php');

    $MainText = mysqli_query($ConnectDatabase, "SELECT * FROM `main_text`");    
    $MainText = mysqli_fetch_assoc($MainText);

    function addMainTextUser($MainText) {
        ?>
            <div id="about-us">
                <div class="layout">
                    <h1>
                        <?= $MainText['NAME'] ?>
                    </h1>    
                    <br>
                    <p>
                        <?= nl2br($MainText['TEXT']) ?>
                    </p>

                </div>
            </div>
        <?php
    }

    function addMainTextAdm($MainText) {
        ?>
            <div id="about-us">
                <div class="layout">
                    <h1>
                        <?= $MainText['NAME'] ?>
                    </h1>    
                    <br>
                    <p>
                        <?= nl2br($MainText['TEXT']) ?>
                    </p>
                    <a href="updMainText.php">
                        <button class="update" type="button">Изменить</button>
                    </a>
                </div>
            </div>
        <?php
    }

?>