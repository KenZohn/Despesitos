<?php
require_once 'Database.php';

function cadastrarUsuario($nome, $senha, $email, $telefone) {
    try {
        $db = new Database();

        // Hash da senha para maior segurança
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nome, senha, email, telefone) VALUES (:nome, :senha, :email, :telefone)";
        $stmt = $db->conecta->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Falha ao cadastrar o usuário.";
        }
    } catch (PDOException $erro) {
        error_log($erro->getMessage());
        echo "Erro ao processar o cadastro.";
    }
}
