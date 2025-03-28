<?php
require_once 'Database.php';

class LoginUsuario {
    public function login($email, $senha) {
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
}
?>