#include <stdio.h>
#include <locale.h>
#include <windows.h>

/******************************************************************************


Disciplina  : [Linguagem e Lógica de Programação]
Descrição   : Realizar uma estatística nas cidades pertencentes ao estado do Paraná.
Autor(a)    : Nelson Felipe Siveira dos Santos
Data atual  : 06/06/2022


*******************************************************************************/


int main()

{

    // Define o valor das páginas de código UTF-8 e default do Windows
  	UINT CPAGE_UTF8 = 65001;
  	UINT CPAGE_DEFAULT = GetConsoleOutputCP();

  	// Define codificação como sendo UTF-8
  	SetConsoleOutputCP(CPAGE_UTF8);

   // Variáveis de entrada

   int input = 1;
    // 'int' e o mesmo que inteiro
   int cod_municipio, num_veiculos, num_acidentes;
    // 'char' e o mesmo que caractere
   char continuar;

   //int continuar = 1;

   // Declarando variáveis de Retorno

   int cod_menor_cidade = 0;

   int cod_maior_cidade = 0;

   int cod_maior_acidente = 0;

   int cod_menor_acidente = 0;

   int soma_de_veiculos = 0;

   int soma_acidentes_menor_2000 = 0;

   int num_cidades = 0;

   int num_cidades_veiculos_menor_2000 = 0;

   int ind_maior_acidentes = 0;

   int ind_menor_acidentes = 0;

   int ind_menor_cidade = 0;

   int ind_maior_cidade = 0;

   float med_de_veiculos = 0;

   float med_de_acidentes_menor_2000 = 0;

   

   do

   {

       printf("\n----------------------------------------------------------------\n");

       printf("     Estatisticas de acidentes no Paraná %d\n", input);

       printf("----------------------------------------------------------------\n");

       printf(" 1- Digite o Código do Municipio: ");

       scanf("%d", &cod_municipio);

       printf(" 2- Digite a quantidade de Veículos: ");

       scanf("%d", &num_veiculos);

       printf(" 3- Digite a quantidade de Acidentes: ");

       scanf("%d", &num_acidentes);

       

       soma_de_veiculos += num_veiculos;

       num_cidades += 1;

       

       if (num_acidentes < ind_menor_cidade || ind_menor_cidade == 0)

           {

               cod_menor_cidade = cod_municipio;

               ind_menor_cidade = num_acidentes;

           }

       

       if (num_acidentes > ind_maior_cidade || ind_maior_cidade == 0)

           {

               cod_maior_cidade = cod_municipio;

               ind_maior_cidade = num_acidentes;

           }

           

       if (num_veiculos < 2000)

           {

               soma_acidentes_menor_2000 += num_acidentes;

               num_cidades_veiculos_menor_2000 += 1;

           }

           

       if (num_acidentes < ind_menor_acidentes || ind_menor_acidentes == 0)

           {

               cod_menor_acidente = cod_municipio;

               ind_menor_acidentes = num_acidentes;

           }

       

       if (num_acidentes > ind_maior_acidentes || ind_maior_acidentes == 0)

           {

               cod_maior_acidente = cod_municipio;

               ind_maior_acidentes = num_acidentes;

           }

      

       printf("\n** Digite 'Sim' para Continuar ou 'Não' para Sair: ");

       scanf("%s", &continuar); 

       input = input + 1;


   } while (continuar == 's');

   

   printf("\n");

   printf("----------------------------------------------------------------\n");

   printf("     RESULTADO para %d Cidades\n", input - 1);

   printf("----------------------------------------------------------------\n");

   

   med_de_veiculos = (soma_de_veiculos/num_cidades);

   med_de_acidentes_menor_2000 = (soma_acidentes_menor_2000/num_cidades_veiculos_menor_2000);

   

   printf(" - Menor Índice de acidentes: %d\n", ind_menor_acidentes);

   printf(" - Cidade com Menor Índice de acidentes: %d\n", cod_menor_cidade);

   printf(" - Maior Índice de acidentes: %d\n", ind_maior_acidentes);

   printf(" - Cidade com Maior Índice de acidentes: %d\n", cod_maior_cidade);

   printf(" - Média de Veiculos de Todas as Cidades: %.1f\n", med_de_veiculos);

   printf(" - Média de Acidentes de Cidades com Menos de 2000 veículos de passeio: %.1f\n\n", med_de_acidentes_menor_2000);


   printf("----------------------------------------------------------------\n");

   return 0;

}