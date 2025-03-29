<?php
    session_start();

    // Limpa as variáveis da sessão
    $_SESSION = []; 

    session_destroy();

    header('Location: ../view/loginView.php');
?>