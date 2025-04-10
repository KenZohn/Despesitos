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

    // função para excluir
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

    // função para listar todas as despesas está sendo usado no add despesas
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

    // função listar despesa está sendo usado no perfil para mostrar o total de cada mÊs
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

    // função para buscar despesas por categoria está sendo usado para o grafico
    public function buscarPorCategoria($categoria, $cod_usuario, $data) {
        try {
           
            $sql = "SELECT * FROM despesas 
            WHERE categoria = :categoria 
            AND cod_usuario = :cod_usuario 
            AND YEAR(data) AS ano, MONTH(data) 
            AS mes = :YEAR(data) AS ano, MONTH(data) 
            AS mes ORDER BY data DESC";


            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
         
    }

    //função para calcular o total por mes está sendo usada na tabela perfil e na consulta
	public function calcularTotalMensal($mes, $ano, $categoria, $id) {
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
            if ($categoria !== 'Todos') {
                $sqlMes .= " AND categoria = :categoria";
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
            if ($categoria !== 'Todos') {
                $stmtMes->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            }            
            
            $stmtMes->execute();
            $resultMes = $stmtMes->fetch(PDO::FETCH_ASSOC);
            return $resultMes['total_mes'] ?? 0;
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return 0;
        }
    }

    //função para calcular o total anual está sendo usado na consulta
    public function calcularTotalAnual($ano, $categoria, $id) {
        try {
            $sqlAno = "SELECT SUM(valor) AS total_ano FROM despesas WHERE cod_usuario = :id";
    
            // Adiciona condição para o ano, se aplicável
            if ($ano !== 'Todos') {
                $sqlAno .= " AND YEAR(data) = :ano";
            }
            if ($categoria !== 'Todos') { // Verifica explicitamente por 'Todos'
                $sqlAno .= " AND categoria = :categoria";
            }
    
            $stmtAno = $this->db->conecta->prepare($sqlAno);
    
            // Define os parâmetros
            $stmtAno->bindParam(':id', $id, PDO::PARAM_INT);
            if ($ano !== 'Todos') {
                $stmtAno->bindParam(':ano', $ano, PDO::PARAM_INT);
            }
            if ($categoria !== 'Todos') {
                $stmtAno->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            }            
    
            $stmtAno->execute();
            $resultAno = $stmtAno->fetch(PDO::FETCH_ASSOC);
            return $resultAno['total_ano'] ?? 0;
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return 0;
        }
    }

    //função buscar nome  
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

    //função buscar total categorias com parametros está sendo usado no grafico
    public function buscarTotalCategoria($cod_usuario, $mes = 'Todos', $ano = 'Todos') {
        try {
            $sql = "SELECT categoria, SUM(valor) AS valor 
                    FROM despesas 
                    WHERE cod_usuario = :cod_usuario";
    
            // Adiciona as condições de filtro para mês e ano
            if ($mes !== 'Todos' && $ano !== 'Todos') {
                $sql .= " AND MONTH(data) = :mes AND YEAR(data) = :ano";
            } elseif ($mes !== 'Todos') {
                $sql .= " AND MONTH(data) = :mes";
            } elseif ($ano !== 'Todos') {
                $sql .= " AND YEAR(data) = :ano";
            }
    
            $sql .= " GROUP BY categoria"; // Agrupamento por categoria
    
            $stmt = $this->db->conecta->prepare($sql);
    
            // Define os parâmetros
            $stmt->bindParam(':cod_usuario', $cod_usuario, PDO::PARAM_INT);
            if ($mes !== 'Todos') {
                $stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
            }
            if ($ano !== 'Todos') {
                $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
            }
    
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage());
            return [];
        }
    }

    // função buscar total categorias sem paremetros está sendo usado no perfil
    public function buscarTotalCategorias($cod_usuario) {
        try {
            $sql = "SELECT categoria, SUM(valor) AS valor 
                    FROM despesas 
                    WHERE cod_usuario = :cod_usuario 
                    GROUP BY categoria"; // Agrupa por categoria para somar os valores
    
            $stmt = $this->db->conecta->prepare($sql);
            $stmt->bindParam(':cod_usuario', $cod_usuario, PDO::PARAM_INT);
    
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage()); // Registra o erro para depuração
            return [];
        }
    }
    // função filtrar despesas está sendo usada em consultas
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
            if ($categoria !== 'Todos') { // Verifica explicitamente por 'Todos'
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
            if ($categoria !== 'Todos') { // Só vincula se for diferente de 'Todos'
                $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            }
    
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            error_log($erro->getMessage()); // Registra o erro para depuração
            return [];
        }
    }    
    
 }        
?>
