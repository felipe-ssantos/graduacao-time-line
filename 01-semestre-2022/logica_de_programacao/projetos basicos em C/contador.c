//conceito de contador

#include <stdio.h>

int main()
{
    int contador = 0; //variavel contador começar do zero, de onde estou partindo
    do
    {
        /* code */
        printf( "contador = %d\n", contador );
        contador += 1; // A cada passagem neste comando ele vai somando um
    }       while( contador <= 10 ); /*Fara isso até que a variavel seja menor do que 5 ou número que você definir, 
    aqui e onde se está chegando */
        
    printf("ACABOU !!!\n");


}