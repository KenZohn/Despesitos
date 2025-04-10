<?php
require_once 'Database.php';

class Despesas {
	private $db;

	// Construtor para inicializar a conexC#o
	public function __construct() {
		$this->db = new Database();
	}

	// função para adicionar uma nova despesa
	public function adicionarDespesa($descricao, $valor, $categoria, $data, $cod_usuario) {
		try {
			$sql = "INSERT INTO despesas (descricao, valor, categoria, data, cod_usuario) VALUES (:descricao, :valor, :categoria, :data, :cod_usuario)";
			$stmt = $this->db->conecta->prepare($sql);
			$stmt->bindParam(':descricao', $descricao);
			$stmt->bindParam(':valor', $valor);
			$stmt->bindParam(':categoria', $categoria);
			$stmt->bindParam(':data', $data);
			$stmt->bindParam(':cod_usuario', $cod_usuario);

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
    public function listarDespesas($cod_usuario) {
        try {
            $sql = "SELECT * FROM despesas WHERE cod_usuario = :cod_usuario ORDER BY data DESC";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }

    public function listarDespesasMes($cod_usuario) {
        try {
            $sql = "SELECT YEAR(data) AS ano, MONTH(data) AS mes, SUM(valor) AS total_valor FROM despesas WHERE cod_usuario = :cod_usuario
                    GROUP BY YEAR(data), MONTH(data) ORDER BY ano, mes;";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }

    // função para buscar despesas por categoria
    public function buscarPorCategoria($categoria, $cod_usuario) {
        try {
            $sql = "SELECT * FROM despesas WHERE categoria = :categoria AND cod_usuario = :cod_usuario ORDER BY data DESC";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }

	public function calcularTotalMensal($mes, $ano, $id) {
        try {
            $sqlMes = "SELECT SUM(valor) AS total_mes FROM despesas WHERE cod_usuario = :id";
            
            // Adiciona condições para o mês e o ano, se aplicável
            if ($mes !== 'Todos' && $ano !== 'Todos') {
                $sqlMes .= " AND MONTH(data) = :mes AND YEAR(data) = :ano";
            } elseif ($mes !== 'Todos') {
                $sqlMes .= " AND MONTH(data) = :mes";
            } elseif ($ano !== 'Todos') {
                $sqlMes .= " AND YEAR(data) = :ano";
            }
    
            $stmtMes = $this->db->conecta->prepare($sqlMes);
    
            // Define os parâmetros
            $stmtMes->bindParam(':id', $id, PDO::PARAM_INT);
            if ($mes !== 'Todos') {
                $stmtMes->bindParam(':mes', $mes, PDO::PARAM_INT);
            }
            if ($ano !== 'Todos') {
                $stmtMes->bindParam(':ano', $ano, PDO::PARAM_INT);
            }
    
            $stmtMes->execute();
            $resultMes = $stmtMes->fetch(PDO::FETCH_ASSOC);
            return $resultMes['total_mes'] ?? 0;
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return 0;
        }
    }

    public function calcularTotalAnual($ano, $id) {
        try {
            $sqlAno = "SELECT SUM(valor) AS total_ano FROM despesas WHERE cod_usuario = :id";
    
            // Adiciona condição para o ano, se aplicável
            if ($ano !== 'Todos') {
                $sqlAno .= " AND YEAR(data) = :ano";
            }
    
            $stmtAno = $this->db->conecta->prepare($sqlAno);
    
            // Define os parâmetros
            $stmtAno->bindParam(':id', $id, PDO::PARAM_INT);
            if ($ano !== 'Todos') {
                $stmtAno->bindParam(':ano', $ano, PDO::PARAM_INT);
            }
    
            $stmtAno->execute();
            $resultAno = $stmtAno->fetch(PDO::FETCH_ASSOC);
            return $resultAno['total_ano'] ?? 0;
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return 0;
        }
    }    
    

	public function buscarPorMes($mes, $ano) {
		// Valida os parâmetros fornecidos
		if ($mes < 1 || $mes > 12 || $ano < 1900 || $ano > date('Y')) {
			throw new InvalidArgumentException("Mês ou ano inválidos.");
		}

		try {
			// Consulta SQL para buscar despesas por mês e ano
			$sql = "SELECT * FROM despesas WHERE MONTH(data) = :mes AND YEAR(data) = :ano ORDER BY data DESC";
			$stmt = $this->db->conecta->prepare($sql);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
			$stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
			$stmt->execute();

			// Recupera os resultados
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (empty($result)) {
				return "Nenhuma despesa encontrada para o mês $mes/$ano.";
			}

			return $result; // Retorna as despesas encontradas
		} catch (PDOException $erro) {
			error_log($erro->getMessage()); // Registra o erro no log
			return []; // Retorna um array vazio em caso de erro
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

    public function buscarNome($cod_usuario) {
        try {
            $sql = "SELECT nome FROM usuario WHERE cod_usuario = :cod_usuario";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return null;
        }
    }

    public function buscarTotalCategoria($cod_usuario) {
        try {
            $sql = "SELECT categoria, SUM(valor) as valor FROM despesas WHERE cod_usuario = :cod_usuario GROUP BY categoria";
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }

    public function filtrarDespesas($mes, $ano, $categoria, $cod_usuario) {
        try {
            $sql = "SELECT * FROM despesas WHERE cod_usuario = :cod_usuario";

            // Condições para o filtro
            if ($mes !== 'Todos') {
                $sql .= " AND MONTH(data) = :mes";
            }
            if ($ano !== 'Todos') {
                $sql .= " AND YEAR(data) = :ano";
            }
            if (!empty($categoria)) {
                $sql .= " AND categoria = :categoria";
            }

            $sql .= " ORDER BY data DESC";

            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':cod_usuario', $cod_usuario, PDO::PARAM_INT);

            if ($mes !== 'Todos') {
                $stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
            }
            if ($ano !== 'Todos') {
                $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
            }
            if (!empty($categoria)) {
                $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }
}
?>
