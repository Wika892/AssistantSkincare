<?php

$id = $_GET['id'] ?? null;

$sql = "SELECT id, nom, description, caracteristiques, besoins
        FROM types_peau
        WHERE id = ?";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$type_peau = $statement->fetch();

$sql = "SELECT i.id, i.nom
        FROM ingredients i
        INNER JOIN ingredients_types_peau itp
            ON itp.ingredient_id = i.id
        WHERE itp.type_peau_id = ?
        ORDER BY i.nom";

$statement = $pdo->prepare($sql);
$statement->execute([$id]);

$ingredients = $statement->fetchAll();

?>

<h1>Peau <?= $type_peau['nom'] ?></h1>

<h2>Qu'est-ce qu'une peau <?= $type_peau['nom'] ?> ?</h2>
<p><?= $type_peau['description'] ?></p>

<h2>Ses Caractéristiques:</h2>
<ul>
    <?php foreach (explode('|', $type_peau['caracteristiques']) as $caracteristique) : ?>
        <li><?= $caracteristique ?></li>
    <?php endforeach ?>
</ul>

<h2>Besoins de la peau</h2>

<ul>
    <?php foreach (explode('|', $type_peau['besoins']) as $besoin) : ?>
        <li><?= $besoin ?></li>
    <?php endforeach ?>
</ul>


<h2>Ingrédients adaptés:</h2>

<?php foreach ($ingredients as $ingredient) : ?>

    <p>
        <a href="index.php?page=ingredient-details&id=<?= $ingredient['id'] ?>">
            <?= $ingredient['nom'] ?>
        </a>
    </p>

<?php endforeach ?>