#include <stdio.h>
#include <stdlib.h>
int main() {
    int num;
   
        for(num = 0; num <= 100; num++)
         
    printf("Digite o numero de 0 ate 100: \n");
    scanf("%d", &num);
    if (num % 2 == 1){
        soma += num; //soma = soma + num
    }

    printf("Soma dos impares de 0 ate 100: %d\n\n", soma);

}
