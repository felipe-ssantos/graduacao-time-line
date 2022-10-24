/*Conceito de acumulador, a diferença dele
para o conceito anterior "contador", é que no caso
do acumulador quem vai entrar com o valor é o
usuário. Para eu acumular, eu preciso ter algo para
eu ir acumulando, e isso que define e o usuário. */

#include <stdio.h>

int main()
{
    int acum = 0; //1 variavel: Caixa onde vamos guardar todos os valores
    int cont=0; //2 variavel: Vai funcionar como contador 
    int y=0;//3 variavel: Onde vamos guardar o valor que o usuário vai digitar

    do
    {
        /* code */
        printf("valor =");// frase pedindo para o usuário digitar o valor
        scanf("%d", &y);//
        acum=acum+y;//Variavel que acumula os valores digitados. Somando esse valor digitado pelo usuário nesta variavel, no caso um input ou entrada
        cont++;// variavel que efetua a contagem (contador), contar de 1 em 1 2 em 2...          
    }       while( cont < 3);//Quantas vezes devo digitar os valores
    
    printf("ACUMULAMOS !!!! %d", acum);


}