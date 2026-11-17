
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Banque\CompteCourant;
use Banque\CompteEpargne;

// Compte Courant
$compte1 = new CompteCourant("C001", "Ali", 1000, 500);

$compte1->retirer(1200);

echo $compte1->afficher() . PHP_EOL;


// Compte Epargne
$compte2 = new CompteEpargne("E001", "Sara", 1000, 0.03);

$compte2->ajouterInterets();

echo $compte2->afficher() . PHP_EOL;
