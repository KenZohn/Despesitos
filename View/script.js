function exibirTabela(dados) {
    // Função para exibir os dados na tabela
    const tabelaBody = document.querySelector("#tabela tbody");

    while (tabelaBody.firstChild) {
        tabelaBody.removeChild(tabelaBody.firstChild);
    }

    dados.forEach(item => {
        const linha = document.createElement("tr");
        linha.setAttribute("data-id", item.id); // Define o ID da linha

        // Cria células para cada propriedade
        const celulaDescricao = document.createElement("td");
        celulaDescricao.textContent = item.descricao;
        linha.appendChild(celulaDescricao);

        const celulaCategoria = document.createElement("td");
        celulaCategoria.textContent = item.categoria;
        linha.appendChild(celulaCategoria);

        const celulaData = document.createElement("td");
        celulaData.textContent = item.data;
        linha.appendChild(celulaData);

        const celulaValor = document.createElement("td");
        const valorFormatado = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(item.valor);
        celulaValor.textContent = valorFormatado;
        linha.appendChild(celulaValor);

        const celulaExcluir = document.createElement("td");
        celulaExcluir.className = "celulaExcluir";

        const botaoExcluir = document.createElement("button");
        botaoExcluir.className = "botaoExcluir";

        const iconeExcluir = document.createElement("img");
        iconeExcluir.src = "./icons/trash.png";
        iconeExcluir.alt = "Excluir";
        iconeExcluir.style.width = "20px";
        botaoExcluir.appendChild(iconeExcluir);

        // Adicionando o evento click
        botaoExcluir.addEventListener("click", async function () {
            const linha = botaoExcluir.parentNode.parentNode;
            const id = linha.getAttribute("data-id"); // Obtém o ID da linha
            console.log(`Excluindo o item com ID: ${id}`);

            const pageIdentifier = document.body.getAttribute("data-page");

            // Chamar o controller via API
            try {
                const response = await fetch(`../controller/delete.php/${id}`, {
                    method: 'DELETE',
                });

                if (response.ok) {
                    console.log('Item deletado com sucesso!');
                    linha.parentNode.removeChild(linha); // Remove a linha da tabela

                    if (pageIdentifier === "paginaMenu") {
                        atualizarTotalMes();
                    } else if (pageIdentifier === "paginaConsulta") {
                        atualizarTotais();
                    }
                } else {
                    console.error('Erro ao deletar o item:', response.statusText);
                }
            } catch (error) {
                console.error('Erro ao conectar com o servidor:', error);
            }
        });

        celulaExcluir.appendChild(botaoExcluir);
        linha.appendChild(celulaExcluir);

        tabelaBody.appendChild(linha);
    });
};

// Atualizar tabela
function atualizarTabela() {
    fetch('../controller/listar.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        exibirTabela(data)
    })
    .catch(error => {
        console.error('Erro ao chamar o controller:', error);
    });
};

// Filtrar tabela em mês, ano e categoria
function filtrarTabela() {
    // Obtendo os valores dos selectboxes
    const mes = document.getElementById('mesConsulta').value;
    const ano = document.getElementById('anoConsulta').value;
    const categoria = document.getElementById('categoriaConsulta').value;

    // Criando o objeto a ser enviado
    const filtro = {
        cx_mes: mes,
        cx_ano: ano,
        cx_categoria: categoria
    };

    // Fazendo a requisição ao controller
    fetch('../controller/filtrar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(filtro) // Enviando os dados como JSON
    })
    .then(response => response.json())
    .then(data => {
        // Exibir os dados na tabela
        exibirTabela(data);
    })
    .catch(error => {
        console.error('Erro ao chamar o controller:', error);
    });
}


// Inserir dados na tabela do perfil
function exibirTabelaPerfil(dados) {
    // Função para exibir os dados na tabela
    const tabelaBody = document.querySelector("#tabela tbody");

    while (tabelaBody.firstChild) {
        tabelaBody.removeChild(tabelaBody.firstChild);
    }

    dados.forEach(item => {
        const linha = document.createElement("tr");

        // Cria células para cada propriedade
        const celulaAno = document.createElement("td");
        celulaAno.textContent = item.ano;
        linha.appendChild(celulaAno);

        const celulaMes = document.createElement("td");
        celulaMes.textContent = item.mes;
        linha.appendChild(celulaMes);

        const celulaValor = document.createElement("td");
        const valorFormatado = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(item.total_valor);
        celulaValor.textContent = valorFormatado;
        linha.appendChild(celulaValor);

        tabelaBody.appendChild(linha);
    });
};

// Atualizar tabela do perfil
function atualizarTabelaPerfil() {
    fetch('../controller/tabelaPerfil.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        exibirTabelaPerfil(data)
    })
    .catch(error => {
        console.error('Erro ao chamar o controller:', error);
    });
};

// Atualizar o total do mês na página Adicionar
function atualizarTotalMes() {
    // Captura os valores selecionados
    const hoje = new Date();
    const mesAtual = hoje.getMonth() + 1; // Meses começam em 0, por isso +1
    const anoAtual = hoje.getFullYear(); // Ano atual

    // Cria o corpo da requisição
    const body = {
        cx_mes: mesAtual,
        cx_ano: anoAtual
    };

    // Faz a requisição POST
    fetch('../controller/totalDespesas.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body) // Transforma o objeto em JSON
    })
    .then(response => response.json())
    .then(data => {
        // Função para formatar números como moeda brasileira
        const formatCurrency = value => new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);

        // Atualiza os campos de entrada com os valores formatados
        const inputTotalMes = document.querySelector('input[name="cx_total_mes"]');
        
        if (inputTotalMes) {
            // Formata o valor antes de atualizar o campo
            inputTotalMes.value = formatCurrency(data.totalMes || 0);
        }
    })
    .catch(error => {
        console.error('Erro ao chamar o controller:', error);
    });
}


// Atualizar o total do mês e ano
function atualizarTotais() {
    // Captura os valores selecionados
    const mes = document.getElementById('mesConsulta').value;
    const ano = document.getElementById('anoConsulta').value;
    const categoria = document.getElementById('categoriaConsulta').value;

    // Cria o corpo da requisição
    const body = {
        cx_mes: mes,
        cx_ano: ano,
        cx_categoria: categoria
    };

    // Faz a requisição POST
    fetch('../controller/totalDespesas.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body) // Transforma o objeto em JSON
    })
    .then(response => response.json())
    .then(data => {
        // Função para formatar números como moeda brasileira
        const formatCurrency = value => new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);

        // Atualiza os campos de entrada com os valores formatados
        const inputTotalMes = document.querySelector('input[name="cx_total_mes"]');
        const inputTotalAno = document.querySelector('input[name="cx_total_ano"]');

        if (inputTotalMes) {
            // Formata o valor antes de atualizar o campo
            inputTotalMes.value = formatCurrency(data.totalMes || 0);
        }

        if (inputTotalAno) {
            // Formata o valor antes de atualizar o campo
            inputTotalAno.value = formatCurrency(data.totalAno || 0);
        }
    })
    .catch(error => {
        console.error('Erro ao chamar o controller:', error);
    });
}


function buscarNome() {
    fetch('../controller/perfil.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.nome) {
            const inputNome = document.getElementById('nome');
            inputNome.value = data.nome;
        } else {
            console.error('Nome não encontrado na resposta.');
        }
    })
    .catch(error => {
        console.error('Erro ao chamar o controller:', error);
    });
}

function buscarTotalCategorias() {
    fetch('../controller/totalCategorias.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Função para normalizar strings (remoção de acentos e caracteres especiais)
        const normalizeString = str => str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();

        // Função para formatar números como moeda brasileira
        const formatCurrency = value => new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);

        // Atualiza os campos com os dados do servidor
        if (data.length > 0) {
            data.forEach(item => {
                const categoriaId = normalizeString(item.categoria); // Normaliza a categoria
                const inputField = document.getElementById(categoriaId);
                if (inputField) {
                    // Formata o valor antes de atribuí-lo ao campo
                    inputField.value = item.valor !== null ? formatCurrency(item.valor) : formatCurrency(0);
                } else {
                    console.warn(`Categoria não reconhecida: ${item.categoria}`);
                }
            });
        } else {
            console.warn("Nenhum dado encontrado para as categorias.");
        }
    })
    .catch(error => {
        console.error('Erro ao chamar o controller:', error);
    });
}
document.getElementById('editarPerfilForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o recarregamento da página

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;

    // Envia os dados via fetch para o back-end
    fetch('../controller/EditarPerfil.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nome, email, senha })
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            alert('Perfil atualizado com sucesso!');
            // Armazena o novo nome no localStorage para usar na tela de perfil
            localStorage.setItem('novo_nome', data.novo_nome);
            window.location.href = './perfilView.php'; // Redireciona para a tela de perfil
        } else {
            alert('Erro ao atualizar perfil: ' + data.mensagem);
        }
    })
    .catch(error => console.error('Erro:', error));
});
document.addEventListener('DOMContentLoaded', function() {
    const novoNome = localStorage.getItem('novo_nome');
    if (novoNome) {
        document.getElementById('nome').value = novoNome; // Atualiza o campo "Nome"
        localStorage.removeItem('novo_nome'); // Limpa o localStorage após o uso
    }
});

