//Exemplo de vetores com 'for'
#include <stdio.h>
#include <locale.h>
#include <windows.h>
#include <conio.h>

// Todo código em linguagem C deve começar com 'int main(){}'
int main(void) {

	// Define o valor das páginas de código UTF-8 e default do Windows
  	UINT CPAGE_UTF8 = 65001;
  	UINT CPAGE_DEFAULT = GetConsoleOutputCP();

  	// Define codificação como sendo UTF-8
  	SetConsoleOutputCP(CPAGE_UTF8);
//
int i;

float num[100];

for( i = 0 ; i < 100; i++)// na estrutura de repetição 'for' não se encerra o código com ';' ou ponto e virgula.

{

printf("\nDigite as posições até 100:");
scanf("%f", &num[i]);
   

}

for( i = 0 ; i <= 99; i++)

{
printf("\nExiba os números digitados: %f.1", num[1]);
}

getch();
return 0;
}