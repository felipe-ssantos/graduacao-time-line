# Projeto de Atualização de Contatos

Este projeto demonstra como realizar operações de atualização em um banco de dados MySQL usando PHP e foi desenvolvido como parte da atividade pratica na unidade 3 da disciplina "Desenvolvimento Web Servidor" no 4º semestre do curso de Sistemas para Internet.

---

| :label: Tecnologias | PHP 8.2.4, HTML5, Bootstrap CDN, JavaScript e MySQL. |
| --------------- | :------------------------------------------------------ |
| :rocket: URL do projeto | http://nfssfacu.wuaze.com/        |
| 📌 Status | Em desenvolvimento...                        |

O banco de dados "contatos" foi configurado com a seguinte estrutura:

- Tabela "contatos" com colunas "id", "nome", "sobrenome" e "e-mail".

## Executando o Projeto

Siga as etapas abaixo para executar o projeto:

1. Configure o ambiente XAMPP e certifique-se de que o Apache e o servidor MySQL esteja em execução.
2. Importe a estrutura do banco de dados e os dados iniciais do arquivo SQL fornecido.
3. Clone ou faça o download deste repositório para o seu ambiente local.
4. Configure a conexão com o banco de dados no arquivo PHP fornecendo as informações corretas de host, nome de usuário e senha do seu ambiente XAMPP.
5. Abra o projeto em um navegador web.
6. Você verá uma lista de contatos da tabela "contatos".
7. No formulário de atualização, insira o ID do contato que você deseja atualizar.
8. Preencha os campos com as novas informações desejadas (novo nome, novo sobrenome, novo email).
9. Clique no botão "Atualizar" para enviar o formulário e atualizar os dados na tabela.
10. Você receberá uma mensagem de confirmação após a atualização bem-sucedida.

---

### Novas funcionalidades

*Tomei a liberdade de usar a criatividade e adicionar novas funcionalidades para teste. Apesar de não ter sido solicitado na atividade em questão. Portanto, não adicionarei mais atualizações já que se trata de um pequeno projeto, por isso pode existe pequenos erros.*

1. Criei a página inicial, que serve como página de login.
2. Implementei a página de cadastro, permitindo que os usuários se registrem para acessar a lista de contatos. (Caso não queira se cadastrar e só conectar-se como usuário: 'teste' e senha:123456)
3. Desenvolvi na página de "Lista de Contatos" (contatos.php) um formulário que possibilita aos usuários cadastrar novos contatos. A lista começa vazia, sendo necessário que o usuário cadastre um novo contato para que ele apareça na lista. Além disso, o 'Formulário de atualização' permanece para que o usuário possa atualizar os dados já cadastrados na lista.
4. Adicionei algumas mensagens de alerta para sinalizar as ações realizadas no sistema, embora ainda necessitem de alguns ajustes.
5. Incluí na tabela de contatos um botão "Excluir" para permitir que os usuários removam contatos que já tenha cadastrado.
6. Adicionei o botão "Sair do Sistema", permitindo que os usuários se desconectem.
7. Cada usuário possui sua lista exclusiva, portanto, pode realizar as alterações necessárias sem interferir na lista de outros usuários cadastrados no sistema.
8. Troquei de hospedagem para melhor gerenciar os arquivos e outras funcionalidades.
9. Em breve, adicionarei o certificado SSL no site, para evitar mensagens de site inseguro em alguns navegadores.

**Observações:** Este projeto não é para fim comercial, se destina apenas para fins de atividade. Portanto, podem ocorrer alguns erros de lógica, não intencionais, devido à falta de tempo para análise detalhada. No entanto, no geral, ele atende ao que foi proposto.
