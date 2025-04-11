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
<body class="main-menu" data-page="paginaConsulta" onload="filtrarTabela(), atualizarTotais()">
    <div class="menu-lateral">
        <h2>Despesitos</h2>
        <h3>Menu</h3>
        <a href="./perfilView.php">Perfil</a>
        <a href="./editarPerfilView.php">Editar Perfil</a>
        <a href="./menuView.php">Adicionar</a>
        <a href="#">Consultar</a>
        <a href="./relatorioView.php">Relatório</a>
        <a href="../controller/logout.php">Sair</a>
    </div>

    <div class="container-esquerda">
        <div class="form-container">
            <h1 class="formTitle">Consultar</h1>
            <form>
                <label>Mês</label>
                <div style="display: flex; gap: 5px;">
                    <select id="mesConsulta" name="cx_mes" onchange="filtrarTabela(), atualizarTotais()" required>
                        <option>Todos</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                </div>
                <label>Ano</label>
                <div style="display: flex; gap: 5px;">
                    <select id="anoConsulta" name="cx_ano" onchange="filtrarTabela(), atualizarTotais()" required>
                        <option>Todos</option>
                        <option>2023</option>
                        <option>2024</option>
                        <option>2025</option>
                        <option>2026</option>
                    </select>
                </div>
                <label for="categoria">Categoria</label>
                <select id="categoriaConsulta" name="cx_categoria" onchange="filtrarTabela(), atualizarTotais()" required>
                    <option>Todos</option>
                    <option>Alimentação</option>
                    <option>Educação</option>
                    <option>Lazer</option>
                    <option>Moradia</option>
                    <option>Saúde</option>
                    <option>Transporte</option>
                    <option>Outros</option>
                </select>
            </form>
        </div>

        <div class="form-container">
            <form>
                <label for="descricao">Total do mês</label>
                <input type="text" name="cx_total_mes" readonly>
                <label for="descricao">Total do ano</label>
                <input type="text" name="cx_total_ano" readonly>
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
    <script src="script.js?v=2.0"></script>
</body>
</html>