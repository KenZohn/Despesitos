<?php
session_start();
require_once '../model/usuarioModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hashear a senha
    $cod_usuario = $_SESSION['cod_usuario']; // Certifique-se de que esse valor está definido corretamente

    $usuarioModel = new Usuario();

    // Aqui passamos os 4 argumentos esperados
    $resultado = $usuarioModel->atualizarPerfil($cod_usuario, $nome, $email, $senha);

    if ($resultado) {
        header('Location: ../view/perfilView.php?sucesso=1');
    } else {
        header('Location: ../view/editarPerfilView.php?erro=1');
    }
}
?>
