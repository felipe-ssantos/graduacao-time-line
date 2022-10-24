// conceito de repetição incondicional

#include <stdio.h>

int main()
{
    /* code */
    int i, soma;//variavel, o 'i' vai funcionar até ele chegar em 9
    soma = 0;
    for(i=0; i<3;i++)//Ficara rodando enquanto ele for menor ou igual a 3 fazendo de 1 em 1
    {
        if ( (i % 3) == 0 )//Td q esta no 'if' o comando 'for' repetira Isso e uma função, significa que  quando ele faz essa divisão o resto e'0', se o resto for igual a zero deve ser exibido.
        //A função testara se o número em 'for' e divisivel por 3, se for exibira, caso não seja pulara para o próximo e testara novamente ate encerrar.
    { printf( "\t%2d\n", i ); soma += i; }  // a linha do for que gera os comandos que estão aqui dentro.  

    printf( "\t soma = %d\n", soma);
   
} 
}
