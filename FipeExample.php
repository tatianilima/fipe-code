<?php
require_once 'SplClassLoader.php';

$autoloader = new SplClassLoader();
$autoloader->register();

use Fipe\Fipe;


echo '<pre>'; //Format array;

#Lookfor A BIKE cotation

echo '######################## MOTO ###########################<br>';

//initialize the APP Fipe
$fipe = new Fipe(Fipe::MOTOS);
//get all trands
$fipe->marcas();
//get one model of the vehicle, you can do it through of one foreach;
$fipe->modelos(80);
// get the list of the years of factored and the year of the model.
$fipe->anoModelo(80, '811094-8');
// get cotation of the vehicle
print_r($fipe->anoModeloCotacao(80, '811094-8', '623906'));

#Lookfor a CAR cotation

echo '######################## CARRO ###########################<br>';

//initialize the APP Fipe
$fipe = new Fipe(Fipe::CARROS);
//get all trands
$fipe->marcas();
//get one model of the vehicle, you can do it through of one foreach;
$fipe->modelos(59);
// get the list of the years of factored and the year of the model.
$fipe->anoModelo(59, '005275-2');
// get cotation of the vehicle
print_r($fipe->anoModeloCotacao(59, '005275-2', '2457516'));


#Lookfor a TRUNCK cotation

echo '######################## CAMINHÃO ###########################<br>';

//initialize the APP Fipe
$fipe = new Fipe(Fipe::CAMINHOES);
//get all trands
$fipe->marcas();
//get one model of the vehicle, you can do it through of one foreach;
$fipe->modelos(105);
// get the list of the years of factored and the year of the model.
$fipe->anoModelo(105, '504144-9');
// get cotation of the vehicle
print_r($fipe->anoModeloCotacao(105, '504144-9', '983845'));






