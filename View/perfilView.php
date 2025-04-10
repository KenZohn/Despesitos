<?php
    require_once '../controller/sessionCheck.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despesitos - Adicionar despesa</title>

    <link rel="stylesheet" href="./css/styleAdicionar.css">
</head>
<body data-page="paginaMenu" onload="atualizarTabelaPerfil(), buscarNome()">
    <div class="menu-lateral">
        <h2>Despesitos</h2>
        <h3>Menu</h3>
        <a href="#">Perfil</a>
        <a href="./menuView.php">Adicionar</a>
        <a href="./consultaView.php">Consultar</a>
        <a href="./relatorioView.php">Relatório</a>
        <a href="../controller/logout.php">Sair</a>
    </div>

    <div class="container-esquerda">
        <div class="form-container">
            <h1 class="formTitle">Perfil</h1>
            <form method="POST" action="../Controller/add.php">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="cx_nome" readonly>
            </form>
        </div>
    </div>

    <div class="container-direita">
        <table class="" id="tabela">
            <thead>
            <tr>
                <th>Ano</th>
                <th>Mês</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            <!-- As linhas da tabela serão inseridas aqui -->
            </tbody>
        </table>
    </div>
    <script src="script.js?v=2.0"></script>
</body>
</html>
