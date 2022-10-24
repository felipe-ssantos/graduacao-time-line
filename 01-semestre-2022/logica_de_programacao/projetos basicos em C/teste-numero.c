#include <stdio.h> /* stdio.h é um cabeçalho da biblioteca padrão do C. 
Seu nome vem da expressão inglesa standard input-output header, 
que significa "cabeçalho padrão de entrada/saída". */

#include <locale.h> //Constantes para setlocale() e assuntos relacionados.
#include <windows.h>
//
#include <string.h>
/* A biblioteca <string.h> da linguagem C, 
contém uma série de funções para manipular strings.
Podendo ser usada para:
Copiar strings em C usando strcpy e strncpy;
Concatenar strings em linguagem C usando strcat e strncat;
Descobrir o tamanho de uma string em C usando strlen();
Comparar strings em C usando strcmp();*/

//

/* Na programação de computadores, uma cadeia de caracteres ou string é uma sequência de caracteres, 
geralmente utilizada para representar palavras, frases ou textos de um programa.*/

// Todo código em linguagem C deve começar com 'int main ()'
int main(int argc, char const *argv[]) {

	// Define o valor das páginas de código UTF-8 e default do Windows
  	UINT CPAGE_UTF8 = 65001;
  	UINT CPAGE_DEFAULT = GetConsoleOutputCP();

  	// Define codificação como sendo UTF-8
  	SetConsoleOutputCP(CPAGE_UTF8);

    char nome [40];
    char saudacao [30];
    /* toda vez que declarar a variável 'char' deve-se informar 
    a quantidade de posições a variavel deve possuir, 
    neste caso usamos '40' posições */
    printf("Digite seu nome:\n");
    fgets(nome, 40,stdin);
    printf("Nome: %s\n");
    fgets(saudacao, 30,stdin);
    printf("Nome: %s\nSaudação: Olá\n", nome, saudacao);

    return 0;

}