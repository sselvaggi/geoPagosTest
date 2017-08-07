<?php 
include 'vendor/autoload.php';
include 'index.php';

$usuario1=new Usuario('Juan', '1234', 18);
$usuario2=new Usuario('Pedro', '1234', 21);

$usuario1->agregarFavorito($usuario2);
$usuario2->agregarFavorito($usuario1);

$pago = new Pago($usuario1, 100.3, '2017-01-10');


print_r($usuario1);
print_r($usuario2);
print_r($pago);