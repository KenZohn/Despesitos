<?php
/**require_once  'Database.php';
try {
    $db = new Database();
    echo "Conexão com o banco de dados estabelecida com sucesso!";
} catch (Exception $e) {
    echo "Erro ao conectar com o banco de dados.";
}**/

require_once 'despesasModel.php';

$despesas = new Despesas();
if ($despesas->adicionarDespesa("Compras no supermercado", 200.50, "Alimentação", "2025-03-28")) {
    echo "Despesa adicionada com sucesso!";
} else {
    echo "Falha ao adicionar a despesa.";
}
?>