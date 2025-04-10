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
        <h1 class="formTitle">Relatório</h1>
            <form>
                <label>Mês</label>
                <div style="display: flex; gap: 5px;">
                    <select id="mesConsulta" name="cx_mes" onchange="criarGraficoPizza()" required>
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
                    <select id="anoConsulta" name="cx_ano" onchange="criarGraficoPizza()" required>
                        <option>2023</option>
                        <option>2024</option>
                        <option>2025</option>
                        <option>2026</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="container-direita">
        <h1 class="formTitle">Gastos por categoria</h1>
        <div style="width: 50%; min-width: 400px; margin: auto;">
            <canvas id="graficoPizza"></canvas>
        </div>
    </div>
    <script src="script.js?v=2.0"></script>
    <script>
        let graficoAtual; // Variável global para manter o gráfico atual

        async function criarGraficoPizza() {
        try {
            // Captura os valores dos selectboxes
            const mes = document.getElementById('mesConsulta').value;
            const ano = document.getElementById('anoConsulta').value;

            // Prepara o corpo da requisição com os valores
            const body = {
                cx_mes: mes,
                cx_ano: ano
            };

            // Faz a requisição ao backend com os valores selecionados
            const response = await fetch('../controller/totalCategoria.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(body) // Converte o objeto para JSON
            });

            const data = await response.json();

            const categorias = data.map(item => item.categoria);
            const valores = data.map(item => item.valor);

            // Verifica se um gráfico já existe e destrói
            if (graficoAtual) {
                graficoAtual.destroy(); // Destrói o gráfico anterior
            }

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
            graficoAtual = new Chart(ctx, config);
        } catch (error) {
            console.error('Erro ao buscar os dados do gráfico:', error);
        }
    }
    </script>
</body>
</html>
