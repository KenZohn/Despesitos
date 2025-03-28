<?php
require_once 'Database.php';

function cadastrarUsuario($nome, $senha, $email) {
    try {
        $db = new Database();

        // Hash da senha para maior segurança
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nome, senha, email) VALUES (:nome, :senha, :email)";
        $stmt = $db->conecta->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':email', $email);

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

function loginUsuario($email, $senha) {
    try {
        $db = new Database();

        // Buscar o usuário pelo email
        $sql = "SELECT senha FROM usuario WHERE email = :email";
        $stmt = $db->conecta->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($senha, $result['senha'])) {
            echo "Login bem-sucedido! Bem-vindo!";
            return true;
        } else {
            echo "E-mail ou senha inválidos.";
            return false;
        }
    } catch (PDOException $erro) {
        error_log($erro->getMessage());
        echo "Erro ao processar o login.";
        return false;
    }
}
