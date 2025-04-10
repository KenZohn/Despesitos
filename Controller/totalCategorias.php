<?php
session_start();
require_once '../model/despesasModel.php';

// Instancia o Model
$descricaoModel = new Despesas();

// Busca os totais por categoria para o usuário logado
$resultado = $descricaoModel->buscarTotalCategorias($_SESSION['cod_usuario']);

// Transforma os dados em JSON
header('Content-Type: application/json');
echo json_encode($resultado);
?>
