<?php

$q1 = $_POST['q1'] ?? '';
$q2 = $_POST['q2'] ?? '';
$q3 = $_POST['q3'] ?? '';
$q4 = $_POST['q4'] ?? '';
$q5 = $_POST['q5'] ?? '';
$q6 = $_POST['q6'] ?? '';
$q7 = $_POST['q7'] ?? '';
$q8 = $_POST['q8'] ?? '';
$q9 = $_POST['q9'] ?? '';
$q10 = $_POST['q10'] ?? '';
$q11 = $_POST['q11'] ?? '';
$q12 = $_POST['q12'] ?? '';
$q13 = $_POST['q13'] ?? '';
$q14 = $_POST['q14'] ?? '';

$points = [
    'seche' => 0,
    'grasse' => 0,
    'mixte' => 0,
    'normale' => 0,
    'mature' => 0,
    'sensible' => 0,
    'acneique' => 0
];

if ($q1 === 'oui') {
    $points['seche']++;
    $points['sensible']++;
}

if ($q2 === 'oui') {
    $points['seche']++;
}

if ($q3 === 'oui') {
    $points['grasse']++;
}

if ($q4 === 'oui') {
    $points['grasse']++;
    $points['acneique']++;
}

if ($q5 === 'oui') {
    $points['grasse']++;
    $points['mixte']++;
}

if ($q6 === 'oui') {
    $points['seche']++;
    $points['mixte']++;
}

if ($q7 === 'oui') {
    $points['normale']++;
}

if ($q8 === 'oui') {
    $points['normale']++;
    $points['mixte']++;
}

if ($q9 === 'oui') {
    $points['mature']+=3;
}

if ($q10 === 'oui') {
    $points['mature']+=2;
}

if ($q11 === 'oui') {
    $points['sensible']+=2;
}

if ($q12 === 'oui') {
    $points['sensible']+=2;
}

if ($q13 === 'oui') {
    $points['acneique']+=2;
    $points['grasse']++;
}

if ($q14 === 'oui') {
    $points['acneique']+2;
}

$max_points = max($points);
$type_resultat = array_search($max_points, $points);

if ($type_resultat === 'seche') {
    $nom_type = 'Sèche';
} elseif ($type_resultat === 'grasse') {
    $nom_type = 'Grasse';
} elseif ($type_resultat === 'mixte') {
    $nom_type = 'Mixte';
} elseif ($type_resultat === 'normale') {
    $nom_type = 'Normale';
} elseif ($type_resultat === 'mature') {
    $nom_type = 'Mature';
} elseif ($type_resultat === 'sensible') {
    $nom_type = 'Sensible';
} else {
    $nom_type = 'Acnéique';
}

$sql = "SELECT id
        FROM types_peau
        WHERE nom = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$nom_type]);

$type_peau = $statement->fetch();

$type_peau_id = $type_peau['id'];

$sql = "SELECT 
            ingredients.id,
            ingredients.nom,
            ingredients.categorie,
            ingredients.bienfaits
        FROM ingredients
        INNER JOIN ingredients_types_peau
            ON ingredients.id = ingredients_types_peau.ingredient_id
        WHERE ingredients_types_peau.type_peau_id = ?
        ORDER BY ingredients.nom";

$statement = $pdo->prepare($sql);
$statement->execute([$type_peau_id]);

$ingredients = $statement->fetchAll();

?>

<h1>Ton résultat</h1>

<?php if ($type_resultat === 'seche') : ?>

<h2>Peau sèche</h2>
<p>Ta peau a tendance à manquer d'hydratation et peut donner une sensation de tiraillement.</p>

<?php elseif ($type_resultat === 'grasse') : ?>

<h2>Peau grasse</h2>
<p>Ta peau peut avoir tendance à briller et à présenter des imperfections.</p>

<?php elseif ($type_resultat === 'mixte') : ?>

<h2>Peau mixte</h2>
<p>Certaines parties de ton visage sont plus grasses tandis que d'autres sont plus sèches.</p>

<?php elseif ($type_resultat === 'normale') : ?>

<h2>Peau normale</h2>
<p>Ta peau semble équilibrée et confortable au quotidien.</p>

<?php elseif ($type_resultat === 'mature') : ?>

<h2>Peau mature</h2>
<p>Ta peau peut présenter de petites lignes et être moins souple qu'avant.</p>

<?php elseif ($type_resultat === 'sensible') : ?>

<h2>Peau sensible</h2>
<p>Ta peau peut devenir facilement rouge ou inconfortable et réagir à certains produits.</p>

<?php elseif ($type_resultat === 'acneique') : ?>

<h2>Peau acnéique</h2>
<p>Ta peau peut présenter régulièrement des boutons, des points noirs ou de petites imperfections.</p>

<?php endif ?>

<h2>Les ingrédients adaptés à ta peau</h2>

<?php foreach ($ingredients as $ingredient) : ?>

    <article>
        <h3><?= $ingredient['nom'] ?></h3>

        <a href="index.php?page=ingredient-details&id=<?= $ingredient['id'] ?>">
            Voir les détails
        </a>
    </article>

<?php endforeach ?>

<br>

<a href="index.php?page=questionnaire">
    Refaire le questionnaire
</a>