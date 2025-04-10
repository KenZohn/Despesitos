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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body data-page="paginaMenu" onload="criarGraficoPizza()">
    <div class="menu-lateral">
        <h2>Despesitos</h2>
        <h3>Menu</h3>
        <a href="./perfilView.php">Perfil</a>
        <a href="./menuView.php">Adicionar</a>
        <a href="./consultaView.php">Consultar</a>
        <a href="#">Relatório</a>
        <a href="../controller/logout.php">Sair</a>
    </div>

    <div class="container-esquerda">
        <div class="form-container">
            <h1 class="formTitle">Gastos por categoria</h1>
            <canvas id="graficoPizza" width="400" height="400"></canvas>
        </div>
    </div>

    <div class="container-direita">
    </div>
    <script src="script.js?v=2.0"></script>
    <script>
        async function criarGraficoPizza() {
            try {
                const response = await fetch('../controller/totalCategoria.php');
                const data = await response.json();

                const categorias = data.map(item => item.categoria);
                const valores = data.map(item => item.valor);

                // Configuração do gráfico
                const ctx = document.getElementById('graficoPizza').getContext('2d');
                const dados = {
                    labels: categorias, // Categorias como rótulos
                    datasets: [{
                        label: 'Despesas por Categoria',
                        data: valores, // Valores como dados
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                        ],
                        hoverOffset: 4
                    }]
                };

                const config = {
                    type: 'pie',
                    data: dados,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                };

                // Renderiza o gráfico
                new Chart(ctx, config);
            } catch (error) {
                console.error('Erro ao buscar os dados do gráfico:', error);
            }
        }
    </script>
</body>
</html>
