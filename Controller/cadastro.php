<?php
    session_start();
    require_once '../model/UsuarioModel.php';

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $usuario = $_POST['cx_usuario'];
        $senha = $_POST['cx_senha'];
        $email = $_POST['cx_email'];

        $resultado = $userModel->cadastrarUsuario($usuario, $senha, $email);

        if ($resultado) {
            $_SESSION['user'] = $usuario;
            header('Location: ../view/loginView.php');
        } else {
            header('Location: ../view/cadastroView.php');
        }

    } else {
        require_once '../view/cadastroView.php';
    }   

?>