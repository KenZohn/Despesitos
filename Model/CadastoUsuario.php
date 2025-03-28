<?php
require_once 'Database.php';

class CadastroUsuario {
    public function cadastrarUsuario($nome, $senha, $email) {
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
}
?>
