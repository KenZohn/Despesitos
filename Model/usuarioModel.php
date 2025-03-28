<?php
require_once 'Database.php';

class Usuario {
    private $db;

    // Construtor para inicializar a conexão
    public function __construct() {
        $this->db = new Database();
    }

    // Método para validar o formato do email
    public function validarEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Método para cadastrar usuário
    public function cadastrarUsuario($nome, $senha, $email) {
        try {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Hash para segurança

            $sql = "INSERT INTO usuario (nome, senha, email) VALUES (:nome, :senha, :email)";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':senha', $senhaHash);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                echo "Usuário cadastrado com sucesso!";
                return true;
            } else {
                echo "Falha ao cadastrar o usuário.";
                return false;
            }
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            echo "Erro ao processar o cadastro.";
            return false;
        }
    }

    // Método para autenticar usuário (login)
    public function loginUsuario($email, $senha) {
        try {
            $sql = "SELECT senha FROM usuario WHERE email = :email";
            $stmt = $this->db->conecta->prepare($sql);
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
}
