<?php
    session_start();
    require_once '../model/UsuarioModel.php';

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $usuario = $_POST['cx_usuario'];
        $email = $_POST['cx_email'];
        $senha = $_POST['cx_senha'];

        $userModel = new UsuarioModel();
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