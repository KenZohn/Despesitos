<?php
    session_start();
    require_once '../model/despesasModel.php';

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $descricao = $_POST['cx_descricao'];
        $categoria = $_POST['cx_categoria'];

        $dia = $_POST['cx_dia'];
        $mes = $_POST['cx_mes'];
        $ano = $_POST['cx_ano'];

        $data = "$ano/$mes/$dia";

        $valor = $_POST['cx_valor'];

        $despesasModel = new Despesas();
        $resultado = $despesasModel -> adicionarDespesa($descricao, $valor, $categoria, $data, $_SESSION['cod_usuario']);

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