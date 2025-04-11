<?php
require_once 'Database.php';

class Usuario {
    private $db;

    // Construtor para inicializar a conexão
    public function __construct() {
        $this->db = new Database();
    }

    //   validar o formato do email
    public function validarEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    //  cadastrar usuário
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

    //  autenticar usuário (login)
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
    //  buscar o usuario por email
    public function buscarIdPorEmail($email) {
        try {
            $sql = "SELECT cod_usuario FROM usuario WHERE email = :email";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            // Verifica o resultado da consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['cod_usuario'] ?? null; // Retorna o ID ou null se não encontrado
        } catch (PDOException $erro) {
            error_log($erro->getMessage()); // Registra o erro no log
            return null; // Retorna null em caso de erro
        }
    }
    // atualizar perfil
    public function atualizarPerfil($cod_usuario, $nome, $email, $senha) {
        try {
            $sql = "UPDATE usuario SET 
                    nome = :nome, 
                    email = :email, 
                    senha = :senha 
                    WHERE cod_usuario = :cod_usuario";
    
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindParam(':cod_usuario', $cod_usuario, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return false;
        }
    }
    
    
    
}
