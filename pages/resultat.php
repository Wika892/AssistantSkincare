<?php

$q1 = $_POST['q1'] ?? '';
$q2 = $_POST['q2'] ?? '';
$q3 = $_POST['q3'] ?? '';
$q4 = $_POST['q4'] ?? '';
$q5 = $_POST['q5'] ?? '';
$q6 = $_POST['q6'] ?? '';

if (
    $q1 === '' ||
    $q2 === '' ||
    $q3 === '' ||
    $q4 === '' ||
    $q5 === '' ||
    $q6 === ''
) {
    header("Location: index.php?page=questionnaire&erreur=1");
    exit;
}

$points = [
    'seche' => 0,
    'grasse' => 0,
    'mixte' => 0,
    'normale' => 0
];

if ($q1 === 'oui') {
    $points['seche']++;
} else {
    $points['normale']++;
}

if ($q2 === 'oui') {
    $points['grasse']++;
} else {
    $points['seche']++;
}

if ($q3 === 'partout') {
    $points['grasse']++;
} elseif ($q3 === 'zone_t') {
    $points['mixte']++;
} else {
    $points['normale']++;
}

if ($q4 === 'oui') {
    $points['mixte']++;
} else {
    $points['normale']++;
}

if ($q5 === 'oui') {
    $points['grasse']++;
} else {
    $points['mixte']++;
}

if ($q6 === 'oui') {
    $points['normale']++;
} else {
    $points['seche']++;
}

$type_resultat = array_search(max($points), $points);

$type_peau_id = null;

if ($type_resultat === 'seche') {
    $nom_type = 'Sèche';
} elseif ($type_resultat === 'grasse') {
    $nom_type = 'Grasse';
} elseif ($type_resultat === 'mixte') {
    $nom_type = 'Mixte';
} else {
    $nom_type = 'Normale';
}

$sql = "SELECT id
        FROM types_peau
        WHERE nom = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$nom_type]);

$type_peau = $statement->fetch();

$type_peau_id = $type_peau['id'];

$sql = "SELECT id, nom, categorie, bienfaits
        FROM ingredients
        WHERE type_peau_id = ?";

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
    <p>Ta peau produit davantage de sébum et peut avoir tendance à briller.</p>

<?php elseif ($type_resultat === 'mixte') : ?>

    <h2>Peau mixte</h2>
    <p>Ta zone T peut être plus grasse tandis que tes joues sont plus sèches.</p>

<?php elseif ($type_resultat === 'normale') : ?>

    <h2>Peau normale</h2>
    <p>Ta peau semble équilibrée et confortable au quotidien.</p>

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