<?php
    session_start();

    // Limpa as variáveis da sessão
    session_unset();

    session_destroy();

    header('Location: ../view/loginView.php');
?>