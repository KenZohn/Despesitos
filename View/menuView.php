<!DOCTYPE html>
<html>
    <head>
        <title>Gastrite</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
        <style>
            .custom-restricted-width {
                width: 10em;
            }

            #side-menu {
                position: absolute;
                top: 0;
                left: 0;
            }
        </style>
    </head>
    <body>
        <div class="pure-menu custom-restricted-width" id="side-menu">
            <span class="pure-menu-heading">Gastritos</span>
            <ul class="pure-menu-list">
                <li class="pure-menu-item">
                    <a href="#" class="pure-menu-link">Gastos</a>
                </li>
                <li class="pure-menu-item">
                    <a href="#" class="pure-menu-link">Relatórios</a>
                </li>
                <li class="pure-menu-item">
                    <a href="#" class="pure-menu-link">Sair</a>
                </li>
            </ul>
        </div>

        <!--
        <form class="pure-form pure-form-aligned"  method="POST" action="../Controller/index.php">
            <h2>Gastos</h2>
            <fieldset>
                <div class="pure-u-1 pure-u-md-1-3">
                    <label for="multi-state">Categoria</label>
                    <select id="multi-state" class="pure-input-1-2">
                        <option>Alimentação</option>
                        <option>Transporte</option>
                        <option>Saúde</option>
                    </select>
                </div>
                <div class="pure-control-group">
                    <input id="aligned-name" type="text" placeholder="E-mail" name="cx_email"/>
                </div>
                <div class="pure-control-group">
                    <input id="aligned-password" type="password" placeholder="Senha" name="cx_senha"/>
                </div>
                <div class="pure-control">
                    <button type="submit" class="pure-button pure-button-primary" name="bt1">Adicionar</button>
                </div>
                
                <div class="pure-control">
                    <button type="reset" class="pure-button" id="btCadastrar" name="bt2">Limpar</button>
                </div>
            </fieldset>
        </form>
        -->

        <table class="pure-table pure-table-horizontal" id="tabela">
            <thead>
            <tr>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            <!-- As linhas da tabela serão inseridas aqui -->
            </tbody>
        </table>

        <script>
            // Exemplo de dados recebidos
            const dados = [
                { categoria: "Alimentação", descricao: "Marmitex", data: "11/03/2025", valor: "R$ 18,00" },
                { categoria: "Transporte", descricao: "Gasolina", data: "11/03/2025", valor: "R$ 122,22" },
                { categoria: "Moradia", descricao: "Aluguel", data: "15/03/2025", valor: "R$ 800,00" },
                { categoria: "Educação", descricao: "Curso de Cozinheiro", data: "15/03/2025", valor: "R$ 800,00" },
                { categoria: "Saúde", descricao: "Dipirona", data: "16/03/2025", valor: "R$ 32,00" },
                { categoria: "Lazer", descricao: "Show do JK", data: "17/03/2025", valor: "R$ 100,00" },
                { categoria: "Outros", descricao: "Algo", data: "20/03/2025", valor: "R$ 2000,00" }
            ];

            // Função para exibir os dados na tabela
            const tabelaBody = document.querySelector("#tabela tbody");

            dados.forEach(item => {
                const linha = document.createElement("tr");

                // Cria células para cada propriedade
                const celulaCategoria = document.createElement("td");
                celulaCategoria.textContent = item.categoria;
                linha.appendChild(celulaCategoria);

                const celulaDescricao = document.createElement("td");
                celulaDescricao.textContent = item.descricao;
                linha.appendChild(celulaDescricao);

                const celulaData = document.createElement("td");
                celulaData.textContent = item.data;
                linha.appendChild(celulaData);

                const celulaValor = document.createElement("td");
                celulaValor.textContent = item.valor;
                linha.appendChild(celulaValor);

                // Adiciona a linha na tabela
                tabelaBody.appendChild(linha);
            });
        </script>
    </body>
</html>