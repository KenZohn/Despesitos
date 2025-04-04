<?php
    session_start();

    if (!isset($_SESSION['cod_usuario'])) {
        header('Location: ../view/loginView.php');
        exit();
    }
?>