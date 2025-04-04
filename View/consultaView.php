<?php
    require_once '../controller/sessionCheck.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despesitos - Consultar</title>

    <link rel="stylesheet" href="./css/styleAdicionar.css">
</head>
<body class="main-menu" onload="exibirTabela()">
    <div class="menu-lateral">
        <h2>Despesitos</h2>
        <h3>Menu</h3>
        <a href="./menuView.php">Adicionar</a>
        <a href="#">Consultar</a>
        <a href="../controller/logout.php">Sair</a>
    </div>

    <div class="container-esquerda">
        <div class="form-container">
            <h1 class="formTitle">Consultar</h1>
            <form method="POST" action="../Controller/add.php">
                <label>Mês</label>
                <div style="display: flex; gap: 5px;">
                    <select id="mes" name="cx_mes" required></select>
                </div>
                <label>Ano</label>
                <div style="display: flex; gap: 5px;">
                    <select id="ano" name="cx_ano" required></select>
                </div>
            </form>
        </div>

        <div class="form-container">
            <form>
                <label for="descricao">Total do mês</label>
                <input type="text" name="" readonly>
                <label for="descricao">Total do ano</label>
                <input type="text" name="" readonly>
            </form>
        </div>
    </div>

    <div class="container-direita">
        <table class="" id="tabela">
            <thead>
            <tr>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Data</th>
                <th>Valor</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <!-- As linhas da tabela serão inseridas aqui -->
            </tbody>
        </table>
    </div>
    <script src="script.js"></script>
</body>
</html>