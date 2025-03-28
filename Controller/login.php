<?php
    session_start();
    require_once '../model/usuarioModel.php';

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $email = $_POST['cx_email'];
        $senha = $_POST['cx_senha'];

        $resultado = loginUsuario($usuario, $senha, $email);

        if ($resultado) {
            $_SESSION['email'] = $email;
            header('Location: ../view/principalView.php');
        } else {
            header('Location: ../view/loginView.php');
        }

    } else {
        require_once '../view/loginView.php';
    }   

?>