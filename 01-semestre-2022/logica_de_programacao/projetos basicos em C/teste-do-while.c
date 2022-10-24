#include <stdio.h>

int main()
{
int numero, soma;

numero = 1;
soma = 0;

    do
{
    if (numero % 2 == 0)
    {
    soma = soma + numero;
    numero = numero +1;
    }
    while (numero <= 100);
}

printf("A soma dos números pares de 1 a 100 é: %d\n", soma);

return 0;

}