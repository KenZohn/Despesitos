<?php
session_start();
require_once '../model/usuarioModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hashear a senha

    $usuarioModel = new Usuario();
    $cod_usuario = $_SESSION['cod_usuario'];

    $resultado = $usuarioModel->atualizarPerfil($cod_usuario, $nome, $email, $senha);

    if ($resultado) {
        header('Location: ../view/perfilView.php?sucesso=1');
    } else {
        header('Location: ../view/editarPerfilView.php?erro=1');
    }
}
?>


