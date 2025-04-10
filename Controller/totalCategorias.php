<?php
session_start();
require_once '../model/despesasModel.php';

// Instancia o Model
$descricaoModel = new Despesas();

// Busca os totais por categoria para o usuário logado
$resultado = $descricaoModel->buscarTotalCategorias($_SESSION['cod_usuario']);

// Retorna valores padrão se o resultado estiver vazio
if (empty($resultado)) {
    $resultado = [
        ["categoria" => "Alimentacao", "valor" => 0],
        ["categoria" => "Educacao", "valor" => 0],
        ["categoria" => "Lazer", "valor" => 0],
        ["categoria" => "Moradia", "valor" => 0],
        ["categoria" => "Saude", "valor" => 0],
        ["categoria" => "Transporte", "valor" => 0],
        ["categoria" => "Outros", "valor" => 0]
    ];
}

// Transforma os dados em JSON
header('Content-Type: application/json');
echo json_encode($resultado);
?>
