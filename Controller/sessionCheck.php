<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header('Location: ../view/loginView.php');
        exit();
    }
?>