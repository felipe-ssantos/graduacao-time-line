/*Todo código em linguagem C deve conter as bibliotecas no inicio, para que o código seja lido
pelo compilador*/
#include <stdio.h>
#include <locale.h>
#include <windows.h>

//Não e obrigatorio criar essa constante 'NUMERO_DE_TENTATIVAS' em maiusculo, mas ela e escrita dessa forma por questões de convenção.
//Letra maiscula só usado em constantes na linguagem C
#define NUMERO_DE_TENTATIVAS 5
// Todo código em linguagem C deve começar com 'int main(){}'
int main() {

	// Define o valor das páginas de código UTF-8 e default do Windows
  	UINT CPAGE_UTF8 = 65001;
  	UINT CPAGE_DEFAULT = GetConsoleOutputCP();

  	// Define codificação como sendo UTF-8
  	SetConsoleOutputCP(CPAGE_UTF8);


	// Imprime o cabeçalho do desconto
	printf("*************************************\n");
	printf("* Bem vindo ao programa de desconto *\n");	
	printf("*************************************\n");
	
	int numerosecreto = 42;

	int chute;
	//Aqui com a variavel 'for' criamos o que se chama 'looping', para não repetir o código
	/* Dentro de parentese i vale 1, depois foi feita a condição 'i e menor ou igual a 3; 
	agora vamos para teceira parte 'i++' que chamamos de incremento, ou seja, i que valia 1 agora
	vale 2, que agora vale 3; sendo assim ele ira executar o bloco de código em quanto i for menor
	ou igual a 3 por 3 vezes */
	for(int i = 1; i <= NUMERO_DE_TENTATIVAS; i++) {
	/* printf imprime uma mensagem na tela; 
	%d usado para colocar uma mascara quando não quero mostrar uma variavel; 
	Usa-se \n para pular uma linha no código
	*/
		printf("Tentativas %d de %d\n", i, NUMERO_DE_TENTATIVAS);
		printf("Qual é o seu chute? \n");
		scanf("%d", &chute);
		printf("Seu chute foi %d \n", chute);
		
		/* Se o chute for igual ao numero secreto, então mostre o printf abaixo 
		"se" em código e 'if' sem aspas e com parentese; dentro do paretese
		colocamos a nossa condição neste caso a variavel é 'numerosecreto', usamos também 
		o simbolo '==' aqui não usa apenas um igual, pois um igual serve apenas para atribuir um valor.
		Com dois iguais estaremos usando o comando 'comparar', pois queremos ver se uma coisa
		e igual a outra */
		int acertou = (chute == numerosecreto);
		//A linguagem C neste caso da linha 39 resolve da seguinte forma 0 se falso e 1 se verdadeiro
		
		/* o if abaixo verificará se cair em 1 ele segue o código abaixo, se cair em 0
		ele não executara o que está dentro do if porque a condição e falsa */
		if(acertou) {
		// se o chute for igual a variavel numerosecreto, então imprima a mensagem abaixo
		// assim como 'main' usamos as {chaves} pois aqui criamos um bloco do código
			printf("Parabéns! Você acertou!\n");
			printf("Jogue de novo, você é um bom jogador!\n");

				//O 'for' possui uma instrução irmã no caso a 'break' onde esse comando estiver no bloco do código ira parar o loop
				//o 'break' e usado para parar o loop por questões de lógica
				break;
		}
		
		//Caso não, mostre o printf seguinte
		//Aqui usamos a função 'else' sem aspas, que o 'caso contrario'
		else {
			//podemos colocar 'ifs' dentro de 'elses' e vise versa
			int maior = chute > numerosecreto;
			/*A expressão colocada no if pode ser colocada em em uma variavel do tipo int ou inteiro
			que será sempre avaliada em 0 ou 1, sempre deve-se colocar um bom nome para a variavel
			por questões de legibilidade do código*/
			if(maior) {
				printf("Seu chute foi maior que o número secreto\n");
			}

			else {
				printf("Seu chute foi menor que o número secreto\n");
			}
			printf("Você errou! \n");
			printf("Mas não desanime, tente de novo!\n");
		}
	}
	//após repetir por 3 vezes na quarta tentativa extrapolando o número 3 se encerra o código.
	printf("Fim de jogo \n");
}

/* A instrução while é utilizada para laços de repetição com teste no início, tendo como base a estrutura ENQUANTO-FAÇA. 
As instruções scanf e printf correspondem a comandos de entrada e de saída, respectivamente. 
A instrução for é utilizada para laços de repetição baseados na estrutura PARA-ATÉ-FAÇA e a instrução do-while para estrutura REPITA-ATÉ. */