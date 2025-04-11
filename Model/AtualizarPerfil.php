<?php
require_once 'Database.php';

public function atualizarPerfil($cod_usuario, $nome, $email, $senha) {
    try {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE cod_usuario = :cod_usuario";

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
?>
