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
//matriz 3 por 3. Exemplo: três andares e três apartamentos por andar
int matriz[3][3] = { {10, 20, 30,}, {40, 50, 60}, {70, 80, 90} }, i, j;
//o 'i' e o primeiro [3] quantidade de vetores, linha dos andares; O 'J' são os andares três vetores
for ( i = 0 ; i < 3; i++ ) 
//variavel 'i'
// na estrutura de repetição 'for' não se encerra o código com ';' ou ponto e virgula.
    for ( j = 0 ; j < 3; j++ )
    //variavel j
{

printf("\nElementos[%d][%d] = %d\n", i, j, matriz[i][j]);

    

}

getch();
return 0;
}