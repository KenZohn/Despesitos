<!DOCTYPE html>
<html>
    <head>
        <title>Despesitos</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styleLogin.css">
    </head>
    <body class="loginCadastro">
        <form class="pure-form pure-form-aligned"  method="POST" action="../Controller/cadastro.php">
            <h1>Despesitos</h1>
            <h2>Criar conta</h2>
            <fieldset>
                <div class="pure-control-group">
                    <input id="aligned-name" type="text" placeholder="Nome" name="cx_nome"/>
                </div>
                <div class="pure-control-group">
                    <input id="aligned-name" type="email" placeholder="E-mail" name="cx_email"/>
                </div>
                <div class="pure-control-group">
                    <input id="aligned-password" type="password" placeholder="Senha" name="cx_senha"/>
                </div>
                <div class="pure-control">
                    <button type="submit" class="pure-button pure-button-primary" name="bt1">Criar</button>
                </div>

                <hr class="linha-divisoria">

                <div class="pure-control btLoginCadastro">
                    <button type="button" onclick="window.location.href='../View/loginView.php';" class="pure-button pure-button-primary" id="btVoltar" name="bt2">Voltar</button>
                </div>
            </fieldset>
        </form>

        <?php
        if (isset($_GET['error'])) {
            echo "Login falhou. Tente novamente.";
        }
        ?>
    </body>
</html>