<!DOCTYPE html>
<html>
    <head>
        <title>Gastrite</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <form class="pure-form pure-form-aligned"  method="POST" action="../controller/index.php">
            <h1>Gastritos</h1>
            <h2>Login</h2>
            <fieldset>
                <div class="pure-control-group">
                    <input id="aligned-name" type="text" placeholder="E-mail" name="cx_email"/>
                </div>
                <div class="pure-control-group">
                    <input id="aligned-password" type="password" placeholder="Senha" name="cx_senha"/>
                </div>
                <div class="pure-control">
                    <button type="submit" class="pure-button pure-button-primary" name="bt1">Entrar</button>
                </div>
                <div class="pure-control">
                    <button type="button" onclick="window.location.href='../View/cadastroView.php';" class="pure-button" id="btCadastrar" name="bt2">Criar novo usuário</button>
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