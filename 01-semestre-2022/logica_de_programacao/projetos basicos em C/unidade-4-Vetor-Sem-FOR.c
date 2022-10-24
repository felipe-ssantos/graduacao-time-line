//Exemplo de vetores sem 'for'
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

float notas[5] = {7, 8, 5, 9.9, 5.2};
// declarando e incializando o vetor notas
printf("Exibindo os Valores do Vetor\n\n");
printf("notas[0] = %.1f\n", notas[0]);
printf("notas[1] = %.1f\n", notas[1]);
printf("notas[2] = %.1f\n", notas[2]);
printf("notas[3] = %.1f\n", notas[3]);
printf("notas[4] = %.1f\n", notas[4]);

getch();
return 0;
}