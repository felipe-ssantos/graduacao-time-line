// Função para ocultar mensagens de sucesso ou erro após 3 segundos, tanto para o formulário de atualização como cadastro.
setTimeout(function () {
  var sucessoDiv = document.querySelector(".alert-success");
  var erroDiv = document.querySelector(".alert-danger");

  if (sucessoDiv) {
    sucessoDiv.style.display = "none";
  }

  if (erroDiv) {
    erroDiv.style.display = "none";
  }
}, 3500);
