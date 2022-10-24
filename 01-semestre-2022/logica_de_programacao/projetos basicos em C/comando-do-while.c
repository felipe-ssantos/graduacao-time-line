//conceito de repetição com teste no final 'do while'

#include <stdio.h>

int main()
{
    int x, fat;
    printf("Entre o valor de n (0 <= n <13)):");
    scanf("%d", &x);
    fat = 1;
    do
    {
        /* code */
        fat = fat * x;
        x--; /* equivalente a: x = x-1 */
    } while (x >  1);
    
    printf("resultado= %d\n", fat);
    return 0;
}