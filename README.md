fipeCode - Biblioteca para busca de valores de veículos na tabela FIPE
========

Obs: Este código é de exemplo, para realizar a utilização de forma correta, realize a persistência  dos dados no MySQL, Postgres e etc.

Importe os dados da tabela FIPE (http://www.fipe.org.br) para seu banco de dados de maneira simples e rápida. Siga o manual abaixo:


Declare em seu componser.json

"repositories": [
	{
		"type": "vcs",
		"url": "https://github.com/jhonjoya-tray/fipeCode"
	}
],
"require": {
	"honjoya/fipecode": "master"
}
	


1 - Utilize autoload PSR-0 (http://www.php-fig.org/psr/psr-0/pt-BR/)

2 - Estrututa sugeria:
    /
    /vendors/Fipe
    
3 - Exemplods de uso em junto com as libs, através do arquivo FipeExample.php

4 - Exemplo código para consulta

```php
use Fipe\Fipe;


echo '<pre>'; //Format array;

#Lookfor A BIKE cotation

echo '######################## MOTO ###########################<br>';

//initialize the APP Fipe
$fipe = new Fipe(Fipe::MOTOS);
//get all brands
$fipe->marcas();
//get one model of the vehicle, you can do it through of one foreach;
$fipe->modelos(80);
// get the list of the years of factored and the year of the model.
$fipe->anoModelo(80, '811094-8');
// get cotation of the vehicle
print_r($fipe->anoModeloCotacao(80, '811094-8', '623906'));
```

5 - RESULTADOS APRESENTADOS:

```php

######################## MOTO ###########################
Array
(
    [codigo_tabela_fipe] => 811094-8
    [marca] => HONDA
    [modelo] => CG 150 TITAN-KS MIX
    [ano_modelo] => 2011
    [valor_medio] => R$ 5.301,00
    [mes_referencia] => Dezembro de 2014
)
######################## CARRO ###########################
Array
(
    [codigo_tabela_fipe] => 005275-2
    [marca] => VW - VolksWagen
    [modelo] => Gol (novo) 1.0 Mi Total Flex 8V 4p
    [ano_modelo] => 2010 Gasolina
    [valor_medio] => R$ 20.746,00
    [mes_referencia] => Dezembro de 2014
)
######################## CAMINHAO ###########################
Array
(
    [codigo_tabela_fipe] => 504144-9
    [marca] => FORD
    [modelo] => CARGO 3133 E 6x4 Turbo 2p (diesel)(E5)
    [ano_modelo] => 2013
    [valor_medio] => R$ 218.458,00
    [mes_referencia] => Dezembro de 2014
)
```

6 - É necessário a execução de todos os processos desde a obtenção de marcas, devido a utilização do viewstate.

7 - Library aberta para utilização e melhorias.

8 - Lembre-se, utilize com moderação devido ao numeros de requisições realizadas, armazene estes dados em seu 
banco de dados e atualize uma vez ao mês
