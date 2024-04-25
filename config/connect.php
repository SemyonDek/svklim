<?php
    $ConnectDatabase = mysqli_connect(
        'localhost',
        'root',
        '',
        'svklim');

    if (!$ConnectDatabase) {
        echo 'Error!';
    }
?>