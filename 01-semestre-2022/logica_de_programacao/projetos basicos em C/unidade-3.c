// Conceito de repetição - Looping: Significar repetir um trecho do programa

#include <stdio.h>
int main()
{
int x, fat;
printf("Quantas vezes tenho que repetir?: ");
scanf("%d", &x);

// Pedaço inicio que será repetido
while (x > 0)
{   // isso será repetido
    printf(" repetindo...\n");
    x--;
} // até aqui!!!
// Pedaço fim que será repetido

return 0;

}