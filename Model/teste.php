<?php
require_once  'Database.php';

try {
    $db = new Database();
    echo "Conexão com o banco de dados estabelecida com sucesso!";
} catch (Exception $e) {
    echo "Erro ao conectar com o banco de dados.";
}
?>