// Validação do formulário
function validateForm() {
    const nome = document.getElementById("nome").value;
    const sobrenome = document.getElementById("sobrenome").value;
    const servico = document.getElementById("servico").value;
    const data = document.getElementById("data").value;
    
    

    if (nome === "" || sobrenome === "" || servico === "" || data === "") {
        alert("Todos os campos são obrigatórios.");
        return false;
    }
    return true;
}

// Recuperação e exibição de dados enviados via método GET
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const nome = urlParams.get('nome');
    const sobrenome = urlParams.get('sobrenome');
    const telefone = urlParams.get('servico');
    const email = urlParams.get('data');

    if (nome && sobrenome && servico && data) {
        document.getElementById("result").textContent = `Nome: ${nome}, Sobrenome: ${sobrenome}, Servico: ${servico}, Data: ${data}`;
    }
};
