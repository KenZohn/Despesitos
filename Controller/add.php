<?php
    session_start();
    require_once '../model/despesasModel.php';

    // TODO: Trazer id do usuário para link com despesa, pegar id do usuário pelo email

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $descricao = $_POST['cx_descricao'];
        $categoria = $_POST['cx_categoria'];

        $dia = $_POST['cx_dia'];
        $mes = $_POST['cx_mes'];
        $ano = $_POST['cx_ano'];

        $data = "$ano/$mes/$dia";

        $valor = $_POST['cx_valor'];

        $descricaoModel = new Despesas();
        $resultado = $descricaoModel -> adicionarDespesa($descricao, $valor, $categoria, $data);

        // TODO: Melhorar sistema de mensagens
        if ($resultado) {
            header('Location: ../view/menuView.php');
        } else {
            $_SESSION['mensagem'] = "Erro: Falha ao adicionar a despesa.";
            header('Location: ../view/menuView.php');
        }

    } else {
        require_once '../view/loginView.php';
    }   

?>