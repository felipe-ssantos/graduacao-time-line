//script pesquisar

// Espera até que o documento esteja completamente carregado
document.addEventListener("DOMContentLoaded", function () {
  // Obtém uma referência ao campo de entrada de pesquisa pelo ID
  const inputPesquisa = document.getElementById("pesquisarContatos");
  // Obtém uma referência ao contêiner da tabela pelo ID
  const tabelaContatos = document.getElementById("contatos-table-container");
  // Seleciona todas as linhas da tabela dentro do contêiner
  const linhas = tabelaContatos.querySelectorAll("tbody tr");

  // Adiciona um ouvinte de eventos de "input" ao campo de pesquisa
  inputPesquisa.addEventListener("input", function () {
    // Obtém o termo de pesquisa inserido no campo de entrada e o converte para minúsculas
    const termoPesquisa = inputPesquisa.value.toLowerCase();

    // Itera sobre todas as linhas da tabela
    linhas.forEach(function (linha) {
      // Obtém o texto completo da linha e o converte para minúsculas
      const textoLinha = linha.innerText.toLowerCase();

      // Verifica se o termo de pesquisa está contido no texto da linha
      if (textoLinha.includes(termoPesquisa)) {
        // Se a linha contiver o termo de pesquisa, exibe a linha
        linha.style.display = "";
      } else {
        // Se a linha não contiver o termo de pesquisa, oculta a linha
        linha.style.display = "none";
      }
    });
  });
});
