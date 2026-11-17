<?php

function additionner(float $a, float $b): float {
    return $a + $b;
}

function soustraire(float $a, float $b): float {
    return $a - $b;
}

function multiplier(float $a, float $b): float {
    return $a * $b;
}

function diviser(float $a, float $b): float {
    if ($b == 0) {
        throw new InvalidArgumentException("Division par zéro impossible");
    }
    return $a / $b;
}

function estPair(int $n): bool {
    return $n % 2 == 0;
}

function estPositif(float $n): bool {
    return $n > 0;
}

function maximum(float $a, float $b, float $c): float {
    $max = $a;
    if ($b > $max) {
        $max = $b;
    }
    if ($c > $max) {
        $max = $c;
    }
    return $max;
}

function maximum2(float $a, float $b, float $c): float {
    return max($a, $b, $c);
}

function estPremier(int $n): bool {
    if ($n < 2) {
        return false;
    }
    for ($i = 2; $i <= floor(sqrt($n)); $i++) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}