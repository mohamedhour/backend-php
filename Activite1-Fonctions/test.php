<?php
require_once __DIR__ . "/fonctions.php";

echo "12 + 8 = " . additionner(12, 8) . PHP_EOL;
echo "12 - 8 = " . soustraire(12, 8) . PHP_EOL;
echo "12 * 8 = " . multiplier(12, 8) . PHP_EOL;
echo "12 / 8 = " . diviser(12, 8) . PHP_EOL;

try {
    echo diviser(5, 0);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo "7 est pair ? " . (estPair(7) ? "oui" : "non") . PHP_EOL;
echo "-3 est positif ? " . (estPositif(-3) ? "oui" : "non") . PHP_EOL;
echo "Le maximum de 4, 9 et 6 est " . maximum(4, 9, 6) . PHP_EOL;
echo "Le maximum avec max() est " . maximum2(4, 9, 6) . PHP_EOL;
echo "17 est premier ? " . (estPremier(17) ? "oui" : "non") . PHP_EOL;
echo "18 est premier ? " . (estPremier(18) ? "oui" : "non") . PHP_EOL;