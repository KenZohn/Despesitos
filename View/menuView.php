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
        <div class="pure-menu custom-restricted-width menu-lateral" id="side-menu">
            <span class="pure-menu-heading">Gastritos</span>
            <ul class="pure-menu-list">
                <li class="pure-menu-item">
                    <a href="#" class="pure-menu-link">Adicionar</a>
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

        <div class="container">
            <div class="horizontal-div">
                <form class="pure-form pure-form-stacked" id="resumo" method="POST" action="">
                    <fieldset>
                        <div class="pure-u-1 pure-u-md-1-3">
                            <label>Total do mês:</label>
                            <input id="aligned-name" type="text" name="cx_descricao" readonly/>
                        </div>

                        <div class="pure-u-1 pure-u-md-1-3 total-despesa">
                            <label>Total do mês passado:</label>
                            <input id="aligned-name" type="text" name="cx_valor" readonly/>
                        </div>

                        <div class="pure-u-1 pure-u-md-1-3 total-despesa">
                            <label>Total do ano:</label>
                            <input id="aligned-name" type="text" name="cx_valor" readonly/>
                        </div>
                    </fieldset>
                </form>
            
                <form class="pure-form pure-form-aligned"  method="POST" action="">
                    <fieldset>
                        <div class="pure-control-group">
                            <input id="aligned-name" type="text" placeholder="Descrição" name="cx_descricao" required/>
                        </div>

                        <div class="pure-u-1 pure-u-md-1-3" id="categoria-selecao">
                            <select id="input-categoria" class="pure-input-1-2" name="cx_categoria">
                                <option>Alimentação</option>
                                <option>Educação</option>
                                <option>Lazer</option>
                                <option>Moradia</option>
                                <option>Saúde</option>
                                <option>Transporte</option>
                                <option>Outros</option>
                            </select>
                        </div>

                        <div id="data-selecao">
                            <select id="dia" class="input-selecao" name="cx_dia"></select>
                            <select id="mes" class="input-selecao" name="cx_mes"></select>
                            <select id="ano" class="input-selecao" name="cx_ano"></select>
                        </div>

                        <div class="pure-control-group">
                            <input id="aligned-name" type="text" placeholder="Valor" name="cx_valor" required/>
                        </div>
                        <div class="pure-control">
                            <button type="submit" class="pure-button pure-button-primary" name="bt1">Adicionar</button>
                        </div>
                        
                        <div class="pure-control">
                            <button type="reset" class="pure-button" id="btCadastrar" name="bt2">Limpar</button>
                        </div>
                    </fieldset>
                </form>
            </div>

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