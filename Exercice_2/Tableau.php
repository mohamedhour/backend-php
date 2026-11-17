<?php
declare(strict_types=1);

$notes = [12, 15, 8, 17, 9, 14, 11];
$prenoms = ['Sara', 'Youssef', 'Imane', 'Omar', 'Khadija'];

// ETAPE 1 : Lecture et parcours

echo "Premier : " . $notes[0] . PHP_EOL;
echo "Dernier : " . $notes[array_key_last($notes)] . PHP_EOL;
echo "Nombre : " . count($notes) . PHP_EOL;

for ($i = 0; $i < count($notes); $i++) {
    echo "Note n°" . ($i + 1) . " : " . $notes[$i] . PHP_EOL;
}

foreach ($prenoms as $i => $prenom) {
    echo ($i + 1) . ". " . $prenom . PHP_EOL;
}

// ETAPE 2 : Ajouter et retirer

$copie = $notes;

$copie[] = 16;
array_push($copie, 16);
array_unshift($copie, 10);

$derniere = array_pop($copie);
$premiere = array_shift($copie);

echo "Dernière retirée : $derniere\n";
echo "Première retirée : $premiere\n";

array_splice($copie, 2, 0, [13]);

unset($copie[1]);
print_r($copie);

$copie = array_values($copie);
print_r($copie);

// ETAPE 3 : Recherche

echo in_array(17, $notes) ? "17 existe\n" : "17 absent\n";

$indice = array_search(9, $notes);

if ($indice !== false) {
    echo "9 se trouve à l'indice $indice\n";
}

echo in_array("Omar", $prenoms) ? "Omar existe\n" : "Omar absent\n";

// ETAPE 4 : Statistiques

$somme = array_sum($notes);
$moyenne = $somme / count($notes);

echo "Somme : $somme\n";
echo "Moyenne : " . round($moyenne, 2) . "\n";
echo "Minimum : " . min($notes) . "\n";
echo "Maximum : " . max($notes) . "\n";

$admisBoucle = 0;

foreach ($notes as $note) {
    if ($note >= 10) {
        $admisBoucle++;
    }
}

$admis = array_filter($notes, fn($n) => $n >= 10);

echo "Admis : $admisBoucle\n";
echo "Admis avec filter : " . count($admis) . "\n";

echo "Réussite : " .
    round(count($admis) / count($notes) * 100, 2) . "%\n";

$copieMediane = $notes;
sort($copieMediane);

$milieu = intdiv(count($copieMediane), 2);
$mediane = $copieMediane[$milieu];

echo "Médiane : $mediane\n";

// ETAPE 5 : Tri

$croissant = $notes;
sort($croissant);

$decroissant = $notes;
rsort($decroissant);

$troisMeilleures = array_slice($decroissant, 0, 3);

echo "Croissant : " . implode(", ", $croissant) . "\n";
echo "Décroissant : " . implode(", ", $decroissant) . "\n";
echo "Top 3 : " . implode(", ", $troisMeilleures) . "\n";

$prenomsTries = $prenoms;
sort($prenomsTries);

print_r($prenomsTries);
print_r(array_reverse($prenomsTries));

// ETAPE 6 : Map, filter, reduce

$bonus = array_map(fn($n) => min($n + 1, 20), $notes);

$admis = array_values(
    array_filter($notes, fn($n) => $n >= 10)
);

$total = array_reduce(
    $notes,
    fn($cumul, $n) => $cumul + $n,
    0
);

$majuscules = array_map("strtoupper", $prenoms);

$mentions = array_map(function ($n) {
    if ($n < 10) return "$n → Ajourné";
    if ($n < 14) return "$n → Passable";
    if ($n < 16) return "$n → Assez bien";
    return "$n → Bien";
}, $notes);

print_r($bonus);
print_r($admis);
echo "Total : $total\n";
print_r($majuscules);
print_r($mentions);

// ETAPE 7 : Chaînes et ensembles

echo implode(", ", $prenoms) . "\n";

$langages = explode(",", "php,js,sql,php,html,js");
$langages = array_unique($langages);

print_r($langages);

$fusion = array_unique(
    array_merge(["php", "sql"], ["js", "sql"])
);

print_r($fusion);

$a = ["php", "js", "sql"];
$b = ["js", "html", "sql"];

print_r(array_intersect($a, $b));
print_r(array_diff($a, $b));

print_r(array_chunk(range(1, 10), 3));

// ETAPE 8 : Carnet de notes

function moyenneNotes(array $notes): float
{
    return count($notes) === 0
        ? 0
        : array_sum($notes) / count($notes);
}

function medianeNotes(array $notes): float
{
    if (empty($notes)) return 0;

    sort($notes);
    $n = count($notes);
    $milieu = intdiv($n, 2);

    if ($n % 2 === 0) {
        return ($notes[$milieu - 1] + $notes[$milieu]) / 2;
    }

    return (float) $notes[$milieu];
}

function admisNotes(array $notes, float $seuil = 10): array
{
    return array_values(
        array_filter($notes, fn($n) => $n >= $seuil)
    );
}

function meilleures(array $notes, int $n = 3): array
{
    rsort($notes);
    return array_slice($notes, 0, $n);
}

function histogramme(array $notes): void
{
    foreach ($notes as $note) {
        echo $note . " : " . str_repeat("*", (int)$note) . PHP_EOL;
    }
}

echo "Moyenne : " . moyenneNotes($notes) . "\n";
echo "Médiane : " . medianeNotes($notes) . "\n";

histogramme($notes);