<?php
    session_start();
    require_once '../model/despesasModel.php';

    $mes = $_POST['cx_mes'];
    $ano = $_POST['cx_ano'];

    $descricaoModel = new Despesas();

    $totalMensal = $descricaoModel->calcularTotalMensal($mes, $ano, $_SESSION['cod_usuario']);

    
    $totalAnual = $descricaoModel->calcularTotalAnual($ano, $_SESSION['cod_usuario']);

    // Enviar os resultados para algum lugar
?>
