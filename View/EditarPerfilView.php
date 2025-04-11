<?php
require_once '../controller/sessionCheck.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="./css/styleEditarPerfil.css">
</head>
<body>
    <div class="menu-lateral">
        <h2>Despesitos</h2>
        <h3>Menu</h3>
        <a href="./perfilView.php">Perfil</a>
        <a href="./editarPerfilView.php">Editar Perfil</a>
        <a href="#">Adicionar</a>
        <a href="./consultaView.php">Consultar</a>
        <a href="./relatorioView.php">Relatório</a>
        <a href="../controller/logout.php">Sair</a>
    </div>

    <div class="container">
        <h1>Editar Perfil</h1>
        <form method="POST" action="../controller/AtualizarPerfil.php">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>

