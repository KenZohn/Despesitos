<?php
header('Content-Type: application/json; charset=utf-8'); // Define o tipo de retorno como JSON

// Verificar e tratar erros
try {
    session_start();
    require_once '../model/despesasModel.php';

    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou não enviados!');
    }

    $mes = $data['cx_mes'] ?? 'Todos';
    $ano = $data['cx_ano'] ?? 'Todos';
    $categoria = $data['cx_categoria'] ?? 'Todos';

    $descricaoModel = new Despesas();
    $resultado = $descricaoModel->filtrarDespesas($mes, $ano, $categoria, $_SESSION['cod_usuario']);

    echo json_encode($resultado);
} catch (Exception $e) {
    http_response_code(500); // Código de erro no servidor
    echo json_encode(['error' => $e->getMessage()]);
}
?>
