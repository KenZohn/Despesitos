<?php
    session_start();
    require_once '../model/despesasModel.php';

    $data = json_decode(file_get_contents("php://input"), true); // Decodifica o JSON do corpo
    $mes = $data['cx_mes'] ?? 'Todos'; // Captura os valores enviados
    $ano = $data['cx_ano'] ?? 'Todos';

    $descricaoModel = new Despesas();

    $totalMensal = $descricaoModel->calcularTotalMensal($mes, $ano, $_SESSION['cod_usuario']);    
    $totalAnual = $descricaoModel->calcularTotalAnual($ano, $_SESSION['cod_usuario']);

    // Transforma os dados em JSON
    $response = [
        "totalMes" => $totalMensal,
        "totalAno" => $totalAnual
    ];
    header('Content-Type: application/json');
    echo json_encode($response);    
?>
