#include <stdio.h>
#include <locale.h>
#include <windows.h>

// Aluno: Nelson Felipe Silveira dos Santos | Polo M' Boi Mirim
// Disciplina: Lógica de programação - Unidade 3 - Atividade 3
// Objetivo: Imprimir números pares e impares de 0 até 100

int main() {

    // Define o valor das páginas de código UTF-8 e default do Windows
  	UINT CPAGE_UTF8 = 65001;
  	UINT CPAGE_DEFAULT = GetConsoleOutputCP();

  	// Define codificação como sendo UTF-8
  	SetConsoleOutputCP(CPAGE_UTF8);
    printf("***************************\n");
    printf("Números pares de 0 até 100 \n");
    printf("***************************\n\n");
    for (int pares = 0; pares <= 100; pares++) {

        if(pares % 2 == 0){
            printf("%d\n", pares);
            
                    
        }



    }

        printf("************************\n");
        printf("Números impares até 99 \n");
        printf("************************\n\n");
        for (int impares = 1; impares <= 99; impares++) {

        if(impares % 2 != 0){
            printf("%d\n", impares);
        
        }

            

    }
        printf("Até logo...'Copy not comedy' \n");

    return 0;
} 