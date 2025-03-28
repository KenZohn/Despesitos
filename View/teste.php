<?php
require_once 'Database.php';

function loginUsuario($nome, $senha) {
    try {
        $db = new Database();

        // Verificar se o usuário existe
        $sql = "SELECT senha FROM usuario WHERE nome = :nome";
        $stmt = $db->conecta->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($senha, $result['senha'])) {
            echo "Login bem-sucedido! Bem-vindo, $nome!";
            return true;
        } else {
            echo "Nome de usuário ou senha inválidos.";
            return false;
        }
    } catch (PDOException $erro) {
        error_log($erro->getMessage());
        echo "Erro ao processar o login.";
        return false;
    }
}

