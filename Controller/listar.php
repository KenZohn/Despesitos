<?php
    session_start();
    require_once '../model/despesasModel.php';

    // Instancia o Model
    $descricaoModel = new Despesas();
    $resultado = $descricaoModel->listarDespesas($_SESSION['cod_usuario']);

    // Transforma os dados em JSON
    $jsonResultado = json_encode($resultado);

    // Exibe o JSON
    header('Content-Type: application/json');
    echo $jsonResultado;
?>
