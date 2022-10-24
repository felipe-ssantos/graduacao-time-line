#include <stdio.h>
#include <locale.h>
#include <windows.h>
#include <stdlib.h>

#define NUMERO_DE_TENTATIVAS 5
int main() {

	// Define o valor das páginas de código UTF-8 e default do Windows.
  	UINT CPAGE_UTF8 = 65001;
  	UINT CPAGE_DEFAULT = GetConsoleOutputCP();

  	// Define codificação como sendo UTF-8
  	SetConsoleOutputCP(CPAGE_UTF8);

	
	printf("********************************************************\n");
	printf("* Bem vindo ao verificador de números impares ou pares *\n");	
	printf("********************************************************\n");
	
	int numero;

	printf("Digite o valor do número" );
    scanf("%d", &numero);
	switch (numero % 2) {
        case 0 :
        printf("O numero e par");
        break;
    default
        printf("O numero e impar");
        break;
    }
	

    return 0;
}
