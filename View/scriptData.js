//Select boxes da data
// Referências aos elementos <select>
const diaSelect = document.getElementById("dia");
const mesSelect = document.getElementById("mes");
const anoSelect = document.getElementById("ano");

// Função para calcular os dias de um mês específico
function calcularDias(mes, ano) {
    // Meses com 31 dias
    const mesesCom31Dias = [1, 3, 5, 7, 8, 10, 12];
    // Meses com 30 dias
    const mesesCom30Dias = [4, 6, 9, 11];

    if (mesesCom31Dias.includes(mes)) {
        return 31;
    } else if (mesesCom30Dias.includes(mes)) {
        return 30;
    } else if (mes === 2) { // Fevereiro
        // Verifica se é ano bissexto
        return (ano % 4 === 0 && (ano % 100 !== 0 || ano % 400 === 0)) ? 29 : 28;
    }
}

// Preencher os meses (1 a 12)
for (let i = 1; i <= 12; i++) {
    const opcao = document.createElement("option");
    opcao.value = i;
    opcao.textContent = i;
    mesSelect.appendChild(opcao);
}

// Preencher os anos (1900 a 2025, por exemplo)
const ano = new Date().getFullYear();
for (let i = 2023; i <= ano + 1; i++) {
    const opcao = document.createElement("option");
    opcao.value = i;
    opcao.textContent = i;
    anoSelect.appendChild(opcao);
}

// Atualizar os dias com base no mês e ano selecionados
function atualizarDias() {
    const mesSelecionado = parseInt(mesSelect.value);
    const anoSelecionado = parseInt(anoSelect.value);
    const diaSelecionado = parseInt(diaSelect.value); // Dia atual selecionado

    // Calcula os dias do mês selecionado
    const diasNoMes = calcularDias(mesSelecionado, anoSelecionado);

    // Limpa os dias existentes
    diaSelect.innerHTML = '';

    // Popula os dias novamente
    for (let i = 1; i <= diasNoMes; i++) {
        const opcao = document.createElement("option");
        opcao.value = i;
        opcao.textContent = i;
        diaSelect.appendChild(opcao);
    }

    // Mantém o dia selecionado, se ainda válido
    if (diaSelecionado <= diasNoMes) {
        diaSelect.value = diaSelecionado;
    } else {
        // Se o dia não for válido, ajusta para o último dia do mês
        diaSelect.value = diasNoMes;
    }
}

// Adiciona eventos para atualizar os dias quando o mês ou ano forem alterados
mesSelect.addEventListener("change", atualizarDias);
anoSelect.addEventListener("change", atualizarDias);

const hoje = new Date();
const diaAtual = hoje.getDate(); // Dia atual
const mesAtual = hoje.getMonth() + 1; // Mês atual (0-11, por isso adicionamos +1)
const anoAtual = hoje.getFullYear(); // Ano atual

// Define o valor padrão selecionado no combobox de anos
anoSelect.value = anoAtual;

// Define o valor padrão selecionado no combobox de meses
mesSelect.value = mesAtual;

atualizarDias();

// Define o valor padrão selecionado no combobox de dias
diaSelect.value = diaAtual;