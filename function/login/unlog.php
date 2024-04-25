<?php
    session_start();

    unset($_SESSION['account']);
    unset($_SESSION['accountId']);
    $_SESSION['basket'] = '';
    $_SESSION['basketSum'] = 0;

    header('Location: ../../index.php');
?>