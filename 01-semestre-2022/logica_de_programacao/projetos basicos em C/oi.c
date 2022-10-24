/*
Cliente: CarFree
Objetivo: 
1. O Algoritmo deverá calcular e exibir o desconto para os clientes
2. O Desconto deve ser de acordo com o ano do veículo
3. Veiculos 2010 o desconte e de 12%;
para veiculos acima de 2010 desconto de 7%
4. O Algoritmo deve ao final da geração do desconto, solicitar se o
usuário deseja realizar um novo cáculo de desconto,
até que a resposta seja N-NÃO.
Autor: Nelson Felipe Silveira dos Santos
*/

#include <stdio.h>
#include <string.h>
int main()
{
char continuar[20]; // S pa sim continuar com o programa
int ano;
float valor;
do
{
printf("Digite o ano do veiculo: ");
scanf(" %d", &ano);
printf("Digite o valor do veiculo: ");
scanf(" %f", &valor);
printf("\nRealizando o calculo de desconto...\n\n");
if(ano > 2010)
{
valor *= 0.12;
}
else
{
valor *= 0.07;
}
printf("Veiculo do ano %d saira por R$ %.2f.\n\n", ano, valor);
printf("Quer realizar um outro orcamento?\nDigite 'S' Sim e 'N' Nao.\n");
scanf(" %s", continuar);
}
while(strcmp(continuar, "N") != 0);
printf("exit...\n");
} 

