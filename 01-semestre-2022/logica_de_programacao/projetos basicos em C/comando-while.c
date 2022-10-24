// conceito de repetição com teste no inicio 'while'
// fatorial conceito da matematica, se tenho 4! exemplo vezes ele menos um 4*3*2*1 = 24
#include <stdio.h>

    int main()
    {
        int n, i, fatorial;
        printf("Entre o valor de n (0 <= n < 13): ");
        scanf("%d", &n);
        fatorial = 1;//onde estamos fazendo a conta
        i = 1;// 'i' vale 1, pode valer 2, 3 até chegar no fatorial
        while (i <= n)// enquanto 'i' for menor do que 'n'
        {
            /* 'n' e o número que a pessoa escolhe para que seja mostrado
            o fatorial */
            fatorial = fatorial * i;
            i++;// somando de 1 em 1
        }
        
        printf("%d! = %d\n", n, fatorial);
        return 0;
    }