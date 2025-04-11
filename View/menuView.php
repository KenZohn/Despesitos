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
<body data-page="paginaMenu" onload="atualizarTabela(), atualizarTotalMes()">
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


    <div class="container-esquerda">
        <div class="form-container">
            <h1 class="formTitle">Adicionar despesa</h1>
            <form method="POST" action="../Controller/add.php">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="cx_descricao" required>

                <label for="categoria">Categoria</label>
                <select id="categoria" name="cx_categoria" required>
                <option value="" disabled selected>Selecione uma categoria</option>
                    <option>Alimentação</option>
                    <option>Educação</option>
                    <option>Lazer</option>
                    <option>Moradia</option>
                    <option>Saúde</option>
                    <option>Transporte</option>
                    <option>Outros</option>
                </select>

                <label>Data</label>
                <div style="display: flex; gap: 5px;">
                    <select id="dia" name="cx_dia" required></select>
                    <select id="mes" name="cx_mes" required></select>
                    <select id="ano" name="cx_ano" required></select>
                </div>

                <label for="valor">Valor</label>
                <input type="number" step="0.01" id="valor" name="cx_valor" required>

                <button type="submit" name="bt1" onclick="atualizarTabela()">Adicionar</button>
            </form>
        </div>

        <div class="form-container">
            <form>
                <label for="descricao">Total do mês</label>
                <input type="text" name="cx_total_mes" readonly>
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
    <script src="scriptData.js?v=2.0"></script>
</body>
</html>
