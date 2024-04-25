<?php
    require_once('../../config/connect.php');

    $id = $_POST['idSlide'];

    $Slide = mysqli_query($ConnectDatabase, "SELECT * FROM `sliders` WHERE `ID`='$id'");
    $Slide = mysqli_fetch_assoc($Slide);
    unlink('../../'.$Slide['PHOTO']);

    mysqli_query($ConnectDatabase, "DELETE FROM sliders WHERE `sliders`.`ID` = $id");

    require_once('../../config/sliders.php');

    slidersAdm($TableSlider);

?>