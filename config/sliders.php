<?php 
    require_once('connect.php');

    $TableSlider = mysqli_query($ConnectDatabase, "SELECT * FROM `sliders`");    
    $TableSlider = mysqli_fetch_all($TableSlider, MYSQLI_ASSOC);

    function slidersUser($TableSlider) {
        ?>
            <div id="home-slider">
                <div class="layout">
                    <div id="img-slider">
                        <?php 
                            foreach($TableSlider as $item) {
                                ?>
                                    <img src="<?= $item['PHOTO'] ?>" alt="" class="img-slider-img">
                                <?php
                            }
                        ?>
                    </div>
                    <div class="buttons-block">
                        <div id="left-button"></div>
                        <div id="right-button"></div>
                    </div>
                </div>
                <div class="layout">
                    <div id="link-slider">
                        <?php
                            $prov = true;
                            foreach($TableSlider as $item) {
                                if ($prov) {
                                    ?>
                                        <div class="button-slider active-slider-btn"><?= $item['NAME'] ?></div>
                                    <?php
                                    $prov = false;
                                } else {
                                    ?>
                                        <div class="button-slider"><?= $item['NAME'] ?></div>
                                    <?php

                                }
                            }
                        
                        ?>
                    </div>
                </div>
            </div>
        <?php
    }
    
    function slidersAdm($TableSlider) {
        ?>
            <div id="home-slider">
                <div class="layout">
                    <div id="img-slider">
                        <?php 
                            foreach($TableSlider as $item) {
                                ?>
                                    <img src="../<?= $item['PHOTO'] ?>" alt="" class="img-slider-img">
                                <?php
                            }
                        ?>
                    </div>
                    <div class="buttons-block">
                        <div id="left-button"></div>
                        <div id="right-button"></div>
                    </div>
                </div>
                <div class="layout">
                    <div id="link-slider">
                        <?php
                            $prov = true;
                            foreach($TableSlider as $item) {
                                if ($prov) {
                                    ?>
                                        <div class="button-slider active-slider-btn"><?= $item['NAME'] ?>
                                        <button class="delSlide" type="button" onclick="delSlider(<?= $item['ID'] ?>)" >x</button></div>
                                    <?php
                                    $prov = false;
                                } else {
                                    ?>
                                        <div class="button-slider"><?= $item['NAME'] ?>
                                        <button class="delSlide" type="button" onclick="delSlider(<?= $item['ID'] ?>)">x</button></div>
                                    <?php

                                }
                            }
                        ?>
                    </div>
                    <button class="update" type="button" onclick="addSlider()" >Добавить</button>
                </div>
            </div>
        <?php
    }

?>