<?php
require_once 'Database.php';

class Despesas {
    private $db;

    // Construtor para inicializar a conexão
    public function __construct() {
        $this->db = new Database();
    }

    // função para adicionar uma nova despesa
    public function adicionarDespesa($descricao, $valor, $categoria, $data) {
        try {
            $sql = "INSERT INTO despesas (descricao, valor, categoria, data) VALUES (:descricao, :valor, :categoria, :data)";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':data', $data);

            if ($stmt->execute()) {
                echo "Despesa adicionada com sucesso!";
                return true;
            } else {
                echo "Falha ao adicionar a despesa.";
                return false;
            }
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            echo "Erro ao processar a despesa.";
            return false;
        }
    }

    // função para listar todas as despesas
    public function listarDespesas() {
        try {
            $sql = "SELECT * FROM despesas ORDER BY data DESC";
            $stmt = $this->db->conecta->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }

    // função para buscar despesas por categoria
    public function buscarPorCategoria($categoria) {
        try {
            $sql = "SELECT * FROM despesas WHERE categoria = :categoria ORDER BY data DESC";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }

    // função para calcular o total das despesas
    public function calcularTotalDespesas() {
        try {
            $sql = "SELECT SUM(valor) AS total FROM despesas";
            $stmt = $this->db->conecta->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return 0;
        }
    }
    // funçao para buscar a despesa por periodo é um filtro que Permite buscar entre duas datas.
    public function buscarPorPeriodo($inicio, $fim) {
        try {
            $sql = "SELECT * FROM despesas WHERE data BETWEEN :inicio AND :fim ORDER BY data DESC";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fim', $fim);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }
    // para excluir
    public function excluirDespesa($id) {
        try {
            $sql = "DELETE FROM despesas WHERE id = :id";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return false;
        }
    }
    
}

?>