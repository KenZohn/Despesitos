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
<body data-page="paginaMenu" onload="atualizarTabelaPerfil(), buscarNome(), buscarTotalCategoria()">
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
            <form>
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="cx_nome" readonly>
            </form>
        </div>
        <div class="form-container">
        <h3 class="formTitle">Total por categoria</h3>
            <form>
                <div class="input-container">
                    <img src="./icons/alimentacao.png" alt="Alimentação">
                    <input type="text" id="alimentacao" name="cx_alimentacao" readonly>
                </div>

                <div class="input-container">
                    <img src="./icons/educacao.png" alt="Educação">
                    <input type="text" id="educacao" name="cx_educacao" readonly>
                </div>

                <div class="input-container">
                    <img src="./icons/lazer.png" alt="Lazer">
                    <input type="text" id="lazer" name="cx_lazer" readonly>
                </div>

                <div class="input-container">
                    <img src="./icons/moradia.png" alt="Moradia">
                    <input type="text" id="moradia" name="cx_moradia" readonly>
                </div>

                <div class="input-container">
                    <img src="./icons/saude.png" alt="Saúde">
                    <input type="text" id="saude" name="cx_saude" readonly>
                </div>

                <div class="input-container">
                    <img src="./icons/transporte.png" alt="Transporte">
                    <input type="text" id="transporte" name="cx_transporte" readonly>
                </div>

                <div class="input-container">
                    <img src="./icons/outros.png" alt="Outros">
                    <input type="text" id="outros" name="cx_outros" readonly>
                </div>
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
