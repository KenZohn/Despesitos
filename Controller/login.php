<?php
    session_start();
    require_once '../model/usuarioModel.php';

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $email = $_POST['cx_email'];
        $senha = $_POST['cx_senha'];

        $userModel = new Usuario();
        $resultado = $userModel -> loginUsuario($email, $senha);

        if ($resultado) {
            $id = $userModel ->buscarIdPorEmail($email);
            $_SESSION['cod_usuario'] = $id;
            header('Location: ../view/menuView.php');
        } else {
            $_SESSION['mensagem'] = "Erro: Email ou senha inválidos.";
            header('Location: ../view/loginView.php');
        }

    } else {
        require_once '../view/loginView.php';
    }   

?>