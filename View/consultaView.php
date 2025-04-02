<!DOCTYPE html>
<html>
    <head>
        <title>Despesitos</title>
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
    <body class="main-menu">
        <div class="pure-menu custom-restricted-width" id="side-menu">
            <span class="pure-menu-heading">Gastritos</span>
            <ul class="pure-menu-list">
                <li class="pure-menu-item">
                    <a href="menuView.php" class="pure-menu-link">Adicionar</a>
                </li>
                <li class="pure-menu-item">
                    <a href="#" class="pure-menu-link">Detalhes</a>
                </li>
                <li class="pure-menu-item">
                    <a href="#" class="pure-menu-link">Relatórios</a>
                </li>
                <li class="pure-menu-item">
                    <a href="../controller/logout.php" class="pure-menu-link">Sair</a>
                </li>
            </ul>
        </div>

        <div class="container-consulta">
            <form class="pure-form pure-form-stacked consulta-form">
                <fieldset>
                    <legend>Selecione o mês</legend>
                    <div class="pure-g">
                        <div class="pure-u-1 pure-u-md-1-3 data-form">
                            <label for="mes">Mês</label>
                            <select id="mes" class="pure-input-1-2" name="cx_mes"></select>
                        </div>
                        <div class="pure-u-1 pure-u-md-1-3">
                            <label for="ano">Ano</label>
                            <select id="ano" class="pure-input-1-2" name="cx_ano"></select>
                        </div>
                    </div>
                </fieldset>
            </form>
            <table class="pure-table pure-table-horizontal" id="tabela">
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