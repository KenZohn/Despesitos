<?php
    require_once '../model/despesasModel.php';

    // Recebe a URL
    $url = $_SERVER['REQUEST_URI'];

    // Divide a URL a partir de cada /
    $partes = explode('/', $url);

    // Recebe o id que se localiza no final da URL
    $id = end($partes);

    $despesasModel = new Despesas();
    $resultado = $despesasModel -> excluirDespesa($id);
?>