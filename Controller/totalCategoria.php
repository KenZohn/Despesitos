<?php
session_start();
require_once '../model/despesasModel.php';

$data = json_decode(file_get_contents("php://input"), true); // Decodifica o JSON do corpo
$mes = $data['cx_mes'] ?? 'Todos'; // Captura os valores enviados
$ano = $data['cx_ano'] ?? 'Todos'; // Captura os valores enviados

// Instancia o Model
$descricaoModel = new Despesas();
$resultado = $descricaoModel->buscarTotalCategoria($_SESSION['cod_usuario'], $mes, $ano);

// Transforma os dados em JSON
$jsonResultado = json_encode($resultado);

// Exibe o JSON
header('Content-Type: application/json');
echo $jsonResultado;
?>
