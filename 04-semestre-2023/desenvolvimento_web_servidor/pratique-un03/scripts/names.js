// Validação de dados: nome & sobrenome

function validarFormulario() {
  // Obtém os valores dos campos de nome e sobrenome
  var nome = document.getElementById("nome_contato").value;
  var sobrenome = document.getElementById("sobrenome_contato").value;

  // Define expressões regulares (/^[a-zA-Z\s]+$/) para verificar se os valores contêm apenas letras
  var nomeValido = /^[a-zA-Z]+$/.test(nome);
  var sobrenomeValido = /^[a-zA-Z\s]+$/.test(sobrenome);

  // Verifica se os campos de nome e sobrenome são válidos
  if (!nomeValido || !sobrenomeValido) {
    alert("Os campos de nome e sobrenome devem conter apenas letras."); //exibe um alerta, caso os campos não forem válidos.
    return false;
  }

  return true; //se verdadeiro retorne true.
}
