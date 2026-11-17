<?php
declare(strict_types=1);

// ==================================================
// ETAPE 1 : LA FICHE D'UN STAGIAIRE
// ==================================================

echo "========== ETAPE 1 : STAGIAIRE ==========\n";

$stagiaire = [
    'nom' => 'Alami',
    'prenom' => 'Sara',
    'age' => 21,
    'filiere' => 'Développement digital',
    'notes' => [
        'php' => 16,
        'js' => 14,
        'sql' => 15
    ],
];


echo $stagiaire['prenom'] . " " .
    strtoupper($stagiaire['nom']) . ", " .
    $stagiaire['age'] . " ans, filière " .
    $stagiaire['filiere'] . PHP_EOL;


$stagiaire['ville'] = 'Casablanca';
$stagiaire['age'] = 22;

echo "Email : " .
    ($stagiaire['email'] ?? 'non renseigné') . PHP_EOL;


$stagiaire['telephone'] = null;

echo "isset telephone : ";
var_dump(isset($stagiaire['telephone']));

echo "array_key_exists telephone : ";
var_dump(array_key_exists('telephone', $stagiaire));


unset($stagiaire['ville']);


echo "Note PHP : " . $stagiaire['notes']['php'] . PHP_EOL;

$moyenne = array_sum($stagiaire['notes']) /
    count($stagiaire['notes']);

echo "Moyenne : " . round($moyenne, 2) . PHP_EOL;


foreach ($stagiaire['notes'] as $matiere => $note) {
    echo $matiere . " : " . $note . "/20" . PHP_EOL;
}


// ==================================================
// ETAPE 2 : LE PANIER D'ACHAT
// ==================================================

echo "\n========== ETAPE 2 : PANIER ==========\n";

$panier = [
    'Clavier' => 250,
    'Souris' => 90,
    'Ecran' => 1400,
    'Casque' => 320,
];


$total = array_sum($panier);

echo "Total du panier : $total MAD (" .
    count($panier) . " articles)" . PHP_EOL;


$prixMax = max($panier);
$prixMin = min($panier);

$produitCher = array_search($prixMax, $panier, true);
$produitMoinsCher = array_search($prixMin, $panier, true);

echo "Plus cher : $produitCher ($prixMax) | ";
echo "Moins cher : $produitMoinsCher ($prixMin)" . PHP_EOL;


$prixRemise = array_map(
    fn($prix) => round($prix * 0.90, 2),
    $panier
);

echo "Prix après remise :\n";

foreach ($prixRemise as $produit => $prix) {
    echo "$produit : $prix MAD" . PHP_EOL;
}


$articlesChers = array_filter(
    $panier,
    fn($prix) => $prix > 200
);

echo "Articles à plus de 200 MAD :\n";
print_r($articlesChers);


$parNom = $panier;
ksort($parNom);

echo "Tri par nom :\n";
print_r($parNom);

$parPrixCroissant = $panier;
asort($parPrixCroissant);

echo "Tri par prix croissant :\n";
print_r($parPrixCroissant);

$parPrixDecroissant = $panier;
arsort($parPrixDecroissant);

echo "Tri par prix décroissant :\n";
print_r($parPrixDecroissant);


$quantites = [
    'Clavier' => 2,
    'Souris' => 3,
    'Ecran' => 1,
    'Casque' => 2,
];

if (!array_key_exists('Webcam', $panier)) {
    $panier['Webcam'] = 180;
    $quantites['Webcam'] = 1;
} else {
    $quantites['Webcam'] =
        ($quantites['Webcam'] ?? 0) + 1;
}


echo "Panier final :\n";

foreach ($panier as $produit => $prix) {
    printf("%-10s %8.2f MAD\n", $produit, $prix);
}


// ==================================================
// ETAPE 3 : TABLEAUX MULTIDIMENSIONNELS
// ==================================================

echo "\n========== ETAPE 3 : CLASSE ==========\n";

$stagiaires = [
    [
        'nom' => 'Alami',
        'filiere' => 'Développement',
        'notes' => [16, 14, 15]
    ],
    [
        'nom' => 'Benani',
        'filiere' => 'Infrastructure',
        'notes' => [11, 13, 12]
    ],
    [
        'nom' => 'Chraibi',
        'filiere' => 'Développement',
        'notes' => [18, 17, 19]
    ],
    [
        'nom' => 'Daoudi',
        'filiere' => 'Infrastructure',
        'notes' => [9, 10, 8]
    ],
];


foreach ($stagiaires as &$s) {
    $s['moyenne'] = array_sum($s['notes']) /
        count($s['notes']);
}
unset($s);


$noms = array_column($stagiaires, 'nom');

echo "Liste des noms :\n";
print_r($noms);


$moyennes = array_column($stagiaires, 'moyenne', 'nom');

echo "Nom => Moyenne :\n";
print_r($moyennes);


usort(
    $stagiaires,
    fn($a, $b) => $b['moyenne'] <=> $a['moyenne']
);

echo "Classement :\n";

foreach ($stagiaires as $i => $s) {
    printf(
        "%d. %s (%.2f)\n",
        $i + 1,
        $s['nom'],
        $s['moyenne']
    );
}


$meilleur = $stagiaires[0];

echo "Meilleur stagiaire : " .
    $meilleur['nom'] . " (" .
    number_format($meilleur['moyenne'], 2) . ")" . PHP_EOL;

$moyenneGenerale = array_sum(
    array_column($stagiaires, 'moyenne')
) / count($stagiaires);

echo "Moyenne générale : " .
    number_format($moyenneGenerale, 2) . PHP_EOL;


$admis = array_filter(
    $stagiaires,
    fn($s) => $s['moyenne'] >= 10
);

echo "Stagiaires admis :\n";

foreach ($admis as $s) {
    echo $s['nom'] . " : " .
        number_format($s['moyenne'], 2) . PHP_EOL;
}


$parFiliere = [];

foreach ($stagiaires as $s) {
    $filiere = $s['filiere'];

    if (!isset($parFiliere[$filiere])) {
        $parFiliere[$filiere] = [];
    }

    $parFiliere[$filiere][] = $s;
}

echo "Statistiques par filière :\n";

foreach ($parFiliere as $filiere => $liste) {
    $moyennesFiliere = array_column($liste, 'moyenne');

    $moyenneFiliere = array_sum($moyennesFiliere) /
        count($moyennesFiliere);

    echo $filiere .
        " | Effectif : " . count($liste) .
        " | Moyenne : " .
        number_format($moyenneFiliere, 2) .
        PHP_EOL;
}


function mention(float $moyenne): string
{
    if ($moyenne < 10) {
        return 'Ajourné';
    }

    if ($moyenne < 12) {
        return 'Passable';
    }

    if ($moyenne < 14) {
        return 'Assez bien';
    }

    if ($moyenne < 16) {
        return 'Bien';
    }

    return 'Très bien';
}

foreach ($stagiaires as &$s) {
    $s['mention'] = mention($s['moyenne']);
}
unset($s);

echo "Mentions :\n";

foreach ($stagiaires as $s) {
    echo $s['nom'] . " : " .
        $s['mention'] . PHP_EOL;
}


// ==================================================
// ETAPE 4 : MINI-PROJET GESTION DE STOCK
// ==================================================

echo "\n========== ETAPE 4 : GESTION DE STOCK ==========\n";

$stock = [
    'P001' => [
        'designation' => 'Clavier',
        'prix' => 250.0,
        'quantite' => 12
    ],
    'P002' => [
        'designation' => 'Souris',
        'prix' => 90.0,
        'quantite' => 40
    ],
    'P003' => [
        'designation' => 'Ecran',
        'prix' => 1400.0,
        'quantite' => 5
    ],
];


function ajouterProduit(
    array &$stock,
    string $ref,
    string $designation,
    float $prix,
    int $qte
): bool {
    if (array_key_exists($ref, $stock)) {
        return false;
    }

    if ($prix < 0 || $qte < 0) {
        return false;
    }

    $stock[$ref] = [
        'designation' => $designation,
        'prix' => $prix,
        'quantite' => $qte
    ];

    return true;
}


function retirerStock(
    array &$stock,
    string $ref,
    int $qte
): bool {
    if (!array_key_exists($ref, $stock) || $qte <= 0) {
        return false;
    }

    if ($stock[$ref]['quantite'] < $qte) {
        return false;
    }

    $stock[$ref]['quantite'] -= $qte;

    return true;
}


function valeurTotale(array $stock): float
{
    $total = 0.0;

    foreach ($stock as $produit) {
        $total += $produit['prix'] * $produit['quantite'];
    }

    return $total;
}


function produitsEnRupture(
    array $stock,
    int $seuil = 10
): array {
    return array_filter(
        $stock,
        fn($produit) => $produit['quantite'] < $seuil
    );
}


function afficherStock(array $stock): void
{
    echo "Référence   Désignation       Prix       Quantité\n";
    echo "--------------------------------------------------\n";

    foreach ($stock as $ref => $produit) {
        printf(
            "%-12s %-17s %8.2f MAD %5d\n",
            $ref,
            $produit['designation'],
            $produit['prix'],
            $produit['quantite']
        );
    }
}


echo "Ajout P004 : ";

var_dump(
    ajouterProduit($stock, 'P004', 'Clavier Gamer', 450.0, 8)
);

echo "Ajout doublon P004 : ";

var_dump(
    ajouterProduit($stock, 'P004', 'Autre clavier', 300.0, 5)
);

echo "Retrait de 3 claviers : ";

var_dump(
    retirerStock($stock, 'P001', 3)
);

echo "Retrait de 100 écrans : ";

var_dump(
    retirerStock($stock, 'P003', 100)
);


echo "\nStock final :\n";
afficherStock($stock);


echo "\nValeur totale du stock : " .
    number_format(valeurTotale($stock), 2) .
    " MAD" . PHP_EOL;


echo "\nProduits en rupture (seuil 10) :\n";

$rupture = produitsEnRupture($stock);

foreach ($rupture as $ref => $produit) {
    echo $ref . " - " .
        $produit['designation'] .
        " : " . $produit['quantite'] .
        " unités" . PHP_EOL;
}
